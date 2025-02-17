@extends('docs.layout')

@section('title', 'User Management API')

@section('content')
<article class="prose prose-invert max-w-none">
    <h1>User Management API</h1>
    
    <p class="lead">
        The User Management API allows administrators to manage users and their roles.
        <br><br>
        <span class="text-yellow-500">
            <strong>Permissions:</strong><br>
            - All endpoints require admin role except:<br>
            - GET /users/{id} (users can view their own profile)<br>
            - PUT /update-profile (users can update their own profile)
        </span>
    </p>

    <div class="my-8">
        <h2>List Users</h2>
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
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><code>page</code></td>
                    <td>integer</td>
                    <td>Page number for pagination</td>
                </tr>
                <tr>
                    <td><code>per_page</code></td>
                    <td>integer</td>
                    <td>Items per page</td>
                </tr>
                <tr>
                    <td><code>role</code></td>
                    <td>string</td>
                    <td>Filter by role</td>
                </tr>
                <tr>
                    <td><code>status</code></td>
                    <td>string</td>
                    <td>Filter by status (active, suspended)</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="my-8">
        <h2>Get User</h2>
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
                    <td><code>id</code></td>
                    <td>integer</td>
                    <td>User ID</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="my-8">
        <h2>Update User Role</h2>
        <div class="my-4">
            <span class="method-badge method-put">PUT</span>
            <code class="endpoint">/api/v1/users/{id}/role</code>
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
                    <td><code>role</code></td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>New role (admin, moderator, user)</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="my-8">
        <h2>Update User Status</h2>
        <div class="my-4">
            <span class="method-badge method-put">PUT</span>
            <code class="endpoint">/api/v1/users/{id}/status</code>
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
                    <td><code>status</code></td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>New status (active, suspended)</td>
                </tr>
                <tr>
                    <td><code>reason</code></td>
                    <td>string</td>
                    <td>No</td>
                    <td>Reason for status change</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="my-8">
        <h2>Delete User</h2>
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
                    <td><code>id</code></td>
                    <td>integer</td>
                    <td>User ID</td>
                </tr>
            </tbody>
        </table>
    </div>
</article>
@endsection
