<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> SQL-Two | Editor problema </title>
    <link rel="stylesheet" href="./CSS/editor.css">
    <script defer src="./JS/editor.js"></script>
    <script>
        function downloadProblem(id, format) {
            var fileName = 'Problema_' + id + '.' + format;
            var url = 'index.php?page=download&format=' + format + '&id=' + id;
        
            // Deschide URL-ul într-o nouă fereastră sau filă
            var link = document.createElement('a');
            link.href = url;
            link.download = fileName;
            link.target = '_blank';
            link.click();
        }
    </script>
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
                        <div class="menu-link active" id="gotoprobleme">
                            <img src="./Images/Icons-white/fi-rr-document-signed.svg" alt="" class="icon-menu">
                            <a id="gotoprobleme" >Probleme</a>
                        </div>
                    </li>
                    <li>
                        <div class="menu-link" id="gotoprofil">
                            <img src="./Images/Icons-black/fi-rr-user.svg" alt="" class="icon-menu">
                            <a id="gotoprofil">Profil</a>
                        </div>
                    </li>
                    <li>
                        <div class="menu-link" id="gotosetari">
                            <img src="./Images/Icons-black/fi-rr-settings.svg" alt="" class="icon-menu">
                            <a id="gotosetari">Setari</a>
                        </div>
                    </li>
                    <li>
                        <div class="menu-link" id="gotoajutor">
                            <img src="./Images/Icons-black/fi-rr-hand-holding-heart.svg" alt="" class="icon-menu">
                            <a id="gotoajutor">Ajutor</a>
                        </div>
                    </li>
                    <li>
                        <div class="menu-link" id="gotologout">
                            <img src="./Images/Icons-black/fi-rr-sign-out.svg" alt="" class="icon-menu">
                            <a id="gotologout">Log out</a>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- </div> -->
        <div class="column main-content">
                <div class="card" id="prb-1">
                    <!-- <div class="text-problem">
                        <h4 id="problem-title"></h4>
                        <p id="problem-description"></p>
                    </div> -->
                    <div class="text-problem">
                        <div class="denumire-dropdown">
                            <h4 id="problem-title"><?php echo htmlspecialchars($problem['question_title']); ?></h4>
                            <img src="./Images/Icons-black/fi-rr-menu-dots.svg" alt="" class="menu-dots"
                                onclick="afiseazaDropdown(this)">
                            <div class="dropdown-content">
                                <a href="#" onclick="downloadProblem(<?php echo $problem['question_id']; ?>, 'json')">
                                        <span><img src="./Images/Icons-black/fi-rr-download.svg" alt="JSON icon"></span>Descarcă JSON
                                    </a>
                                <a href="#" onclick="downloadProblem(<?php echo $problem['question_id']; ?>, 'xml')">
                                        <span><img src="./Images/Icons-black/fi-rr-download.svg" alt="XML icon"></span>Descarcă XML
                                    </a>
                            </div>
    
                        </div>
                        <p id="problem-description"><?php echo htmlspecialchars($problem['description']); ?></p>
                    </div>
                </div>
                <div class="editor">
                    <div class="live-editor">
                        <textarea id="userInput" class="input" placeholder="Introdu aici rezolvarea ta"></textarea>
                    </div>
                    <div class="buttons">
                        <a id="resetBtn" class="btn btn-secondary" href="#">Reseteaza</a>
                        <a id="verifyBtn" class="btn btn-primary" href="#">Verifica</a>
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
                    <p>Vrei numele tău pe lista celor care rezolvă cele mai multe probleme? Începe să înveți și să
                        rezolvi!
                    </p>
                </div>
                <div class="list-top5">
                    <div id="top-student-1" class="top-student winner">
                        <div class="user-data">
                            <img src="./Images/Icons-white/fi-rr-user.svg" alt="">
                            <h5></h5>
                        </div>
                        <h4></h4>
                    </div>
                    <div id="top-student-2" class="top-student">
                        <div class="user-data">
                            <img src="./Images/Icons-black/fi-rr-user.svg" alt="">
                            <h5></h5>
                        </div>
                        <h4></h4>
                    </div>
                    <div id="top-student-3" class="top-student">
                        <div class="user-data">
                            <img src="./Images/Icons-black/fi-rr-user.svg" alt="">
                            <h5></h5>
                        </div>
                        <h4></h4>
                    </div>
                    <div id="top-student-4" class="top-student">
                        <div class="user-data">
                            <img src="./Images/Icons-black/fi-rr-user.svg" alt="">
                            <h5></h5>
                        </div>
                        <h4></h4>
                    </div>
                    <div id="top-student-5" class="top-student">
                        <div class="user-data">
                            <img src="./Images/Icons-black/fi-rr-user.svg" alt="">
                            <h5></h5>
                        </div>
                        <h4></h4>
                    </div>
                </div>
            </div>
            <div id="quote-container"></div>
        </div>
    </div>
    <div class="glass-effect-div" id="glassSolvedTrue" style="display: none;">
        <div class="popup" id="popupCorect">
            <img src="./Images/Editor%20images/Enthusiastic-rafiki.svg" alt="">
            <h3>Raspuns corect!</h3>
            <p>Felicitari! Ai rezolvat interogarea corect.
                Te rugam sa notezi dificultatea problemei rezolvate
            </p>
            <div class="dificultate-options">
                <button class="dificultate-button" data-dificultate="usor">Ușor</button>
                <button class="dificultate-button" data-dificultate="mediu">Mediu</button>
                <button class="dificultate-button" data-dificultate="greu">Greu</button>
            </div>
        </div>
    </div>

    <div class="glass-effect-div" id="glassSolvedFalse" style="display: none;">
        <div class="popup" id="popupGresit">
            <img src="./Images/Editor%20images/Writer's%20block-rafiki.svg" alt="">
            <h3>Raspuns gresit!</h3>
            <p>Te rugam sa incerci inca o data. Rezultatul obtinut nu satisface conditia problemei.</p>
        </div>
    </div>

</body>

</html>