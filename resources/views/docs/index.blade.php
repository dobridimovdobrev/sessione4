@extends('docs.layout')

@section('title', 'Introduction')

@section('content')
<article class="prose prose-invert max-w-none">
    <h1 id="introduction">Introduction</h1>
    <p class="lead">
        Welcome to the API documentation for our streaming platform. This API provides a comprehensive set of endpoints
        to manage movies, TV series, and related media content.
    </p>

    <h2>Base URL</h2>
    <p>All API requests should be made to:</p>
    <pre><code>https://your-domain.com/api/v1/</code></pre>

    <h2>Authentication</h2>
    <p>
        This API uses Laravel Sanctum for authentication. All requests must include a valid Bearer token in the
        Authorization header:
    </p>
    <pre><code>Authorization: Bearer your-token-here</code></pre>

    <h2>Response Format</h2>
    <p>All responses are returned in JSON format. A typical success response looks like:</p>
    <pre><code>{
    "data": {
        // Response data here
    },
    "message": "Operation successful"
}</code></pre>

    <p>Error responses follow this format:</p>
    <pre><code>{
    "error": "Error message here",
    "code": 400
}</code></pre>

    <h2>Rate Limiting</h2>
    <p>
        API requests are limited to protect our servers from overwhelming traffic. The current limits are:
    </p>
    <ul>
        <li>Authentication endpoints: 3 requests per 10 minutes</li>
        <li>Other endpoints: 60 requests per minute</li>
    </ul>

    <h2>Pagination</h2>
    <p>
        List endpoints return paginated results with 24 items per page. The response includes metadata about the
        current page and total results:
    </p>
    <pre><code>{
    "data": [],
    "links": {
        "first": "http://api.example.com/items?page=1",
        "last": "http://api.example.com/items?page=5",
        "prev": null,
        "next": "http://api.example.com/items?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 5,
        "path": "http://api.example.com/items",
        "per_page": 24,
        "to": 24,
        "total": 120
    }
}</code></pre>

    <h2>HTTP Methods</h2>
    <p>The API uses standard HTTP methods:</p>
    <ul>
        <li><span class="method-get">GET</span> - Retrieve resources</li>
        <li><span class="method-post">POST</span> - Create new resources</li>
        <li><span class="method-put">PUT</span> - Update existing resources</li>
        <li><span class="method-delete">DELETE</span> - Remove resources</li>
    </ul>

    <h2>Content Types</h2>
    <p>
        For endpoints that accept data (POST/PUT), you should send the data as JSON with the appropriate
        Content-Type header:
    </p>
    <pre><code>Content-Type: application/json</code></pre>

    <h2>File Uploads</h2>
    <p>
        For endpoints that handle file uploads (images, videos), use multipart/form-data:
    </p>
    <pre><code>Content-Type: multipart/form-data</code></pre>
</article>
@endsection
