@extends('docs.layout')

@section('title', 'Authentication')

@section('content')
<article class="prose prose-invert max-w-none">
    <h1>Authentication</h1>
    
    <p class="lead">
        All API requests require authentication using Bearer tokens. You'll need to include your API token in the Authorization header of each request.
    </p>

    <div class="my-8 p-4 bg-docs-light rounded-lg border border-docs-lighter">
        <h2 class="text-xl font-semibold mb-4">Authentication Header</h2>
        <pre><code>Authorization: Bearer your-api-token-here</code></pre>
    </div>

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
            <code class="endpoint">/api/v1/auth/login</code>
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
                    <td><code>email</code></td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Your email address</td>
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
        <pre><code>curl -X POST "https://api.example.com/v1/auth/login" \
    -H "Content-Type: application/json" \
    -d '{
        "email": "user@example.com",
        "password": "your-password"
    }'</code></pre>

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "token": "your-api-token-here",
        "token_type": "Bearer",
        "expires_in": 3600
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Register</h2>
        <p>Create a new account to access the API.</p>

        <div class="my-4">
            <span class="method-badge method-post">POST</span>
            <code class="endpoint">/api/v1/auth/register</code>
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
                    <td><code>name</code></td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Your full name</td>
                </tr>
                <tr>
                    <td><code>email</code></td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Your email address</td>
                </tr>
                <tr>
                    <td><code>password</code></td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Your password (min. 8 characters)</td>
                </tr>
                <tr>
                    <td><code>password_confirmation</code></td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Password confirmation</td>
                </tr>
            </tbody>
        </table>

        <h3>Example Request</h3>
        <pre><code>curl -X POST "https://api.example.com/v1/auth/register" \
    -H "Content-Type: application/json" \
    -d '{
        "name": "John Doe",
        "email": "user@example.com",
        "password": "your-password",
        "password_confirmation": "your-password"
    }'</code></pre>

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "id": 1,
        "name": "John Doe",
        "email": "user@example.com",
        "token": "your-api-token-here"
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Logout</h2>
        <p>Invalidate your current API token.</p>

        <div class="my-4">
            <span class="method-badge method-post">POST</span>
            <code class="endpoint">/api/v1/auth/logout</code>
        </div>

        <h3>Example Request</h3>
        <pre><code>curl -X POST "https://api.example.com/v1/auth/logout" \
    -H "Authorization: Bearer your-api-token-here"</code></pre>

        <h3>Response</h3>
        <pre><code>{
    "message": "Successfully logged out"
}</code></pre>
    </div>

    <div class="my-8 p-4 bg-blue-900/50 border-l-4 border-docs-primary rounded-lg">
        <h3 class="text-lg font-semibold mb-2">Security Note</h3>
        <p class="mb-0">
            Always keep your API tokens secure and never share them. If you suspect your token has been compromised,
            you should immediately invalidate it and generate a new one.
        </p>
    </div>
</article>
@endsection
