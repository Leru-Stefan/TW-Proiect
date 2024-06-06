document.addEventListener('DOMContentLoaded', function () {
    const loginLink = document.getElementById('goToLoginLink');

    if (loginLink) {
        loginLink.addEventListener('click', (event) => {
            event.preventDefault();
            window.location.href = 'index.php?page=login';
        });
    }
});
