@extends('docs.layout')

@section('title', 'Trailers API')

@section('content')
<article class="prose prose-invert max-w-none">
    <h1>Trailers</h1>
    
    <p class="lead">
        The Trailers API allows you to manage movie and TV series trailers.
    </p>

    <div class="my-8">
        <h2>Upload Movie Trailer</h2>
        <div class="my-4">
            <span class="method-badge method-post">POST</span>
            <code>/api/v1/movies/{movie}/trailers</code>
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
                    <td>trailer</td>
                    <td>file</td>
                    <td>Yes</td>
                    <td>Trailer video file (mp4, max 100MB)</td>
                </tr>
                <tr>
                    <td>title</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Trailer title</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "id": 1,
        "title": "Official Trailer",
        "url": "https://api.dobridobrev.com/storage/movies/1/trailers/official.mp4"
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Upload TV Series Trailer</h2>
        <div class="my-4">
            <span class="method-badge method-post">POST</span>
            <code>/api/v1/tv-series/{series}/trailers</code>
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
                    <td>series</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>TV Series ID</td>
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
                    <td>trailer</td>
                    <td>file</td>
                    <td>Yes</td>
                    <td>Trailer video file (mp4, max 100MB)</td>
                </tr>
                <tr>
                    <td>title</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Trailer title</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "id": 1,
        "title": "Season 1 Trailer",
        "url": "https://api.dobridobrev.com/storage/series/1/trailers/season1.mp4"
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Delete Trailer</h2>
        <div class="my-4">
            <span class="method-badge method-delete">DELETE</span>
            <code>/api/v1/trailers/{trailer}</code>
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
                    <td>trailer</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>Trailer ID</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "message": "Trailer deleted successfully"
}</code></pre>
    </div>
</article>
@endsection
