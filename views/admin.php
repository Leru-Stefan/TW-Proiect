<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> SQL-Two | Profil </title>
    <link rel="stylesheet" href="./CSS/admin.css">
    <script defer src="./JS/admin.js"></script>

</head>

<body>
    <div class="grid-container">
        <!-- <div class="column"> -->
        <div class="side-bar column">
            <img src="./Images/Landing%20images/Logo-nav-bar.svg" alt="Logo navigation bar" class="logo-nav">
            <img src="./Images/Profile%20images/Logo-small.svg" alt="" class="logo-small">
            <nav>
                <ul class="menu-links">
                    <li>
                        <div class="menu-link" id="gotoprobleme">
                            <img src="./Images/Icons-black/fi-rr-document-signed.svg" alt="" class="icon-menu">
                            <a href="./HTML%20files/probleme.html">Probleme</a>
                        </div>
                    </li>
                    <li>
                        <div class="menu-link active" id="gotoprofil">
                            <img src="./Images/Icons-white/fi-rr-user.svg" alt="" class="icon-menu">
                            <a href="./HTML%20files/profile.html">Profil</a>
                        </div>
                    </li>
                    <li>
                        <div class="menu-link" id="gotosetari">
                            <img src="./Images/Icons-black/fi-rr-settings.svg" alt="" class="icon-menu">
                            <a href="./HTML%20files/setari.html">Setari</a>
                        </div>
                    </li>
                
                    <li>
                        <div class="menu-link" id="gotologout">
                            <img src="./Images/Icons-black/fi-rr-sign-out.svg" alt="" class="icon-menu">
                            <a href="./HTML%20files/Login.html">Log out</a>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- </div> -->
        <div class="column main-content">

            <div class="greeting">
                <div class="text-box">
                    <h3>Buna, admin!</h3>
                    <p>Din aceasta pagina poti sa urmaresti ce probleme ai adaugat tu! Totodata, poti sa si stergi problemele care le consideri invechite</p>
                    <img src="./Images/Profile images/admin.svg" alt="admin" class="greeting-img">
                </div>
            </div>
            <div class="statistics">
                <div class="stat" id="stat-1">
                    <h1>42</h1>
                    <h4>Probleme rezolvate</h4>
                    <p>Devina expert in SQL prin rezolvarea a cat mai multe probleme posibil</p>
                </div>
                <div class="stat" id="stat-2">
                    <h1>2</h1>
                    <h4>Probleme adaugate</h4>
                    <p>La fiecare 20 probleme rezolvate ai posibilitatea sa scrii problema ta.</p>
                </div>
            </div>
            <div class="problemele-mele">
                <h4>Problemele mele</h4>
                <div class="grid-problems-admin">
                    <div class="add-problem-card" id="add-problem">
                        <img src="./Images/Icons-white/add.svg" alt="">
                        <p>Adauga problema</p>
                    </div>
                    <div class="card" id="prbm-1">
                        <div class="name-delete" >
                            <h5>Problema 1</h5>
                            <img src="./Images/Icons-black/fi-rr-menu-dots.svg" alt="" class="delete-dots"  onclick="afiseazaDropdown(this)">
                            <div class="dropdown-content">
                                <a href="#" id="deleteBtn"><span><img src="./Images/Icons-black/fi-rr-trash.svg"
                                    alt="delete icon"></span>Sterge</a>
                            </div>
                        </div>
                        <p>Aici ar trebui sa fie continul unei probleme pe care a adaugat-o utilizatorul. Aici ar trebui sa fie continul unei probleme pe care a adaugat-o utilizatorul</p>
                    </div>
                    <div class="card" id="prbm-2">
                        <div class="name-delete" >
                            <h5>Problema 2</h5>
                            <img src="./Images/Icons-black/fi-rr-menu-dots.svg" alt="" class="delete-dots"  onclick="afiseazaDropdown(this)">
                            <div class="dropdown-content">
                                <a href="#" id="deleteBtn"><span><img src="./Images/Icons-black/fi-rr-trash.svg"
                                    alt="delete icon"></span>Sterge</a>
                            </div>
                        </div>
                        <p>Aici ar trebui sa fie continul unei probleme pe care a adaugat-o utilizatorul. Aici ar trebui sa fie continul unei probleme pe care a adaugat-o utilizatorul</p>
                    </div>
                    <div class="card" id="prbm-3">
                        <div class="name-delete" >
                            <h5>Problema 3</h5>
                            <img src="./Images/Icons-black/fi-rr-menu-dots.svg" alt="" class="delete-dots"  onclick="afiseazaDropdown(this)">
                            <div class="dropdown-content">
                                <a href="#" id="deleteBtn"><span><img src="./Images/Icons-black/fi-rr-trash.svg"
                                    alt="delete icon"></span>Sterge</a>
                            </div>
                        </div>
                        <p>Aici ar trebui sa fie continul unei probleme pe care a adaugat-o utilizatorul. Aici ar trebui sa fie continul unei probleme pe care a adaugat-o utilizatorul</p>
                    </div>
                    <div class="card" id="prbm-4">
                        <div class="name-delete" >
                            <h5>Problema 4</h5>
                            <img src="./Images/Icons-black/fi-rr-menu-dots.svg" alt="" class="delete-dots"  onclick="afiseazaDropdown(this)">
                            <div class="dropdown-content">
                                <a href="#" id="deleteBtn"><span><img src="./Images/Icons-black/fi-rr-trash.svg"
                                    alt="delete icon"></span>Sterge</a>
                            </div>
                        </div>
                        <p>Aici ar trebui sa fie continul unei probleme pe care a adaugat-o utilizatorul. Aici ar trebui sa fie continul unei probleme pe care a adaugat-o utilizatorul</p>
                    </div>
                    <div class="card" id="prbm-5">
                        <div class="name-delete" >
                            <h5>Problema 5</h5>
                            <img src="./Images/Icons-black/fi-rr-menu-dots.svg" alt="" class="delete-dots"  onclick="afiseazaDropdown(this)">
                            <div class="dropdown-content">
                                <a href="#" id="deleteBtn"><span><img src="./Images/Icons-black/fi-rr-trash.svg"
                                    alt="delete icon"></span>Sterge</a>
                            </div>
                        </div>
                        <p>Aici ar trebui sa fie continul unei probleme pe care a adaugat-o utilizatorul. Aici ar trebui sa fie continul unei probleme pe care a adaugat-o utilizatorul</p>
                    </div>
                    <div class="card" id="prbm-6">
                        <div class="name-delete" >
                            <h5>Problema 6</h5>
                            <img src="./Images/Icons-black/fi-rr-menu-dots.svg" alt="" class="delete-dots"  onclick="afiseazaDropdown(this)">
                            <div class="dropdown-content">
                                <a href="#" id="deleteBtn"><span><img src="./Images/Icons-black/fi-rr-trash.svg"
                                    alt="delete icon"></span>Sterge</a>
                            </div>
                        </div>
                        <p>Aici ar trebui sa fie continul unei probleme pe care a adaugat-o utilizatorul. Aici ar trebui sa fie continul unei probleme pe care a adaugat-o utilizatorul</p>
                    </div>
                    <div class="card" id="prbm-7">
                        <div class="name-delete" >
                            <h5>Problema 7</h5>
                            <img src="./Images/Icons-black/fi-rr-menu-dots.svg" alt="" class="delete-dots"  onclick="afiseazaDropdown(this)">
                            <div class="dropdown-content">
                                <a href="#" id="deleteBtn"><span><img src="./Images/Icons-black/fi-rr-trash.svg"
                                    alt="delete icon"></span>Sterge</a>
                            </div>
                        </div>
                        <p>Aici ar trebui sa fie continul unei probleme pe care a adaugat-o utilizatorul. Aici ar trebui sa fie continul unei probleme pe care a adaugat-o utilizatorul</p>
                    </div>
                </div>
                    
            </div>

            <div class="problemele-mele">
                <h4>Problemele rezolvate</h4>
                <div class="grid-problems-admin">
                    <div class="card" id="prbm-1">
                        <h5>Problema 1</h5>
                        <p>Aici ar trebui sa fie continul unei probleme pe care a adaugat-o utilizatorul</p>
                    </div>
                    <div class="card" id="prbm-2">
                        <h5>Problema 2</h5>
                        <p>Aici ar trebui sa fie continul unei probleme pe care a adaugat-o utilizatorul</p>
                    </div>
                    <div class="card" id="prbm-3">
                        <h5>Problema 3</h5>
                        <p>Aici ar trebui sa fie continul unei probleme pe care a adaugat-o utilizatorul</p>
                    </div>
                    <div class="card" id="prbm-4">
                        <h5>Problema 4</h5>
                        <p>Aici ar trebui sa fie continul unei probleme pe care a adaugat-o utilizatorul</p>
                    </div>
                    <div class="card" id="prbm-5">
                        <h5>Problema 5</h5>
                        <p>Aici ar trebui sa fie continul unei probleme pe care a adaugat-o utilizatorul</p>
                    </div>
                    <div class="card" id="prbm-6">
                        <h5>Problema 6</h5>
                        <p>Aici ar trebui sa fie continul unei probleme pe care a adaugat-o utilizatorul</p>
                    </div>
                </div>
                    
            </div>
        </div>
        <div class="column right-side">
            <div class="leaderboard">
                <div class="text-box">
                    <div class="table-heading">
                        <img src="./Images/Icons-black/fi-rr-badge.svg" alt="" class="leader-icon">
                        <h3>Leaderboard</h3>
                    </div>
                    <p>Vezi cine a rezolvat cele mai multe probleme si apuca-te de invatat ca sa ti vezi si numele
                        tau aici.
                    </p>
                </div>
                <div class="list-top5">
                    <div class="top-student winner" id="top-student-1">
                        <div class="user-data">
                            <img src="./Images/Icons-white/fi-rr-user.svg" alt="">
                            <h5>Nume prenume</h5>
                        </div>
                        <h4>118</h4>
                    </div>
                    <div class="top-student " id="top-student-2">
                        <div class="user-data">
                            <img src="./Images/Icons-black/fi-rr-user.svg" alt="">
                            <h5>Nume prenume</h5>
                        </div>
                        <h4>116</h4>
                    </div>
                    <div class="top-student " id="top-student-3">
                        <div class="user-data">
                            <img src="./Images/Icons-black/fi-rr-user.svg" alt="">
                            <h5>Nume prenume</h5>
                        </div>
                        <h4>114</h4>
                    </div>
                    <div class="top-student " id="top-student-4">
                        <div class="user-data">
                            <img src="./Images/Icons-black/fi-rr-user.svg" alt="">
                            <h5>Nume prenume</h5>
                        </div>
                        <h4>113</h4>
                    </div>
                    <div class="top-student " id="top-student-5">
                        <div class="user-data">
                            <img src="./Images/Icons-black/fi-rr-user.svg" alt="">
                            <h5>Nume prenume</h5>
                        </div>
                        <h4>110</h4>
                    </div>
                </div>
            </div>
            <div class="quote-container" id="quote-container"></div>

        </div>
    </div>
    <div class="glass-effect-div" id="glassAddTrue" style="display: none;">
        <div class="popup-add" id="addTrue">
            <img class="image-popup" src="./Images/Profile%20images/upload.svg" alt="Congrats">
            <div class="text-wrapper">
                <h2>Incarca problema!</h2>
                <p>Va rugam sa adaugati problema intr un format JSON</p>
            </div>
            <a class="btn btn-primary" id="importJsonButton">Import JSON</a>
            <input type="file" id="jsonFileInput" accept=".json" style="display: none;">
        </div>
    </div>

    <div class="glass-effect-div" id="glassDelete" style="display: none;">
        <div class="popup-add" id="deleteTrue">
            <img class="image-popup" src="./Images/Profile%20images/delete.svg" alt="Delete">
            <div class="text-wrapper">
                <h2>Stergi problema?</h2>
                <p>Esti sigur ca vrei sa stergi aceasta problema de pe platforma?</p>
            </div>
            <div class="buttons">
                <a class="btn btn-secondary" id="cancelButton">Anuleaza</a>
                <a class="btn btn-primary" id="confirmDeleteButton">Sterge</a>
            </div>
        </div>
    </div>

</body>

</html>