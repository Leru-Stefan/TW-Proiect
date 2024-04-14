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

function afiseazaDropdown(imgElement) {
    var dropdownContent = imgElement.nextElementSibling;
    dropdownContent.classList.toggle("show");
}

// Închide dropdown-ul dacă utilizatorul face clic în afara acestuia
window.onclick = function (event) {
    if (!event.target.matches('.download-button')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}