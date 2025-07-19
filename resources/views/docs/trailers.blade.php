@extends('docs.layout')

@section('content')
<article class="prose prose-invert max-w-none">
    <h1>Trailers</h1>
    
    <p class="lead">
        The Trailers API allows you to manage movie and TV series trailers.
    </p>

    <div class="my-8">
        <h2>List Trailers</h2>
        <div class="my-4">
            <span class="method-badge method-get">GET</span>
            <code>/api/v1/trailers</code>
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
                    <td>trailer_id</td>
                    <td>integer</td>
                    <td>No</td>
                    <td>Filter by trailer ID</td>
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
            "trailer_id": 1,
            "title": "Breaking Bad Season 1 Trailer",
            "url": "https://youtube.com/watch?v=...",
            "trailerable_type": "App\\Models\\TvSeries",
            "trailerable_id": 1
        }
    ],
    "links": {
        "first": "https://api.dobridobrev.com/api/v1/trailers?page=1",
        "last": "https://api.dobridobrev.com/api/v1/trailers?page=1",
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
        <h2>Get Trailer</h2>
        <div class="my-4">
            <span class="method-badge method-get">GET</span>
            <code>/api/v1/trailers/{trailer_id}</code>
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
                    <td>trailer_id</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>Trailer ID</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "trailer_id": 1,
        "title": "Breaking Bad Season 1 Trailer",
        "url": "https://youtube.com/watch?v=...",
        "trailerable_type": "App\\Models\\TvSeries",
        "trailerable_id": 1
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Create Trailer</h2>
        <div class="my-4">
            <span class="method-badge method-post">POST</span>
            <code>/api/v1/trailers</code>
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
                    <td>Trailer title</td>
                </tr>
                <tr>
                    <td>url</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>YouTube URL of the trailer</td>
                </tr>
                <tr>
                    <td>trailerable_type</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Related model type (Movie, TvSeries)</td>
                </tr>
                <tr>
                    <td>trailerable_id</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>ID of the related model</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "message": "Trailer created successfully",
    "data": {
        "trailer_id": 1,
        "title": "Breaking Bad Season 1 Trailer",
        "url": "https://youtube.com/watch?v=...",
        "trailerable_type": "App\\Models\\TvSeries",
        "trailerable_id": 1
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Update Trailer</h2>
        <div class="my-4">
            <span class="method-badge method-put">PUT</span>
            <code>/api/v1/trailers/{trailer_id}</code>
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
                    <td>trailer_id</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>Trailer ID</td>
                </tr>
            </tbody>
        </table>

        <h3>Request Body</h3>
        <p>Same as Create Trailer endpoint.</p>

        <h3>Response</h3>
        <p>Same as Create Trailer response.</p>
    </div>

    <div class="my-8">
        <h2>Delete Trailer</h2>
        <div class="my-4">
            <span class="method-badge method-delete">DELETE</span>
            <code>/api/v1/trailers/{trailer_id}</code>
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
                    <td>trailer_id</td>
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
