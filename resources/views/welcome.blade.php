<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>API Documentation</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { text-align: center; }
        h2 { text-align: left; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; vertical-align: top; }
        th { background-color: #f4f4f4; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        code { font-family: monospace; background-color: #f9f9f9; padding: 2px 5px; }
    </style>
</head>
<body>
    <h1>API Documentation</h1>
    <hr>

    <!-- Guest Role -->
    <h1>Guest Role</h1>
    <h2>Authentication</h2>
    <table>
        <tr>
            <th>Endpoint</th>
            <th>HTTP Method</th>
            <th>Description</th>
            <th>Parameters</th>
            <th>Example Response</th>
        </tr>
        <tr>
            <td>/api/register</td>
            <td>POST</td>
            <td>Register a new user.</td>
            <td>
                <ul>
                    <li>username: string, required</li>
                    <li>email: string, required</li>
                    <li>password: string, required</li>
                    <li>first_name: string, required</li>
                    <li>last_name: string, required</li>
                    <li>gender: string, optional</li>
                    <li>birthday: date, optional</li>
                    <li>country_id: integer, optional</li>
                </ul>
            </td>
            <td>
                Success (200): <code>{ "message": "User registered successfully" }</code><br>
                Error (400): <code>{ "error": "Validation failed" }</code>
            </td>
        </tr>
        <tr>
            <td>/api/login</td>
            <td>POST</td>
            <td>Login with credentials.</td>
            <td>
                <ul>
                    <li>email: string, required</li>
                    <li>password: string, required</li>
                </ul>
            </td>
            <td>
                Success (200): <code>{ "token": "..." }</code><br>
                Error (401): <code>{ "error": "Invalid credentials" }</code>
            </td>
        </tr>
    </table>

    <!-- Authorization -->
    <h2>Authorization</h2>
    <p>The API uses role-based access control with Laravel Sanctum for authentication:</p>
    <ul>
        <li><strong>Guest</strong>: Can only access registration and login endpoints</li>
        <li><strong>User</strong>: Can view content and manage their own profile</li>
        <li><strong>Admin</strong>: Has full access to all endpoints and can manage all resources</li>
    </ul>
    <p>All authenticated endpoints require a Bearer token in the Authorization header:</p>
    <code>Authorization: Bearer your-token-here</code>

    <!-- Admin Role -->
    <h1>Admin Role Endpoints</h1>
    <h2>Resource Management</h2>
    <table>
        <tr>
            <th>Endpoint</th>
            <th>HTTP Method</th>
            <th>Description</th>
            <th>Access</th>
        </tr>
        <tr>
            <td>/api/v1/users</td>
            <td>GET, POST</td>
            <td>Manage users</td>
            <td>Admin only</td>
        </tr>
        <tr>
            <td>/api/v1/categories</td>
            <td>POST, PUT, DELETE</td>
            <td>Manage categories</td>
            <td>Admin only</td>
        </tr>
        <tr>
            <td>/api/v1/movies</td>
            <td>POST, PUT, DELETE</td>
            <td>Manage movies</td>
            <td>Admin only</td>
        </tr>
        <tr>
            <td>/api/v1/tvseries</td>
            <td>POST, PUT, DELETE</td>
            <td>Manage TV series</td>
            <td>Admin only</td>
        </tr>
        <tr>
            <td>/api/v1/seasons</td>
            <td>POST, PUT, DELETE</td>
            <td>Manage seasons</td>
            <td>Admin only</td>
        </tr>
        <tr>
            <td>/api/v1/episodes</td>
            <td>POST, PUT, DELETE</td>
            <td>Manage episodes</td>
            <td>Admin only</td>
        </tr>
        <tr>
            <td>/api/v1/persons</td>
            <td>POST, PUT, DELETE</td>
            <td>Manage persons</td>
            <td>Admin only</td>
        </tr>
    </table>

    <!-- User and Admin Role -->
    <h1>User and Admin Role Endpoints</h1>
    <h2>Content Access</h2>
    <table>
        <tr>
            <th>Endpoint</th>
            <th>HTTP Method</th>
            <th>Description</th>
            <th>Access</th>
        </tr>
        <tr>
            <td>/api/v1/movies</td>
            <td>GET</td>
            <td>List and view movies</td>
            <td>User, Admin</td>
        </tr>
        <tr>
            <td>/api/v1/tvseries</td>
            <td>GET</td>
            <td>List and view TV series</td>
            <td>User, Admin</td>
        </tr>
        <tr>
            <td>/api/v1/seasons</td>
            <td>GET</td>
            <td>List and view seasons</td>
            <td>User, Admin</td>
        </tr>
        <tr>
            <td>/api/v1/episodes</td>
            <td>GET</td>
            <td>List and view episodes</td>
            <td>User, Admin</td>
        </tr>
        <tr>
            <td>/api/v1/persons</td>
            <td>GET</td>
            <td>List and view persons</td>
            <td>User, Admin</td>
        </tr>
    </table>

    <h2>Media Relationships</h2>
    <table>
        <tr>
            <th>Endpoint</th>
            <th>HTTP Method</th>
            <th>Description</th>
            <th>Access</th>
        </tr>
        <tr>
            <td>/api/v1/movies/{movie}/images</td>
            <td>GET</td>
            <td>Get movie images</td>
            <td>User, Admin</td>
        </tr>
        <tr>
            <td>/api/v1/movies/{movie}/trailers</td>
            <td>GET</td>
            <td>Get movie trailers</td>
            <td>User, Admin</td>
        </tr>
        <tr>
            <td>/api/v1/tvseries/{tvSerie}/images</td>
            <td>GET</td>
            <td>Get TV series images</td>
            <td>User, Admin</td>
        </tr>
        <tr>
            <td>/api/v1/tvseries/{tvSerie}/trailers</td>
            <td>GET</td>
            <td>Get TV series trailers</td>
            <td>User, Admin</td>
        </tr>
        <tr>
            <td>/api/v1/episodes/{episode}/images</td>
            <td>GET</td>
            <td>Get episode images</td>
            <td>User, Admin</td>
        </tr>
        <tr>
            <td>/api/v1/persons/{person}/images</td>
            <td>GET</td>
            <td>Get person images</td>
            <td>User, Admin</td>
        </tr>
    </table>

    <h2>Response Format</h2>
    <p>All responses are returned in JSON format and include:</p>
    <ul>
        <li>HTTP status code indicating success or failure</li>
        <li>Response data or error message</li>
        <li>Pagination information for list endpoints</li>
    </ul>

    <h2>Error Handling</h2>
    <p>The API uses standard HTTP status codes:</p>
    <ul>
        <li>200: Success</li>
        <li>201: Created</li>
        <li>400: Bad Request</li>
        <li>401: Unauthorized</li>
        <li>403: Forbidden</li>
        <li>404: Not Found</li>
        <li>422: Validation Error</li>
        <li>500: Server Error</li>
    </ul>
</body>
</html>
