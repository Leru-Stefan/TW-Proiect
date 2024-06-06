document.addEventListener('DOMContentLoaded', function () {
    const logoutButton = document.getElementById('gotologout');
    const problemeButton = document.getElementById('gotoprobleme');
    const profilButton = document.getElementById('gotoprofil');
    const setariButton = document.getElementById('gotosetari');
    const ajutorButton = document.getElementById('gotoajutor');
    const downloadButton = document.querySelector('.download-button');
    const downloadJson = document.getElementById('downloadJSON');
    const downloadXmlBtn = document.getElementById('downloadXML');
    const editorButton = document.getElementById('gotoeditor');


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

    if (editorButton) {
        editorButton.addEventListener('click', () => {
            window.location.href = 'index.php?page=editor';
        });
    }

    window.afiseazaDropdown = function (dropdownButton) {
        // Ascunde toate celelalte meniuri derulante
        document.querySelectorAll('.dropdown-content').forEach(function (dropdownContent) {
            if (dropdownContent !== dropdownButton.nextElementSibling) {
                dropdownContent.classList.remove('show');
            }
        });

        // Afișează sau ascunde meniul derulant curent
        dropdownButton.nextElementSibling.classList.toggle('show');
    }


    // Închide dropdown-ul dacă utilizatorul face clic în afara acestuia
    document.addEventListener('click', function (event) {
        var dropdowns = document.querySelectorAll('.dropdown-content');
        dropdowns.forEach(function (dropdown) {
            if (!dropdown.contains(event.target) && !dropdown.previousElementSibling.contains(event.target)) {
                dropdown.classList.remove('show');
            }
        });
    });



    function numarProblemeRezolvate() {
        // Hardcodare pentru testare
        return 20; // Modifica acest numar pentru testare
    }

    // Functie pentru a afisa popup-ul corespunzator
    function afiseazaPopup() {
        const glassAddTrue = document.getElementById('glassAddTrue');
        const glassAddFalse = document.getElementById('glassAddFalse');

        // Ascunde ambele popup-uri initial
        glassAddTrue.style.display = 'none';
        glassAddFalse.style.display = 'none';

        // Verifica numarul de probleme rezolvate
        if (numarProblemeRezolvate() >= 20) {
            glassAddTrue.style.display = 'flex';
        } else {
            glassAddFalse.style.display = 'flex';
        }
    }

    // Adauga eveniment pentru div-ul add-problem
    const addProblemDiv = document.getElementById('add-problem');
    if (addProblemDiv) {
        addProblemDiv.addEventListener('click', afiseazaPopup);
    }

    // Adauga eveniment pentru butonul de import JSON
    const importJsonButton = document.getElementById('importJsonButton');
    if (importJsonButton) {
        importJsonButton.addEventListener('click', function () {
            const jsonFileInput = document.getElementById('jsonFileInput');
            if (jsonFileInput) {
                jsonFileInput.click();
            }
        });
    }

    // Adauga eveniment pentru input-ul de tip file
    const jsonFileInput = document.getElementById('jsonFileInput');
    if (jsonFileInput) {
        jsonFileInput.addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    try {
                        const jsonData = JSON.parse(e.target.result);
                        console.log('JSON data loaded:', jsonData);
                        // Aici poți adăuga logica pentru a procesa datele încărcate
                        handleJsonData(jsonData);
                    } catch (error) {
                        console.error('Eroare la citirea fișierului JSON:', error);
                    }
                };
                reader.readAsText(file);
            }
        });
    }

    function handleJsonData(data) {
        // Adaugă logica pentru a procesa datele încărcate din fișierul JSON
        console.log('Procesare date JSON:', data);
    }

    function hidePopup(event) {
        const glassAddTrue = document.getElementById('glassAddTrue');
        const glassAddFalse = document.getElementById('glassAddFalse');

        if (glassAddTrue.style.display === 'flex' && !document.getElementById('addTrue').contains(event.target) && !document.getElementById('add-problem').contains(event.target)) {
            glassAddTrue.style.display = 'none';
        }
        if (glassAddFalse.style.display === 'flex' && !document.getElementById('addFalse').contains(event.target) && !document.getElementById('add-problem').contains(event.target)) {
            glassAddFalse.style.display = 'none';
        }
    }

    document.addEventListener('click', hidePopup);
    
    
});




