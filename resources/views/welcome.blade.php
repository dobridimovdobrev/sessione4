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
            <td>Login to the system and receive an auth token.</td>
            <td>
                <ul>
                    <li>username: string, required</li>
                    <li>password: string, required</li>
                </ul>
            </td>
            <td>
                Success (200): <code>{ "token": "auth_token" }</code><br>
                Error (401): <code>{ "error": "Invalid credentials" }</code>
            </td>
        </tr>
    </table>

    <!-- User Role Routes -->
    <h1>User Role</h1>
    
    <h2>User Profile</h2>
    <table>
        <tr>
            <th>Endpoint</th>
            <th>HTTP Method</th>
            <th>Description</th>
            <th>Parameters</th>
            <th>Example Response</th>
        </tr>
        <tr>
            <td>/api/v1/update-profile</td>
            <td>PUT</td>
            <td>Update the user's profile.</td>
            <td>
                <ul>
                    <li>first_name: string, optional</li>
                    <li>last_name: string, optional</li>
                    <li>email: string, optional</li>
                    <li>password: string, optional</li>
                    <li>gender: string, optional</li>
                    <li>birthday: date, optional</li>
                    <li>country_id: integer, optional</li>
                </ul>
            </td>
            <td>
                Success (200): <code>{ "message": "Profile updated successfully" }</code><br>
                Error (403): <code>{ "error": "Forbidden" }</code>
            </td>
        </tr>
        <tr>
            <td>/api/v1/credits</td>
            <td>POST</td>
            <td>Add credits to the user's account.</td>
            <td>
                <ul>
                    <li>credits: int, required</li>
                </ul>
            </td>
            <td>
                Success (200): <code>{ "message": "Credits added successfully", "balance": 100 }</code><br>
                Error (403): <code>{ "error": "Forbidden" }</code>
            </td>
        </tr>
    </table>

    <!-- Countries -->
    <h2>Countries</h2>
    <table>
        <tr>
            <th>Endpoint</th>
            <th>HTTP Method</th>
            <th>Description</th>
            <th>Filter Parameters</th>
            <th>Example Response</th>
        </tr>
        <tr>
            <td>/api/v1/countries</td>
            <td>GET</td>
            <td>Retrieve all countries.</td>
            <td>
                <ul>
                    <li>name: string, optional</li>
                </ul>
            </td>
            <td>
                Success (200): <code>[{ "country_id": 1, "name": "USA" }]</code><br>
                Error (403): <code>{ "error": "Forbidden" }</code>
            </td>
        </tr>
        <tr>
            <td>/api/v1/countries/{country}</td>
            <td>GET</td>
            <td>Retrieve specific country details.</td>
            <td>None</td>
            <td>
                Success (200): <code>{ "country_id": 1, "name": "USA" }</code><br>
                Error (404): <code>{ "error": "Country not found" }</code>
            </td>
        </tr>
    </table>

    <!-- Categories -->
    <h2>Categories</h2>
    <table>
        <tr>
            <th>Endpoint</th>
            <th>HTTP Method</th>
            <th>Description</th>
            <th>Filter Parameters</th>
            <th>Example Response</th>
        </tr>
        <tr>
            <td>/api/v1/categories</td>
            <td>GET</td>
            <td>Retrieve all categories.</td>
            <td>None</td>
            <td>
                Success (200): <code>[{ "category_id": 1, "name": "Action" }]</code><br>
                Error (403): <code>{ "error": "Forbidden" }</code>
            </td>
        </tr>
        <tr>
            <td>/api/v1/categories/{category}</td>
            <td>GET</td>
            <td>Retrieve specific category details.</td>
            <td>None</td>
            <td>
                Success (200): <code>{ "category_id": 1, "name": "Action" }</code><br>
                Error (404): <code>{ "error": "Category not found" }</code>
            </td>
        </tr>
    </table>

    <!-- Persons -->
    <h2>Persons</h2>
    <table>
        <tr>
            <th>Endpoint</th>
            <th>HTTP Method</th>
            <th>Description</th>
            <th>Filter Parameters</th>
            <th>Example Response</th>
        </tr>
        <tr>
            <td>/api/v1/persons</td>
            <td>GET</td>
            <td>Retrieve all persons.</td>
            <td>
                <ul>
                    <li>name: string, optional</li>
                    <li>birthdate: date, optional</li>
                </ul>
            </td>
            <td>
                Success (200): <code>[{ "person_id": 1, "name": "John Doe" }]</code><br>
                Error (403): <code>{ "error": "Forbidden" }</code>
            </td>
        </tr>
        <tr>
            <td>/api/v1/persons/{person}</td>
            <td>GET</td>
            <td>Retrieve specific person details.</td>
            <td>None</td>
            <td>
                Success (200): <code>{ "person_id": 1, "name": "John Doe" }</code><br>
                Error (404): <code>{ "error": "Person not found" }</code>
            </td>
        </tr>
    </table>

    <!-- Movies -->
    <h2>Movies</h2>
    <table>
        <tr>
            <th>Endpoint</th>
            <th>HTTP Method</th>
            <th>Description</th>
            <th>Filter Parameters</th>
            <th>Example Response</th>
        </tr>
        <tr>
            <td>/api/v1/movies</td>
            <td>GET</td>
            <td>Retrieve all movies.</td>
            <td>
                <ul>
                    <li>title: string, optional</li>
                    <li>year: integer, optional</li>
                    <li>category_id: integer, optional</li>
                </ul>
            </td>
            <td>
                Success (200): <code>[{ "movie_id": 1, "title": "Inception" }]</code><br>
                Error (403): <code>{ "error": "Forbidden" }</code>
            </td>
        </tr>
        <tr>
            <td>/api/v1/movies/{movie}</td>
            <td>GET</td>
            <td>Retrieve specific movie details.</td>
            <td>None</td>
            <td>
                Success (200): <code>{ "movie_id": 1, "title": "Inception" }</code><br>
                Error (404): <code>{ "error": "Movie not found" }</code>
            </td>
        </tr>
    </table>

    <!-- TV Series -->
    <h2>TV Series</h2>
    <table>
        <tr>
            <th>Endpoint</th>
            <th>HTTP Method</th>
            <th>Description</th>
            <th>Filter Parameters</th>
            <th>Example Response</th>
        </tr>
        <tr>
            <td>/api/v1/tvseries</td>
            <td>GET</td>
            <td>Retrieve all TV series.</td>
            <td>
                <ul>
                    <li>title: string, optional</li>
                    <li>year: integer, optional</li>
                    <li>category_id: integer, optional</li>
                </ul>
            </td>
            <td>
                Success (200): <code>[{ "tv_series_id": 1, "title": "Breaking Bad" }]</code><br>
                Error (403): <code>{ "error": "Forbidden" }</code>
            </td>
        </tr>
        <tr>
            <td>/api/v1/tvseries/{tvSerie}</td>
            <td>GET</td>
            <td>Retrieve specific TV series details.</td>
            <td>None</td>
            <td>
                Success (200): <code>{ "tv_series_id": 1, "title": "Breaking Bad" }</code><br>
                Error (404): <code>{ "error": "TV Series not found" }</code>
            </td>
        </tr>
    </table>

    <!-- Seasons -->
    <h2>Seasons</h2>
    <table>
        <tr>
            <th>Endpoint</th>
            <th>HTTP Method</th>
            <th>Description</th>
            <th>Filter Parameters</th>
            <th>Example Response</th>
        </tr>
        <tr>
            <td>/api/v1/seasons</td>
            <td>GET</td>
            <td>Retrieve all seasons.</td>
            <td>
                <ul>
                    <li>title: string, optional</li>
                    <li>tv_series_id: integer, optional</li>
                </ul>
            </td>
            <td>
                Success (200): <code>[{ "season_id": 1, "title": "Season 1" }]</code><br>
                Error (403): <code>{ "error": "Forbidden" }</code>
            </td>
        </tr>
        <tr>
            <td>/api/v1/seasons/{season}</td>
            <td>GET</td>
            <td>Retrieve specific season details.</td>
            <td>None</td>
            <td>
                Success (200): <code>{ "season_id": 1, "title": "Season 1" }</code><br>
                Error (404): <code>{ "error": "Season not found" }</code>
            </td>
        </tr>
    </table>

    <!-- Episodes -->
    <h2>Episodes</h2>
    <table>
        <tr>
            <th>Endpoint</th>
            <th>HTTP Method</th>
            <th>Description</th>
            <th>Filter Parameters</th>
            <th>Example Response</th>
        </tr>
        <tr>
            <td>/api/v1/episodes</td>
            <td>GET</td>
            <td>Retrieve all episodes.</td>
            <td>
                <ul>
                    <li>title: string, optional</li>
                    <li>season_id: integer, optional</li>
                </ul>
            </td>
            <td>
                Success (200): <code>[{ "episode_id": 1, "title": "Pilot" }]</code><br>
                Error (403): <code>{ "error": "Forbidden" }</code>
            </td>
        </tr>
        <tr>
            <td>/api/v1/episodes/{episode}</td>
            <td>GET</td>
            <td>Retrieve specific episode details.</td>
            <td>None</td>
            <td>
                Success (200): <code>{ "episode_id": 1, "title": "Pilot" }</code><br>
                Error (404): <code>{ "error": "Episode not found" }</code>
            </td>
        </tr>
    </table>

    <!-- Trailers, Videos, and Images -->
    <h2>Media (Trailers, Videos, Images)</h2>
    <table>
        <tr>
            <th>Endpoint</th>
            <th>HTTP Method</th>
            <th>Description</th>
            <th>Example Response</th>
        </tr>
        <tr>
            <td>/api/v1/trailers</td>
            <td>GET</td>
            <td>Retrieve all trailers.</td>
            <td>
                Success (200): <code>[{ "trailer_id": 1, "title": "Official Trailer" }]</code><br>
                Error (403): <code>{ "error": "Forbidden" }</code>
            </td>
        </tr>
        <tr>
            <td>/api/v1/trailers/{trailer}</td>
            <td>GET</td>
            <td>Retrieve specific trailer details.</td>
            <td>
                Success (200): <code>{ "trailer_id": 1, "title": "Official Trailer" }</code><br>
                Error (404): <code>{ "error": "Trailer not found" }</code>
            </td>
        </tr>
        <tr>
            <td>/api/v1/videos</td>
            <td>GET</td>
            <td>Retrieve all videos.</td>
            <td>
                Success (200): <code>[{ "video_id": 1, "title": "Episode Clip" }]</code><br>
                Error (403): <code>{ "error": "Forbidden" }</code>
            </td>
        </tr>
        <tr>
            <td>/api/v1/videos/{video}</td>
            <td>GET</td>
            <td>Retrieve specific video details.</td>
            <td>
                Success (200): <code>{ "video_id": 1, "title": "Episode Clip" }</code><br>
                Error (404): <code>{ "error": "Video not found" }</code>
            </td>
        </tr>
        <tr>
            <td>/api/v1/images</td>
            <td>GET</td>
            <td>Retrieve all images.</td>
            <td>
                Success (200): <code>[{ "image_id": 1, "url": "image.jpg" }]</code><br>
                Error (403): <code>{ "error": "Forbidden" }</code>
            </td>
        </tr>
        <tr>
            <td>/api/v1/images/{image}</td>
            <td>GET</td>
            <td>Retrieve specific image details.</td>
            <td>
                Success (200): <code>{ "image_id": 1, "url": "image.jpg" }</code><br>
                Error (404): <code>{ "error": "Image not found" }</code>
            </td>
        </tr>
    </table>

    
    <!-- Relationship Data Access -->
    <div class="endpoint-section">
        <h2>Relationship Data Access</h2>
        <table>
            <tr>
                <th>Endpoint</th>
                <th>HTTP Method</th>
                <th>Description</th>
                <th>Parameters</th>
                <th>Example Responses</th>
            </tr>
            <!-- Person-Movie Pivot -->
            <tr>
                <td>/api/v1/persons/{person}/movies</td>
                <td>GET</td>
                <td>Get all movies associated with a person.</td>
                <td>person (int)</td>
                <td>
                    Success (200):<br>
                    <code>[{ "movie_id": 1, "title": "Inception" }]</code>
                </td>
            </tr>
            <!-- Image-Movie Pivot -->
            <tr>
                <td>/api/v1/images/{image}/movies</td>
                <td>GET</td>
                <td>Get all movies associated with an image.</td>
                <td>image (int)</td>
                <td>
                    Success (200):<br>
                    <code>[{ "movie_id": 1, "title": "Inception" }]</code>
                </td>
            </tr>
            <!-- Video-Movie Pivot -->
            <tr>
                <td>/api/v1/videos/{video}/movies</td>
                <td>GET</td>
                <td>Get all movies associated with a video.</td>
                <td>video (int)</td>
                <td>
                    Success (200):<br>
                    <code>[{ "movie_id": 1, "title": "Inception" }]</code>
                </td>
            </tr>
            <!-- Trailer-Movie Pivot -->
            <tr>
                <td>/api/v1/trailers/{trailer}/movies</td>
                <td>GET</td>
                <td>Get all movies associated with a trailer.</td>
                <td>trailer (int)</td>
                <td>
                    Success (200):<br>
                    <code>[{ "movie_id": 1, "title": "Inception" }]</code>
                </td>
            </tr>
            <!-- Person-TvSeries Pivot -->
            <tr>
                <td>/api/v1/tvseries/{tvSeries}/persons</td>
                <td>GET</td>
                <td>Get all persons associated with a TV series.</td>
                <td>tvSeries (int)</td>
                <td>
                    Success (200):<br>
                    <code>[{ "person_id": 1, "name": "Actor Name" }]</code>
                </td>
            </tr>
            <!-- Trailer-TvSeries Pivot -->
            <tr>
                <td>/api/v1/tvseries/{tvSeries}/trailers</td>
                <td>GET</td>
                <td>Get all trailers associated with a TV series.</td>
                <td>tvSeries (int)</td>
                <td>
                    Success (200):<br>
                    <code>[{ "trailer_id": 1, "title": "Official Trailer" }]</code>
                </td>
            </tr>
            <!-- Image-TvSeries Pivot -->
            <tr>
                <td>/api/v1/tvseries/{tvSeries}/images</td>
                <td>GET</td>
                <td>Get all images associated with a TV series.</td>
                <td>tvSeries (int)</td>
                <td>
                    Success (200):<br>
                    <code>[{ "image_id": 1, "url": "image.jpg" }]</code>
                </td>
            </tr>
            <!-- Person-Season Pivot -->
            <tr>
                <td>/api/v1/seasons/{season}/persons</td>
                <td>GET</td>
                <td>Get all persons associated with a season.</td>
                <td>season (int)</td>
                <td>
                    Success (200):<br>
                    <code>[{ "person_id": 1, "name": "Actor Name" }]</code>
                </td>
            </tr>
            <!-- Image-Season Pivot -->
            <tr>
                <td>/api/v1/seasons/{season}/images</td>
                <td>GET</td>
                <td>Get all images associated with a season.</td>
                <td>season (int)</td>
                <td>
                    Success (200):<br>
                    <code>[{ "image_id": 1, "url": "season-image.jpg" }]</code>
                </td>
            </tr>
            <!-- Trailer-Season Pivot -->
            <tr>
                <td>/api/v1/seasons/{season}/trailers</td>
                <td>GET</td>
                <td>Get all trailers associated with a season.</td>
                <td>season (int)</td>
                <td>
                    Success (200):<br>
                    <code>[{ "trailer_id": 1, "title": "Season Trailer" }]</code>
                </td>
            </tr>
            <!-- Person-Episode Pivot -->
            <tr>
                <td>/api/v1/episodes/{episode}/persons</td>
                <td>GET</td>
                <td>Get all persons associated with an episode.</td>
                <td>episode (int)</td>
                <td>
                    Success (200):<br>
                    <code>[{ "person_id": 1, "name": "Actor Name" }]</code>
                </td>
            </tr>
            <!-- Image-Episode Pivot -->
            <tr>
                <td>/api/v1/episodes/{episode}/images</td>
                <td>GET</td>
                <td>Get all images associated with an episode.</td>
                <td>episode (int)</td>
                <td>
                    Success (200):<br>
                    <code>[{ "image_id": 1, "url": "episode-image.jpg" }]</code>
                </td>
            </tr>
            <!-- Image-Person Pivot -->
            <tr>
                <td>/api/v1/persons/{person}/images</td>
                <td>GET</td>
                <td>Get all images associated with a person.</td>
                <td>person (int)</td>
                <td>
                    Success (200):<br>
                    <code>[{ "image_id": 1, "url": "person-image.jpg" }]</code>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
