<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - API Documentation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'docs-dark': '#0F172A',
                        'docs-darker': '#0B1120',
                        'docs-light': '#1E293B',
                        'docs-lighter': '#334155',
                        'docs-blue': '#3B82F6',
                        'docs-text': '#E2E8F0',
                        'docs-text-light': '#94A3B8'
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
        .method-get { @apply px-2 py-1 text-blue-700 bg-blue-100 dark:text-blue-300 dark:bg-blue-900 rounded-md }
        .method-post { @apply px-2 py-1 text-green-700 bg-green-100 dark:text-green-300 dark:bg-green-900 rounded-md }
        .method-put { @apply px-2 py-1 text-yellow-700 bg-yellow-100 dark:text-yellow-300 dark:bg-yellow-900 rounded-md }
        .method-delete { @apply px-2 py-1 text-red-700 bg-red-100 dark:text-red-300 dark:bg-red-900 rounded-md }
        .endpoint { @apply ml-2 text-gray-700 dark:text-gray-300 }
        pre { @apply p-4 bg-gray-800 rounded-lg overflow-x-auto text-sm text-gray-200 }
    </style>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-docs-dark text-docs-text antialiased">
    <div class="min-h-screen">
        <nav class="fixed w-64 h-screen bg-docs-darker border-r border-docs-light overflow-y-auto">
            <div class="p-6">
                <h1 class="text-xl font-bold mb-6">API Documentation</h1>
                <ul class="space-y-4">
                    <li>
                        <a href="/docs" class="text-docs-text-light hover:text-white">Introduction</a>
                    </li>
                    <li>
                        <h2 class="text-sm font-semibold text-docs-text-light uppercase tracking-wider mb-2">Getting Started</h2>
                        <ul class="space-y-2 ml-2">
                            <li>
                                <a href="/docs/introduction" class="text-docs-text-light hover:text-white">Introduction</a>
                            </li>
                            <li>
                                <a href="/docs/authentication" class="text-docs-text-light hover:text-white">Authentication</a>
                            </li>
                            <li>
                                <a href="/docs/roles" class="text-docs-text-light hover:text-white">Roles & Permissions</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <h2 class="text-sm font-semibold text-docs-text-light uppercase tracking-wider mb-2">Core Resources</h2>
                        <ul class="space-y-2 ml-2">
                            <li>
                                <a href="/docs/movies" class="text-docs-text-light hover:text-white">Movies</a>
                            </li>
                            <li>
                                <a href="/docs/tv-series" class="text-docs-text-light hover:text-white">TV Series</a>
                            </li>
                            <li>
                                <a href="/docs/seasons" class="text-docs-text-light hover:text-white">Seasons</a>
                            </li>
                            <li>
                                <a href="/docs/episodes" class="text-docs-text-light hover:text-white">Episodes</a>
                            </li>
                            <li>
                                <a href="/docs/people" class="text-docs-text-light hover:text-white">People</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <h2 class="text-sm font-semibold text-docs-text-light uppercase tracking-wider mb-2">Media</h2>
                        <ul class="space-y-2 ml-2">
                            <li>
                                <a href="/docs/images" class="text-docs-text-light hover:text-white">Images</a>
                            </li>
                            <li>
                                <a href="/docs/trailers" class="text-docs-text-light hover:text-white">Trailers</a>
                            </li>
                            <li>
                                <a href="/docs/video-files" class="text-docs-text-light hover:text-white">Video Files</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <h2 class="text-sm font-semibold text-docs-text-light uppercase tracking-wider mb-2">Users</h2>
                        <ul class="space-y-2 ml-2">
                            <li>
                                <a href="/docs/user-management" class="text-docs-text-light hover:text-white">User Management</a>
                            </li>
                            <li>
                                <a href="/docs/profile" class="text-docs-text-light hover:text-white">Profile Updates</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="ml-64">
            <div class="max-w-4xl mx-auto py-12 px-8">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        // Highlight current page in navigation
        document.addEventListener('DOMContentLoaded', () => {
            const currentPath = window.location.pathname;
            const links = document.querySelectorAll('nav a');
            links.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('text-docs-blue', 'font-medium');
                    link.classList.remove('text-docs-text-light');
                }
            });
        });
    </script>
</body>
</html>
