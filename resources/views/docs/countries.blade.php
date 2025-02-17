@extends('docs.layout')

@section('title', 'Countries API')

@section('content')
<article class="prose prose-invert max-w-none">
    <h1>Countries</h1>
    
    <p class="lead">
        The Countries API allows you to manage country information for content availability.
    </p>

    <div class="my-8">
        <h2>List Countries</h2>
        <div class="my-4">
            <span class="method-badge method-get">GET</span>
            <code>/api/v1/countries</code>
        </div>

        <h3>Response</h3>
        <pre><code>{
    "data": [
        {
            "id": 1,
            "name": "United States",
            "code": "US"
        },
        {
            "id": 2,
            "name": "United Kingdom",
            "code": "GB"
        }
    ]
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Create Country</h2>
        <div class="my-4">
            <span class="method-badge method-post">POST</span>
            <code>/api/v1/countries</code>
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
                    <td>Country name</td>
                </tr>
                <tr>
                    <td>code</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>ISO 3166-1 alpha-2 country code</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "id": 3,
        "name": "France",
        "code": "FR"
    }
}</code></pre>
    </div>
</article>
@endsection
