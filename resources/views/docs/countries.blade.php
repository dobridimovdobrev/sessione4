@extends('docs.layout')

@section('title', 'Countries API')

@section('content')
<article class="prose prose-invert max-w-none">
    <h1>Countries API</h1>
    
    <p class="lead">
        The Countries API allows you to manage country information for content availability and restrictions.
        <br><br>
        <span class="text-yellow-500">
            <strong>Permissions:</strong><br>
            - GET endpoints are accessible to both admin and user roles<br>
            - POST, PUT, DELETE endpoints require admin role
        </span>
    </p>

    <div class="my-8">
        <h2>List Countries</h2>
        <div class="my-4">
            <span class="method-badge method-get">GET</span>
            <code class="endpoint">/api/v1/countries</code>
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
                    <td><code>region</code></td>
                    <td>string</td>
                    <td>Filter by region</td>
                </tr>
                <tr>
                    <td><code>available</code></td>
                    <td>boolean</td>
                    <td>Filter by service availability</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="my-8">
        <h2>Get Country</h2>
        <div class="my-4">
            <span class="method-badge method-get">GET</span>
            <code class="endpoint">/api/v1/countries/{code}</code>
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
                    <td><code>code</code></td>
                    <td>string</td>
                    <td>Country code (ISO 3166-1 alpha-2)</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="my-8">
        <h2>Update Country Availability</h2>
        <div class="my-4">
            <span class="method-badge method-put">PUT</span>
            <code class="endpoint">/api/v1/countries/{code}/availability</code>
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
                    <td><code>code</code></td>
                    <td>string</td>
                    <td>Country code (ISO 3166-1 alpha-2)</td>
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
                    <td><code>available</code></td>
                    <td>boolean</td>
                    <td>Yes</td>
                    <td>Service availability status</td>
                </tr>
                <tr>
                    <td><code>restrictions</code></td>
                    <td>array</td>
                    <td>No</td>
                    <td>Content restrictions</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="my-8">
        <h2>Get Content Availability</h2>
        <div class="my-4">
            <span class="method-badge method-get">GET</span>
            <code class="endpoint">/api/v1/countries/{code}/content/{content_id}</code>
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
                    <td><code>code</code></td>
                    <td>string</td>
                    <td>Country code (ISO 3166-1 alpha-2)</td>
                </tr>
                <tr>
                    <td><code>content_id</code></td>
                    <td>integer</td>
                    <td>Content ID (movie or series)</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="my-8">
        <h2>Update Content Availability</h2>
        <div class="my-4">
            <span class="method-badge method-put">PUT</span>
            <code class="endpoint">/api/v1/countries/{code}/content/{content_id}</code>
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
                    <td><code>code</code></td>
                    <td>string</td>
                    <td>Country code (ISO 3166-1 alpha-2)</td>
                </tr>
                <tr>
                    <td><code>content_id</code></td>
                    <td>integer</td>
                    <td>Content ID (movie or series)</td>
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
                    <td><code>available</code></td>
                    <td>boolean</td>
                    <td>Yes</td>
                    <td>Content availability status</td>
                </tr>
                <tr>
                    <td><code>start_date</code></td>
                    <td>string</td>
                    <td>No</td>
                    <td>Availability start date</td>
                </tr>
                <tr>
                    <td><code>end_date</code></td>
                    <td>string</td>
                    <td>No</td>
                    <td>Availability end date</td>
                </tr>
            </tbody>
        </table>
    </div>
</article>
@endsection
