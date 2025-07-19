@extends('docs.layout')

@section('content')
<article class="prose prose-invert max-w-none">
    <h1>TV Series</h1>
    
    <p class="lead">
        Manage TV series including basic information, seasons, episodes, and related content.
    </p>

    <div class="my-8">
        <h2>List TV Series</h2>
        <div class="my-4">
            <span class="method-badge method-get">GET</span>
            <code>/api/v1/tv-series</code>
        </div>

        <h3>Response</h3>
        <pre><code>{
    "data": [
        {
            "tv_series_id": 1,
            "title": "Breaking Bad",
            "year": 2008,
            "imdb_rating": 9.5,
            "total_seasons": 5,
            "status": "published",
            "category": {
                "id": 1,
                "name": "Drama"
            },
            "poster": "https://api.dobridobrev.com/storage/tv-series/1/poster.jpg"
        }
    ],
    "links": {
        "first": "https://api.dobridobrev.com/api/v1/tv-series?page=1",
        "last": "https://api.dobridobrev.com/api/v1/tv-series?page=1",
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
        <h2>Get TV Series</h2>
        <div class="my-4">
            <span class="method-badge method-get">GET</span>
            <code>/api/v1/tv-series/{tv_series}</code>
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
                    <td>tv_series</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>TV Series ID</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "tv_series_id": 1,
        "title": "Breaking Bad",
        "year": 2008,
        "imdb_rating": 9.5,
        "total_seasons": 5,
        "status": "published",
        "category": {
            "id": 1,
            "name": "Drama"
        },
        "poster": "https://api.dobridobrev.com/storage/tv-series/1/poster.jpg",
        "description": "A high school chemistry teacher turned methamphetamine manufacturer...",
        "backdrop": "https://api.dobridobrev.com/storage/tv-series/1/backdrop.jpg",
        "persons": [
            {
                "id": 1,
                "name": "Vince Gilligan",
                "pivot": {
                    "role": "creator"
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
                "url": "https://api.dobridobrev.com/storage/tv-series/1/poster.jpg"
            },
            {
                "id": 2,
                "type": "backdrop",
                "url": "https://api.dobridobrev.com/storage/tv-series/1/backdrop.jpg"
            }
        ],
        "seasons": [
            {
                "season_id": 1,
                "season_number": 1,
                "year": 2008,
                "total_episodes": 7,
                "poster": "https://api.dobridobrev.com/storage/seasons/1/poster.jpg"
            }
        ]
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Create TV Series</h2>
        <div class="my-4">
            <span class="method-badge method-post">POST</span>
            <code>/api/v1/tv-series</code>
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
                    <td>TV Series title (max 255 characters)</td>
                </tr>
                <tr>
                    <td>description</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>TV Series description</td>
                </tr>
                <tr>
                    <td>year</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>Release year</td>
                </tr>
                <tr>
                    <td>imdb_rating</td>
                    <td>numeric</td>
                    <td>No</td>
                    <td>IMDB rating (between 0 and 10)</td>
                </tr>
                <tr>
                    <td>total_seasons</td>
                    <td>integer</td>
                    <td>No</td>
                    <td>Total number of seasons</td>
                </tr>
                <tr>
                    <td>status</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>TV Series status (published, draft, coming soon)</td>
                </tr>
                <tr>
                    <td>category_id</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>Category ID</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "tv_series_id": 1,
        "title": "Breaking Bad",
        "year": 2008,
        "imdb_rating": 9.5,
        "total_seasons": 5,
        "status": "published",
        "category": {
            "id": 1,
            "name": "Drama"
        },
        "poster": "https://api.dobridobrev.com/storage/tv-series/1/poster.jpg"
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Update TV Series</h2>
        <div class="my-4">
            <span class="method-badge method-put">PUT</span>
            <code>/api/v1/tv-series/{tv_series}</code>
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
                    <td>tv_series</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>TV Series ID</td>
                </tr>
            </tbody>
        </table>

        <h3>Request Body</h3>
        <p>Same as Create TV Series endpoint.</p>

        <h3>Response</h3>
        <p>Same as Create TV Series response.</p>
    </div>

    <div class="my-8">
        <h2>Delete TV Series</h2>
        <div class="my-4">
            <span class="method-badge method-delete">DELETE</span>
            <code>/api/v1/tv-series/{tv_series}</code>
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
                    <td>tv_series</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>TV Series ID</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "message": "TV Series deleted successfully"
}</code></pre>
    </div>
</article>
@endsection
