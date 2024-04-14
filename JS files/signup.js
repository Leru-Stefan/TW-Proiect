// Selectează butoanele de login și sign up
var loginButton = document.querySelector('.primary');
var signUpButton = document.querySelector('.secondary');

// Selectează partea stângă și partea dreaptă
var leftHalf = document.querySelector('.left-half');
var rightHalf = document.querySelector('.right-half');

// Adaugă eveniment pentru butonul de login
loginButton.addEventListener('click', function() {
    // Ascunde partea dreaptă și afișează partea stângă
    leftHalf.style.display = 'none';
    rightHalf.style.display = 'flex';
});

// Adaugă eveniment pentru butonul de sign up
signUpButton.addEventListener('click', function() {
    // Ascunde partea stângă și afișează partea dreaptă
    leftHalf.style.display = 'none';
    rightHalf.style.display = 'block';

    // Folosește metoda fetch pentru a încărca conținutul paginii Sign-up.html
    fetch('/HTML%20files/Sign-up.html')
        .then(response => response.text())
        .then(data => {
            // Încarcă conținutul paginii în div-ul right-half
            rightHalf.innerHTML = data;
        })
        .catch(error => {
            console.error('A apărut o eroare:', error);
        });
});
