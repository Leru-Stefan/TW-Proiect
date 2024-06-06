document.addEventListener('DOMContentLoaded', function() {
    const logoutButton = document.getElementById('gotologout');
    const problemeButton = document.getElementById('gotoprobleme');
    const profilButton = document.getElementById('gotoprofil');
    const setariButton = document.getElementById('gotosetari');

    if (logoutButton) {
        logoutButton.addEventListener('click', () => {
            window.location.href = 'index.php?page=login';
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

    // Adauga eveniment pentru butonul deleteProfile
    const deleteProfile = document.getElementById('deleteBtn');
    if (deleteProfile) {
        deleteProfile.addEventListener('click', afiseazaPopup);
    }

    document.getElementById("cancel").addEventListener("click", function() {
        document.getElementById("glassDelete").style.display = "none";
    });

    document.getElementById("confirm").addEventListener("click", function() {
        // Aici poți face o cerere către server pentru a executa acțiunea de ștergere a contului
        // După ce operația este completă cu succes, poți redirecționa utilizatorul către o altă pagină sau să afișezi un mesaj de confirmare
        // În caz contrar, poți afișa un mesaj de eroare sau să închizi popup-ul de confirmare
        // Pentru scopul demo, închidem doar popup-ul de confirmare
        document.getElementById("glassDelete").style.display = "none";
    });

    // Functie pentru a afisa popup-ul corespunzator
    function afiseazaPopup() {
        const glassDelete = document.getElementById('glassDelete');
        glassDelete.style.display = 'flex';
    }

    function hidePopup(event) {
        const glassDelete = document.getElementById('glassDelete');

        if (glassDelete.style.display === 'flex' && !document.getElementById('deleteBtn').contains(event.target) && !document.getElementById('deletePopup').contains(event.target)) {
            glassDelete.style.display = 'none';
        }
    }

    document.addEventListener('click', hidePopup);

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
