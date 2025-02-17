@extends('docs.layout')

@section('title', 'Categories API')

@section('content')
<article class="prose prose-invert max-w-none">
    <h1>Categories API</h1>
    
    <p class="lead">
        The Categories API allows you to manage content categories for movies and TV series.
        <br><br>
        <span class="text-yellow-500">
            <strong>Permissions:</strong><br>
            - GET endpoints are accessible to both admin and user roles<br>
            - POST, PUT, DELETE endpoints require admin role
        </span>
    </p>

    <div class="my-8">
        <h2>List Categories</h2>
        <div class="my-4">
            <span class="method-badge method-get">GET</span>
            <code class="endpoint">/api/v1/categories</code>
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
                    <td><code>type</code></td>
                    <td>string</td>
                    <td>Filter by type (movie, series)</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="my-8">
        <h2>Get Category</h2>
        <div class="my-4">
            <span class="method-badge method-get">GET</span>
            <code class="endpoint">/api/v1/categories/{id}</code>
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
                    <td>Category ID</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="my-8">
        <h2>Create Category</h2>
        <div class="my-4">
            <span class="method-badge method-post">POST</span>
            <code class="endpoint">/api/v1/categories</code>
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
                    <td><code>name</code></td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Category name</td>
                </tr>
                <tr>
                    <td><code>description</code></td>
                    <td>string</td>
                    <td>No</td>
                    <td>Category description</td>
                </tr>
                <tr>
                    <td><code>type</code></td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Content type (movie, series)</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="my-8">
        <h2>Update Category</h2>
        <div class="my-4">
            <span class="method-badge method-put">PUT</span>
            <code class="endpoint">/api/v1/categories/{id}</code>
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
                    <td><code>name</code></td>
                    <td>string</td>
                    <td>No</td>
                    <td>Category name</td>
                </tr>
                <tr>
                    <td><code>description</code></td>
                    <td>string</td>
                    <td>No</td>
                    <td>Category description</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="my-8">
        <h2>Delete Category</h2>
        <div class="my-4">
            <span class="method-badge method-delete">DELETE</span>
            <code class="endpoint">/api/v1/categories/{id}</code>
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
                    <td>Category ID</td>
                </tr>
            </tbody>
        </table>
    </div>
</article>
@endsection
