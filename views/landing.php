<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> SQL-Two | Invata SQL cu noi</title>
    <link rel="stylesheet" href="./CSS/landingStyle.css">
    <script src="./JS/landing.js"></script>

</head>

<body>
    <!-- Nav-bar -->
    <nav>
        <div class="container">
            <img src="./Images/Landing%20images/Logo-nav-bar.svg" alt="" class="nav-logo">
            <ul class="menu-links">
                <li><a href="#hero">Acasa</a></li>
                <li><a href="#functionalitati">Functionalitati</a></li>
                <li><a href="#despre-noi">Despre noi</a></li>
            </ul>
            <div class="buttons">
                <button class=" btn btn-secondary" id="goToLogin">Log in</button>
                <button class=" btn btn-primary" id="goToSignUp">Sign up</button>
            </div>
            <img src="./Images/Icons-black/fi-rr-menu-burger.svg" alt="" class="burger-menu">
        </div>
    </nav>
    <!-- Continut -->
    <section class="hero container" id="hero">
        <div class="text-box">
            <h1>Devină expert în SQL rapid și ușor!</h1>
            <p>Descoperă și explorează posibilitățile nelimitate ale SQL-ului în
                propriul tău ritm, prin lecții captivante și exerciții practice,
                adaptate nevoilor tale individuale de învățare.
            </p>
            <button class="btn-primary" id="goToLogin2">Conecteaza-te</button>
        </div>
        <img src="./Images/Landing%20images/Ilustratie%20hero-section-landing.svg" alt="" class="hero-img">
    </section>

    <section class="functionalitati" id="functionalitati">
        <div class="container">
            <div class="grid-60-40">
                <div class="grid-2x2">
                    <!-- Card 2 -->
                    <div class="card active" id="2">
                        <div class="text-card">
                            <img class="icon-card" src="./Images/Landing images/Icon-1.svg" alt="">
                            <h4>Rezolvă pe loc</h4>
                        </div>
                        <p>Utilizează editorul nostru integrat pentru a răspunde la întrebările SQL propuse. Trimite-ți
                            soluțiile și verifică-le pe loc pentru a vedea dacă ai obținut răspunsul corect.</p>
                    </div>
    
                    <!-- Card 5 -->
                    <div class="card" id="5">
                        <div class="text-card">
                            <img class="icon-card" src="./Images/Landing images/Icon.svg" alt="">
                            <h4>Scrie propria problema</h4>
                        </div>
                        <p>După ce ai parcurs un număr de 20 de întrebări și ai dobândit experiență, ai posibilitatea să
                            creezi și să distribui propria ta problemă SQL pentru a fi rezolvate de ceilalți.</p>
                    </div>
                    <!-- Card 6 -->
                    <div class="card" id="6">
                        <div class="text-card">
                            <img class="icon-card" src="./Images/Landing images/Icon-2.svg" alt="icon">
                            <h4>Monitorizează progresul</h4>
                        </div>
                        <p>Urmărește progresul tău în învățarea SQL-ului prin rapoarte și statistici personale. Vezi
                            scorul total, numărul de întrebări corect rezolvate și alte informații despre
                            progresul tău</p>
                    </div>
                    <!-- Card 7 -->
                    <div class="card" id="7">
                        <div class="text-card">
                            <img class="icon-card" src="./Images/Landing images/Icon-3.svg" alt="">
                            <h4>Salvează problemele</h4>
                        </div>
                        <p>Exportă sau importă întrebări într-un format XML sau JSON, pentru a le
                            utiliza offline sau pentru a le împărtăși cu alții. Împărtășește-ți experiențele cu
                            ceilalți.
                        </p>
                    </div>
                </div>

                <div class="text-box">
                    <h2>Descoperă ce poți face în SQL-TWO.</h2>
                    <p>Aici vei găsi o listă cuprinzătoare a funcționalităților oferite de aplicația noastră, concepute special
                        pentru a-ți facilita învățarea limbajului SQL. De la exerciții interactive și exemple de cod, la testare automată,
                        SQL-TWO îți oferă toate instrumentele necesare pentru a deveni un expert în SQL. Poți aplica cunoștințele în proiecte
                        practice și învăța să utilizezi SQL în diferite sisteme de gestionare a bazelor de date. În această platformă,
                        studenții pot importa și exporta probleme în format JSON și XML, pot rezolva problemele în editorul integrat,
                        pot crea propriile probleme și își pot urmări progresul prin statistici detaliate. De asemenea, te poți alătura
                        unei comunități active de utilizatori pentru a împărtăși cunoștințe și a primi sfaturi utile. Toate aceste resurse
                        sunt disponibile pentru a te ajuta să-ți atingi obiectivele de învățare în cel mai eficient mod posibil.
                    </p>
                    
                </div>
            </div>
            

    </section>

    <section class="despre container" id="despre-noi">
        <img src="./Images/Landing%20images/Ilustratie-despre-noi-section-landing.svg" alt="" class="despre-img">

        <div class="text-box">
            <h2>Cei din spatele scenei</h2>
            <p>Suntem doi studenți din anul al doilea de la Facultatea de Informatică din cadrul Universității din
                Iași
                și
                suntem mândri să vă prezentăm acest proiect pe care l-am realizat cu pasiune și determinare. Ne-am
                unit
                forțele
                pentru a dezvolta o aplicație web menită să ușureze procesul de învățare a limbajului SQL pentru
                începători.
            </p>
            <p>Fiecare linie de cod și fiecare caracteristică au fost create cu atenție și dedicare pentru a oferi o
                experiență educațională de calitate. Ne dorim să împărtășim munca noastră și să contribuim la
                creșterea
                cunoștințelor în domeniul informaticii, oferind o platformă interactivă și accesibilă pentru toți
                cei
                interesați
                să învețe SQL. </p>
        </div>
    </section>
    <footer>
        <div class="container">
            <img src="./Images/Landing%20images/LogoWhiteFooter.svg" alt="" class="footer-logo">
            <ul class="footer-links">
                <li><a href="#hero">Acasa</a></li>
                <li><a href="#functionalitati">Functionalitati</a></li>
                <li><a href="#despre-noi">Despre noi</a></li>
            </ul>
            <svg class="divider" width="100%" viewBox="0 0 322 1" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 1L321 1" stroke="#8292AA" stroke-linecap="round" stroke-width="1" />
            </svg>
            <small-body-text class="copyright">
                Copyright ©2024 SQL-TWO. All rights reserved.
            </small-body-text>
        </div>
    </footer>
</body>

</html>