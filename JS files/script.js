const loginButton = document.getElementById('goToLogin');
const signupButton = document.getElementById('goToSignUp');

loginButton.addEventListener('click', () => {
  window.location.href = 'Login.html';
});

signupButton.addEventListener('click', () => {
  window.location.href = 'Sign-up.html';
});

// Get the arrows and the cards
const arrowLeft = document.querySelector('.arrow-left');
const arrowRight = document.querySelector('.arrow-right');
const cards = document.querySelectorAll('.card');

// Set the initial index
let index = 0;

// Set the maximum index
const maxIndex = cards.length - 3;

// Add an event listener to the left arrow
arrowLeft.addEventListener('click', () => {
  // Move the cards to the left
  index = Math.max(index - 1, 0);
  moveCards();
});

// Add an event listener to the right arrow
arrowRight.addEventListener('click', () => {
  // Move the cards to the right
  index = Math.min(index + 1, maxIndex);
  moveCards();

  if (index === maxIndex - 1) {
    cards[maxIndex].classList.add('active');
  }
});



// Move the cards based on the index
function moveCards() {
  // Remove the active class from all cards
  cards.forEach(card => card.classList.remove('active'));

  // Add the active class to the cards that should be visible
  for (let i = index; i < index + 3; i++) {
    cards[i].classList.add('active');
  }
}