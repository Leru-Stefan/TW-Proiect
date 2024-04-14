const logoutButton = document.getElementById('gotologout');
const problemeButton = document.getElementById('gotoprobleme');
const profilButton = document.getElementById('gotoprofil');
const setariButton = document.getElementById('gotosetari');
const ajutorButton = document.getElementById('gotoajutor');

logoutButton.addEventListener('click', () => {
    window.location.href = 'Login.html';
});

problemeButton.addEventListener('click', () => {
    window.location.href = 'probleme.html';
});

profilButton.addEventListener('click', () => {
    window.location.href = 'profile.html';
});

setariButton.addEventListener('click', () => {
    window.location.href = 'setari.html';
});

ajutorButton.addEventListener('click', () => {
    window.location.href = 'ajutor.html';
});


// Get the arrows and the cards for the first carousel
const arrowLeft1 = document.querySelector('.problemele-mele .arrow-left');
const arrowRight1 = document.querySelector('.problemele-mele .arrow-right');
const cards1 = document.querySelectorAll('.problemele-mele .card');

// Get the arrows and the cards for the second carousel
const arrowLeft2 = document.querySelector('.probleme-rezolvate .arrow-left');
const arrowRight2 = document.querySelector('.probleme-rezolvate .arrow-right');
const cards2 = document.querySelectorAll('.probleme-rezolvate .card');

// Set the initial index for each carousel
let index1 = 0;
let index2 = 0;

// Set the maximum index for each carousel
const maxIndex1 = cards1.length - 3;
const maxIndex2 = cards2.length - 3;

// Add event listeners to the arrows for the first carousel
arrowLeft1.addEventListener('click', () => {
    if (cards1.length > 0) {
        index1 = Math.max(index1 - 1, 0);
        moveCards(cards1, index1);
    }
});

arrowRight1.addEventListener('click', () => {
    if (cards1.length > 0) {
        index1 = Math.min(index1 + 1, maxIndex1);
        moveCards(cards1, index1);
    }
});

// Add event listeners to the arrows for the second carousel
arrowLeft2.addEventListener('click', () => {
    if (cards2.length > 0) {
        index2 = Math.max(index2 - 1, 0);
        moveCards(cards2, index2);
    }
});

arrowRight2.addEventListener('click', () => {
    if (cards2.length > 0) {
        index2 = Math.min(index2 + 1, maxIndex2);
        moveCards(cards2, index2);
    }
});


// Move the cards based on the index for each carousel
function moveCards(cards, index) {
  // Hide all cards
  cards.forEach(card => {
    card.style.display = 'none';
    card.style.transition = 'transform 0.5s ease';
    card.style.transform = 'translateX(-100%)';
});

  // Show the next three cards based on the index
  for (let i = index; i < index + 3 && i < cards.length; i++) {
    cards[i].style.display = 'block';
    cards[i].style.transform = 'translateX(0)';
  }
}

