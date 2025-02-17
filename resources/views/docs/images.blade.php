@extends('docs.layout')

@section('title', 'Images API')

@section('content')
<article class="prose prose-invert max-w-none">
    <h1>Images API</h1>
    
    <p class="lead">
        The Images API allows you to manage images for movies, TV series, episodes, and user profiles.
    </p>

    <div class="my-8">
        <h2>Upload Movie Image</h2>
        <div class="my-4">
            <span class="method-badge method-post">POST</span>
            <code class="endpoint">/api/v1/movies/{movie}/images</code>
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
                    <td><code>movie</code></td>
                    <td>integer</td>
                    <td>Movie ID</td>
                </tr>
            </tbody>
        </table>

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
                    <td><code>image</code></td>
                    <td>file</td>
                    <td>Yes</td>
                    <td>Image file (JPG, PNG, WebP)</td>
                </tr>
                <tr>
                    <td><code>type</code></td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Type of image (poster, backdrop)</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="my-8">
        <h2>Upload TV Series Image</h2>
        <div class="my-4">
            <span class="method-badge method-post">POST</span>
            <code class="endpoint">/api/v1/tvseries/{tvSeries}/images</code>
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
                    <td><code>tvSeries</code></td>
                    <td>integer</td>
                    <td>TV Series ID</td>
                </tr>
            </tbody>
        </table>

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
                    <td><code>image</code></td>
                    <td>file</td>
                    <td>Yes</td>
                    <td>Image file (JPG, PNG, WebP)</td>
                </tr>
                <tr>
                    <td><code>type</code></td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Type of image (poster, backdrop)</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="my-8">
        <h2>Upload Episode Image</h2>
        <div class="my-4">
            <span class="method-badge method-post">POST</span>
            <code class="endpoint">/api/v1/episodes/{episode}/images</code>
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
                    <td><code>episode</code></td>
                    <td>integer</td>
                    <td>Episode ID</td>
                </tr>
            </tbody>
        </table>

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
                    <td><code>image</code></td>
                    <td>file</td>
                    <td>Yes</td>
                    <td>Image file (JPG, PNG, WebP)</td>
                </tr>
                <tr>
                    <td><code>type</code></td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Type of image (still, thumbnail)</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="my-8">
        <h2>Upload Person Image</h2>
        <div class="my-4">
            <span class="method-badge method-post">POST</span>
            <code class="endpoint">/api/v1/persons/{person}/images</code>
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
                    <td><code>person</code></td>
                    <td>integer</td>
                    <td>Person ID</td>
                </tr>
            </tbody>
        </table>

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
                    <td><code>image</code></td>
                    <td>file</td>
                    <td>Yes</td>
                    <td>Image file (JPG, PNG, WebP)</td>
                </tr>
                <tr>
                    <td><code>type</code></td>
                    <td>string</td>
                    <td>Yes</td>
                    <td>Type of image (profile, backdrop)</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="my-8">
        <h2>Get Images</h2>
        <p>Each entity type has its own endpoint to retrieve images:</p>
        <ul>
            <li><code>GET /api/v1/movies/{movie}/images</code> - Get movie images</li>
            <li><code>GET /api/v1/tvseries/{tvSeries}/images</code> - Get TV series images</li>
            <li><code>GET /api/v1/episodes/{episode}/images</code> - Get episode images</li>
            <li><code>GET /api/v1/persons/{person}/images</code> - Get person images</li>
        </ul>
    </div>

    <div class="my-8">
        <h2>Delete Image</h2>
        <p>Each entity type has its own endpoint to delete images:</p>
        <ul>
            <li><code>DELETE /api/v1/movies/{movie}/images/{image}</code> - Delete movie image</li>
            <li><code>DELETE /api/v1/tvseries/{tvSeries}/images/{image}</code> - Delete TV series image</li>
            <li><code>DELETE /api/v1/episodes/{episode}/images/{image}</code> - Delete episode image</li>
            <li><code>DELETE /api/v1/persons/{person}/images/{image}</code> - Delete person image</li>
        </ul>
        <p class="text-yellow-500">Note: Only administrators can delete images.</p>
    </div>
</article>
@endsection
