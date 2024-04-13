function afiseazaDropdown(imgElement) {
    var dropdownContent = imgElement.nextElementSibling;
    dropdownContent.classList.toggle("show");
}

// Închide dropdown-ul dacă utilizatorul face clic în afara acestuia
window.onclick = function(event) {
    if (!event.target.matches('.menu-dots')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}

// Funcție pentru afișarea popup-ului corespunzător în funcție de rezultatul verificării
function afiseazaPopupCorect() {
    var popupCorect = document.getElementById('popupCorect');
    popupCorect.style.display = 'block';
}

function afiseazaPopupGresit() {
    var popupGresit = document.getElementById('popupGresit');
    popupGresit.style.display = 'block';
}

// Ascunde toate popup-urile
function ascundePopups(popupId) {
    var popup = document.getElementById(popupId);
    popup.style.display = 'none';
}

// La apăsarea butonului "Verifică acum", afișează popup-ul corespunzător
document.getElementById('verifyBtn').addEventListener('click', function() {
    // Aici poți adăuga logica pentru verificarea răspunsului
    var raspunsCorect = true; // De exemplu, presupunem că răspunsul este corect

    if (raspunsCorect) {
        afiseazaPopupCorect();
    } else {
        afiseazaPopupGresit();
    }
});

// La click pe unul dintre butoanele de notare a dificultății, trimite nivelul de dificultate la server
var dificultateButtons = document.querySelectorAll('.dificultate-button');
dificultateButtons.forEach(function(button) {
    button.addEventListener('click', function() {
        var dificultate = this.getAttribute('data-dificultate');
        // Aici poți adăuga cod pentru a trimite nivelul de dificultate la server
        ascundePopups('popupCorect'); // Ascunde popup-ul după ce studentul a făcut alegerea
    });
});

// La click pe butonul "Resetează", șterge conținutul din input
document.getElementById('resetBtn').addEventListener('click', function() {
    var inputElement = document.querySelector('.input pre.editable');
    inputElement.innerText = ''; // Șterge conținutul din input
});

