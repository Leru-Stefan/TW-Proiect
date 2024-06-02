document.addEventListener('DOMContentLoaded', function () {
    const loginLink = document.getElementById('goToLoginLink');

    if (loginLink) {
        loginLink.addEventListener('click', (event) => {
            event.preventDefault();
            window.location.href = 'index.php?page=Login';
        });
    }

    const signupForm = document.querySelector('form');
    if (signupForm) {
        signupForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const username = signupForm.querySelector('input[name="fullname"]').value;
            const email = signupForm.querySelector('input[name="email"]').value;
            const password = signupForm.querySelector('input[name="password"]').value;
            const confirmPassword = signupForm.querySelector('input[name="confirm_password"]').value;

            if (username && email && password && confirmPassword && password === confirmPassword) {
                window.location.href = 'index.php?page=probleme';
            } else {
                console.error("Toate câmpurile trebuie completate, iar parolele trebuie să coincidă.");
            }
        });
    }
});




