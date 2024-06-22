document.addEventListener('DOMContentLoaded', async function() {
    const userId = document.getElementById('userId').value;
    console.log('User ID:', userId); // Linie de debug
    const logoutButton = document.getElementById('gotologout');
    const problemeButton = document.getElementById('gotoprobleme');
    const profilButton = document.getElementById('gotoprofil');
    const setariButton = document.getElementById('gotosetari');
    const ajutorButton = document.getElementById('gotoajutor');

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

    if (ajutorButton) {
        ajutorButton.addEventListener('click', () => {
            window.location.href = 'index.php?page=ajutor';
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
        const params = new URLSearchParams();
        params.append('user_id', userId);
        
        fetch('./PHP/deleteUser.php', {
            method: 'POST',
            body: params
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Eroare de rețea sau server');
            }
            return response.text();
        })
        .then(message => {
            if (message.trim() === '') {
                throw new Error('Mesajul este gol');
            }
            alert(message);
        })
        .catch(error => {
            alert(`Eroare la ștergerea contului utilizatorului: ${error}`);
        })
        .finally(() => {
            window.location.href = './index.php?page=login';
        });
    
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
        if (resetPasswordContainer.style.display === 'none' || resetPasswordContainer.style.display === '') {
            // Dacă este ascuns sau nu are setat niciun stil de afișare, îl facem vizibil
            resetPasswordContainer.style.display = 'flex';
        } else {
            // Dacă este vizibil, îl ascundem
            resetPasswordContainer.style.display = 'none';
        }
    });

    const form = document.getElementById('passwordResetForm');
const messageContainer = document.getElementById('message-container');

form.addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(form);
    const currPassword = formData.get('curr-password');
    const newPassword = formData.get('new-password');

    console.log('Parola curenta:', currPassword);
    console.log('Parola noua:', newPassword);

    // Validare simplă
    if (!currPassword || !newPassword) {
        displayMessage('Toate câmpurile sunt obligatorii.', 'error');
        return;
    }

    fetch('index.php?page=setari&action=changePassword', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log(data); // Adăugați acest log pentru a vedea răspunsul de la server
        if (data.success) {
            displayMessage(data.message, 'success');
            form.reset();
        } else {
            displayMessage(data.error, 'error');
        }
    })
    .catch(error => {
        displayMessage('A apărut o eroare. Te rugăm să încerci din nou.', 'error');
    });
});

function displayMessage(message, type) {
    messageContainer.innerHTML = `<div class="alert alert-${type}">${message}</div>`;
}
});
