@extends('docs.layout')

@section('title', 'Introduction')

@section('content')
<article class="prose prose-invert max-w-none">
    <h1>Introduction</h1>
    <p class="lead">
        Welcome to the API documentation for our streaming platform. This API provides a comprehensive set of endpoints
        to manage movies, TV series, and related media content.
    </p>

    <h2>Base URL</h2>
    <p>All API requests should be made to:</p>
    <pre><code>https://api.dobridobrev.com/api/v1/</code></pre>

    <h2>Authentication</h2>
    <p>
        All API requests must include a valid Bearer token in the Authorization header:
    </p>
    <pre><code>Authorization: Bearer your-token-here</code></pre>

    <h2>Response Format</h2>
    <p>All responses are returned in JSON format.</p>
    
    <h3>Success Response</h3>
    <pre><code>{
    "data": {
        // Response data here
    }
}</code></pre>

    <h3>Error Response</h3>
    <pre><code>{
    "error": "Error message here",
    "code": 400
}</code></pre>

    <h2>Rate Limiting</h2>
    <ul>
        <li>Authentication endpoints: 3 requests per 10 minutes</li>
        <li>Other endpoints: 60 requests per minute</li>
    </ul>

    <h2>Pagination</h2>
    <p>List endpoints return paginated results with 24 items per page.</p>
    <pre><code>{
    "data": [
        // Array of items
    ],
    "meta": {
        "current_page": 1,
        "total": 50,
        "per_page": 24
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
