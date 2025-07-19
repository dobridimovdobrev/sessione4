@extends('docs.layout')

@section('content')
<article class="prose prose-invert max-w-none">
    <h1>Persons</h1>
    
    <p class="lead">
        Manage persons (actors, directors, etc.) for movies and TV series.
    </p>

    <div class="my-8">
        <h2>List Persons</h2>
        <div class="my-4">
            <span class="method-badge method-get">GET</span>
            <code>/api/v1/persons</code>
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
                    <td>person_id</td>
                    <td>string</td>
                    <td>No</td>
                    <td>Filter by person ID</td>
                </tr>
                <tr>
                    <td>name</td>
                    <td>string</td>
                    <td>No</td>
                    <td>Filter by person name</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": [
        {
            "id": 1,
            "name": "Tom Hanks"
        },
        {
            "id": 2,
            "name": "Steven Spielberg"
        }
    ],
    "links": {
        "first": "https://api.dobridobrev.com/api/v1/persons?page=1",
        "last": "https://api.dobridobrev.com/api/v1/persons?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "per_page": 100,
        "to": 2,
        "total": 2
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Get Person</h2>
        <div class="my-4">
            <span class="method-badge method-get">GET</span>
            <code>/api/v1/persons/{person}</code>
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

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "id": 1,
        "name": "Tom Hanks"
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Create Person</h2>
        <div class="my-4">
            <span class="method-badge method-post">POST</span>
            <code>/api/v1/persons</code>
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
                    <td>Person's name (max 128 characters)</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "message": "Person created successfully",
    "data": {
        "id": 1,
        "name": "Tom Hanks"
    }
}</code></pre>

        <h3>Note</h3>
        <p>If a person with the same name already exists, the API will return the existing person instead of creating a duplicate:</p>
        <pre><code>{
    "message": "Person already exists",
    "person": {
        "id": 1,
        "name": "Tom Hanks"
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Update Person</h2>
        <div class="my-4">
            <span class="method-badge method-put">PUT</span>
            <code>/api/v1/persons/{person}</code>
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
                    <td>New person's name (max 128 characters)</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "id": 1,
        "name": "Tom Hanks"
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Delete Person</h2>
        <div class="my-4">
            <span class="method-badge method-delete">DELETE</span>
            <code>/api/v1/persons/{person}</code>
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

        <h3>Response</h3>
        <pre><code>{
    "message": "Person deleted successfully"
}</code></pre>
    </div>
</article>
@endsection
