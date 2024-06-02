document.addEventListener('DOMContentLoaded', function() {
    const logoutButton = document.getElementById('gotologout');
    const problemeButton = document.getElementById('gotoprobleme');
    const profilButton = document.getElementById('gotoprofil');
    const setariButton = document.getElementById('gotosetari');

    if (logoutButton) {
        logoutButton.addEventListener('click', () => {
            window.location.href = 'index.php?page=Login';
        });
    }

    if (problemeButton) {
        problemeButton.addEventListener('click', () => {
            window.location.href = 'index.php?page=probleme';
        });
    }

    if (profilButton) {
        profilButton.addEventListener('click', () => {
            window.location.href = 'index.php?page=profile';
        });
    }

    if (setariButton) {
        setariButton.addEventListener('click', () => {
            window.location.href = 'index.php?page=setari';
        });
    }
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
