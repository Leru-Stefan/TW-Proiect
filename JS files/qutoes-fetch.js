// quoteFetcher.js
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

export { fetchQuotes }; // Exportați funcția fetchQuotes pentru a o face disponibilă pentru import
