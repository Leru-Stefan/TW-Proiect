document.addEventListener('DOMContentLoaded', function () {
    const logoutButton = document.getElementById('gotologout');
    const problemeButton = document.getElementById('gotoprobleme');
    const profilButton = document.getElementById('gotoprofil');
    const setariButton = document.getElementById('gotosetari');
    const ajutorButton = document.getElementById('gotoajutor');
    const downloadButton = document.querySelector('.download-button');
    const downloadJson = document.getElementById('downloadJSON');
    const downloadXmlBtn = document.getElementById('downloadXML');


    if (logoutButton) {
        logoutButton.addEventListener('click', () => {
            window.location.href = 'Login.html';
        });
    }

    if (problemeButton) {
        problemeButton.addEventListener('click', () => {
            window.location.href = 'probleme.html';
        });
    }

    if (profilButton) {
        profilButton.addEventListener('click', () => {
            window.location.href = 'profile.html';
        });
    }

    if (setariButton) {
        setariButton.addEventListener('click', () => {
            window.location.href = 'setari.html';
        });
    }

    if (ajutorButton) {
        ajutorButton.addEventListener('click', () => {
            window.location.href = 'ajutor.html';
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
        });
    }

    if (downloadXmlBtn) {
        downloadXmlBtn.addEventListener('click', function (event) {
            event.preventDefault(); // Oprire acțiune implicită de navigare
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
        });
    }

    // --------------------------------------------CAND SE FACE BAZA DE DATE---------------------------------------------------------

    // document.querySelectorAll('.download-json').forEach(function (downloadJsonButton) {
    //     downloadJsonButton.addEventListener('click', function (event) {
    //         event.preventDefault(); // Oprire acțiune implicită de navigare
    //         const problemId = downloadJsonButton.dataset.id;
    //         const problemData = getProblemData(problemId);
    //         if (!problemData) {
    //             console.error('Nu s-au putut obține datele pentru problema cu ID-ul', problemId);
    //             return;
    //         }
    //         downloadJSON(problemData, problemId);
    //     });
    // });
    
    // document.querySelectorAll('.download-xml').forEach(function (downloadXmlButton) {
    //     downloadXmlButton.addEventListener('click', function (event) {
    //         event.preventDefault(); // Oprire acțiune implicită de navigare
    //         const problemId = downloadXmlButton.dataset.id;
    //         const problemData = getProblemData(problemId);
    //         if (!problemData) {
    //             console.error('Nu s-au putut obține datele pentru problema cu ID-ul', problemId);
    //             return;
    //         }
    //         downloadXML(problemData, problemId);
    //     });
    // });
    
    // function getProblemData(problemId) {
    //     // Implementează logica pentru a obține datele problemei în funcție de problemId
    //     // Returnează datele problemei sau null dacă nu sunt disponibile
    // }
    
    // function downloadJSON(problemData, problemId) {
    //     // Implementează descărcarea pentru formatul JSON folosind datele problemei și ID-ul problemei
    // }
    
    // function downloadXML(problemData, problemId) {
    //     // Implementează descărcarea pentru formatul XML folosind datele problemei și ID-ul problemei
    // }
    

    // --------------------------------------------CAND SE FACE BAZA DE DATE---------------------------------------------------------


    // Închide dropdown-ul dacă utilizatorul face clic în afara acestuia
    document.addEventListener('click', function (event) {
        var dropdowns = document.querySelectorAll('.dropdown-content');
        dropdowns.forEach(function (dropdown) {
            if (!dropdown.contains(event.target) && !dropdown.previousElementSibling.contains(event.target)) {
                dropdown.classList.remove('show');
            }
        });
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

