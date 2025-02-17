@extends('docs.layout')

@section('title', 'TV Series API')

@section('content')
<article class="prose max-w-none">
    <h1 id="tv-series">TV Series</h1>
    <p>
        The TV Series API provides endpoints for managing TV series resources including basic information,
        seasons, episodes, images, trailers, and cast members.
    </p>

    <div class="mt-8">
        <h2 id="list-tv-series">List TV Series</h2>
        <div class="my-4">
            <span class="method-get font-bold">GET</span>
            <code class="endpoint">/api/v1/tv-series</code>
        </div>
        <p>Retrieve a paginated list of TV series with basic information.</p>

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
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">status</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">string</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">No</td>
                    <td class="px-6 py-4 text-sm text-gray-500">Filter by status (draft, published)</td>
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

    <div class="mt-8">
        <h2 id="get-tv-series">Get TV Series Details</h2>
        <div class="my-4">
            <span class="method-get font-bold">GET</span>
            <code class="endpoint">/api/v1/tv-series/{id}</code>
        </div>
        <p>Retrieve detailed information about a specific TV series including seasons list.</p>

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
                    <td class="px-6 py-4 text-sm text-gray-500">The TV series ID</td>
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

    <div class="mt-8">
        <h2 id="create-tv-series">Create TV Series</h2>
        <div class="my-4">
            <span class="method-post font-bold">POST</span>
            <code class="endpoint">/api/v1/tv-series</code>
        </div>
        <p>Create a new TV series resource. Requires admin role.</p>

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
                    <td class="px-6 py-4 text-sm text-gray-500">TV series title</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">year</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">integer</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Yes</td>
                    <td class="px-6 py-4 text-sm text-gray-500">Release year</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">total_seasons</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">integer</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Yes</td>
                    <td class="px-6 py-4 text-sm text-gray-500">Total number of seasons</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">description</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">string</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Yes</td>
                    <td class="px-6 py-4 text-sm text-gray-500">TV series description</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">category_id</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">integer</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Yes</td>
                    <td class="px-6 py-4 text-sm text-gray-500">Category ID</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">status</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">string</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">No</td>
                    <td class="px-6 py-4 text-sm text-gray-500">Status (draft or published, default: draft)</td>
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

    <div class="mt-8 mb-16">
        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-8">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-blue-700">
                        For managing seasons and episodes of a TV series, please refer to the
                        <a href="/docs/seasons" class="font-medium underline">Seasons</a> and
                        <a href="/docs/episodes" class="font-medium underline">Episodes</a> documentation.
                    </p>
                </div>
            </div>
        </div>
    </div>
</article>
@endsection
