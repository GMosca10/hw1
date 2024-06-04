<?php
    include 'auth.php';
    if (checkAuth()) {
        header('Location: home.php');
        exit;
    }

    if (!empty($_POST["username"]) && !empty($_POST["password"]) )
    {

        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $query = "SELECT * FROM users WHERE username = '".$username."'";

        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));;
        
        if (mysqli_num_rows($res) > 0) {
            $entry = mysqli_fetch_assoc($res);
            if (password_verify($_POST['password'], $entry['password'])) {
                $_SESSION["_agora_username"] = $entry['username'];
                $_SESSION["_agora_user_id"] = $entry['id'];
                header("Location: home.php");
                mysqli_free_result($res);
                mysqli_close($conn);
                exit;
            }
        }
        $error = "Username e/o password errati.";
    }
    else if (isset($_POST["username"]) || isset($_POST["password"])) {
        $error = "Inserisci username e password.";
    }

?>

<html>
    <head>
        <link rel="icon" type="image/jpg" href="Img/Favicon.jpg">
        <link rel="stylesheet" href="login.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Accedi</title>
        <script src='login.js' defer></script>
    </head>
    <body>
        <div class="logo">
            <img src="Img/Logo3.png">
        </div>
        <main>
            <section>
                <h2 class="accedi">Accedi a Hilton!</h2>
                <?php
                if (isset($error)) {
                    echo "<div class='error'>$error</div>";
                }
                
            ?>
                <form name="login" method="post">
                    <div class="username">
                        <label for="username">Username</label>
                        <input class="input-u" type="text" name="username" <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>>
                    </div>
                    <div class="password">
                        <label for="password">Password</label>
                        <input class="input-p" type="password" name="password" <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>>
                        <span class="icon-cont"><img class="visible" src="Img/Visible.png"></span>
                    </div>
                    <div class="container">
                        <div>
                            <input class="login-button" type="submit" value="Accedi">
                        </div>
                    </div>
                </form>
                <div class="signup">Non hai un Account?</div>
                <div><a class="signup-button" href="signup.php">Registrati subito!</a></div>
            </section>
        </main>
        <div class="line"></div>
        <footer>
            <span class="footer-box1">
                <div class="footer-txt">Come possiamo aiutarti?</div>
                <div class="contact">
                    <div class="number" data-info="Visibile">+1-800-HILTONS</div>
                    <div class="txt-contact">Chiamaci: la telefonata è gratuita</div>
                </div>
                <div class="footer-icon">
                    <img class="social" src="Img/Facebook.png">
                    <img class="social" src="Img/Twitter.png">
                    <img class="social" src="Img/Instagram.png">
                </div>
            </span>
            <span class="footer-box-link">
            <span class="footer-box2">
                <ul>
                    <li>Media</li>
                    <li>Sviluppo</li>
                    <li>Opportunità di carriera</li>
                    <li>Mappa del sito</li>
                    <li>Informativa globale sulla privacy</li>
                    <li>Ispirazione di viaggio</li>
                    <li>I nostri marchi</li>
                    <li>Assistenza clienti</li>
                </ul>
            </span>
            <span class="footer-box3">
                <ul>
                    <li>Accessibilità web</li>
                    <li>Linea diretta Hilton</li>
                    <li>Responsabilità aziendali</li>
                    <li>Consulta i Termini e condizioni di Hilton Honors</li>
                    <li>Schiavitù moderna e traffico di esseri umani</li>
                    <li>Non vendere o condividere le mie informazioni</li>
                    <li>Termini di utilizzo del sito</li>
                    <li>Cookie Preferenze</li>
                </ul>
            </span>
        </span>
        </footer>
        <div class="mark">©2024 Hilton</div>
    </body>
</html>