@extends('docs.layout')

@section('title', 'Movies API')

@section('content')
<article class="prose prose-invert max-w-none">
    <h1>Movies</h1>
    
    <p class="lead">
        Manage movies in the streaming platform.
    </p>

    <div class="my-8">
        <h2>List Movies</h2>
        <div class="my-4">
            <span class="method-badge method-get">GET</span>
            <code>/api/v1/movies</code>
        </div>

        <h3>Response</h3>
        <pre><code>{
    "data": [
        {
            "movie_id": 1,
            "title": "The Shawshank Redemption",
            "year": 1994,
            "duration": 142,
            "imdb_rating": 9.3,
            "status": "published",
            "category": {
                "id": 1,
                "name": "Drama"
            },
            "poster": "https://api.dobridobrev.com/storage/movies/1/poster.jpg"
        }
    ],
    "links": {
        "first": "https://api.dobridobrev.com/api/v1/movies?page=1",
        "last": "https://api.dobridobrev.com/api/v1/movies?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "per_page": 15,
        "to": 1,
        "total": 1
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
        "movie_id": 1,
        "title": "The Shawshank Redemption",
        "year": 1994,
        "duration": 142,
        "imdb_rating": 9.3,
        "status": "published",
        "category": {
            "id": 1,
            "name": "Drama"
        },
        "poster": "https://api.dobridobrev.com/storage/movies/1/poster.jpg",
        "description": "Two imprisoned men bond over a number of years...",
        "backdrop": "https://api.dobridobrev.com/storage/movies/1/backdrop.jpg",
        "persons": [
            {
                "id": 1,
                "name": "Frank Darabont",
                "pivot": {
                    "role": "director"
                }
            }
        ],
        "trailers": [
            {
                "id": 1,
                "url": "https://youtube.com/watch?v=..."
            }
        ],
        "images": [
            {
                "id": 1,
                "type": "poster",
                "url": "https://api.dobridobrev.com/storage/movies/1/poster.jpg"
            },
            {
                "id": 2,
                "type": "backdrop",
                "url": "https://api.dobridobrev.com/storage/movies/1/backdrop.jpg"
            }
        ]
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
                    <td>Movie title (max 128 characters, must be unique)</td>
                </tr>
                <tr>
                    <td>slug</td>
                    <td>string</td>
                    <td>No</td>
                    <td>URL-friendly title (max 128 characters)</td>
                </tr>
                <tr>
                    <td>description</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Movie description</td>
                </tr>
                <tr>
                    <td>year</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>Release year</td>
                </tr>
                <tr>
                    <td>duration</td>
                    <td>integer</td>
                    <td>No</td>
                    <td>Duration in minutes</td>
                </tr>
                <tr>
                    <td>imdb_rating</td>
                    <td>numeric</td>
                    <td>No</td>
                    <td>IMDB rating (between 0 and 10)</td>
                </tr>
                <tr>
                    <td>premiere_date</td>
                    <td>date</td>
                    <td>No</td>
                    <td>Premiere date</td>
                </tr>
                <tr>
                    <td>status</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Movie status (published, draft, sheduled, coming soon)</td>
                </tr>
                <tr>
                    <td>category_id</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>Category ID</td>
                </tr>
                <tr>
                    <td>persons</td>
                    <td>array</td>
                    <td>No</td>
                    <td>Array of person IDs</td>
                </tr>
                <tr>
                    <td>trailers</td>
                    <td>array</td>
                    <td>No</td>
                    <td>Array of trailer objects with URL</td>
                </tr>
                <tr>
                    <td>video_files</td>
                    <td>array</td>
                    <td>No</td>
                    <td>Array of video file objects with URL</td>
                </tr>
                <tr>
                    <td>image_files</td>
                    <td>array</td>
                    <td>No</td>
                    <td>Array of image file objects with URL</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "movie_id": 1,
        "title": "The Shawshank Redemption",
        "year": 1994,
        "duration": 142,
        "imdb_rating": 9.3,
        "status": "published",
        "category": {
            "id": 1,
            "name": "Drama"
        },
        "poster": "https://api.dobridobrev.com/storage/movies/1/poster.jpg"
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
        <p>Same as Create Movie endpoint.</p>

        <h3>Response</h3>
        <p>Same as Create Movie response.</p>
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
