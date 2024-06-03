document.addEventListener('DOMContentLoaded', function () {
    const loginLink = document.getElementById('goToLoginLink');

    if (loginLink) {
        loginLink.addEventListener('click', (event) => {
            event.preventDefault();
            window.location.href = 'index.php?page=Login';
        });
    }

    const signupForm = document.getElementById('signupForm');
    if (signupForm) {
        signupForm.addEventListener('submit', function(event) {
            event.preventDefault();
            
            const username = signupForm.querySelector('input[name="fullname"]').value;
            const email = signupForm.querySelector('input[name="email"]').value;
            const password = signupForm.querySelector('input[name="password"]').value;
            const confirmPassword = signupForm.querySelector('input[name="confirm_password"]').value;

            if (username && email && password && confirmPassword && password === confirmPassword) {
                // Trimite datele către server
                var xhr = new XMLHttpRequest();
                xhr.open('POST', './PHP%20files/Sign-up.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onload = function() {
                    if (xhr.status === 200) {
                        document.getElementById('response').innerText = xhr.responseText;
                        if (xhr.responseText.includes("Înregistrare reușită")) {
                            window.location.href = 'index.php?page=probleme';
                        }
                    } else {
                        document.getElementById('response').innerText = 'An error occurred. Please try again.';
                    }
                };

                var formData = new FormData(signupForm);
                var data = new URLSearchParams();
                for (var pair of formData.entries()) {
                    data.append(pair[0], pair[1]);
                }

                xhr.send(data);
            } else {
                console.error("Toate câmpurile trebuie completate, iar parolele trebuie să coincidă.");
            }
        });
    }
});
