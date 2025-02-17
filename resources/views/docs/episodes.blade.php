@extends('docs.layout')

@section('title', 'Episodes API')

@section('content')
<article class="prose max-w-none">
    <h1 id="episodes">Episodes</h1>
    <p>
        The Episodes API provides endpoints for managing TV series episodes. Each episode belongs to a specific season
        and includes details like title, description, duration, and associated media files.
    </p>

    <div class="mt-8">
        <h2 id="list-episodes">List Episodes</h2>
        <div class="my-4">
            <span class="method-get font-bold">GET</span>
            <code class="endpoint">/api/v1/episodes</code>
        </div>
        <p>Retrieve a paginated list of episodes.</p>

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
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">season_id</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">integer</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">No</td>
                    <td class="px-6 py-4 text-sm text-gray-500">Filter by season ID</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">title</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">string</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">No</td>
                    <td class="px-6 py-4 text-sm text-gray-500">Filter by title</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": [
        {
            "episode_id": 1,
            "title": "Pilot",
            "episode_number": 1,
            "description": "Walter White, a high school chemistry teacher...",
            "duration": "58:00",
            "season": {
                "id": 1,
                "season_number": 1,
                "tv_series": {
                    "id": 1,
                    "title": "Breaking Bad"
                }
            },
            "still": "https://example.com/episodes/breaking-bad-s1e1.jpg"
        }
    ],
    "links": {
        "first": "http://api.example.com/episodes?page=1",
        "last": "http://api.example.com/episodes?page=5",
        "prev": null,
        "next": "http://api.example.com/episodes?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 5,
        "path": "http://api.example.com/episodes",
        "per_page": 24,
        "to": 24,
        "total": 120
    }
}</code></pre>
    </div>

    <div class="mt-8">
        <h2 id="get-episode">Get Episode Details</h2>
        <div class="my-4">
            <span class="method-get font-bold">GET</span>
            <code class="endpoint">/api/v1/episodes/{id}</code>
        </div>
        <p>Retrieve detailed information about a specific episode.</p>

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
                    <td class="px-6 py-4 text-sm text-gray-500">The episode ID</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "episode_id": 1,
        "title": "Pilot",
        "episode_number": 1,
        "description": "Walter White, a high school chemistry teacher...",
        "duration": "58:00",
        "season": {
            "id": 1,
            "season_number": 1,
            "tv_series": {
                "id": 1,
                "title": "Breaking Bad"
            }
        },
        "still": "https://example.com/episodes/breaking-bad-s1e1.jpg",
        "video_files": [
            {
                "video_id": 1,
                "quality": "1080p",
                "url": "https://example.com/videos/breaking-bad-s1e1-1080p.mp4"
            }
        ]
    }
}</code></pre>
    </div>

    <div class="mt-8">
        <h2 id="create-episode">Create Episode</h2>
        <div class="my-4">
            <span class="method-post font-bold">POST</span>
            <code class="endpoint">/api/v1/episodes</code>
        </div>
        <p>Create a new episode for a season. Requires admin role.</p>

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
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">season_id</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">integer</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Yes</td>
                    <td class="px-6 py-4 text-sm text-gray-500">ID of the season</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">title</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">string</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Yes</td>
                    <td class="px-6 py-4 text-sm text-gray-500">Episode title</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">episode_number</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">integer</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Yes</td>
                    <td class="px-6 py-4 text-sm text-gray-500">Episode number within the season</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">description</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">string</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Yes</td>
                    <td class="px-6 py-4 text-sm text-gray-500">Episode description</td>
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
        <pre><code>curl -X POST /api/v1/episodes \
    -H "Authorization: Bearer {token}" \
    -H "Content-Type: application/json" \
    -d '{
        "season_id": 1,
        "title": "Pilot",
        "episode_number": 1,
        "description": "Walter White, a high school chemistry teacher...",
        "duration": "58:00"
    }'</code></pre>

        <h3>Response</h3>
        <pre><code>{
    "message": "Episode created successfully",
    "data": {
        "episode_id": 1,
        "season_id": 1,
        "title": "Pilot",
        "episode_number": 1,
        "duration": "58:00"
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
                        For managing episode media files (images and videos), please refer to the
                        <a href="/docs/media" class="font-medium underline">Media</a> documentation.
                    </p>
                </div>
            </div>
        </div>
    </div>
</article>
@endsection
