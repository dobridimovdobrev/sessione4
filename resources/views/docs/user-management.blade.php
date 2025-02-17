@extends('docs.layout')

@section('title', 'User Management API')

@section('content')
<article class="prose prose-invert max-w-none">
    <h1>User Management</h1>
    
    <p class="lead">
        The User Management API allows administrators to manage users.
    </p>

    <div class="my-8">
        <h2>List Users</h2>
        <div class="my-4">
            <span class="method-badge method-get">GET</span>
            <code>/api/v1/users</code>
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
                    <td>page</td>
                    <td>integer</td>
                    <td>No</td>
                    <td>Page number (default: 1)</td>
                </tr>
                <tr>
                    <td>per_page</td>
                    <td>integer</td>
                    <td>No</td>
                    <td>Items per page (default: 15, max: 50)</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": [
        {
            "id": 1,
            "username": "john.doe",
            "email": "john.doe@example.com",
            "name": "John Doe",
            "status": "active",
            "created_at": "2023-01-01T00:00:00Z"
        }
    ],
    "meta": {
        "current_page": 1,
        "per_page": 15,
        "total": 100
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Get User</h2>
        <div class="my-4">
            <span class="method-badge method-get">GET</span>
            <code>/api/v1/users/{user}</code>
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
                    <td>user</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>User ID</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "id": 1,
        "username": "john.doe",
        "email": "john.doe@example.com",
        "name": "John Doe",
        "status": "active",
        "created_at": "2023-01-01T00:00:00Z"
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Create User</h2>
        <div class="my-4">
            <span class="method-badge method-post">POST</span>
            <code>/api/v1/users</code>
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
                    <td>username</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Username</td>
                </tr>
                <tr>
                    <td>email</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Email address</td>
                </tr>
                <tr>
                    <td>password</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Password (min: 8 characters)</td>
                </tr>
                <tr>
                    <td>name</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Full name</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "id": 1,
        "username": "john.doe",
        "email": "john.doe@example.com",
        "name": "John Doe",
        "status": "active",
        "created_at": "2023-01-01T00:00:00Z"
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Update User</h2>
        <div class="my-4">
            <span class="method-badge method-put">PUT</span>
            <code>/api/v1/users/{user}</code>
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
                    <td>user</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>User ID</td>
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
                    <td>email</td>
                    <td>string</td>
                    <td>No</td>
                    <td>Email address</td>
                </tr>
                <tr>
                    <td>name</td>
                    <td>string</td>
                    <td>No</td>
                    <td>Full name</td>
                </tr>
                <tr>
                    <td>status</td>
                    <td>string</td>
                    <td>No</td>
                    <td>User status (active, suspended)</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "id": 1,
        "username": "john.doe",
        "email": "john.doe@example.com",
        "name": "John Doe",
        "status": "active",
        "created_at": "2023-01-01T00:00:00Z"
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Delete User</h2>
        <div class="my-4">
            <span class="method-badge method-delete">DELETE</span>
            <code>/api/v1/users/{user}</code>
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
                    <td>user</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>User ID</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "message": "User deleted successfully"
}</code></pre>
    </div>
</article>
@endsection
