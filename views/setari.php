<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> SQL-Two | Setari </title>
    <link rel="stylesheet" href="./CSS/setari.css">
    <script defer src="./JS/setari.js"></script>
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
                        <div class="menu-link active" id="gotosetari">
                            <img src="./Images/Icons-white/fi-rr-settings.svg" alt="" class="icon-menu">
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
        <div class="column main-content-setari">
            <!-- <h1>Aici trebuie sa fie setarile</h1> -->
            <div class="settings-page-content-options">
                <div class="settins-option-item">
                    <h2 class="h3-as-h2">Setari</h2>
                </div>
                <div class="setting-item-functions">
                    <h4>Setarile profilului</h4>
                    <div class="setting-preferences">
                        <div class="settings-item-function-container">
                            <div class="setting-option-line">
                                <div class="setting-item">Schimba parola</div>
                                <a class="button-change-language" id="changePassBtn">Schimba</a>
                            </div>
                            <div class="reset-password-container" style="display: none;">
                                <div class="setting-option-line input-forms-password">
                                    <form class="password-input-reset">
                                        <label for="current-password">Parola curenta</label>
                                        <input type="password" id="curr-password" name="password">
                                    </form>
                                    <form class="password-input-reset">
                                        <label for="new-password">Parola noua</label>
                                        <input type="password" id="new-password" name="password">
                                    </form>
                                </div>
                                <div class="setting-option-line">
                                    <div class="reset-password-line-link">Nu iti amintesti parola? 
                                        <a class="link-to-reset-page" >Resteaza parola</a>
                                    </div>
                                </div>
                                <div class="setting-option-line">
                                    <a class="button-change-password">Salveaza parola</a>
                                </div>
                            </div>
                            <div class="setting-option-line">
                                <div  class="setting-item">Sterge profilul</div>
                                <a id = "deleteBtn" class="button-delete-account" > Sterge</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="setting-item-functions">
                    <h4>Setarile limbii</h4>
                    <div class="setting-preferences">
                        <div class="settings-item-function-container">
                            <div class="setting-option-line">
                                <div>Afiseaza limba</div>
                                <a class="button-change-language" >Schimba limba</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    <div class="glass-effect-div" id="glassDelete" style="display: none;">

        <div class="popup-add" id="deletePopup">
            <img class="image-popup" src="./Images/Profile images/ohno.svg" alt="Sad">
            <div class="text-wrapper">
                <h2>Ai decis sa ne parasesti?!</h2>
                <p>Esti sigur ca vrei sa ti stergi contul? Ne pare rau sa-ti spunem ca progresul tau va fi sters de tot.</p>
            </div>
            <div class="buttons-wrapper">
                <a class="btn btn-secondary" id="cancel">Cancel</a>
                <a class="btn btn-primary" id="confirm">Confirm</a>
            </div>
        </div>
    </div>
</body>

</html>