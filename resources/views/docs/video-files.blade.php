@extends('docs.layout')

@section('title', 'Video Files API')

@section('content')
<article class="prose prose-invert max-w-none">
    <h1>Video Files API</h1>
    
    <p class="lead">
        The Video Files API allows you to manage video files for movies and TV series episodes.
    </p>

    <div class="my-8">
        <h2>Upload Movie Video</h2>
        <div class="my-4">
            <span class="method-badge method-post">POST</span>
            <code class="endpoint">/api/v1/movies/{movie}/videos</code>
        </div>

        <h3>Path Parameters</h3>
        <table class="docs-table">
            <thead>
                <tr>
                    <th>Parameter</th>
                    <th>Type</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><code>movie</code></td>
                    <td>integer</td>
                    <td>Movie ID</td>
                </tr>
            </tbody>
        </table>

        <h3>Request Body (multipart/form-data)</h3>
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
                    <td><code>video</code></td>
                    <td>file</td>
                    <td>Yes</td>
                    <td>Video file (MP4, MKV)</td>
                </tr>
                <tr>
                    <td><code>quality</code></td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Video quality (SD, HD, FHD, 4K)</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="my-8">
        <h2>Upload Episode Video</h2>
        <div class="my-4">
            <span class="method-badge method-post">POST</span>
            <code class="endpoint">/api/v1/episodes/{episode}/videos</code>
        </div>

        <h3>Path Parameters</h3>
        <table class="docs-table">
            <thead>
                <tr>
                    <th>Parameter</th>
                    <th>Type</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><code>episode</code></td>
                    <td>integer</td>
                    <td>Episode ID</td>
                </tr>
            </tbody>
        </table>

        <h3>Request Body (multipart/form-data)</h3>
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
                    <td><code>video</code></td>
                    <td>file</td>
                    <td>Yes</td>
                    <td>Video file (MP4, MKV)</td>
                </tr>
                <tr>
                    <td><code>quality</code></td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Video quality (SD, HD, FHD, 4K)</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="my-8">
        <h2>Get Videos</h2>
        <p>Each entity type has its own endpoint to retrieve videos:</p>
        <ul>
            <li><code>GET /api/v1/movies/{movie}/videos</code> - Get movie videos</li>
            <li><code>GET /api/v1/episodes/{episode}/videos</code> - Get episode videos</li>
        </ul>
    </div>

    <div class="my-8">
        <h2>Delete Video</h2>
        <p>Each entity type has its own endpoint to delete videos:</p>
        <ul>
            <li><code>DELETE /api/v1/movies/{movie}/videos/{video}</code> - Delete movie video</li>
            <li><code>DELETE /api/v1/episodes/{episode}/videos/{video}</code> - Delete episode video</li>
        </ul>
        <p class="text-yellow-500">Note: Only administrators can delete videos.</p>
    </div>

    <div class="my-8">
        <h2>Get Streaming URL</h2>
        <div class="my-4">
            <span class="method-badge method-get">GET</span>
            <code class="endpoint">/api/v1/videos/{id}/stream</code>
        </div>

        <h3>Path Parameters</h3>
        <table class="docs-table">
            <thead>
                <tr>
                    <th>Parameter</th>
                    <th>Type</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><code>id</code></td>
                    <td>integer</td>
                    <td>Video file ID</td>
                </tr>
            </tbody>
        </table>

        <h3>Query Parameters</h3>
        <table class="docs-table">
            <thead>
                <tr>
                    <th>Parameter</th>
                    <th>Type</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><code>quality</code></td>
                    <td>string</td>
                    <td>Desired quality (SD, HD, FHD, 4K)</td>
                </tr>
                <tr>
                    <td><code>token</code></td>
                    <td>string</td>
                    <td>Streaming token</td>
                </tr>
            </tbody>
        </table>
    </div>
</article>
@endsection
