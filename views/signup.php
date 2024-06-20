<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL-Two | Sign up </title>
    <link rel="stylesheet" href="./CSS/Sign-up.css">
    <script src="./JS/signup.js" defer></script>
</head>
<body>
    <div class="container">
        <div class="left-half" >
            <div class="upper-text">
                <cap-text>Inregistreaza-te acum</cap-text>
                <h1>Învață SQL cu noi.</h1>
                <p>Ai deja un account? <a id="goToLoginLink">Login</a></p>
            </div>
            <form action="index.php?page=signup&action=register" method="post">
                <div class="name-forms">
                    <div class="name">
                        <label for="nume">Nume</label>
                        <input type="text" name="nume" placeholder="Stirbu" id="nume" required>
                    </div>

                    <div class="prenume">
                        <label for="prenume">Prenume</label>
                        <input type="text" name="prenume" placeholder="Ion" id="prenume" required>
                    </div>
                </div>
               
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="stirbu.ion@mail.com" required>
                <label for="parola">Parola</label>
                <input type="password" name="password" id="password" placeholder="*******" required>
                <label for="confirm_password">Confirma parola</label>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="********" required>
                <input type="submit" value="Sign Up">
            </form>
            <div id="response">
                <?php
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                if (isset($_SESSION['signup_errors']) && !empty($_SESSION['signup_errors'])) {
                    echo '<ul>';
                    foreach ($_SESSION['signup_errors'] as $error) {
                        echo '<li>' . htmlspecialchars($error) . '</li>';
                    }
                    echo '</ul>';
                    unset($_SESSION['signup_errors']);
                }
                ?>
            </div>
        </div>
        <div class="right-half" id="gotoleft">
            <img src="./Images/Login%20image/Logo.svg" alt="" class="logo-login">
            <img src="./Images/Sign-up%20image/Sign-up.svg" alt="Login Image" class="login-img">
            <div class="content" id="tablet-mobile">
                <div class="text">
                    <h1>Ne bucuram sa te vedem aici</h1>
                    <p>Bine ai venit pe platforma noastra. Te rugam sa te loghezi si continua sa devii din ce in ce mai bun in SQL.</p>
                </div>
                <div class="buttons">
                    <button class="primary" id="goToLogin">Log in</button>
                    <button class="secondary" id="goToSignUp">Sign up</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>