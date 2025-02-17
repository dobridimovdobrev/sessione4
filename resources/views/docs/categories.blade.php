@extends('docs.layout')

@section('title', 'Categories API')

@section('content')
<article class="prose prose-invert max-w-none">
    <h1>Categories</h1>
    
    <p class="lead">
        The Categories API allows you to manage content categories for movies and TV series.
    </p>

    <div class="my-8">
        <h2>List Categories</h2>
        <div class="my-4">
            <span class="method-badge method-get">GET</span>
            <code>/api/v1/categories</code>
        </div>

        <h3>Response</h3>
        <pre><code>{
    "data": [
        {
            "id": 1,
            "name": "Action",
            "slug": "action"
        },
        {
            "id": 2,
            "name": "Comedy",
            "slug": "comedy"
        }
    ]
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Create Category</h2>
        <div class="my-4">
            <span class="method-badge method-post">POST</span>
            <code>/api/v1/categories</code>
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
                    <td>name</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Category name</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "id": 3,
        "name": "Horror",
        "slug": "horror"
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Get Category</h2>
        <div class="my-4">
            <span class="method-badge method-get">GET</span>
            <code>/api/v1/categories/{id}</code>
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
                    <td>id</td>
                    <td>integer</td>
                    <td>Category ID</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "id": 1,
        "name": "Action",
        "slug": "action"
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Update Category</h2>
        <div class="my-4">
            <span class="method-badge method-put">PUT</span>
            <code>/api/v1/categories/{id}</code>
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
                    <td>id</td>
                    <td>integer</td>
                    <td>Category ID</td>
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
                    <td>name</td>
                    <td>string</td>
                    <td>No</td>
                    <td>Category name</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "id": 1,
        "name": "Action",
        "slug": "action"
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Delete Category</h2>
        <div class="my-4">
            <span class="method-badge method-delete">DELETE</span>
            <code>/api/v1/categories/{id}</code>
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
                    <td>id</td>
                    <td>integer</td>
                    <td>Category ID</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "message": "Category deleted successfully"
}</code></pre>
    </div>
</article>
@endsection
