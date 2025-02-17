@extends('docs.layout')

@section('content')
<article class="prose prose-invert max-w-none">
    <h1>Profile</h1>
    
    <p class="lead">
        The Profile API allows users to manage their profile information and preferences.
    </p>

    <div class="my-8">
        <h2>Get Profile</h2>
        <div class="my-4">
            <span class="method-badge method-get">GET</span>
            <code>/api/v1/profile</code>
        </div>

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "id": 1,
        "username": "john.doe",
        "email": "john.doe@example.com",
        "name": "John Doe",
        "avatar_url": "https://api.dobridobrev.com/storage/avatars/1.jpg",
        "language": "en",
        "notifications_enabled": true
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Update Profile</h2>
        <div class="my-4">
            <span class="method-badge method-put">PUT</span>
            <code>/api/v1/profile</code>
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
                    <td>name</td>
                    <td>string</td>
                    <td>No</td>
                    <td>Full name</td>
                </tr>
                <tr>
                    <td>email</td>
                    <td>string</td>
                    <td>No</td>
                    <td>Email address</td>
                </tr>
                <tr>
                    <td>language</td>
                    <td>string</td>
                    <td>No</td>
                    <td>Preferred language (en, it)</td>
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
        "avatar_url": "https://api.dobridobrev.com/storage/avatars/1.jpg",
        "language": "en",
        "notifications_enabled": true
    }
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Update Password</h2>
        <div class="my-4">
            <span class="method-badge method-put">PUT</span>
            <code>/api/v1/profile/password</code>
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
                    <td>current_password</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Current password</td>
                </tr>
                <tr>
                    <td>password</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>New password (min: 8 characters)</td>
                </tr>
                <tr>
                    <td>password_confirmation</td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>New password confirmation</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "message": "Password updated successfully"
}</code></pre>
    </div>

    <div class="my-8">
        <h2>Update Notification Settings</h2>
        <div class="my-4">
            <span class="method-badge method-put">PUT</span>
            <code>/api/v1/profile/notifications</code>
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
                    <td>notifications_enabled</td>
                    <td>boolean</td>
                    <td>Yes</td>
                    <td>Enable/disable notifications</td>
                </tr>
            </tbody>
        </table>

        <h3>Response</h3>
        <pre><code>{
    "data": {
        "notifications_enabled": true
    }
}</code></pre>
    </div>
</article>
@endsection
