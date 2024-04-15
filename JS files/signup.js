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

var signupForm = document.querySelector('form');

signupForm.addEventListener('submit', function(event) {
    // Oprește comportamentul implicit al formularului (trimiterea datelor către un server)
    event.preventDefault();

    // Obține valorile introduse de utilizator pentru numele de utilizator, email, parolă și confirmare parolă
    var username = signupForm.querySelector('input[name="fullname"]').value;
    var email = signupForm.querySelector('input[name="email"]').value;
    var password = signupForm.querySelector('input[name="password"]').value;
    var confirmPassword = signupForm.querySelector('input[name="confirm_password"]').value;

    // Verifică dacă toate câmpurile sunt completate și dacă parolele coincid
    if (username && email && password && confirmPassword && password === confirmPassword) {
        // Redirecționează utilizatorul către pagina de probleme
        window.location.href = "/HTML%20files/Probleme.html";
    } else {
        console.error("Toate câmpurile trebuie completate, iar parolele trebuie să coincidă.");
    }
});


