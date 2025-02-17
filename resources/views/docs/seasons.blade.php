@extends('docs.layout')

@section('title', 'Seasons API')

@section('content')
<article class="prose max-w-none">
    <h1>Seasons</h1>
    
    <p class="lead">
        The Seasons API allows you to manage TV series seasons.
    </p>

    <div class="my-8">
        <h2>List Seasons</h2>
        <div class="my-4">
            <span class="method-badge method-get">GET</span>
            <code>/api/v1/tv-series/{series}/seasons</code>
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
                    <td>series</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>TV Series ID</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": [
        {
            "id": 1,
            "number": 1,
            "title": "Season 1",
            "episodes_count": 10,
            "release_date": "2023-01-01",
            "poster_url": "https://api.dobridobrev.com/storage/seasons/1/poster.jpg"
        }
    ]
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Get Season</h2>
        <div class="my-4">
            <span class="method-badge method-get">GET</span>
            <code>/api/v1/seasons/{season}</code>
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
                    <td>season</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>Season ID</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "id": 1,
        "number": 1,
        "title": "Season 1",
        "description": "First season of the series...",
        "episodes_count": 10,
        "release_date": "2023-01-01",
        "poster_url": "https://api.dobridobrev.com/storage/seasons/1/poster.jpg",
        "episodes": [
            {
                "id": 1,
                "number": 1,
                "title": "Pilot",
                "duration": 45,
                "thumbnail_url": "https://api.dobridobrev.com/storage/episodes/1/thumbnail.jpg"
            }
        ]
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Create Season</h2>
        <div class="my-4">
            <span class="method-badge method-post">POST</span>
            <code>/api/v1/tv-series/{series}/seasons</code>
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
                    <td>series</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>TV Series ID</td>
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
                    <td>number</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>Season number</td>
                </tr>
                <tr>
                    <td>title</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Season title</td>
                </tr>
                <tr>
                    <td>description</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Season description</td>
                </tr>
                <tr>
                    <td>release_date</td>
                    <td>date</td>
                    <td>Yes</td>
                    <td>Release date (YYYY-MM-DD)</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "id": 1,
        "number": 1,
        "title": "Season 1",
        "description": "First season of the series...",
        "episodes_count": 0,
        "release_date": "2023-01-01"
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Update Season</h2>
        <div class="my-4">
            <span class="method-badge method-put">PUT</span>
            <code>/api/v1/seasons/{season}</code>
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
                    <td>season</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>Season ID</td>
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
                    <td>Season title</td>
                </tr>
                <tr>
                    <td>description</td>
                    <td>string</td>
                    <td>No</td>
                    <td>Season description</td>
                </tr>
                <tr>
                    <td>release_date</td>
                    <td>date</td>
                    <td>No</td>
                    <td>Release date (YYYY-MM-DD)</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "id": 1,
        "number": 1,
        "title": "Season 1",
        "description": "First season of the series...",
        "episodes_count": 0,
        "release_date": "2023-01-01"
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Delete Season</h2>
        <div class="my-4">
            <span class="method-badge method-delete">DELETE</span>
            <code>/api/v1/seasons/{season}</code>
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
                    <td>season</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>Season ID</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "message": "Season deleted successfully"
}</code></pre>
    </div>
</article>
@endsection
