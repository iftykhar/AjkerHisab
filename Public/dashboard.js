document.addEventListener('DOMContentLoaded', () => {
    const app = document.getElementById('app');

    function loadContent(route) {
        fetch(`index.php?route=ajax-${route}`)
            .then(res => res.text())
            .then(html => {
                app.innerHTML = html;
            })
            .catch(err => {
                app.innerHTML = '<p>Error loading page</p>';
            });
    }

    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const route = this.getAttribute('data-route');
            loadContent(route);
        });
    });

    // Load default route
    loadContent('home');
});
