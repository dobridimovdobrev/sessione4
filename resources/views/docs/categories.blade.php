@extends('docs.layout')

@section('content')
<article class="prose prose-invert max-w-none">
    <h1>Categories</h1>
    
    <p class="lead">
        Manage movie and TV series categories.
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
            "name": "Action"
        },
        {
            "id": 2,
            "name": "Comedy"
        }
    ]
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Get Category</h2>
        <div class="my-4">
            <span class="method-badge method-get">GET</span>
            <code>/api/v1/categories/{category}</code>
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
                    <td>category</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>Category ID</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "id": 1,
        "name": "Action"
    }
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
                    <th>Parameter</th>
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
                    <td>Category name (max 64 characters)</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "message": "Category created successfully",
    "data": {
        "id": 1,
        "name": "Action"
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Update Category</h2>
        <div class="my-4">
            <span class="method-badge method-put">PUT</span>
            <code>/api/v1/categories/{category}</code>
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
                    <td>category</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>Category ID</td>
                </tr>
            </tbody>
        </table>

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
                    <td>name</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>New category name (max 64 characters)</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "message": "Category updated successfully",
    "data": {
        "id": 1,
        "name": "Action Movies"
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Delete Category</h2>
        <div class="my-4">
            <span class="method-badge method-delete">DELETE</span>
            <code>/api/v1/categories/{category}</code>
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
                    <td>category</td>
                    <td>integer</td>
                    <td>Yes</td>
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
