
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
        <div class="left-half">
            <div class="upper-text">
                <cap-text>Inregistreaza-te acum</cap-text>
                <h1>Învață SQL cu noi.</h1>
                <p>Ai deja un account? <a id="goToLoginLink">Login</a></p>
            </div>
            <form action="index.php?page=signup&action=register" method="post">
                <div class="name-forms">
                    <div class="name">
                        <label>Nume</label>
                        <input type="text" name="nume" placeholder="Stirbu" required>
                    </div>

                    <div class="prenume">
                        <label>Prenume</label>
                        <input type="text" name="prenume" placeholder="Ion" required>
                    </div>
                </div>
               
                <label>Email</label>
                <input type="email" name="email" placeholder="stirbu.ion@mail.com" required>
                <label>Parola</label>
                <input type="password" name="password" placeholder="*******" required>
                <label>Confirma parola</label>
                <input type="password" name="confirm_password" placeholder="********" required>
                <input type="submit" value="Sign Up">
            </form>
            <div id="response">
                <?php
                if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
                    echo '<ul>';
                    foreach ($_SESSION['errors'] as $error) {
                        echo '<li>' . htmlspecialchars($error) . '</li>';
                    }
                    echo '</ul>';
                    unset($_SESSION['errors']);
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