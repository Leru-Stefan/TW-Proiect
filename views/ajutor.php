<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
?>

<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> SQL-Two | Ajutor </title>
    <link rel="stylesheet" href="./CSS/ajutor.css">
    <script defer src="./JS/ajutor.js"></script>
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
                        <div class="menu-link " id="gotoprobleme">
                            <img src="./Images/Icons-black/fi-rr-document-signed.svg" alt="" class="icon-menu">
                            <a id="gotoprobleme">Probleme</a>
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
                        <div class="menu-link active" id="gotoajutor">
                            <img src="./Images/Icons-white/fi-rr-hand-holding-heart.svg" alt="" class="icon-menu">
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
        <div class="column main-content-setari">
            <div class="help-content">
                <section>
                    <h3>Despre aplicație</h3>
                    <p>Aplicația noastră este un instrument educațional conceput pentru a ajuta utilizatorii să învețe și să practice interogări SQL. Utilizatorii pot rezolva exerciții, vizualiza soluțiile corecte și urmări progresul lor.</p>
                </section>

                <section>
                    <h3>Despre baza de date</h3>
                    <p>Baza de date utilizată în această aplicație este un sistem de gestionare a bazei de date relațional (RDBMS). Ea conține tabele care reflectă diferite aspecte ale unui sistem de management academic, cum ar fi studenți, cursuri, note, profesori, etc.</p>
                    <ul>
                        <li><strong>studenti</strong>: Conține informații despre studenți (nr_matricol, nume, prenume, an, grupa, bursa, data_nastere).</li>
                        <li><strong>cursuri</strong>: Conține informații despre cursuri (id_curs, titlu_curs, an, semestru, credite).</li>
                        <li><strong>note</strong>: Înregistrează notele studenților la cursuri (nr_matricol, id_curs, valoare, data_notare).</li>
                        <li><strong>profesori</strong>: Conține informații despre profesori (id_prof, nume, prenume, grad_didactic).</li>
                        <li><strong>didactic</strong>: Conține informații despre profesorii care predau cursuri (id_prof, id_curs).</li>
                    </ul>
                </section>

                <section>
                    <h3>Cum să folosești aplicația</h3>
                    <p>Urmărește acești pași pentru a începe:</p>
                    <ol>
                        <li><strong>Înregistrează-te</strong>: Creează-ți un cont nou pentru a începe.</li>
                        <li><strong>Loghează-te</strong>: Accesează-ți contul pentru a vedea exercițiile disponibile.</li>
                        <li><strong>Rezolvă exercițiile</strong>: Alege un exercițiu și trimite soluția ta SQL.</li>
                        <li><strong>Verifică rezultatele</strong>: Vezi dacă răspunsul tău este corect și studiază soluțiile corecte.</li>
                        <li><strong>Urmărește progresul</strong>: Verifică leaderboard-ul pentru a vedea cum te descurci în comparație cu alți utilizatori.</li>
                    </ol>
                </section>

                <section>
                    <h3>Întrebări frecvente</h3>
                    <ul>
                        <li><strong>Ce este SQL?</strong> SQL (Structured Query Language) este un limbaj standardizat pentru gestionarea și manipularea bazelor de date relaționale.</li>
                        <li><strong>Ce exerciții sunt disponibile?</strong> Aplicația oferă exerciții care acoperă diverse capitole și niveluri de dificultate, de la interogări de bază la subinterogări complexe.</li>
                        <li><strong>Pot vedea soluțiile corecte?</strong> Da, după ce trimiți un răspuns, poți vedea soluția corectă și explicații detaliate.</li>
                    </ul>
                </section>
            </div>
        </div>
    </div>
</body>

</html>