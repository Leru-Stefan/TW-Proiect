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
            <nav class="mobile-nav">
                
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
            <div class="filter">
                <h5>Filtru:</h5>
                <form method="GET" action="<?php echo $_SERVER['PHP_SELF'];?>" class="categories">
                    <input type="hidden" name="page" value="probleme">

                    <select name="chapter" id="chapter">
                        <option value="">Selectează un capitol</option>
                        <option value="<?php echo urlencode('SELECT Basics'); ?>">SELECT Basics</option>
                        <option value="<?php echo urlencode('JOINs'); ?>">JOINs</option>
                        <option value="<?php echo urlencode('GROUP BY'); ?>">GROUP BY</option>
                        <option value="<?php echo urlencode('Subinterogări'); ?>">Subinterogări</option>
                        <option value="<?php echo rawurlencode('Manipularea Datelor'); ?>">Manipularea Datelor</option>
                    </select>

                    <select name="difficulty" id="difficulty">
                        <option value="">Selecteaza o dificultate</option>
                        <option value="<?php echo urlencode('easy'); ?>">Usor</option>
                        <option value="<?php echo urlencode('medium'); ?>">Mediu</option>
                        <option value="<?php echo urlencode('hard'); ?>">Dificil</option>
                    </select>

                    <button type="submit" class="btn btn-primary">Cauta</button>
                </form>
            </div>

            <div class="cards-probleme" id="cards-probleme">
            <?php
            $chapter = isset($_GET['chapter']) ? urldecode($_GET['chapter']) : '';
            $difficulty = isset($_GET['difficulty']) ? urldecode($_GET['difficulty']) : '';
            
            $model = new ProblemModel();
            $problems = $model->getFilteredProblems($chapter, $difficulty);

            ?>
                <?php if (!empty($problems)): ?>
                     <?php foreach ($problems as $problem): ?>
                        <div class="card" id="problema-<?php echo $problem['question_id']; ?>">
                            <div class="text-problem">
                                <h4><?php echo htmlspecialchars($problem['question_title']); ?></h4>
                                <p><?php echo htmlspecialchars($problem['description']); ?></p>
                            </div>
                            <div class="cta-buttons">
                                <a href="index.php?page=editor&id=<?php echo $problem['question_id']; ?>" class="btn btn-primary">Rezolvă acum</a>
                                <div class="download-button" onclick="afiseazaDropdown(this)">
                                    <img class="download-btn" src="./Images/Icons-black/fi-rr-download.svg" alt="" >
                                </div>
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


    <div class="glass-effect-div" id="glassAddTrue" style="display: none;">
        <div class="popup-add" id="addTrue">
            <!-- <img class="image-popup" src="./Images/Profile%20images/upload.svg" alt="Congrats"> -->
            <div class="text-wrapper">
                <h2>Incarca problema!</h2>
                <p>Va rugam sa completati campurile de mai jos pentru a putea adauga o problema pe platforma noastra.</p>
            </div>
            <form action="index.php?page=probleme&&action=addOrImport" method="post" id="problem_import" class="problem-form" enctype="multipart/form-data">
                <label for="question_title">Titlu</label>
                <input type="text" id="question_title" name="question_title" placeholder="Titlul problemei" required>
                <label for="descriere">Descriere</label>
                <textarea type="text" placeholder="Continutul problemei in 2-3 enunturi" id="description" name="description" required></textarea> 
                <label for="rezolvare">Rezolvare</label>
                <textarea type="text" placeholder="Rezolvarea corecta a problemei" id="rezolvare" name="correct_query" required></textarea>
                <label for="chapter">Capitol si dificultate</label>
                <div class="categories">
                    <select id="chapter" name="chapter" required>
                        <option value="">Selectează un capitol</option>
                        <option value="SELECT Basics">SELECT Basics</option>
                        <option value="JOINs">JOINs</option>
                        <option value="GROUP BY">GROUP BY</option>
                        <option value="Subinterogări">Subinterogări</option>
                        <option value="Manipularea Datelor">Manipularea Datelor</option>
                    </select>

                    <select name="difficulty" id="difficulty">
                        <option value="">Selecteaza o dificultate</option>
                        <option value="easy">Usor</option>
                        <option value="medium">Mediu</option>
                        <option value="hard">Dificil</option>
                    </select>

                </div>
                <input type="submit" class="btn btn-secondary" id="createJsonButton" name="action" value="Trimite"></input>
            </form>
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