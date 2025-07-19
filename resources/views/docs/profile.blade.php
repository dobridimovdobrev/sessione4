@extends('docs.layout')

@section('content')
<article class="prose prose-invert max-w-none">
    <h1>Profile</h1>
    
    <p class="lead">
        The Profile API allows users to manage their profile information.
    </p>

    <div class="my-8">
        <h2>Update Profile</h2>
        <div class="my-4">
            <span class="method-badge method-put">PUT</span>
            <code>/api/v1/update-profile</code>
        </div>

        <p>Update the authenticated user's profile information.</p>

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
                    <td>No</td>
                    <td>Password (min 8 characters, must be confirmed)</td>
                </tr>
                <tr>
                    <td>password_confirmation</td>
                    <td>string</td>
                    <td>No</td>
                    <td>Password confirmation (required if password is provided)</td>
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
            </tbody>
        </table>

        <h3>Example Request</h3>
        <pre><code>{
    "username": "johndoe",
    "email": "john.doe@example.com",
    "first_name": "John",
    "last_name": "Doe",
    "gender": "male",
    "birthday": "1990-01-01",
    "country_id": 1
}</code></pre>

        <h3>Response</h3>
        <pre><code>{
    "message": "Profile updated successfully",
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
                    <td>401</td>
                    <td>Unauthenticated - User is not logged in</td>
                </tr>
                <tr>
                    <td>403</td>
                    <td>Forbidden - User does not have permission to update this profile</td>
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
