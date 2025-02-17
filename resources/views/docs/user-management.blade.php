@extends('docs.layout')

@section('title', 'User Management')

@section('content')
<article class="prose prose-invert max-w-none">
    <h1>User Management</h1>
    
    <p class="lead">
        These endpoints allow administrators to manage users in the system.
        All endpoints in this section require administrator privileges.
    </p>

    <div class="my-8">
        <h2>List Users</h2>
        <p>Retrieve a list of all users in the system.</p>

        <div class="my-4">
            <span class="method-badge method-get">GET</span>
            <code class="endpoint">/api/v1/users</code>
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
                    <td>Page number for pagination (default: 1)</td>
                </tr>
                <tr>
                    <td>per_page</td>
                    <td>integer</td>
                    <td>No</td>
                    <td>Number of items per page (default: 15)</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": [
        {
            "user_id": 1,
            "username": "johndoe",
            "first_name": "John",
            "last_name": "Doe",
            "email": "john.doe@example.com",
            "gender": "male",
            "birthday": "1990-01-01",
            "country_id": 1,
            "user_status": "active",
            "role_id": 2
        },
        // ... more users
    ],
    "meta": {
        "current_page": 1,
        "per_page": 15,
        "total": 50
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Get User Details</h2>
        <p>Retrieve details of a specific user.</p>

        <div class="my-4">
            <span class="method-badge method-get">GET</span>
            <code class="endpoint">/api/v1/users/{id}</code>
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
                    <td>User ID</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "user_id": 1,
        "username": "johndoe",
        "first_name": "John",
        "last_name": "Doe",
        "email": "john.doe@example.com",
        "gender": "male",
        "birthday": "1990-01-01",
        "country_id": 1,
        "user_status": "active",
        "role_id": 2
    }
}</code></pre>

        <h3>Error Responses</h3>
        <table class="docs-table">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>404</td>
                    <td>User not found</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="my-8">
        <h2>Create User</h2>
        <p>Create a new user in the system.</p>

        <div class="my-4">
            <span class="method-badge method-post">POST</span>
            <code class="endpoint">/api/v1/users</code>
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
                    <td>username</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Username (max 64 characters)</td>
                </tr>
                <tr>
                    <td>email</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Valid email address</td>
                </tr>
                <tr>
                    <td>password</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Password (min 8 characters)</td>
                </tr>
                <tr>
                    <td>password_confirmation</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Password confirmation</td>
                </tr>
                <tr>
                    <td>first_name</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>First name (max 64 characters)</td>
                </tr>
                <tr>
                    <td>last_name</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Last name (max 64 characters)</td>
                </tr>
                <tr>
                    <td>gender</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Gender (male or female)</td>
                </tr>
                <tr>
                    <td>birthday</td>
                    <td>date</td>
                    <td>Yes</td>
                    <td>Date of birth</td>
                </tr>
                <tr>
                    <td>country_id</td>
                    <td>integer</td>
                    <td>No</td>
                    <td>ID of the user's country</td>
                </tr>
                <tr>
                    <td>role_id</td>
                    <td>integer</td>
                    <td>No</td>
                    <td>User role ID (default: 2 - regular user)</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "message": "User created successfully",
    "data": {
        "user_id": 1,
        "username": "johndoe",
        "first_name": "John",
        "last_name": "Doe",
        "email": "john.doe@example.com",
        "gender": "male",
        "birthday": "1990-01-01",
        "country_id": 1,
        "user_status": "active",
        "role_id": 2
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Update User</h2>
        <p>Update an existing user's information.</p>

        <div class="my-4">
            <span class="method-badge method-put">PUT</span>
            <code class="endpoint">/api/v1/users/{id}</code>
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
                    <td>User ID</td>
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
                    <td>username</td>
                    <td>string</td>
                    <td>No</td>
                    <td>Username (max 64 characters)</td>
                </tr>
                <tr>
                    <td>email</td>
                    <td>string</td>
                    <td>No</td>
                    <td>Valid email address</td>
                </tr>
                <tr>
                    <td>first_name</td>
                    <td>string</td>
                    <td>No</td>
                    <td>First name (max 64 characters)</td>
                </tr>
                <tr>
                    <td>last_name</td>
                    <td>string</td>
                    <td>No</td>
                    <td>Last name (max 64 characters)</td>
                </tr>
                <tr>
                    <td>gender</td>
                    <td>string</td>
                    <td>No</td>
                    <td>Gender (male or female)</td>
                </tr>
                <tr>
                    <td>birthday</td>
                    <td>date</td>
                    <td>No</td>
                    <td>Date of birth</td>
                </tr>
                <tr>
                    <td>country_id</td>
                    <td>integer</td>
                    <td>No</td>
                    <td>ID of the user's country</td>
                </tr>
                <tr>
                    <td>role_id</td>
                    <td>integer</td>
                    <td>No</td>
                    <td>User role ID</td>
                </tr>
                <tr>
                    <td>user_status</td>
                    <td>string</td>
                    <td>No</td>
                    <td>User status (active/inactive)</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "message": "User updated successfully",
    "data": {
        "user_id": 1,
        "username": "johndoe",
        "first_name": "John",
        "last_name": "Doe",
        "email": "john.doe@example.com",
        "gender": "male",
        "birthday": "1990-01-01",
        "country_id": 1,
        "user_status": "active",
        "role_id": 2
    }
}</code></pre>

        <h3>Error Responses</h3>
        <table class="docs-table">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>404</td>
                    <td>User not found</td>
                </tr>
                <tr>
                    <td>422</td>
                    <td>Validation Error - Invalid or missing fields</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="my-8">
        <h2>Delete User</h2>
        <p>Delete a user from the system.</p>

        <div class="my-4">
            <span class="method-badge method-delete">DELETE</span>
            <code class="endpoint">/api/v1/users/{id}</code>
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
                    <td>User ID</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "message": "User deleted successfully"
}</code></pre>

        <h3>Error Responses</h3>
        <table class="docs-table">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>404</td>
                    <td>User not found</td>
                </tr>
            </tbody>
        </table>
    </div>
</article>
@endsection
