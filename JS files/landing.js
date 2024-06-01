const loginButton = document.getElementById('goToLogin');
const signupButton = document.getElementById('goToSignUp');

loginButton.addEventListener('click', () => {
  window.location.href = 'Login.html';
});

signupButton.addEventListener('click', () => {
  window.location.href = 'Sign-up.html';
});
