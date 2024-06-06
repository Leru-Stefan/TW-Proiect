
document.addEventListener('DOMContentLoaded', function () {
    const logoutButton = document.getElementById('gotologout');
    const problemeButton = document.getElementById('gotoprobleme');
    const profilButton = document.getElementById('gotoprofil');
    const setariButton = document.getElementById('gotosetari');

    const userInput = document.getElementById('userInput');
    const result = document.getElementById('result');
    const downloadJson = document.getElementById('downloadJSON');
    const downloadXmlBtn = document.getElementById('downloadXML');
    const downloadButton = document.querySelector('.download-button');
    const verifyBtn = document.getElementById('verifyBtn');
    const resetBtn = document.getElementById('resetBtn');
    const glassSolvedTrue = document.getElementById('glassSolvedTrue');
    const glassSolvedFalse = document.getElementById('glassSolvedFalse');


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

    window.afiseazaDropdown = function (imgElement) {
        var dropdownContent = imgElement.nextElementSibling;
        dropdownContent.classList.toggle("show");
    }


    // Close the dropdown if the user clicks outside of it
    window.onclick = function (event) {
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

    document.addEventListener('click', function(event) {
        const glassSolvedFalse = document.getElementById('glassSolvedFalse');
        console.log('Document click event');
        if (glassSolvedFalse.style.display === 'flex' && !document.getElementById('popupGresit').contains(event.target)) {
            glassSolvedFalse.style.display = 'none';
            console.log('Popup greșit ascuns');
        }
    });

    console.log(glassSolvedFalse); // Ar trebui să vezi elementul în consolă
    verifyBtn.addEventListener('click', function (event) {
        event.stopPropagation(); // Oprim propagarea evenimentului pentru a preveni ascunderea imediată
        console.log('Verificare apăsată');
        const raspunsCorect = true; // Presupunem că este un răspuns greșit pentru testare
        if (raspunsCorect) {
            glassSolvedTrue.style.display = 'flex';
        } else {
            console.log(glassSolvedFalse); // Verificăm dacă elementul este selectat corect
            glassSolvedFalse.style.display = 'flex';
            console.log('Afișare popup greșit');
        }
    });

    resetBtn.addEventListener('click', function () {
        console.log('Resetare apăsată');
        glassSolvedTrue.style.display = 'none';
        glassSolvedFalse.style.display = 'none';
    });

    var dificultateButtons = document.querySelectorAll('#popupCorect .dificultate-button');
    dificultateButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            var dificultate = this.getAttribute('data-dificultate');
            glassSolvedTrue.style.display = 'none';
        });
    });

    document.addEventListener('click', function(event) {
        console.log('Document click event');
        if (glassSolvedFalse.style.display === 'flex' && !document.getElementById('popupGresit').contains(event.target)) {
            glassSolvedFalse.style.display = 'none';
            console.log('Popup greșit ascuns');
        }
    }); 

});


