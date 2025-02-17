@extends('docs.layout')

@section('title', 'TV Series API')

@section('content')
<article class="prose max-w-none">
    <h1 id="tv-series">TV Series</h1>
    
    <p class="lead">
        The TV Series API provides endpoints for managing TV series resources including basic information,
        seasons, episodes, images, trailers, and cast members.
    </p>

    <div class="my-8">
        <h2 id="list-tv-series">List TV Series</h2>
        <div class="my-4">
            <span class="method-badge method-get">GET</span>
            <code>/api/v1/tv-series</code>
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
                    <td>title</td>
                    <td>string</td>
                    <td>No</td>
                    <td>Filter by title</td>
                </tr>
                <tr>
                    <td>year</td>
                    <td>integer</td>
                    <td>No</td>
                    <td>Filter by release year</td>
                </tr>
                <tr>
                    <td>status</td>
                    <td>string</td>
                    <td>No</td>
                    <td>Filter by status (draft, published)</td>
                </tr>
            </tbody>
        </table>

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
            "poster": "https://example.com/posters/breaking-bad.jpg"
        }
    ],
    "links": {
        "first": "http://api.example.com/tv-series?page=1",
        "last": "http://api.example.com/tv-series?page=5",
        "prev": null,
        "next": "http://api.example.com/tv-series?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 5,
        "path": "http://api.example.com/tv-series",
        "per_page": 24,
        "to": 24,
        "total": 120
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2 id="get-tv-series">Get TV Series Details</h2>
        <div class="my-4">
            <span class="method-badge method-get">GET</span>
            <code>/api/v1/tv-series/{id}</code>
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
                    <td>id</td>
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
        "description": "A high school chemistry teacher turned methamphetamine manufacturer...",
        "category": {
            "id": 1,
            "name": "Drama"
        },
        "poster": "https://example.com/posters/breaking-bad.jpg",
        "backdrop": "https://example.com/backdrops/breaking-bad.jpg",
        "persons": [
            {
                "person_id": 1,
                "name": "Vince Gilligan",
                "role": "Creator",
                "image": "https://example.com/persons/gilligan.jpg"
            }
        ],
        "seasons": [
            {
                "season_id": 1,
                "season_number": 1,
                "year": 2008,
                "total_episodes": 7,
                "poster": "https://example.com/seasons/breaking-bad-s1.jpg"
            }
        ],
        "trailers": [
            {
                "trailer_id": 1,
                "title": "Season 1 Trailer",
                "url": "https://example.com/trailers/breaking-bad-s1.mp4"
            }
        ],
        "images": [
            {
                "image_id": 1,
                "type": "poster",
                "url": "https://example.com/images/breaking-bad-1.jpg"
            }
        ]
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2 id="create-tv-series">Create TV Series</h2>
        <div class="my-4">
            <span class="method-badge method-post">POST</span>
            <code>/api/v1/tv-series</code>
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
                    <td>TV series title</td>
                </tr>
                <tr>
                    <td>year</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>Release year</td>
                </tr>
                <tr>
                    <td>total_seasons</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>Total number of seasons</td>
                </tr>
                <tr>
                    <td>description</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>TV series description</td>
                </tr>
                <tr>
                    <td>category_id</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>Category ID</td>
                </tr>
                <tr>
                    <td>status</td>
                    <td>string</td>
                    <td>No</td>
                    <td>Status (draft or published, default: draft)</td>
                </tr>
            </tbody>
        </table>

        <h3>Example Request</h3>
        <pre><code>curl -X POST /api/v1/tv-series \
    -H "Authorization: Bearer {token}" \
    -H "Content-Type: application/json" \
    -d '{
        "title": "Breaking Bad",
        "year": 2008,
        "total_seasons": 5,
        "description": "A high school chemistry teacher turned methamphetamine manufacturer...",
        "category_id": 1,
        "status": "draft"
    }'</code></pre>

        <h3>Response</h3>
        <pre><code>{
    "message": "TV Series created successfully",
    "data": {
        "tv_series_id": 1,
        "title": "Breaking Bad",
        "year": 2008,
        "total_seasons": 5,
        "status": "draft"
    }
}</code></pre>
    </div>
</article>
@endsection
