document.addEventListener('DOMContentLoaded', function () {


const loginButton = document.getElementById('goToLogin');
const signupButton = document.getElementById('goToSignUp');

loginButton.addEventListener('click', () => {
  window.location.href = 'index.php?page=Login';
});

signupButton.addEventListener('click', () => {
  window.location.href = 'index.php?page=Sign-up';
});
}); 