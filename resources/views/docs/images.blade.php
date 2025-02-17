@extends('docs.layout')

@section('content')
<article class="prose prose-invert max-w-none">
    <h1>Images</h1>
    
    <p class="lead">
        The Images API allows you to manage images for movies, TV series, episodes, and user profiles.
    </p>

    <div class="my-8">
        <h2>List Images</h2>
        <div class="my-4">
            <span class="method-badge method-get">GET</span>
            <code>/api/v1/images</code>
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
                    <td>image_id</td>
                    <td>integer</td>
                    <td>No</td>
                    <td>Filter by image ID</td>
                </tr>
                <tr>
                    <td>url</td>
                    <td>string</td>
                    <td>No</td>
                    <td>Filter by URL</td>
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
            "image_id": 1,
            "title": "Breaking Bad Poster",
            "url": "https://api.dobridobrev.com/storage/images/breaking-bad-poster.jpg",
            "type": "poster",
            "imageable_type": "App\\Models\\TvSeries",
            "imageable_id": 1
        }
    ],
    "links": {
        "first": "https://api.dobridobrev.com/api/v1/images?page=1",
        "last": "https://api.dobridobrev.com/api/v1/images?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "per_page": 50,
        "to": 1,
        "total": 1
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Get Image</h2>
        <div class="my-4">
            <span class="method-badge method-get">GET</span>
            <code>/api/v1/images/{image_id}</code>
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
                    <td>image_id</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>Image ID</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "image_id": 1,
        "title": "Breaking Bad Poster",
        "url": "https://api.dobridobrev.com/storage/images/breaking-bad-poster.jpg",
        "type": "poster",
        "imageable_type": "App\\Models\\TvSeries",
        "imageable_id": 1
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Upload Image</h2>
        <div class="my-4">
            <span class="method-badge method-post">POST</span>
            <code>/api/v1/images</code>
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
                    <td>Image title</td>
                </tr>
                <tr>
                    <td>file</td>
                    <td>file</td>
                    <td>Yes</td>
                    <td>Image file (jpeg, png, jpg)</td>
                </tr>
                <tr>
                    <td>type</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Image type (poster, backdrop, still)</td>
                </tr>
                <tr>
                    <td>imageable_type</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Related model type (Movie, TvSeries, Episode)</td>
                </tr>
                <tr>
                    <td>imageable_id</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>ID of the related model</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "message": "Image created successfully",
    "data": {
        "image_id": 1,
        "title": "Breaking Bad Poster",
        "url": "https://api.dobridobrev.com/storage/images/breaking-bad-poster.jpg",
        "type": "poster",
        "imageable_type": "App\\Models\\TvSeries",
        "imageable_id": 1
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Update Image</h2>
        <div class="my-4">
            <span class="method-badge method-put">PUT</span>
            <code>/api/v1/images/{image_id}</code>
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
                    <td>image_id</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>Image ID</td>
                </tr>
            </tbody>
        </table>

        <h3>Request Body</h3>
        <p>Same as Upload Image endpoint.</p>

        <h3>Response</h3>
        <p>Same as Upload Image response.</p>
    </div>

    <div class="my-8">
        <h2>Delete Image</h2>
        <div class="my-4">
            <span class="method-badge method-delete">DELETE</span>
            <code>/api/v1/images/{image_id}</code>
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
                    <td>image_id</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>Image ID</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "message": "Image deleted successfully"
}</code></pre>
    </div>
</article>
@endsection
