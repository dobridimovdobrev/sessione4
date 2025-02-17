@extends('docs.layout')

@section('title', 'Profile Updates API')

@section('content')
<article class="prose prose-invert max-w-none">
    <h1>Profile Updates API</h1>
    
    <p class="lead">
        The Profile Updates API allows users to manage their profile information and preferences.
        <br><br>
        <span class="text-yellow-500">
            <strong>Permissions:</strong><br>
            - All endpoints require authentication<br>
            - Users can only update their own profile<br>
            - Admins can update any profile
        </span>
    </p>

    <div class="my-8">
        <h2>Get Profile</h2>
        <div class="my-4">
            <span class="method-badge method-get">GET</span>
            <code class="endpoint">/api/v1/profile</code>
        </div>
    </div>

    <div class="my-8">
        <h2>Update Profile</h2>
        <div class="my-4">
            <span class="method-badge method-put">PUT</span>
            <code class="endpoint">/api/v1/update-profile</code>
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
                    <td>No</td>
                    <td>Full name</td>
                </tr>
                <tr>
                    <td><code>email</code></td>
                    <td>string</td>
                    <td>No</td>
                    <td>Email address</td>
                </tr>
                <tr>
                    <td><code>password</code></td>
                    <td>string</td>
                    <td>No</td>
                    <td>New password</td>
                </tr>
                <tr>
                    <td><code>password_confirmation</code></td>
                    <td>string</td>
                    <td>No</td>
                    <td>Password confirmation</td>
                </tr>
                <tr>
                    <td><code>language</code></td>
                    <td>string</td>
                    <td>No</td>
                    <td>Preferred language</td>
                </tr>
                <tr>
                    <td><code>notifications</code></td>
                    <td>object</td>
                    <td>No</td>
                    <td>Notification preferences</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="my-8">
        <h2>Update Profile Picture</h2>
        <div class="my-4">
            <span class="method-badge method-post">POST</span>
            <code class="endpoint">/api/v1/profile/picture</code>
        </div>

        <h3>Request Body (multipart/form-data)</h3>
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
                    <td><code>picture</code></td>
                    <td>file</td>
                    <td>Yes</td>
                    <td>Profile picture (JPG, PNG)</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="my-8">
        <h2>Delete Profile Picture</h2>
        <div class="my-4">
            <span class="method-badge method-delete">DELETE</span>
            <code class="endpoint">/api/v1/profile/picture</code>
        </div>
    </div>

    <div class="my-8">
        <h2>Update Notification Settings</h2>
        <div class="my-4">
            <span class="method-badge method-put">PUT</span>
            <code class="endpoint">/api/v1/profile/notifications</code>
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
                    <td><code>email_notifications</code></td>
                    <td>boolean</td>
                    <td>No</td>
                    <td>Enable/disable email notifications</td>
                </tr>
                <tr>
                    <td><code>push_notifications</code></td>
                    <td>boolean</td>
                    <td>No</td>
                    <td>Enable/disable push notifications</td>
                </tr>
                <tr>
                    <td><code>newsletter</code></td>
                    <td>boolean</td>
                    <td>No</td>
                    <td>Subscribe/unsubscribe from newsletter</td>
                </tr>
            </tbody>
        </table>
    </div>
</article>
@endsection
