
document.addEventListener('DOMContentLoaded', async function () {
    const logoutButton = document.getElementById('gotologout');
    const problemeButton = document.getElementById('gotoprobleme');
    const profilButton = document.getElementById('gotoprofil');
    const setariButton = document.getElementById('gotosetari');
    const ajutorButton = document.getElementById('gotoajutor');
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
    if (ajutorButton) {
        ajutorButton.addEventListener('click', () => {
            window.location.href = 'index.php?page=ajutor';
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
   /* verifyBtn.addEventListener('click', function (event) {
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
    });*/

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
        }
    }); 

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
    }

    // Apelezăm funcția pentru a afișa topul studenților când pagina se încarcă
    await afiseazaTopStudents();

    document.querySelectorAll('.dificultate-button').forEach(button => {
        button.addEventListener('click', function() {
            var selectedDifficulty = this.getAttribute('data-dificultate');
            // Maparea valorilor din română în engleză
            var difficultyMap = {
                'usor': 'easy',
                'mediu': 'medium',
                'greu': 'hard'
            };
            var mappedDifficulty = difficultyMap[selectedDifficulty];
            
            fetch('index.php?page=editor&action=saveDifficulty', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ difficulty: mappedDifficulty })
            })
            .then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error('Network response was not ok');
                }
            })
            .then(data => {
                if (data && data.success) {
                    console.log('Difficulty saved successfully');
                } else if (data && data.error) {
                    console.error('Error:', data.error);
                } else {
                    console.error('Unknown error');
                }
            })
            .catch(error => {
                console.error('Fetch Error:', error);
            });
        });
    });
    
    
    
    
});


