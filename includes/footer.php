<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASE_URL ?>/assets/js/app.js"></script>
</body>
</html>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const themeToggleBtn = document.querySelector('[data-bs-theme-value], [class*="bi-sun"], [class*="bi-moon"], #theme-toggle, .btn-light'); 
    // Sesuaikan selector tombol di atas dengan tombol yang ada di projectmu

    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', function () {
            const currentTheme = document.documentElement.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            document.documentElement.setAttribute('data-bs-theme', newTheme);
            localStorage.setItem('theme', newTheme);
        });
    }
});
</script>