@extends('docs.layout')

@section('content')
<article class="prose prose-invert max-w-none">
    <h1>Images</h1>
    
    <p class="lead">
        The Images API allows you to manage images for movies, TV series, episodes, and user profiles.
    </p>

    <div class="my-8">
        <h2>Upload Movie Image</h2>
        <div class="my-4">
            <span class="method-badge method-post">POST</span>
            <code>/api/v1/movies/{movie}/images</code>
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
                    <td>movie</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>Movie ID</td>
                </tr>
            </tbody>
        </table>

        <h3>Request Body (multipart/form-data)</h3>
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
                    <td>image</td>
                    <td>file</td>
                    <td>Yes</td>
                    <td>Image file (jpeg, png, max 2MB)</td>
                </tr>
                <tr>
                    <td>type</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Image type (poster, backdrop)</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "id": 1,
        "url": "https://api.dobridobrev.com/storage/movies/1/poster.jpg",
        "type": "poster"
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Upload TV Series Image</h2>
        <div class="my-4">
            <span class="method-badge method-post">POST</span>
            <code>/api/v1/tv-series/{series}/images</code>
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

        <h3>Request Body (multipart/form-data)</h3>
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
                    <td>image</td>
                    <td>file</td>
                    <td>Yes</td>
                    <td>Image file (jpeg, png, max 2MB)</td>
                </tr>
                <tr>
                    <td>type</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Image type (poster, backdrop)</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "id": 1,
        "url": "https://api.dobridobrev.com/storage/series/1/poster.jpg",
        "type": "poster"
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Upload Episode Image</h2>
        <div class="my-4">
            <span class="method-badge method-post">POST</span>
            <code>/api/v1/episodes/{episode}/images</code>
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
                    <td>episode</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>Episode ID</td>
                </tr>
            </tbody>
        </table>

        <h3>Request Body (multipart/form-data)</h3>
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
                    <td>image</td>
                    <td>file</td>
                    <td>Yes</td>
                    <td>Image file (jpeg, png, max 2MB)</td>
                </tr>
                <tr>
                    <td>type</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Image type (thumbnail, still)</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "id": 1,
        "url": "https://api.dobridobrev.com/storage/episodes/1/thumbnail.jpg",
        "type": "thumbnail"
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Upload Person Image</h2>
        <div class="my-4">
            <span class="method-badge method-post">POST</span>
            <code>/api/v1/persons/{person}/images</code>
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
                    <td>person</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>Person ID</td>
                </tr>
            </tbody>
        </table>

        <h3>Request Body (multipart/form-data)</h3>
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
                    <td>image</td>
                    <td>file</td>
                    <td>Yes</td>
                    <td>Image file (jpeg, png, max 2MB)</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "id": 1,
        "url": "https://api.dobridobrev.com/storage/persons/1/profile.jpg",
        "type": "profile"
    }
}</code></pre>
    </div>
</article>
@endsection
