document.addEventListener('DOMContentLoaded', async function () {

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

    // Functie pentru a obtine numarul de probleme rezolvate
    async function numarProblemeRezolvate() {
        try {
            const response = await fetch('./PHP/getSolvedProblemsCount.php');
            const data = await response.json();
            if (data.solvedCount !== undefined && data.role !== undefined && data.addedCount !== undefined) {
                return data;
            } else {
                console.error('Error fetching solved problems and role:', data.error);
                return { solvedCount: 0, addedCount: 0, role: 'student' };
            }
        } catch (error) {
            console.error('Error fetching solved problems and role:', error);
            return { solvedCount: 0,addedCount: 0 ,role: 'student' };
        }
    }


    // Functie pentru a afisa popup-ul corespunzator
    async function afiseazaPopup() {
        const glassAddTrue = document.getElementById('glassAddTrue');
        const glassAddFalse = document.getElementById('glassAddFalse');

        // Ascunde ambele popup-uri initial
        glassAddTrue.style.display = 'none';
        glassAddFalse.style.display = 'none';

        // Get the number of solved problems and user's role
        const { solvedCount, role, addedCount } = await numarProblemeRezolvate();

        if (role === 'admin') {
            glassAddTrue.style.display = 'flex';
        } else {
            const allowedAdds = Math.floor(solvedCount / 20); // Calculate how many problems can be added
            if (solvedCount > 0 && addedCount < allowedAdds) {
                glassAddTrue.style.display = 'flex';
                glassAddFalse.style.display = 'none';
            } else {
                glassAddTrue.style.display = 'none';
                glassAddFalse.style.display = 'flex';
            }

            console.log(allowedAdds);
            console.log(addedCount);
            console.log(solvedCount);
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

 // Funcție pentru a obține topul studenților
 async function getTopStudents() {
    try {
        const response = await fetch('./PHP/getTopStudents.php');
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const topStudents = await response.json();
        if (!Array.isArray(topStudents)) {
            throw new Error('Răspunsul nu este în format JSON valid');
        }
        return topStudents;
    } catch (error) {
        console.error('Eroare la obținerea topului studenților:', error);
        return [];
    }
}

// Funcție pentru a afișa topul studenților în leaderboard
async function afiseazaTopStudents() {
    const topStudents = await getTopStudents();

    // Selectăm containerul leaderboard
    const leaderboardContainer = document.querySelector('.leaderboard .list-top5');

    // Verificăm dacă există containerul și dacă avem date despre topul studenților
    if (leaderboardContainer && topStudents.length > 0) {
        // Parcurgem fiecare element din topStudents și actualizăm afișarea în interfața utilizatorului
        topStudents.forEach((student, index) => {
            const studentElement = document.getElementById(`top-student-${index + 1}`);
            if (studentElement && index < topStudents.length) {
                // Actualizăm numele și numărul de probleme rezolvate pentru fiecare student
                studentElement.querySelector('h5').textContent = `${student.nume} ${student.prenume}`;
                studentElement.querySelector('h4').textContent = student.solved_count;
                studentElement.style.display = 'flex'; // Asigurăm că elementul este vizibil
            }
        });
    }

    console.log(topStudents)
}

// Apelezăm funcția pentru a afișa topul studenților când pagina se încarcă
await afiseazaTopStudents();
});