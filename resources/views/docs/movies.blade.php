@extends('docs.layout')

@section('title', 'Movies API')

@section('content')
<article class="prose max-w-none">
    <h1 id="movies">Movies</h1>
    <p>
        The Movies API provides endpoints for managing movie resources including basic information,
        images, trailers, and cast members.
    </p>

    <div class="mt-8">
        <h2 id="list-movies">List Movies</h2>
        <div class="my-4">
            <span class="method-get font-bold">GET</span>
            <code class="endpoint">/api/v1/movies</code>
        </div>
        <p>Retrieve a paginated list of movies with basic information.</p>

        <h3>Query Parameters</h3>
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Parameter</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Required</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">page</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">integer</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">No</td>
                    <td class="px-6 py-4 text-sm text-gray-500">Page number (default: 1)</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">title</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">string</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">No</td>
                    <td class="px-6 py-4 text-sm text-gray-500">Filter by title</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">year</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">integer</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">No</td>
                    <td class="px-6 py-4 text-sm text-gray-500">Filter by release year</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": [
        {
            "movie_id": 1,
            "title": "Inception",
            "year": 2010,
            "duration": "2:28:00",
            "imdb_rating": 8.8,
            "status": "published",
            "category": {
                "id": 1,
                "name": "Science Fiction"
            },
            "poster": "https://example.com/posters/inception.jpg"
        }
    ],
    "links": {
        "first": "http://api.example.com/movies?page=1",
        "last": "http://api.example.com/movies?page=5",
        "prev": null,
        "next": "http://api.example.com/movies?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 5,
        "path": "http://api.example.com/movies",
        "per_page": 24,
        "to": 24,
        "total": 120
    }
}</code></pre>
    </div>

    <div class="mt-8">
        <h2 id="get-movie">Get Movie Details</h2>
        <div class="my-4">
            <span class="method-get font-bold">GET</span>
            <code class="endpoint">/api/v1/movies/{id}</code>
        </div>
        <p>Retrieve detailed information about a specific movie.</p>

        <h3>Path Parameters</h3>
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Parameter</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Required</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">id</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">integer</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Yes</td>
                    <td class="px-6 py-4 text-sm text-gray-500">The movie ID</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "movie_id": 1,
        "title": "Inception",
        "year": 2010,
        "duration": "2:28:00",
        "imdb_rating": 8.8,
        "status": "published",
        "description": "A thief who steals corporate secrets...",
        "category": {
            "id": 1,
            "name": "Science Fiction"
        },
        "poster": "https://example.com/posters/inception.jpg",
        "backdrop": "https://example.com/backdrops/inception.jpg",
        "persons": [
            {
                "person_id": 1,
                "name": "Christopher Nolan",
                "role": "Director",
                "image": "https://example.com/persons/nolan.jpg"
            }
        ],
        "trailers": [
            {
                "trailer_id": 1,
                "title": "Official Trailer",
                "url": "https://example.com/trailers/inception.mp4"
            }
        ],
        "images": [
            {
                "image_id": 1,
                "type": "poster",
                "url": "https://example.com/images/inception-1.jpg"
            }
        ]
    }
}</code></pre>
    </div>

    <div class="mt-8">
        <h2 id="create-movie">Create Movie</h2>
        <div class="my-4">
            <span class="method-post font-bold">POST</span>
            <code class="endpoint">/api/v1/movies</code>
        </div>
        <p>Create a new movie resource. Requires admin role.</p>

        <h3>Request Body</h3>
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Field</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Required</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">title</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">string</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Yes</td>
                    <td class="px-6 py-4 text-sm text-gray-500">Movie title</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">year</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">integer</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Yes</td>
                    <td class="px-6 py-4 text-sm text-gray-500">Release year</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">duration</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">string</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Yes</td>
                    <td class="px-6 py-4 text-sm text-gray-500">Duration in format HH:MM:SS</td>
                </tr>
            </tbody>
        </table>

        <h3>Example Request</h3>
        <pre><code>curl -X POST /api/v1/movies \
    -H "Authorization: Bearer {token}" \
    -H "Content-Type: application/json" \
    -d '{
        "title": "Inception",
        "year": 2010,
        "duration": "2:28:00",
        "description": "A thief who steals corporate secrets...",
        "category_id": 1,
        "status": "draft"
    }'</code></pre>

        <h3>Response</h3>
        <pre><code>{
    "message": "Movie created successfully",
    "data": {
        "movie_id": 1,
        "title": "Inception",
        "year": 2010,
        "duration": "2:28:00",
        "status": "draft"
    }
}</code></pre>
    </div>
</article>
@endsection
