document.addEventListener('DOMContentLoaded', function () {

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



async function fetchQuotes() {
    try {
        const response = await fetch('https://api.quotable.io/quotes?tags=inspirational');
        const data = await response.json();
        displayQuote(data.results);
    } catch (error) {
        console.error('Eroare la obținerea citatelor:', error);
    }
}

function displayQuote(quotes) {
    const container = document.getElementById('quote-container');
    if (!container) {
        console.error('Elementul "quote-container" nu a fost găsit.');
        return;
    }

    const randomIndex = Math.floor(Math.random() * quotes.length);
    const quote = quotes[randomIndex];

    const quoteElement = document.createElement('div');
    quoteElement.classList.add('quote');
    quoteElement.innerHTML = `
        <h5>${quote.content}</h5>
        <p class="author">- ${quote.author}</p>
    `;
    container.appendChild(quoteElement);
}

fetchQuotes();

function numarProblemeRezolvate() {
    // Hardcodare pentru testare
    return 19; // Modifica acest numar pentru testare
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