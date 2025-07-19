@extends('docs.layout')

@section('content')
<article class="prose prose-invert max-w-none">
    <h1>Video Files</h1>
    
    <p class="lead">
        The Video Files API allows you to manage video files for movies and TV series episodes.
    </p>

    <div class="my-8">
        <h2>List Video Files</h2>
        <div class="my-4">
            <span class="method-badge method-get">GET</span>
            <code>/api/v1/video-files</code>
        </div>

        <h3>Query Parameters</h3>
        <table class="docs-table">
            <thead>
                <tr>
                    <th>Parameter</th>
                    <th>Type</th>
                    <th>Required</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>video_file_id</td>
                    <td>integer</td>
                    <td>No</td>
                    <td>Filter by video file ID</td>
                </tr>
                <tr>
                    <td>title</td>
                    <td>string</td>
                    <td>No</td>
                    <td>Filter by title</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": [
        {
            "video_file_id": 1,
            "title": "Breaking Bad S01E01 1080p",
            "url": "https://api.dobridobrev.com/storage/videos/breaking-bad-s01e01-1080p.mp4",
            "quality": "1080p",
            "videoable_type": "App\\Models\\Episode",
            "videoable_id": 1
        }
    ],
    "links": {
        "first": "https://api.dobridobrev.com/api/v1/video-files?page=1",
        "last": "https://api.dobridobrev.com/api/v1/video-files?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "per_page": 50,
        "to": 1,
        "total": 1
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Get Video File</h2>
        <div class="my-4">
            <span class="method-badge method-get">GET</span>
            <code>/api/v1/video-files/{video_file_id}</code>
        </div>

        <h3>Path Parameters</h3>
        <table class="docs-table">
            <thead>
                <tr>
                    <th>Parameter</th>
                    <th>Type</th>
                    <th>Required</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>video_file_id</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>Video File ID</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "video_file_id": 1,
        "title": "Breaking Bad S01E01 1080p",
        "url": "https://api.dobridobrev.com/storage/videos/breaking-bad-s01e01-1080p.mp4",
        "quality": "1080p",
        "videoable_type": "App\\Models\\Episode",
        "videoable_id": 1
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Upload Video File</h2>
        <div class="my-4">
            <span class="method-badge method-post">POST</span>
            <code>/api/v1/video-files</code>
        </div>

        <h3>Request Body</h3>
        <table class="docs-table">
            <thead>
                <tr>
                    <th>Parameter</th>
                    <th>Type</th>
                    <th>Required</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>title</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Video file title</td>
                </tr>
                <tr>
                    <td>file</td>
                    <td>file</td>
                    <td>Yes</td>
                    <td>Video file (mp4)</td>
                </tr>
                <tr>
                    <td>quality</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Video quality (e.g., 1080p, 720p)</td>
                </tr>
                <tr>
                    <td>videoable_type</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Related model type (Episode)</td>
                </tr>
                <tr>
                    <td>videoable_id</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>ID of the related model</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "message": "Video file created successfully",
    "data": {
        "video_file_id": 1,
        "title": "Breaking Bad S01E01 1080p",
        "url": "https://api.dobridobrev.com/storage/videos/breaking-bad-s01e01-1080p.mp4",
        "quality": "1080p",
        "videoable_type": "App\\Models\\Episode",
        "videoable_id": 1
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Update Video File</h2>
        <div class="my-4">
            <span class="method-badge method-put">PUT</span>
            <code>/api/v1/video-files/{video_file_id}</code>
        </div>

        <h3>Path Parameters</h3>
        <table class="docs-table">
            <thead>
                <tr>
                    <th>Parameter</th>
                    <th>Type</th>
                    <th>Required</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>video_file_id</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>Video File ID</td>
                </tr>
            </tbody>
        </table>

        <h3>Request Body</h3>
        <p>Same as Upload Video File endpoint.</p>

        <h3>Response</h3>
        <p>Same as Upload Video File response.</p>
    </div>

    <div class="my-8">
        <h2>Delete Video File</h2>
        <div class="my-4">
            <span class="method-badge method-delete">DELETE</span>
            <code>/api/v1/video-files/{video_file_id}</code>
        </div>

        <h3>Path Parameters</h3>
        <table class="docs-table">
            <thead>
                <tr>
                    <th>Parameter</th>
                    <th>Type</th>
                    <th>Required</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>video_file_id</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>Video File ID</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "message": "Video file deleted successfully"
}</code></pre>
    </div>
</article>
@endsection
