@extends('docs.layout')

@section('title', 'Authentication')

@section('content')
<article class="prose prose-invert max-w-none">
    <h1>Authentication</h1>
    
    <p class="lead">
        All API requests require authentication using Bearer tokens. You'll need to include your API token in the Authorization header of each request.
    </p>

    <pre><code>Authorization: Bearer your-api-token-here</code></pre>

    <h2>Obtaining an API Token</h2>
    <p>
        To obtain an API token, you need to:
    </p>
    <ol>
        <li>Register an account on our platform</li>
        <li>Log in to your account</li>
        <li>Navigate to your profile settings</li>
        <li>Generate a new API token</li>
    </ol>

    <div class="my-8">
        <h2>Login</h2>
        <p>Use this endpoint to obtain an authentication token. Note: This endpoint has rate limiting of 3 attempts every 10 minutes.</p>

        <div class="my-4">
            <span class="method-badge method-post">POST</span>
            <code class="endpoint">/api/login</code>
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
                    <td><code>username</code></td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Your username</td>
                </tr>
                <tr>
                    <td><code>password</code></td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Your password</td>
                </tr>
            </tbody>
        </table>

        <h3>Example Request</h3>
        <pre><code>curl -X POST "https://api.dobridobrev.com/api/login" \
    -H "Content-Type: application/json" \
    -d '{
        "username": "your-username",
        "password": "your-password"
    }'</code></pre>

        <h3>Response</h3>
        <pre><code>{
    "message": "Login successful",
    "data": {
        "token": "your-api-token",
        "user": {
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
                    <td>Invalid credentials</td>
                </tr>
                <tr>
                    <td>429</td>
                    <td>Too many login attempts. Please try again in 10 minutes.</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="my-8">
        <h2>Register</h2>
        <p>Use this endpoint to create a new user account.</p>

        <div class="my-4">
            <span class="method-badge method-post">POST</span>
            <code class="endpoint">/api/register</code>
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
    "country_id": 1
}</code></pre>

        <h3>Response</h3>
        <pre><code>{
    "message": "Registration successful",
    "data": {
        "token": "your-api-token",
        "user": {
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
                    <td>422</td>
                    <td>Validation Error - Invalid or missing fields</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="my-8">
        <h2>Logout</h2>
        <p>Invalidate your current API token.</p>

        <div class="my-4">
            <span class="method-badge method-post">POST</span>
            <code class="endpoint">/api/auth/logout</code>
        </div>

        <h3>Example Request</h3>
        <pre><code>curl -X POST "/api/auth/logout" \
    -H "Authorization: Bearer your-api-token-here"</code></pre>

        <h3>Response</h3>
        <pre><code>{
    "message": "Successfully logged out"
}</code></pre>
    </div>
</article>
@endsection
