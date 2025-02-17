@extends('docs.layout')

@section('content')
<article class="prose prose-invert max-w-none">
    <h1>Countries</h1>
    
    <p class="lead">
        Manage countries for user profiles and content.
    </p>

    <div class="my-8">
        <h2>List Countries</h2>
        <div class="my-4">
            <span class="method-badge method-get">GET</span>
            <code>/api/v1/countries</code>
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
                    <td>country_id</td>
                    <td>string</td>
                    <td>No</td>
                    <td>Filter by country ID</td>
                </tr>
                <tr>
                    <td>name</td>
                    <td>string</td>
                    <td>No</td>
                    <td>Filter by country name</td>
                </tr>
                <tr>
                    <td>continent</td>
                    <td>string</td>
                    <td>No</td>
                    <td>Filter by continent</td>
                </tr>
                <tr>
                    <td>iso2</td>
                    <td>string</td>
                    <td>No</td>
                    <td>Filter by ISO 2-letter code</td>
                </tr>
                <tr>
                    <td>iso3</td>
                    <td>string</td>
                    <td>No</td>
                    <td>Filter by ISO 3-letter code</td>
                </tr>
                <tr>
                    <td>phone_prefix</td>
                    <td>string</td>
                    <td>No</td>
                    <td>Filter by phone prefix</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": [
        {
            "id": 1,
            "name": "Italy",
            "continent": "EU",
            "iso_char2": "IT",
            "iso_char3": "ITA",
            "phone_prefix": "+39"
        },
        {
            "id": 2,
            "name": "Spain",
            "continent": "EU",
            "iso_char2": "ES",
            "iso_char3": "ESP",
            "phone_prefix": "+34"
        }
    ]
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Get Country</h2>
        <div class="my-4">
            <span class="method-badge method-get">GET</span>
            <code>/api/v1/countries/{country}</code>
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
                    <td>country</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>Country ID</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "id": 1,
        "name": "Italy",
        "continent": "EU",
        "iso_char2": "IT",
        "iso_char3": "ITA",
        "phone_prefix": "+39"
    }
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
                    <td>Country name (max 64 characters)</td>
                </tr>
                <tr>
                    <td>continent</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Continent code (max 5 characters)</td>
                </tr>
                <tr>
                    <td>iso_char2</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>ISO 2-letter code (2 characters)</td>
                </tr>
                <tr>
                    <td>iso_char3</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>ISO 3-letter code (3 characters)</td>
                </tr>
                <tr>
                    <td>phone_prefix</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Phone prefix (max 5 characters)</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "id": 1,
        "name": "Italy",
        "continent": "EU",
        "iso_char2": "IT",
        "iso_char3": "ITA",
        "phone_prefix": "+39"
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Update Country</h2>
        <div class="my-4">
            <span class="method-badge method-put">PUT</span>
            <code>/api/v1/countries/{country}</code>
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
                    <td>country</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>Country ID</td>
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
                    <td>Country name (max 64 characters)</td>
                </tr>
                <tr>
                    <td>continent</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Continent code (max 5 characters)</td>
                </tr>
                <tr>
                    <td>iso_char2</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>ISO 2-letter code (2 characters)</td>
                </tr>
                <tr>
                    <td>iso_char3</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>ISO 3-letter code (3 characters)</td>
                </tr>
                <tr>
                    <td>phone_prefix</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Phone prefix (max 5 characters)</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "id": 1,
        "name": "Italy",
        "continent": "EU",
        "iso_char2": "IT",
        "iso_char3": "ITA",
        "phone_prefix": "+39"
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Delete Country</h2>
        <div class="my-4">
            <span class="method-badge method-delete">DELETE</span>
            <code>/api/v1/countries/{country}</code>
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
                    <td>country</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>Country ID</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "message": "Country deleted successfully"
}</code></pre>
    </div>
</article>
@endsection
