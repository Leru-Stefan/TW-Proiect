<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL-Two | Login</title>
    <link rel="stylesheet" href="./CSS/Login.css">
    <script src="./JS/login.js"></script>

</head>
<body>
    <div class="container">
        <div class="left-half" id="gotoright">
            <img src="./Images/Login%20image/Logo.svg" alt="" class="logo-login">
            <img src="./Images/Login%20image/Login.svg" alt="Login Image" class="login-img">
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
        <div class="right-half">
            <div class="upper-text">
                <cap-text>
                    Incepe calatoria
                </cap-text>
                <h1>Bine ai revenit</h1>
                <p>Inca nu ai un account? <a id="goToSignUpLink">Sign up</a></p>
            </div>
            <form action="index.php?page=login&action=authenticate" method="post">
                <h5>Email</h5>
                <input type="text" name="username" placeholder="Username" required>
                <h5>Parola</h5>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" value="Login" id='goToProbleme'>
            </form>

            <div id="response">
                <?php
                if (isset($_SESSION['login_errors']) && !empty($_SESSION['login_errors'])) {
                    echo '<ul>';
                    foreach ($_SESSION['login_errors'] as $error) {
                        echo '<li>' . htmlspecialchars($error) . '</li>';
                    }
                    echo '</ul>';
                    unset($_SESSION['login_errors']);
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>