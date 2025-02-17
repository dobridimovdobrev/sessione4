<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - API Documentation</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/docs.css">
</head>
<body>
    <div class="docs-sidebar">
        <div class="docs-logo">
            <h1>Streaming API</h1>
        </div>

        <nav class="docs-nav">
            <div class="docs-nav-section">
                <h3 class="docs-nav-title">Getting Started</h3>
                <ul class="docs-nav-items">
                    <li class="docs-nav-item">
                        <a href="/docs" class="docs-nav-link {{ request()->is('docs') ? 'active' : '' }}">Introduction</a>
                    </li>
                    <li class="docs-nav-item">
                        <a href="/docs/authentication" class="docs-nav-link {{ request()->is('docs/authentication') ? 'active' : '' }}">Authentication</a>
                    </li>
                    <li class="docs-nav-item">
                        <a href="/docs/roles" class="docs-nav-link {{ request()->is('docs/roles') ? 'active' : '' }}">Roles & Permissions</a>
                    </li>
                </ul>
            </div>

            <div class="docs-nav-section">
                <h3 class="docs-nav-title">Users</h3>
                <ul class="docs-nav-items">
                    <li class="docs-nav-item">
                        <a href="/docs/user-management" class="docs-nav-link {{ request()->is('docs/user-management') ? 'active' : '' }}">User Management</a>
                    </li>
                    <li class="docs-nav-item">
                        <a href="/docs/profile" class="docs-nav-link {{ request()->is('docs/profile') ? 'active' : '' }}">Profile Updates</a>
                    </li>
                </ul>
            </div>

            <div class="docs-nav-section">
                <h3 class="docs-nav-title">Content</h3>
                <ul class="docs-nav-items">
                    <li class="docs-nav-item">
                        <a href="/docs/movies" class="docs-nav-link {{ request()->is('docs/movies') ? 'active' : '' }}">Movies</a>
                    </li>
                    <li class="docs-nav-item">
                        <a href="/docs/tv-series" class="docs-nav-link {{ request()->is('docs/tv-series') ? 'active' : '' }}">TV Series</a>
                    </li>
                    <li class="docs-nav-item">
                        <a href="/docs/seasons" class="docs-nav-link {{ request()->is('docs/seasons') ? 'active' : '' }}">Seasons</a>
                    </li>
                    <li class="docs-nav-item">
                        <a href="/docs/episodes" class="docs-nav-link {{ request()->is('docs/episodes') ? 'active' : '' }}">Episodes</a>
                    </li>
                    <li class="docs-nav-item">
                        <a href="/docs/persons" class="docs-nav-link {{ request()->is('docs/persons') ? 'active' : '' }}">Persons</a>
                    </li>
                </ul>
            </div>

            <div class="docs-nav-section">
                <h3 class="docs-nav-title">Media</h3>
                <ul class="docs-nav-items">
                    <li class="docs-nav-item">
                        <a href="/docs/images" class="docs-nav-link {{ request()->is('docs/images') ? 'active' : '' }}">Images</a>
                    </li>
                    <li class="docs-nav-item">
                        <a href="/docs/trailers" class="docs-nav-link {{ request()->is('docs/trailers') ? 'active' : '' }}">Trailers</a>
                    </li>
                    <li class="docs-nav-item">
                        <a href="/docs/video-files" class="docs-nav-link {{ request()->is('docs/video-files') ? 'active' : '' }}">Video Files</a>
                    </li>
                </ul>
            </div>

            <div class="docs-nav-section">
                <h3 class="docs-nav-title">Metadata</h3>
                <ul class="docs-nav-items">
                    <li class="docs-nav-item">
                        <a href="/docs/categories" class="docs-nav-link {{ request()->is('docs/categories') ? 'active' : '' }}">Categories</a>
                    </li>
                    <li class="docs-nav-item">
                        <a href="/docs/countries" class="docs-nav-link {{ request()->is('docs/countries') ? 'active' : '' }}">Countries</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="version-selector">
        <select>
            <option>v1.0</option>
        </select>
        <button class="theme-toggle">
            Theme
        </button>
    </div>

    <main class="docs-content">
        @yield('content')
    </main>
</body>
</html>
