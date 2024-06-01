document.addEventListener('DOMContentLoaded', function() {
    // Selectăm butonul
    var changePassBtn = document.getElementById('changePassBtn');

    // Selectăm container-ul de resetare a parolei
    var resetPasswordContainer = document.querySelector('.reset-password-container');

    // Adăugăm un ascultător de eveniment pentru clic pe buton
    changePassBtn.addEventListener('click', function() {
        // Verificăm dacă container-ul este afișat sau nu
        console.log("Click pe change");
        if (resetPasswordContainer.style.display === 'none' || resetPasswordContainer.style.display === '') {
            // Dacă este ascuns sau nu are setat niciun stil de afișare, îl facem vizibil
            resetPasswordContainer.style.display = 'flex';
        } else {
            // Dacă este vizibil, îl ascundem
            resetPasswordContainer.style.display = 'none';
        }
    });

});
