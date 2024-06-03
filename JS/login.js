document.addEventListener('DOMContentLoaded', function () {
    const signupButton = document.getElementById('goToSignUp');
    const signupLink = document.getElementById('goToSignUpLink');
    const goToProbleme = document.getElementById('goToProbleme');


    if (signupButton) {
        signupButton.addEventListener('click', () => {
            window.location.href = 'index.php?page=signup';
        });
    }

    if (signupLink) {
        signupLink.addEventListener('click', (event) => {
            event.preventDefault();
            window.location.href = 'index.php?page=signup';
        });
    }

    if (goToProbleme) {
        goToProbleme.addEventListener('click', (event) => {
            event.preventDefault();
            window.location.href = 'index.php?page=probleme';
        });
    }


    // const loginForm = document.getElementById('LoginForm');
    // if (loginForm) {
    //     loginForm.addEventListener('submit', function(event) {
    //         event.preventDefault();
            
    //         const email = loginForm.querySelector('input[name="username"]').value;
    //         const password = loginForm.querySelector('input[name="password"]').value;

    //         // Verificarea câmpurilor de email și parolă
    //         if (!email || !password) {
    //             console.error("Toate câmpurile trebuie completate.");
    //             return; // Oprire dacă nu sunt completate ambele câmpuri
    //         }

    //         // Trimite datele către server
    //         var xhr = new XMLHttpRequest();
    //         xhr.open('POST', './PHP%20files/Login.php', true);
    //         xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    //         xhr.onload = function() {
    //             if (xhr.status === 200) {
    //                 document.getElementById('response').innerText = xhr.responseText;
    //                 if (xhr.responseText.includes("Login reușit")) {
    //                     window.location.href = 'index.php?page=probleme';
    //                 }
    //             } else {
    //                 document.getElementById('response').innerText = 'An error occurred. Please try again.';
    //             }
    //         };

    //         var formData = new FormData(loginForm);
    //         var data = new URLSearchParams();
    //         for (var pair of formData.entries()) {
    //             data.append(pair[0], pair[1]);
    //         }

    //         xhr.send(data);
    //     });
    // }
});
