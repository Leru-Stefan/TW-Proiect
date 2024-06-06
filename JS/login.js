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

    // if (goToProbleme) {
    //     goToProbleme.addEventListener('click', (event) => {
    //         event.preventDefault();
    //         window.location.href = 'index.php?page=probleme';
    //     });
    // }

});
