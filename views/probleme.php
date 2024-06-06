<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> SQL-Two | Probleme </title>
    <link rel="stylesheet" href="./CSS/problemeStyle.css">
    <script defer src="./JS/problem.js"></script>
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
        <div class="side-bar column">
            <img src="./Images/Landing%20images/Logo-nav-bar.svg" alt="Logo navigation bar" class="logo-nav">
            <img src="./Images/Profile%20images/Logo-small.svg" alt="" class="logo-small">
            <nav>
                <ul class="menu-links">
                    <li>
                        <div class="menu-link active" id="gotoprobleme">
                            <img src="./Images/Icons-white/fi-rr-document-signed.svg" alt="" class="icon-menu">
                            <a id="gotoprobleme"> Probleme</a>
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
                        <div class="menu-link" id="gotologout">
                            <img src="./Images/Icons-black/fi-rr-sign-out.svg" alt="" class="icon-menu">
                            <a id="gotologout">Log out</a>
                        </div>
                    </li>
                </ul>

            </nav>
        </div>
        <div class="column main-content">
            <div class="search">
                <img src="./Images/Icons-black/fi-rr-search.svg" alt="" class="search-icon">
                <input type="text" placeholder="Cauta...">
            </div>
            <div class="add-problem-container" id="add-problem">
                <div class="inner-content">
                    <img src="./Images/Icons-white/add.svg" alt="addIcon">
                    <p>Adauga o problema</p>
                </div>
            </div>

            <div class="cards-probleme" id="cards-probleme">
                <?php if (!empty($problems)): ?>
                     <?php foreach ($problems as $problem): ?>
                        <div class="card" id="problema-<?php echo $problem['question_id']; ?>">
                            <div class="text-problem">
                                <h4><?php echo htmlspecialchars($problem['question_title']); ?></h4>
                                <p><?php echo htmlspecialchars($problem['description']); ?></p>
                            </div>
                            <div class="cta-buttons">
                                <a href="index.php?page=editor&id=<?php echo $problem['question_id']; ?>" class="btn btn-primary">Rezolvă acum</a>
                                <img class="download-button" src="./Images/Icons-black/fi-rr-download.svg" alt="" onclick="afiseazaDropdown(this)">
                                <div class="dropdown-content">
                                    <a href="#" onclick="downloadProblem(<?php echo $problem['question_id']; ?>, 'json')">
                                        <span><img src="./Images/Icons-black/fi-rr-download.svg" alt="JSON icon"></span>Descarcă JSON
                                    </a>
                                    <a href="#" onclick="downloadProblem(<?php echo $problem['question_id']; ?>, 'xml')">
                                        <span><img src="./Images/Icons-black/fi-rr-download.svg" alt="XML icon"></span>Descarcă XML
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No problems found.</p>
                <?php endif; ?>
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
            <img class="image-popup" src="./Images/Profile images/celebration.svg" alt="Congrats">
            <div class="text-wrapper">
                <h2>Felicitari!</h2>
                <p>Ai rezolvat cu succes 20 de probleme. Te rugăm să încarci problema ta pe platforma noastră în format
                    JSON.</p>
            </div>
            <a class="btn btn-primary" id="importJsonButton">Import JSON</a>
            <input type="file" id="jsonFileInput" accept=".json" style="display: none;">
        </div>
    </div>

    <div class="glass-effect-div" id="glassAddFalse" style="display: none;">

        <div class="popup-add" id="addFalse">
            <img class="image-popup" src="./Images/Profile images/sad.svg" alt="Congrats">
            <div class="text-wrapper">
                <h2>Ne pare rau!</h2>
                <p>Încă nu ai rezolvat 20 de probleme pentru a putea adăuga propria ta problemă. Te rugăm să continui să
                    lucrezi la probleme.</p>
            </div>
        </div>
    </div>
</body>

</html>