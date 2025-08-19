<?php

namespace App\Http\Controllers\api\v1;

use App\Models\TvSerie;
use App\Models\Trailer;
use App\Models\ImageFile;
use App\Models\VideoFile;
use Illuminate\Http\Request;
use App\Helpers\ResponseMessages;
use App\Helpers\FileUploadHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\api\v1\TvSeriesResource;
use App\Http\Resources\api\v1\TvSeriesCollection;
use App\Http\Requests\api\v1\TvSeriesStoreRequest;
use App\Http\Requests\api\v1\TvSeriesUpdateRequest;

class TvSerieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Authorization for viewing TV series
        $this->authorize('viewAny', TvSerie::class);
    
        // Initialize query with eager loading for basic TV series data
        $query = TvSerie::query()
            ->with(['category', 'imageFiles' => function($query) {
                $query->wherePivot('type', 'poster')->limit(1);
            }]);
    
        // User can see only published and coming soon TV series but not draft
        if (Auth::user()->role->role_name === 'user') {
            $query->whereIn('status', ['published', 'coming soon']);
        }
    
        // Apply filters from request parameters
        $filterData = $request->all();
        foreach ($filterData as $key => $value) {
            if (in_array($key, ['tv_series_id', 'title', 'year', 'total_seasons', 'imdb_rating', 'status', 'category_id'])) {
                // Use exact match for numeric IDs, LIKE for text fields
                if (in_array($key, ['tv_series_id', 'category_id', 'year', 'total_seasons'])) {
                    $query->where($key, '=', $value);
                } else {
                    $query->where($key, 'LIKE', "%$value%");
                }
            }
        }
    
        // Order by creation date (newest first) and execute query with pagination
        $tvSeries = $query->orderBy('created_at', 'desc')->paginate(20);
    
        return new TvSeriesCollection($tvSeries);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TvSeriesStoreRequest $request)
    {
        // Authorization for creating a TV series
        $this->authorize('create', TvSerie::class);

        $validatedData = $request->validated();
        
        $fileFields = [
            'trailer_video'
        ];
        $tvSeriesData = collect($validatedData)->except($fileFields)->toArray();

        // Create the TV series
        $tvSeries = TvSerie::create($tvSeriesData);

        // Handle poster and backdrop URLs directly
        // These are already uploaded via /api/v1/upload/image endpoint
        
        // 1. Poster URL - find existing ImageFile by URL
        if ($request->has('poster')) {
            $posterImage = ImageFile::where('url', 'LIKE', '%' . basename($request->poster) . '%')
                                    ->where('type', 'poster')
                                    ->first();
            if ($posterImage) {
                $tvSeries->imageFiles()->attach($posterImage->image_id, ['type' => 'poster']);
            }
        }

        // 2. Backdrop URL - find existing ImageFile by URL
        if ($request->has('backdrop')) {
            $backdropImage = ImageFile::where('url', 'LIKE', '%' . basename($request->backdrop) . '%')
                                      ->where('type', 'backdrop')
                                      ->first();
            if ($backdropImage) {
                $tvSeries->imageFiles()->attach($backdropImage->image_id, ['type' => 'backdrop']);
            }
        }

        // Upload trailer video
        if ($request->hasFile('trailer_video')) {
            $trailerFile = $request->file('trailer_video');
            $fileData = FileUploadHelper::uploadVideo($trailerFile);
            
            // Automatic generation of title description
            $trailerTitle = $request->title . ' - Trailer';
            
            $trailerVideo = VideoFile::create([
                'url' => $fileData['url'],
                'title' => $trailerTitle, // Il titolo contiene 'Trailer' per identificarlo
                'format' => $fileData['format'] ?? 'mp4', // Default format if missing
                'resolution' => isset($fileData['width']) && isset($fileData['height']) ? $fileData['width'].'x'.$fileData['height'] : null,
            ]);
            
            $tvSeries->videoFiles()->attach($trailerVideo->video_file_id);
        }
        
        // Attach persons (actors) to the TV series
        if ($request->has('persons')) {
            $tvSeries->persons()->sync($request->persons);
        }

        // Attach trailers
        if ($request->has('trailers')) {
            foreach ($request->trailers as $trailerData) {
                $trailer = Trailer::create($trailerData);
                $tvSeries->trailers()->attach($trailer->trailer_id);
            }
        }

        // Attach image files
        if ($request->has('image_files')) {
            foreach ($request->image_files as $imageData) {
                $imageFile = ImageFile::create($imageData);
                $tvSeries->imageFiles()->attach($imageFile->image_id);
            }
        }

        return ResponseMessages::success(['message' => 'TV Series created successfully', 'tv_series' => new TvSeriesResource($tvSeries)], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(TvSerie $tvSerie)
    {
        $this->authorize('view', $tvSerie);

        // Eager load all relationships for detailed view
        $tvSerie->load([
            'category',
            'persons.imageFiles',  // Eager load imageFiles with persons
            'trailers',
            'imageFiles',
            'videoFiles',  // Load video files for streaming
            'seasons' => function($query) {
                $query->select('season_id', 'tv_series_id', 'season_number', 'year', 'total_episodes')
                      ->orderBy('season_number', 'asc')
                      ->with(['episodes' => function($query) {
                          $query->select('episode_id', 'season_id', 'title', 'episode_number', 'duration', 'air_date')
                                ->orderBy('episode_number', 'asc')
                                ->with([
                                    'imageFiles' => function($query) {
                                        $query->wherePivot('type', 'still')->limit(1);
                                    },
                                    'videoFiles'  // Load video files for each episode
                                ]);
                      }]);
            }
        ]);

        return new TvSeriesResource($tvSerie);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TvSeriesUpdateRequest $request, TvSerie $tvSerie)
    {
        // Authorization for update a TV series
        $this->authorize('update', $tvSerie);
        
        $validatedData = $request->validated();
        
        // Remove file fields from validatedData for basic TV series update
        $fileFields = [
            'poster', 'backdrop', 'trailer_video'
        ];
        $tvSeriesData = collect($validatedData)->except($fileFields)->toArray();
        
        // Update the TV series with basic data
        $tvSerie->update($tvSeriesData);
        
        // Handle poster URL update (same logic as store method)
        if ($request->has('poster')) {
            // Remove existing poster associations
            $existingPosters = $tvSerie->imageFiles()->wherePivot('type', 'poster')->get();
            foreach ($existingPosters as $existingPoster) {
                $tvSerie->imageFiles()->detach($existingPoster->image_id);
            }
            
            // Find existing ImageFile by URL
            $posterImage = ImageFile::where('url', 'LIKE', '%' . basename($request->poster) . '%')
                                    ->where('type', 'poster')
                                    ->first();
            if ($posterImage) {
                $tvSerie->imageFiles()->attach($posterImage->image_id, ['type' => 'poster']);
            }
        }

        // Handle backdrop URL update (same logic as store method)
        if ($request->has('backdrop')) {
            // Remove existing backdrop associations
            $existingBackdrops = $tvSerie->imageFiles()->wherePivot('type', 'backdrop')->get();
            foreach ($existingBackdrops as $existingBackdrop) {
                $tvSerie->imageFiles()->detach($existingBackdrop->image_id);
            }
            
            // Find existing ImageFile by URL
            $backdropImage = ImageFile::where('url', 'LIKE', '%' . basename($request->backdrop) . '%')
                                      ->where('type', 'backdrop')
                                      ->first();
            if ($backdropImage) {
                $tvSerie->imageFiles()->attach($backdropImage->image_id, ['type' => 'backdrop']);
            }
        }

        // Handle trailer video file upload
        if ($request->hasFile('trailer_video')) {
            // Remove existing trailer associations
            $existingTrailers = $tvSerie->videoFiles()->whereRaw("LOWER(title) LIKE '%trailer%'")->get();
            foreach ($existingTrailers as $existingTrailer) {
                $tvSerie->videoFiles()->detach($existingTrailer->video_file_id);
            }
            
            // Upload new trailer
            $trailerFile = $request->file('trailer_video');
            $fileData = FileUploadHelper::uploadVideo($trailerFile);
            
            // Automatic generation of title description
            $trailerTitle = ($request->title ?? $tvSerie->title) . ' - Trailer';
            
            $trailerVideo = VideoFile::create([
                'url' => $fileData['url'],
                'title' => $trailerTitle,
                'format' => $fileData['format'] ?? 'mp4',
                'resolution' => isset($fileData['width']) && isset($fileData['height']) ? $fileData['width'].'x'.$fileData['height'] : null,
            ]);
            
            $tvSerie->videoFiles()->attach($trailerVideo->video_file_id);
        }
        
        // Update persons (actors) if provided
        if ($request->has('persons')) {
            $tvSerie->persons()->sync($request->persons);
        }
        
        return ResponseMessages::success(['message' => 'TV Series successfully updated', 'tv_series' => new TvSeriesResource($tvSerie)], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TvSerie $tvSerie)
    {
        $this->authorize('delete', $tvSerie);
        $tvSerie->delete();
        return ResponseMessages::success('TV Serie is deleted successfully', 204);
    }
}
