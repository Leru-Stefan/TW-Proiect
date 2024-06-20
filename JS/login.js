document.addEventListener('DOMContentLoaded', function () {
    const signupButton = document.getElementById('goToSignUp');
    const signupLink = document.getElementById('goToSignUpLink');
    const goToProbleme = document.getElementById('goToProbleme');
    const loginButton = document.getElementById('goToLogin');


    if (signupButton) {
        signupButton.addEventListener('click', () => {
            window.location.href = 'index.php?page=signup';
        });
    }

    if (loginButton) {
        loginButton.addEventListener('click', () => {
            window.location.href = 'index.php?page=login';
        });
    }

    if (signupLink) {
        signupLink.addEventListener('click', (event) => {
            event.preventDefault();
            window.location.href = 'index.php?page=signup';
        });
    }

    var logButton = document.querySelector('.primary');
    var signUpButton = document.querySelector('.secondary');

    var leftHalf = document.querySelector('.left-half');
    var rightHalf = document.querySelector('.right-half');

    logButton.addEventListener('click', function() {
        // Ascunde partea dreaptă și afișează partea stângă
        leftHalf.style.display = 'none';
        rightHalf.style.display = 'flex';
    });

    signUpButton.addEventListener('click', function() {
        // Ascunde partea stângă și afișează partea dreaptă
        leftHalf.style.display = 'none';
        rightHalf.style.display = 'flex';
    });

});
