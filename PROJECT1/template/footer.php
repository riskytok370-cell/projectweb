    <footer class="app-footer">
        <span>&copy; 2026 <strong>NoteClass</strong> · Dibuat oleh @Rskyyy.kyyy</span>
    </footer>
</div>

<script>
    (function () {
        var sidebar = document.getElementById('sidebar');
        var overlay = document.getElementById('sidebarOverlay');
        var toggle = document.getElementById('menuToggle');

        function closeNav() {
            if (!sidebar) return;
            sidebar.classList.remove('open');
            if (overlay) overlay.classList.remove('show');
            document.body.classList.remove('nav-open');
        }

        if (toggle && sidebar) {
            toggle.addEventListener('click', function () {
                var isOpen = sidebar.classList.toggle('open');
                if (overlay) overlay.classList.toggle('show', isOpen);
                document.body.classList.toggle('nav-open', isOpen);
            });
        }

        if (overlay) {
            overlay.addEventListener('click', closeNav);
        }

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') closeNav();
        });

        if (sidebar) {
            sidebar.querySelectorAll('.sidebar-nav a').forEach(function (link) {
                link.addEventListener('click', closeNav);
            });
        }
    })();
</script>
</body>
</html>
