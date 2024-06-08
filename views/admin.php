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
                                    <h5>Problema <?php echo $problem['question_id']; ?></h5>
                                    <img src="./Images/Icons-black/fi-rr-menu-dots.svg" alt="" class="delete-dots"  onclick="afiseazaDropdown(this)">
                                    <div class="dropdown-content">
                                        <a href="#" id="deleteBtn"><span><img src="./Images/Icons-black/fi-rr-trash.svg"
                                            alt="delete icon"></span>Sterge</a>
                                    </div>
                                </div>
                                <p><?php echo htmlspecialchars($problem['question']); ?></p>
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
                    <p>Vezi cine a rezolvat cele mai multe probleme si apuca-te de invatat ca sa ti vezi si numele
                        tau aici.
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