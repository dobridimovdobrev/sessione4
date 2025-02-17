@extends('docs.layout')

@section('title', 'Trailers API')

@section('content')
<article class="prose prose-invert max-w-none">
    <h1>Trailers API</h1>
    
    <p class="lead">
        The Trailers API allows you to manage movie and TV series trailers.
    </p>

    <div class="my-8">
        <h2>Add Trailer</h2>
        <div class="my-4">
            <span class="method-badge method-post">POST</span>
            <code class="endpoint">/api/v1/trailers</code>
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
                    <td><code>title</code></td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Trailer title</td>
                </tr>
                <tr>
                    <td><code>url</code></td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>URL of the trailer (YouTube, Vimeo)</td>
                </tr>
                <tr>
                    <td><code>entity_type</code></td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Type (movie, series)</td>
                </tr>
                <tr>
                    <td><code>entity_id</code></td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>ID of the movie or series</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="my-8">
        <h2>Get Trailer</h2>
        <div class="my-4">
            <span class="method-badge method-get">GET</span>
            <code class="endpoint">/api/v1/trailers/{id}</code>
        </div>

        <h3>Path Parameters</h3>
        <table class="docs-table">
            <thead>
                <tr>
                    <th>Parameter</th>
                    <th>Type</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><code>id</code></td>
                    <td>integer</td>
                    <td>Trailer ID</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="my-8">
        <h2>List Trailers</h2>
        <div class="my-4">
            <span class="method-badge method-get">GET</span>
            <code class="endpoint">/api/v1/trailers</code>
        </div>

        <h3>Query Parameters</h3>
        <table class="docs-table">
            <thead>
                <tr>
                    <th>Parameter</th>
                    <th>Type</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><code>entity_type</code></td>
                    <td>string</td>
                    <td>Filter by type (movie, series)</td>
                </tr>
                <tr>
                    <td><code>entity_id</code></td>
                    <td>integer</td>
                    <td>Filter by movie/series ID</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="my-8">
        <h2>Delete Trailer</h2>
        <div class="my-4">
            <span class="method-badge method-delete">DELETE</span>
            <code class="endpoint">/api/v1/trailers/{id}</code>
        </div>

        <h3>Path Parameters</h3>
        <table class="docs-table">
            <thead>
                <tr>
                    <th>Parameter</th>
                    <th>Type</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><code>id</code></td>
                    <td>integer</td>
                    <td>Trailer ID</td>
                </tr>
            </tbody>
        </table>
    </div>
</article>
@endsection
