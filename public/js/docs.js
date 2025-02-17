document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('.docs-search input');
    const navItems = document.querySelectorAll('.docs-nav-item');
    const navLinks = document.querySelectorAll('.docs-nav-link');

    // Collect all searchable content
    const searchableContent = [];
    navLinks.forEach(link => {
        searchableContent.push({
            title: link.textContent.trim(),
            url: link.getAttribute('href'),
            element: link.parentElement
        });
    });

    // Search function
    function performSearch(query) {
        const normalizedQuery = query.toLowerCase();
        
        searchableContent.forEach(item => {
            const matches = item.title.toLowerCase().includes(normalizedQuery);
            item.element.style.display = matches ? 'block' : 'none';
        });

        // Show/hide section titles based on visible items
        document.querySelectorAll('.docs-nav-section').forEach(section => {
            const hasVisibleItems = Array.from(section.querySelectorAll('.docs-nav-item'))
                .some(item => item.style.display !== 'none');
            section.style.display = hasVisibleItems ? 'block' : 'none';
        });
    }

    // Search input handler
    searchInput.addEventListener('input', (e) => {
        performSearch(e.target.value);
    });

    // Theme toggle
    const themeToggle = document.querySelector('.theme-toggle');
    themeToggle.addEventListener('click', () => {
        document.documentElement.classList.toggle('light');
    });
});
