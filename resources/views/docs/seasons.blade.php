@extends('docs.layout')

@section('title', 'Seasons API')

@section('content')
<article class="prose max-w-none">
    <h1 id="seasons">Seasons</h1>
    <p>
        The Seasons API provides endpoints for managing TV series seasons and their episodes. Each season belongs to a TV series
        and contains multiple episodes.
    </p>

    <div class="mt-8">
        <h2 id="list-seasons">List Seasons</h2>
        <div class="my-4">
            <span class="method-get font-bold">GET</span>
            <code class="endpoint">/api/v1/seasons</code>
        </div>
        <p>Retrieve a paginated list of seasons.</p>

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
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">tv_series_id</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">integer</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">No</td>
                    <td class="px-6 py-4 text-sm text-gray-500">Filter by TV series ID</td>
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
            "tv_series": {
                "id": 1,
                "title": "Breaking Bad"
            },
            "season_id": 1,
            "season_number": 1,
            "total_episodes": 7,
            "year": 2008,
            "poster": "https://example.com/seasons/breaking-bad-s1.jpg"
        }
    ],
    "links": {
        "first": "http://api.example.com/seasons?page=1",
        "last": "http://api.example.com/seasons?page=5",
        "prev": null,
        "next": "http://api.example.com/seasons?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 5,
        "path": "http://api.example.com/seasons",
        "per_page": 24,
        "to": 24,
        "total": 120
    }
}</code></pre>
    </div>

    <div class="mt-8">
        <h2 id="get-season">Get Season Details</h2>
        <div class="my-4">
            <span class="method-get font-bold">GET</span>
            <code class="endpoint">/api/v1/seasons/{id}</code>
        </div>
        <p>Retrieve detailed information about a specific season including its episodes.</p>

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
                    <td class="px-6 py-4 text-sm text-gray-500">The season ID</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "tv_series": {
            "id": 1,
            "title": "Breaking Bad"
        },
        "season_id": 1,
        "season_number": 1,
        "total_episodes": 7,
        "year": 2008,
        "poster": "https://example.com/seasons/breaking-bad-s1.jpg",
        "episodes": [
            {
                "episode_id": 1,
                "title": "Pilot",
                "episode_number": 1,
                "description": "Walter White, a high school chemistry teacher...",
                "duration": "58:00",
                "still": "https://example.com/episodes/breaking-bad-s1e1.jpg"
            }
        ]
    }
}</code></pre>
    </div>

    <div class="mt-8">
        <h2 id="create-season">Create Season</h2>
        <div class="my-4">
            <span class="method-post font-bold">POST</span>
            <code class="endpoint">/api/v1/seasons</code>
        </div>
        <p>Create a new season for a TV series. Requires admin role.</p>

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
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">tv_series_id</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">integer</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Yes</td>
                    <td class="px-6 py-4 text-sm text-gray-500">ID of the TV series</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">season_number</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">integer</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Yes</td>
                    <td class="px-6 py-4 text-sm text-gray-500">Season number</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">total_episodes</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">integer</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Yes</td>
                    <td class="px-6 py-4 text-sm text-gray-500">Total number of episodes</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">year</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">integer</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Yes</td>
                    <td class="px-6 py-4 text-sm text-gray-500">Release year</td>
                </tr>
            </tbody>
        </table>

        <h3>Example Request</h3>
        <pre><code>curl -X POST /api/v1/seasons \
    -H "Authorization: Bearer {token}" \
    -H "Content-Type: application/json" \
    -d '{
        "tv_series_id": 1,
        "season_number": 1,
        "total_episodes": 7,
        "year": 2008
    }'</code></pre>

        <h3>Response</h3>
        <pre><code>{
    "message": "Season created successfully",
    "data": {
        "season_id": 1,
        "tv_series_id": 1,
        "season_number": 1,
        "total_episodes": 7,
        "year": 2008
    }
}</code></pre>
    </div>

    <div class="mt-8 mb-16">
        <div class="bg-blue-50 border-l-4 border-blue-400 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-blue-700">
                        For managing individual episodes within a season, please refer to the
                        <a href="/docs/episodes" class="font-medium underline">Episodes</a> documentation.
                    </p>
                </div>
            </div>
        </div>
    </div>
</article>
@endsection
