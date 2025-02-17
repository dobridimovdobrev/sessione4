<!DOCTYPE html>
<html lang="en" class="dark">
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

        <div class="docs-search">
            <input type="text" placeholder="Search documentation..." />
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
                <h3 class="docs-nav-title">Core Resources</h3>
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
                        <a href="/docs/people" class="docs-nav-link {{ request()->is('docs/people') ? 'active' : '' }}">People</a>
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
        </nav>
    </div>

    <div class="version-selector">
        <select>
            <option>v1.0</option>
        </select>
        <button class="theme-toggle">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                <path fill-rule="evenodd" d="M7.455 2.004a.75.75 0 01.26.77 7 7 0 009.958 7.967.75.75 0 011.067.853A8.5 8.5 0 116.647 1.921a.75.75 0 01.808.083z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>

    <main class="docs-content">
        @yield('content')
    </main>
</body>
</html>
