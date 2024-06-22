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
                            <a id="gotoprobleme">Probleme</a>
                        </div>
                    </li>
                    <li>
                        <div class="menu-link active" id="gotoprofil">
                            <img src="./Images/Icons-white/fi-rr-user.svg" alt="" class="icon-menu">
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

            <div class="greeting">
                <div class="text-box">
                    <h3>Buna, <?php echo htmlspecialchars($_SESSION['prenume']); ?>!</h3>
                    <p>Din aceasta pagina poti sa urmaresti ce probleme ai adaugat tu! Totodata, poti sa si stergi problemele care le consideri invechite</p>
                    <img src="./Images/Profile images/admin.svg" alt="admin" class="greeting-img">
                </div>
            </div>
            <div class="statistics">
            <div class="stat" id="stat-1">
                    <h2><?php echo $solvedProblemsCount; ?></h2>
                    <h4>Probleme rezolvate</h4>

                </div>
                <div class="stat" id="stat-2">
                    <h2><?php echo $addedProblemsCount; ?></h2>
                    <h4>Probleme adaugate</h4>

                </div>
                <div class="stat" id="stat-3">
                    <h2><?php echo $accuracy; ?>%</h2>
                    <h4>Acuratetea rezolvarilor</h4>
                </div>
            </div>
            <div class="problemele-mele">
                <h4>Problemele mele</h4>
                <div class="grid-problems-admin">
                    <div class="add-problem-card" id="add-problem">
                        <img src="./Images/Icons-white/add.svg" alt="">
                        <p>Adauga problema</p>
                    </div>
                    <?php if (empty($addedProblems)): ?>
                        <div class="card">
                            <h5>Mesaj</h5>
                            <p>Nu ai adaugat nicio problemă până acum. Începe să rezolvi probleme pentru a deveni un expert!</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($addedProblems as $problem): ?>
                            <div class="card" id="prbm-<?php echo $problem['question_id']; ?>">
                                <div class="name-delete" >
                                    <h5><?php echo $problem['question_title']; ?></h5>
                                    <img src="./Images/Icons-black/fi-rr-menu-dots.svg" alt="" class="delete-dots"  onclick="afiseazaDropdown(this)">
                                    <div class="dropdown-content">
                                        <a href="#" id="deleteBtn"><span><img src="./Images/Icons-black/fi-rr-trash.svg"
                                            alt="delete icon"></span>Sterge</a>
                                    </div>
                                </div>
                                <p><?php echo htmlspecialchars($problem['description']); ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                    
            </div>

            <div class="problemele-mele">
                <h4>Problemele rezolvate</h4>
                <div class="grid-problems-admin">
                    <?php if (empty($solvedProblems)): ?>
                        <div class="card">
                            <h5>Mesaj</h5>
                            <p>Nu ai rezolvat nicio problemă până acum. Începe să rezolvi probleme pentru a deveni un expert!</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($solvedProblems as $problem): ?>
                            <div class="card" id="prbm-<?php echo htmlspecialchars($problem['question_id']); ?>">
                                <h5>Problema <?php echo htmlspecialchars($problem['question_id']); ?></h5>
                                <p><?php echo htmlspecialchars($problem['description']); ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
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
                        <option value="<?php echo urlencode('easy'); ?>">Usor</option>
                        <option value="<?php echo urlencode('medium'); ?>">Mediu</option>
                        <option value="<?php echo urlencode('hard'); ?>">Dificil</option>
                    </select>

                </div>
                <input type="submit" class="btn btn-secondary" id="createJsonButton" name="action" value="Trimite"></input>
            </form>
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