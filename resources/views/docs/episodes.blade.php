@extends('docs.layout')

@section('title', 'Episodes API')

@section('content')
<article>
    <h1>Episodes</h1>
    <p class="lead">
        The Episodes API provides endpoints for managing TV series episodes. Each episode belongs to a specific season
        and includes details like title, description, duration, and associated media files.
    </p>

    <div class="my-8">
        <h2>List Episodes</h2>
        <div class="my-4">
            <span class="method-badge method-get">GET</span>
            <code>/api/v1/episodes</code>
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
                    <td>season_id</td>
                    <td>integer</td>
                    <td>No</td>
                    <td>Filter by season ID</td>
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

    <div class="my-8">
        <h2>Get Episode Details</h2>
        <div class="my-4">
            <span class="method-badge method-get">GET</span>
            <code>/api/v1/episodes/{id}</code>
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
                    <td>Episode ID</td>
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

    <div class="my-8">
        <h2>Create Episode</h2>
        <div class="my-4">
            <span class="method-badge method-post">POST</span>
            <code>/api/v1/episodes</code>
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
                    <td>season_id</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>ID of the season</td>
                </tr>
                <tr>
                    <td>title</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Episode title</td>
                </tr>
                <tr>
                    <td>episode_number</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>Episode number within the season</td>
                </tr>
                <tr>
                    <td>description</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Episode description</td>
                </tr>
                <tr>
                    <td>duration</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Duration in format HH:MM:SS</td>
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

    <div class="my-8 mb-16">
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
