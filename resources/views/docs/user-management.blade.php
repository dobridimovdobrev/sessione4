@extends('docs.layout')

@section('content')
<article class="prose prose-invert max-w-none">
    <h1>User Management</h1>
    
    <p class="lead">
        The User Management API allows administrators to manage users in the system.
    </p>

    <div class="my-8">
        <h2>Create User</h2>
        <div class="my-4">
            <span class="method-badge method-post">POST</span>
            <code>/api/v1/users</code>
        </div>

        <p>Create a new user in the system. Requires administrator privileges.</p>

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
                    <td>user_status</td>
                    <td>string</td>
                    <td>No</td>
                    <td>User status (active, inactive, banned)</td>
                </tr>
            </tbody>
        </table>

        <h3>Example Request</h3>
        <pre><code>{
    "username": "johndoe",
    "email": "john.doe@example.com",
    "password": "password123",
    "password_confirmation": "password123",
    "first_name": "John",
    "last_name": "Doe",
    "gender": "male",
    "birthday": "1990-01-01",
    "country_id": 1,
    "user_status": "active"
}</code></pre>

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
        <div class="my-4">
            <span class="method-badge method-put">PUT</span>
            <code>/api/v1/users/{id}</code>
        </div>

        <p>Update an existing user's information. Requires administrator privileges.</p>

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
                    <td>id</td>
                    <td>integer</td>
                    <td>Yes</td>
                    <td>User ID</td>
                </tr>
            </tbody>
        </table>

        <h3>Request Body</h3>
        <p>Same fields as Create User endpoint, but all fields are optional.</p>

        <h3>Example Request</h3>
        <pre><code>{
    "email": "john.updated@example.com",
    "first_name": "John Updated",
    "user_status": "inactive"
}</code></pre>

        <h3>Response</h3>
        <pre><code>{
    "message": "User updated successfully",
    "data": {
        "user_id": 1,
        "username": "johndoe",
        "first_name": "John Updated",
        "last_name": "Doe",
        "email": "john.updated@example.com",
        "gender": "male",
        "birthday": "1990-01-01",
        "country_id": 1,
        "user_status": "inactive",
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
                    <td>401</td>
                    <td>Unauthenticated - User is not logged in</td>
                </tr>
                <tr>
                    <td>403</td>
                    <td>Forbidden - User does not have administrator privileges</td>
                </tr>
                <tr>
                    <td>404</td>
                    <td>Not Found - User with specified ID does not exist</td>
                </tr>
                <tr>
                    <td>422</td>
                    <td>Validation Error - Invalid or missing fields</td>
                </tr>
            </tbody>
        </table>
    </div>
</article>
@endsection
