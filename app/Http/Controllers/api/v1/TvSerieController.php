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
use App\Http\Requests\api\v1\TvSeriesCompleteStoreRequest;
use App\Http\Requests\api\v1\TvSeriesCompleteUpdateRequest;
use App\Models\Season;
use App\Models\Episode;

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
        
        // 1. Poster URL - create ImageFile directly from URL
        if ($request->has('poster')) {
            $posterImage = ImageFile::create([
                'url' => $request->poster,
                'title' => $request->title . ' - Poster',
                'description' => 'TV Series poster image',
                'type' => 'poster',
                'format' => pathinfo($request->poster, PATHINFO_EXTENSION) ?: 'jpg',
                'size' => 0, // Unknown size for URL
                'width' => null,
                'height' => null,
            ]);
            
            $tvSeries->imageFiles()->attach($posterImage->image_id, ['type' => 'poster']);
        }

        // 2. Backdrop URL - create ImageFile directly from URL
        if ($request->has('backdrop')) {
            $backdropImage = ImageFile::create([
                'url' => $request->backdrop,
                'title' => $request->title . ' - Backdrop',
                'description' => 'TV Series backdrop image',
                'type' => 'backdrop',
                'format' => pathinfo($request->backdrop, PATHINFO_EXTENSION) ?: 'jpg',
                'size' => 0, // Unknown size for URL
                'width' => null,
                'height' => null,
            ]);
            
            $tvSeries->imageFiles()->attach($backdropImage->image_id, ['type' => 'backdrop']);
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
     * Store a complete TV series with seasons and episodes in one request
     */
    public function storeComplete(TvSeriesCompleteStoreRequest $request)
    {
        // Authorization for creating a TV series
        $this->authorize('create', TvSerie::class);

        $validatedData = $request->validated();
        
        // Extract file fields and seasons data
        $fileFields = ['poster_image', 'backdrop_image', 'trailer_video', 'seasons'];
        $tvSeriesData = collect($validatedData)->except($fileFields)->toArray();

        // Create the TV series
        $tvSeries = TvSerie::create($tvSeriesData);

        // 1. Handle poster image upload
        if ($request->hasFile('poster_image')) {
            $posterFile = $request->file('poster_image');
            $fileData = FileUploadHelper::uploadImage($posterFile, 'poster');
            
            $posterImage = ImageFile::create([
                'url' => $fileData['url'],
                'title' => $request->title . ' - Poster',
                'description' => 'TV Series poster image',
                'type' => 'poster',
                'format' => $fileData['format'] ?? 'jpg',
                'size' => $fileData['size'] ?? 0,
                'width' => $fileData['width'] ?? null,
                'height' => $fileData['height'] ?? null,
            ]);
            
            $tvSeries->imageFiles()->attach($posterImage->image_id, ['type' => 'poster']);
        }

        // 2. Handle backdrop image upload
        if ($request->hasFile('backdrop_image')) {
            $backdropFile = $request->file('backdrop_image');
            $fileData = FileUploadHelper::uploadImage($backdropFile, 'backdrop');
            
            $backdropImage = ImageFile::create([
                'url' => $fileData['url'],
                'title' => $request->title . ' - Backdrop',
                'description' => 'TV Series backdrop image',
                'type' => 'backdrop',
                'format' => $fileData['format'] ?? 'jpg',
                'size' => $fileData['size'] ?? 0,
                'width' => $fileData['width'] ?? null,
                'height' => $fileData['height'] ?? null,
            ]);
            
            $tvSeries->imageFiles()->attach($backdropImage->image_id, ['type' => 'backdrop']);
        }

        // 3. Handle trailer video upload
        if ($request->hasFile('trailer_video')) {
            $trailerFile = $request->file('trailer_video');
            $fileData = FileUploadHelper::uploadVideo($trailerFile);
            
            $trailerTitle = $request->title . ' - Trailer';
            
            $trailerVideo = VideoFile::create([
                'url' => $fileData['url'],
                'title' => $trailerTitle,
                'format' => $fileData['format'] ?? 'mp4',
                'resolution' => isset($fileData['width']) && isset($fileData['height']) ? $fileData['width'].'x'.$fileData['height'] : null,
            ]);
            
            $tvSeries->videoFiles()->attach($trailerVideo->video_file_id);
        }
        
        // 4. Attach persons to the TV series
        if ($request->has('persons')) {
            $tvSeries->persons()->sync($request->persons);
        }

        // 5. Attach trailers
        if ($request->has('trailers')) {
            foreach ($request->trailers as $trailerData) {
                $trailer = Trailer::create($trailerData);
                $tvSeries->trailers()->attach($trailer->trailer_id);
            }
        }

        // 6. Create seasons and episodes
        if ($request->has('seasons')) {
            foreach ($request->seasons as $seasonIndex => $seasonData) {
                // Extract episodes data before creating season
                $episodesData = $seasonData['episodes'];
                $seasonFields = collect($seasonData)->except(['episodes'])->toArray();
                $seasonFields['tv_series_id'] = $tvSeries->tv_series_id;
                
                // Auto-calculate total_episodes if not provided
                if (!isset($seasonFields['total_episodes']) || empty($seasonFields['total_episodes'])) {
                    $seasonFields['total_episodes'] = count($episodesData);
                }
                
                // Create season
                $season = Season::create($seasonFields);
                
                // Create episodes for this season
                foreach ($episodesData as $episodeIndex => $episodeData) {
                    // Extract file fields from episode data
                    $episodeFileFields = ['episode_video', 'still_image', 'persons'];
                    $episodeFields = collect($episodeData)->except($episodeFileFields)->toArray();
                    $episodeFields['season_id'] = $season->season_id;
                    
                    // Set default description if not provided (required by database)
                    if (!isset($episodeFields['description']) || empty($episodeFields['description'])) {
                        $episodeFields['description'] = $episodeFields['title'] ?? 'Episode description';
                    }
                    
                    // Create episode
                    $episode = Episode::create($episodeFields);
                    
                    // Handle episode video upload
                    $videoKey = "seasons.{$seasonIndex}.episodes.{$episodeIndex}.episode_video";
                    if ($request->hasFile($videoKey)) {
                        $videoFile = $request->file($videoKey);
                        $fileData = FileUploadHelper::uploadVideo($videoFile);
                        
                        $videoTitle = $episodeData['title'] . ' - Episode ' . $episodeData['episode_number'];
                        
                        $episodeVideo = VideoFile::create([
                            'url' => $fileData['url'],
                            'title' => $videoTitle,
                            'format' => $fileData['format'] ?? 'mp4',
                            'resolution' => isset($fileData['width']) && isset($fileData['height']) ? $fileData['width'].'x'.$fileData['height'] : null,
                        ]);
                        
                        $episode->videoFiles()->attach($episodeVideo->video_file_id);
                    }
                    
                    // Handle still image upload
                    $stillImageKey = "seasons.{$seasonIndex}.episodes.{$episodeIndex}.still_image";
                    if ($request->hasFile($stillImageKey)) {
                        $imageFile = $request->file($stillImageKey);
                        $fileData = FileUploadHelper::uploadImage($imageFile, 'still');
                        
                        $stillImage = ImageFile::create([
                            'url' => $fileData['url'],
                            'title' => $episodeData['title'] . ' - Still',
                            'description' => 'Episode still image',
                            'type' => 'still',
                            'format' => $fileData['format'] ?? 'jpg',
                            'size' => $fileData['size'] ?? 0,
                            'width' => $fileData['width'] ?? null,
                            'height' => $fileData['height'] ?? null,
                        ]);
                        
                        $episode->imageFiles()->attach($stillImage->image_id, ['type' => 'still']);
                    }
                    
                    // Attach persons to episode if provided
                    if (isset($episodeData['persons'])) {
                        $episode->persons()->sync($episodeData['persons']);
                    }
                }
            }
        }

        // Load relationships for response
        $tvSeries->load([
            'category',
            'persons.imageFiles',
            'trailers',
            'imageFiles',
            'videoFiles',
            'seasons.episodes.imageFiles',
            'seasons.episodes.videoFiles'
        ]);

        return ResponseMessages::success([
            'message' => 'Complete TV Series created successfully', 
            'tv_series' => new TvSeriesResource($tvSeries)
        ], 201);
    }

    /**
     * Update a complete TV series with partial updates for seasons and episodes
     */
    public function updateComplete(TvSeriesCompleteUpdateRequest $request, TvSerie $tvSerie)
    {
        // Authorization for updating a TV series
        $this->authorize('update', $tvSerie);

        // CRITICAL DEBUG: Check what Laravel actually receives
        \Log::info('TvSerie Update - Raw Request Data:', $request->all());
        \Log::info('TvSerie Update - Request Input Keys:', array_keys($request->all()));
        \Log::info('TvSerie Update - Request Content Type:', ['content_type' => $request->header('Content-Type')]);
        \Log::info('TvSerie Update - Request Method:', ['method' => $request->method()]);
        \Log::info('TvSerie Update - Has Files:', ['has_files' => $request->hasFile('poster_image') || $request->hasFile('backdrop_image') || $request->hasFile('trailer_video')]);

        $validatedData = $request->validated();
        
        // Debug logging
        \Log::info('TvSerie Update - Validated Data:', $validatedData);
        \Log::info('TvSerie Update - Request all data:', $request->all());
        \Log::info('TvSerie Update - Has title in request:', ['has_title' => $request->has('title')]);
        \Log::info('TvSerie Update - Title from request:', ['title' => $request->get('title')]);
        
        // Extract file fields and seasons data
        $fileFields = ['poster_image', 'backdrop_image', 'trailer_video', 'seasons'];
        $tvSeriesData = collect($validatedData)->except($fileFields)->toArray();
        
        // Debug logging
        \Log::info('TvSerie Update - Data for update:', $tvSeriesData);
        \Log::info('TvSerie Update - Before update TV Series:', $tvSerie->toArray());

        // Update the TV series basic data
        $updateResult = $tvSerie->update($tvSeriesData);
        
        // Debug logging
        \Log::info('TvSerie Update - Update result:', ['success' => $updateResult]);
        \Log::info('TvSerie Update - After update TV Series:', $tvSerie->fresh()->toArray());

        // 1. Handle poster image upload (partial update)
        if ($request->hasFile('poster_image')) {
            // Remove existing poster associations
            $existingPosters = $tvSerie->imageFiles()->wherePivot('type', 'poster')->get();
            foreach ($existingPosters as $existingPoster) {
                $tvSerie->imageFiles()->detach($existingPoster->image_id);
            }
            
            $posterFile = $request->file('poster_image');
            $fileData = FileUploadHelper::uploadImage($posterFile, 'poster');
            
            $posterImage = ImageFile::create([
                'url' => $fileData['url'],
                'title' => ($request->title ?? $tvSerie->title) . ' - Poster',
                'description' => 'TV Series poster image',
                'type' => 'poster',
                'format' => $fileData['format'] ?? 'jpg',
                'size' => $fileData['size'] ?? 0,
                'width' => $fileData['width'] ?? null,
                'height' => $fileData['height'] ?? null,
            ]);
            
            $tvSerie->imageFiles()->attach($posterImage->image_id, ['type' => 'poster']);
        }

        // 2. Handle backdrop image upload (partial update)
        if ($request->hasFile('backdrop_image')) {
            // Remove existing backdrop associations
            $existingBackdrops = $tvSerie->imageFiles()->wherePivot('type', 'backdrop')->get();
            foreach ($existingBackdrops as $existingBackdrop) {
                $tvSerie->imageFiles()->detach($existingBackdrop->image_id);
            }
            
            $backdropFile = $request->file('backdrop_image');
            $fileData = FileUploadHelper::uploadImage($backdropFile, 'backdrop');
            
            $backdropImage = ImageFile::create([
                'url' => $fileData['url'],
                'title' => ($request->title ?? $tvSerie->title) . ' - Backdrop',
                'description' => 'TV Series backdrop image',
                'type' => 'backdrop',
                'format' => $fileData['format'] ?? 'jpg',
                'size' => $fileData['size'] ?? 0,
                'width' => $fileData['width'] ?? null,
                'height' => $fileData['height'] ?? null,
            ]);
            
            $tvSerie->imageFiles()->attach($backdropImage->image_id, ['type' => 'backdrop']);
        }

        // 3. Handle trailer video upload (partial update)
        if ($request->hasFile('trailer_video')) {
            // Remove existing trailer associations
            $existingTrailers = $tvSerie->videoFiles()->whereRaw("LOWER(title) LIKE '%trailer%'")->get();
            foreach ($existingTrailers as $existingTrailer) {
                $tvSerie->videoFiles()->detach($existingTrailer->video_file_id);
            }
            
            $trailerFile = $request->file('trailer_video');
            $fileData = FileUploadHelper::uploadVideo($trailerFile);
            
            $trailerTitle = ($request->title ?? $tvSerie->title) . ' - Trailer';
            
            $trailerVideo = VideoFile::create([
                'url' => $fileData['url'],
                'title' => $trailerTitle,
                'format' => $fileData['format'] ?? 'mp4',
                'resolution' => isset($fileData['width']) && isset($fileData['height']) ? $fileData['width'].'x'.$fileData['height'] : null,
            ]);
            
            $tvSerie->videoFiles()->attach($trailerVideo->video_file_id);
        }
        
        // 4. Update persons if provided
        if ($request->has('persons')) {
            $tvSerie->persons()->sync($request->persons);
        }

        // 5. Update trailers if provided
        if ($request->has('trailers')) {
            // Remove existing trailer associations
            $tvSerie->trailers()->detach();
            
            foreach ($request->trailers as $trailerData) {
                $trailer = Trailer::create($trailerData);
                $tvSerie->trailers()->attach($trailer->trailer_id);
            }
        }

        // 6. Update seasons and episodes (partial updates)
        if ($request->has('seasons')) {
            foreach ($request->seasons as $seasonIndex => $seasonData) {
                // Check if season has an ID for update or create new
                if (isset($seasonData['season_id'])) {
                    // Update existing season
                    $season = Season::findOrFail($seasonData['season_id']);
                    $episodesData = isset($seasonData['episodes']) ? $seasonData['episodes'] : [];
                    $seasonFields = collect($seasonData)->except(['episodes', 'season_id'])->toArray();
                    $season->update($seasonFields);
                } else {
                    // Create new season
                    $episodesData = $seasonData['episodes'] ?? [];
                    $seasonFields = collect($seasonData)->except(['episodes'])->toArray();
                    $seasonFields['tv_series_id'] = $tvSerie->tv_series_id;
                    $season = Season::create($seasonFields);
                }
                
                // Update episodes for this season
                if (!empty($episodesData)) {
                    foreach ($episodesData as $episodeIndex => $episodeData) {
                        if (isset($episodeData['episode_id'])) {
                            // Update existing episode
                            $episode = Episode::findOrFail($episodeData['episode_id']);
                            $episodeFileFields = ['episode_video', 'still_image', 'persons', 'episode_id'];
                            $episodeFields = collect($episodeData)->except($episodeFileFields)->toArray();
                            $episode->update($episodeFields);
                        } else {
                            // Create new episode
                            $episodeFileFields = ['episode_video', 'still_image', 'persons'];
                            $episodeFields = collect($episodeData)->except($episodeFileFields)->toArray();
                            $episodeFields['season_id'] = $season->season_id;
                            $episode = Episode::create($episodeFields);
                        }
                        
                        // Handle episode video upload (partial update)
                        $episodeVideoKey = "seasons.{$seasonIndex}.episodes.{$episodeIndex}.episode_video";
                        if ($request->hasFile($episodeVideoKey)) {
                            // Remove existing video associations
                            $existingVideos = $episode->videoFiles()->get();
                            foreach ($existingVideos as $existingVideo) {
                                $episode->videoFiles()->detach($existingVideo->video_file_id);
                            }
                            
                            $videoFile = $request->file($episodeVideoKey);
                            $fileData = FileUploadHelper::uploadVideo($videoFile);
                            
                            $videoTitle = $episodeData['title'] . ' - Episode ' . $episodeData['episode_number'];
                            
                            $episodeVideo = VideoFile::create([
                                'url' => $fileData['url'],
                                'title' => $videoTitle,
                                'format' => $fileData['format'] ?? 'mp4',
                                'resolution' => isset($fileData['width']) && isset($fileData['height']) ? $fileData['width'].'x'.$fileData['height'] : null,
                            ]);
                            
                            $episode->videoFiles()->attach($episodeVideo->video_file_id);
                        }
                        
                        // Handle still image upload (partial update)
                        $stillImageKey = "seasons.{$seasonIndex}.episodes.{$episodeIndex}.still_image";
                        if ($request->hasFile($stillImageKey)) {
                            // Remove existing still associations
                            $existingStills = $episode->imageFiles()->wherePivot('type', 'still')->get();
                            foreach ($existingStills as $existingStill) {
                                $episode->imageFiles()->detach($existingStill->image_id);
                            }
                            
                            $imageFile = $request->file($stillImageKey);
                            $fileData = FileUploadHelper::uploadImage($imageFile, 'still');
                            
                            $stillImage = ImageFile::create([
                                'url' => $fileData['url'],
                                'title' => $episodeData['title'] . ' - Still',
                                'description' => 'Episode still image',
                                'type' => 'still',
                                'format' => $fileData['format'] ?? 'jpg',
                                'size' => $fileData['size'] ?? 0,
                                'width' => $fileData['width'] ?? null,
                                'height' => $fileData['height'] ?? null,
                            ]);
                            
                            $episode->imageFiles()->attach($stillImage->image_id, ['type' => 'still']);
                        }
                        
                        // Update persons for episode if provided
                        if (isset($episodeData['persons'])) {
                            $episode->persons()->sync($episodeData['persons']);
                        }
                    }
                }
            }
        }

        // Load relationships for response
        $tvSerie->load([
            'category',
            'persons.imageFiles',
            'trailers',
            'imageFiles',
            'videoFiles',
            'seasons.episodes.imageFiles',
            'seasons.episodes.videoFiles'
        ]);

        return ResponseMessages::success([
            'message' => 'TV Series updated successfully', 
            'tv_series' => new TvSeriesResource($tvSerie)
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(TvSerie $tvSerie)
    {
        try {
            $this->authorize('view', $tvSerie);

            // Eager load all relationships for detailed view
            $tvSerie->load([
                'category',
                'persons.imageFiles',
                'trailers',
                'videoFiles',
                'imageFiles',
                'seasons.episodes.imageFiles',
                'seasons.episodes.videoFiles'
            ]);

            return new TvSeriesResource($tvSerie);
        } catch (\Exception $e) {
            \Log::error('Error in TvSerieController@show: ' . $e->getMessage(), [
                'tv_series_id' => $tvSerie->tv_series_id ?? null,
                'user_id' => auth()->id(),
                'exception' => $e
            ]);

            return response()->json([
                'error' => 'Unable to load TV series details',
                'message' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TvSeriesUpdateRequest $request, TvSerie $tvSerie)
    {
        // Authorization for update a TV series
        $this->authorize('update', $tvSerie);
        
        // Handle poster URL update
        if ($request->has('poster')) {
            // Remove existing poster associations
            $existingPosters = $tvSerie->imageFiles()->wherePivot('type', 'poster')->get();
            foreach ($existingPosters as $existingPoster) {
                $tvSerie->imageFiles()->detach($existingPoster->image_id);
            }
            
            // Create new ImageFile from URL
            $posterImage = ImageFile::create([
                'url' => $request->poster,
                'title' => ($request->title ?? $tvSerie->title) . ' - Poster',
                'description' => 'TV Series poster image',
                'type' => 'poster',
                'format' => pathinfo($request->poster, PATHINFO_EXTENSION) ?: 'jpg',
                'size' => 0,
                'width' => null,
                'height' => null,
            ]);
            
            $tvSerie->imageFiles()->attach($posterImage->image_id, ['type' => 'poster']);
        }

        // Handle backdrop URL update
        if ($request->has('backdrop')) {
            // Remove existing backdrop associations
            $existingBackdrops = $tvSerie->imageFiles()->wherePivot('type', 'backdrop')->get();
            foreach ($existingBackdrops as $existingBackdrop) {
                $tvSerie->imageFiles()->detach($existingBackdrop->image_id);
            }
            
            // Create new ImageFile from URL
            $backdropImage = ImageFile::create([
                'url' => $request->backdrop,
                'title' => ($request->title ?? $tvSerie->title) . ' - Backdrop',
                'description' => 'TV Series backdrop image',
                'type' => 'backdrop',
                'format' => pathinfo($request->backdrop, PATHINFO_EXTENSION) ?: 'jpg',
                'size' => 0,
                'width' => null,
                'height' => null,
            ]);
            
            $tvSerie->imageFiles()->attach($backdropImage->image_id, ['type' => 'backdrop']);
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
