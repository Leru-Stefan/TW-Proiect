function afiseazaDropdown(imgElement) {
    var dropdownContent = imgElement.nextElementSibling;
    dropdownContent.classList.toggle("show");
}

// Închide dropdown-ul dacă utilizatorul face clic în afara acestuia
window.onclick = function(event) {
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