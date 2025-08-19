<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Episode;
use App\Models\ImageFile;
use App\Models\VideoFile;
use Illuminate\Http\Request;
use App\Helpers\ResponseMessages;
use App\Helpers\FileUploadHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\api\v1\EpisodeResource;
use App\Http\Resources\api\v1\EpisodeCollection;
use App\Http\Requests\api\v1\EpisodeStoreRequest;
use App\Http\Requests\api\v1\EpisodeUpdateRequest;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Episode::class);
        $filterData = $request->all();
        $query = Episode::query()
            ->with(['imageFiles' => function($query) {
                $query->where('episode_image.type', 'still')->limit(1);
            }]);
        foreach($filterData as $key => $value){
            if(in_array($key,['season_id', 'episode_id', 'title', 'episode_number', 'status'])){
               $query = $query->where($key,'LIKE', "%$value%");
            }
        }
        $episodes = $query->paginate(10);
        return new EpisodeCollection($episodes);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(EpisodeStoreRequest $request)
    {
        $this->authorize('create', Episode::class);
        
        $validatedData = $request->validated();
        
        $fileFields = [
            'episode_video', 'still_image'
        ];
        $episodeData = collect($validatedData)->except($fileFields)->toArray();

        // Create the episode
        $episode = Episode::create($episodeData);

        // Handle episode video upload
        if ($request->hasFile('episode_video')) {
            $videoFile = $request->file('episode_video');
            $fileData = FileUploadHelper::uploadVideo($videoFile);
            
            // Automatic generation of title description
            $videoTitle = $request->title . ' - Episode ' . $request->episode_number;
            
            $episodeVideo = VideoFile::create([
                'url' => $fileData['url'],
                'title' => $videoTitle,
                'format' => $fileData['format'] ?? 'mp4',
                'resolution' => isset($fileData['width']) && isset($fileData['height']) ? $fileData['width'].'x'.$fileData['height'] : null,
            ]);
            
            $episode->videoFiles()->attach($episodeVideo->video_file_id);
        }

        // Handle still image upload
        if ($request->hasFile('still_image')) {
            $imageFile = $request->file('still_image');
            $fileData = FileUploadHelper::uploadImage($imageFile, 'still');
            
            $stillImage = ImageFile::create([
                'url' => $fileData['url'],
                'title' => $request->title . ' - Still',
                'description' => 'Episode still image',
                'type' => 'still',
                'format' => $fileData['format'] ?? 'jpg',
                'size' => $fileData['size'] ?? 0,
                'width' => $fileData['width'] ?? null,
                'height' => $fileData['height'] ?? null,
            ]);
            
            $episode->imageFiles()->attach($stillImage->image_id, ['type' => 'still']);
        }
        
        // Attach persons if provided
        if ($request->has('persons')) {
            $episode->persons()->sync($request->persons);
        }

        return ResponseMessages::success(
            ['message' => 'Episode created successfully', 'episode' => new EpisodeResource($episode)], 
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Episode $episode)
    {
        $this->authorize('view', $episode);
        
        // Eager load all relationships for detailed view
        $episode->load([
            'season',
            'videoFiles',  // Load video files for streaming
            'imageFiles',  // Load still images
            'persons.imageFiles'  // Load persons with their images
        ]);
        
        return new EpisodeResource($episode);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EpisodeUpdateRequest $request, Episode $episode)
    {
        $this->authorize('update', $episode);
        
        $validatedData = $request->validated();
        
        // Remove file fields from validatedData for basic episode update
        $fileFields = [
            'episode_video', 'still_image'
        ];
        $episodeData = collect($validatedData)->except($fileFields)->toArray();
        
        // Update the episode with basic data
        $episode->update($episodeData);
        
        // Handle episode video file upload (partial update)
        if ($request->hasFile('episode_video')) {
            // Remove existing video associations
            $existingVideos = $episode->videoFiles()->get();
            foreach ($existingVideos as $existingVideo) {
                $episode->videoFiles()->detach($existingVideo->video_file_id);
            }
            
            // Upload new video
            $videoFile = $request->file('episode_video');
            $fileData = FileUploadHelper::uploadVideo($videoFile);
            
            // Automatic generation of title description
            $videoTitle = ($request->title ?? $episode->title) . ' - Episode ' . ($request->episode_number ?? $episode->episode_number);
            
            $episodeVideo = VideoFile::create([
                'url' => $fileData['url'],
                'title' => $videoTitle,
                'format' => $fileData['format'] ?? 'mp4',
                'resolution' => isset($fileData['width']) && isset($fileData['height']) ? $fileData['width'].'x'.$fileData['height'] : null,
            ]);
            
            $episode->videoFiles()->attach($episodeVideo->video_file_id);
        }

        // Handle still image upload (partial update)
        if ($request->hasFile('still_image')) {
            // Remove existing still associations
            $existingStills = $episode->imageFiles()->wherePivot('type', 'still')->get();
            foreach ($existingStills as $existingStill) {
                $episode->imageFiles()->detach($existingStill->image_id);
            }
            
            // Upload new still
            $imageFile = $request->file('still_image');
            $fileData = FileUploadHelper::uploadImage($imageFile, 'still');
            
            $stillImage = ImageFile::create([
                'url' => $fileData['url'],
                'title' => ($request->title ?? $episode->title) . ' - Still',
                'description' => 'Episode still image',
                'type' => 'still',
                'format' => $fileData['format'] ?? 'jpg',
                'size' => $fileData['size'] ?? 0,
                'width' => $fileData['width'] ?? null,
                'height' => $fileData['height'] ?? null,
            ]);
            
            $episode->imageFiles()->attach($stillImage->image_id, ['type' => 'still']);
        }
        
        // Update persons if provided
        if ($request->has('persons')) {
            $episode->persons()->sync($request->persons);
        }

        return ResponseMessages::success(
            ['message' => 'Episode updated successfully', 'episode' => new EpisodeResource($episode)], 
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Episode $episode)
    {
        $this->authorize('delete', $episode);
        $episode->delete();
        return ResponseMessages::success('Episode deleted successfully', 204);
    }
}
