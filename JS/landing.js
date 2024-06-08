document.addEventListener('DOMContentLoaded', function () {


const loginButton = document.getElementById('goToLogin');
const signupButton = document.getElementById('goToSignUp');
const connectButton = document.getElementById('goToLogin2');

loginButton.addEventListener('click', () => {
  window.location.href = 'index.php?page=login';
});

signupButton.addEventListener('click', () => {
  window.location.href = 'index.php?page=signup';
});

connectButton.addEventListener ('click', () => {
  window.location.href = 'index.php?page=login';
})


}); 