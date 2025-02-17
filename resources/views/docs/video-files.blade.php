@extends('docs.layout')

@section('title', 'Video Files API')

@section('content')
<article class="prose prose-invert max-w-none">
    <h1>Video Files</h1>
    
    <p class="lead">
        The Video Files API allows you to manage video files for movies and TV series episodes.
    </p>

    <div class="my-8">
        <h2>Upload Movie Video</h2>
        <div class="my-4">
            <span class="method-badge method-post">POST</span>
            <code>/api/v1/movies/{movie}/video</code>
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
                    <td>movie</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>Movie ID</td>
                </tr>
            </tbody>
        </table>

        <h3>Request Body (multipart/form-data)</h3>
        <table class="docs-table">
            <thead>
                <tr>
                    <th>Field</th>
                    <th>Type</th>
                    <th>Required</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>video</td>
                    <td>file</td>
                    <td>Yes</td>
                    <td>Video file (mp4, max 2GB)</td>
                </tr>
                <tr>
                    <td>quality</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Video quality (sd, hd, 4k)</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "id": 1,
        "quality": "hd",
        "url": "https://api.dobridobrev.com/storage/movies/1/video-hd.mp4"
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Upload Episode Video</h2>
        <div class="my-4">
            <span class="method-badge method-post">POST</span>
            <code>/api/v1/episodes/{episode}/video</code>
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
                    <td>episode</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>Episode ID</td>
                </tr>
            </tbody>
        </table>

        <h3>Request Body (multipart/form-data)</h3>
        <table class="docs-table">
            <thead>
                <tr>
                    <th>Field</th>
                    <th>Type</th>
                    <th>Required</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>video</td>
                    <td>file</td>
                    <td>Yes</td>
                    <td>Video file (mp4, max 2GB)</td>
                </tr>
                <tr>
                    <td>quality</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Video quality (sd, hd, 4k)</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "id": 1,
        "quality": "hd",
        "url": "https://api.dobridobrev.com/storage/episodes/1/video-hd.mp4"
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Get Video Stream</h2>
        <div class="my-4">
            <span class="method-badge method-get">GET</span>
            <code>/api/v1/videos/{video}/stream</code>
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
                    <td>video</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>Video ID</td>
                </tr>
            </tbody>
        </table>

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
                    <td>quality</td>
                    <td>string</td>
                    <td>No</td>
                    <td>Video quality (sd, hd, 4k)</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <p>Returns video stream with Content-Type: video/mp4</p>
    </div>

    <div class="my-8">
        <h2>Delete Video</h2>
        <div class="my-4">
            <span class="method-badge method-delete">DELETE</span>
            <code>/api/v1/videos/{video}</code>
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
                    <td>video</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>Video ID</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "message": "Video deleted successfully"
}</code></pre>
    </div>
</article>
@endsection
