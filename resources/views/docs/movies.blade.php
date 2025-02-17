@extends('docs.layout')

@section('title', 'Movies API')

@section('content')
<article class="prose max-w-none">
    <h1>Movies</h1>
    
    <p class="lead">
        The Movies API allows you to manage movies in the streaming platform.
    </p>

    <div class="my-8">
        <h2>List Movies</h2>
        <div class="my-4">
            <span class="method-badge method-get">GET</span>
            <code>/api/v1/movies</code>
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
                    <td>page</td>
                    <td>integer</td>
                    <td>No</td>
                    <td>Page number (default: 1)</td>
                </tr>
                <tr>
                    <td>per_page</td>
                    <td>integer</td>
                    <td>No</td>
                    <td>Items per page (default: 15, max: 50)</td>
                </tr>
                <tr>
                    <td>category</td>
                    <td>string</td>
                    <td>No</td>
                    <td>Filter by category name</td>
                </tr>
                <tr>
                    <td>country</td>
                    <td>string</td>
                    <td>No</td>
                    <td>Filter by country code</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": [
        {
            "id": 1,
            "title": "The Matrix",
            "description": "A computer programmer discovers a mysterious world...",
            "release_date": "1999-03-31",
            "duration": 136,
            "category": "Science Fiction",
            "country": "US",
            "poster_url": "https://api.dobridobrev.com/storage/movies/1/poster.jpg",
            "backdrop_url": "https://api.dobridobrev.com/storage/movies/1/backdrop.jpg"
        }
    ],
    "meta": {
        "current_page": 1,
        "per_page": 15,
        "total": 100
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Get Movie</h2>
        <div class="my-4">
            <span class="method-badge method-get">GET</span>
            <code>/api/v1/movies/{movie}</code>
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

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "id": 1,
        "title": "The Matrix",
        "description": "A computer programmer discovers a mysterious world...",
        "release_date": "1999-03-31",
        "duration": 136,
        "category": "Science Fiction",
        "country": "US",
        "poster_url": "https://api.dobridobrev.com/storage/movies/1/poster.jpg",
        "backdrop_url": "https://api.dobridobrev.com/storage/movies/1/backdrop.jpg",
        "trailer_url": "https://api.dobridobrev.com/storage/movies/1/trailer.mp4",
        "video_url": "https://api.dobridobrev.com/storage/movies/1/video.mp4"
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Create Movie</h2>
        <div class="my-4">
            <span class="method-badge method-post">POST</span>
            <code>/api/v1/movies</code>
        </div>

        <h3>Request Body</h3>
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
                    <td>title</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Movie title</td>
                </tr>
                <tr>
                    <td>description</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Movie description</td>
                </tr>
                <tr>
                    <td>release_date</td>
                    <td>date</td>
                    <td>Yes</td>
                    <td>Release date (YYYY-MM-DD)</td>
                </tr>
                <tr>
                    <td>duration</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>Duration in minutes</td>
                </tr>
                <tr>
                    <td>category</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Category name</td>
                </tr>
                <tr>
                    <td>country</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Country code (ISO 3166-1 alpha-2)</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "id": 1,
        "title": "The Matrix",
        "description": "A computer programmer discovers a mysterious world...",
        "release_date": "1999-03-31",
        "duration": 136,
        "category": "Science Fiction",
        "country": "US"
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Update Movie</h2>
        <div class="my-4">
            <span class="method-badge method-put">PUT</span>
            <code>/api/v1/movies/{movie}</code>
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

        <h3>Request Body</h3>
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
                    <td>title</td>
                    <td>string</td>
                    <td>No</td>
                    <td>Movie title</td>
                </tr>
                <tr>
                    <td>description</td>
                    <td>string</td>
                    <td>No</td>
                    <td>Movie description</td>
                </tr>
                <tr>
                    <td>release_date</td>
                    <td>date</td>
                    <td>No</td>
                    <td>Release date (YYYY-MM-DD)</td>
                </tr>
                <tr>
                    <td>duration</td>
                    <td>integer</td>
                    <td>No</td>
                    <td>Duration in minutes</td>
                </tr>
                <tr>
                    <td>category</td>
                    <td>string</td>
                    <td>No</td>
                    <td>Category name</td>
                </tr>
                <tr>
                    <td>country</td>
                    <td>string</td>
                    <td>No</td>
                    <td>Country code (ISO 3166-1 alpha-2)</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "id": 1,
        "title": "The Matrix",
        "description": "A computer programmer discovers a mysterious world...",
        "release_date": "1999-03-31",
        "duration": 136,
        "category": "Science Fiction",
        "country": "US"
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Delete Movie</h2>
        <div class="my-4">
            <span class="method-badge method-delete">DELETE</span>
            <code>/api/v1/movies/{movie}</code>
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

        <h3>Response</h3>
        <pre><code>{
    "message": "Movie deleted successfully"
}</code></pre>
    </div>
</article>
@endsection
