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

    window.afiseazaDropdown = function (imgElement) {
        var dropdownContent = imgElement.nextElementSibling;
        dropdownContent.classList.toggle("show");
    }

    if (downloadJson) {
        downloadJson.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default link behavior

            console.log('Download JSON button clicked');

            // Sample JSON data
            const problemData = {
                title: "Example Problem",
                description: "This is an example problem description.",
                input: "Example input",
            };

            const jsonData = JSON.stringify(problemData, null, 2); // Convert the problem data to a JSON string
            const blob = new Blob([jsonData], { type: 'application/json' }); // Create a Blob from the JSON string
            const url = URL.createObjectURL(blob); // Create a URL for the Blob

            // Create a temporary link element and set its attributes for downloading the JSON file
            const a = document.createElement('a');
            a.href = url;
            a.download = 'problem.json';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url); // Clean up the URL object

            console.log('JSON file download triggered');
            alert('JSON file download has started');
        });
    }

    if (downloadXmlBtn) {
        downloadXmlBtn.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default link behavior

            console.log('Download XML button clicked');

            // Sample XML data
            const problemData = `
                <problem>
                    <title>Example Problem</title>
                    <description>This is an example problem description.</description>
                    <input>Example input</input>
                    <output>Example output</output>
                </problem>
            `;

            const blob = new Blob([problemData], { type: 'application/xml' }); // Create a Blob from the XML string
            const url = URL.createObjectURL(blob); // Create a URL for the Blob

            // Create a temporary link element and set its attributes for downloading the XML file
            const a = document.createElement('a');
            a.href = url;
            a.download = 'problem.xml';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url); // Clean up the URL object

            console.log('XML file download triggered');
            alert('XML file download has started');
        });
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


    // Preluăm ID-ul problemei din query string
    const urlParams = new URLSearchParams(window.location.search);
    const problemId = urlParams.get('id');

    // Funcția pentru a încărca detaliile problemei
    function loadProblemDetails(id) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', './PHP%20files/get_problem_details.php?id=' + id, true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                var problem = JSON.parse(xhr.responseText);
                document.getElementById('problem-title').textContent = problem.title;
                document.getElementById('problem-description').textContent = problem.description;
            }
        };
        xhr.send();
    }

    // Verificăm dacă există un ID valid și încărcăm detaliile problemei
    if (problemId) {
        loadProblemDetails(problemId);
    } else {
        document.getElementById('problem-title').textContent = 'Problemă indisponibilă';
        document.getElementById('problem-description').textContent = 'ID-ul problemei nu este valid.';
    }


});


