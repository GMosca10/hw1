<?php
    require_once 'auth.php';

    if (checkAuth()) {
        header("Location: home.php");
        exit;
    }   

    if (!empty($_POST["nome"]) && !empty($_POST["cognome"]) && !empty($_POST["data_nascita"]) && !empty($_POST["email"]) && 
        !empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["confpass"]) && !empty($_POST["allow"]))
    {
        $error = array();
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

        if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $_POST['username'])) {
            $error[] = "Username non valido";
        } else {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $query = "SELECT username FROM users WHERE username = '$username'";
            $res = mysqli_query($conn, $query);
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Username già utilizzato";
            }
        }

        if (strlen($_POST["password"]) < 8) {
            $error[] = "La password deve contenere almeno 8 caratteri";
        } 

        if (strcmp($_POST["password"], $_POST["confpass"]) != 0) {
            $error[] = "Le password non coincidono";
        }

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error[] = "Email non valida";
        } else {
            $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
            $res = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Email già utilizzata";
            }
        }



        if (count($error) == 0) {
            $name = mysqli_real_escape_string($conn, $_POST['nome']);
            $surname = mysqli_real_escape_string($conn, $_POST['cognome']);
            $birthdate = mysqli_real_escape_string($conn, $_POST['data_nascita']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $password = password_hash($password, PASSWORD_BCRYPT);

            $query = "INSERT INTO users(nome, cognome, data_nascita, username, email, password) VALUES('$name', '$surname', '$birthdate', '$username', '$email', '$password')";
            
            if (mysqli_query($conn, $query)) {
                $_SESSION["_agora_username"] = $_POST["username"];
                $_SESSION["_agora_user_id"] = mysqli_insert_id($conn);
                mysqli_close($conn);
                header("Location: home.php");
                exit;
            } else {
                $error[] = "Errore di connessione al Database";
            }
        }

        mysqli_close($conn);
    }
    else if (isset($_POST["username"])) {
        $error = array("Riempi tutti i campi");
    }

?>

<html>
    <head>
        <link rel="icon" type="image/jpg" href="Img/Favicon.jpg">
        <link rel="stylesheet" href="signup.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src='signup.js' defer></script>
        <meta charset="utf-8">
        <title>Iscriviti ora!</title>
    </head>
    <body>
        <div class="logo">
            <img src="Img/Logo3.png">
        </div>
        <main>
            <section>
                <h2 class="accedi">Iscriviti!</h2>
                <form name="login" method="post">
                    <div class="nome">
                        <label for="nome">Nome</label>
                        <input class="input-u" type="text" name="nome" <?php if(isset($_POST["nome"])){echo "value=".$_POST["nome"];} ?>>
                        <div><span>Devi inserire il tuo nome</span></div>
                    </div>
                    <div class="cognome">
                        <label for="cognome">Cognome</label>
                        <input class="input-u" type="text" name="cognome" <?php if(isset($_POST["cognome"])){echo "value=".$_POST["cognome"];} ?>>
                        <div><span>Devi inserire il tuo cognome</span></div>
                    </div>
                    <div class="data_nascita">
                        <label for="data_nascita">Data di nascita</label>
                        <input class="input-u" type="date" name="data_nascita" <?php if(isset($_POST["data_nascita"])){echo "value=".$_POST["data_nascita"];} ?>>
                        <div><span>Devi inserire la tua data di nascita</span></div>
                    </div>
                    <div class="email">
                        <label for="email">E-mail</label>
                        <input class="input-u" type="text" name="email" <?php if(isset($_POST["email"])){echo "value=".$_POST["email"];} ?>>
                        <div><span>Indirizzo E-mail non valido</span></div>
                    </div>
                    <div class="username">
                        <label for="username">Username</label>
                        <input class="input-u" type="text" name="username" <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>>
                        <div><span>Username non disponibile</span></div>
                    </div>
                    <div class="password">
                        <label for="password">Password</label>
                        <input class="input-p" type="password" name="password" <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>>
                        <img class="visible" src="Img/Visible.png">
                        <div><span>Inserisci almeno 8 caratteri</span></div>
                    </div>
                    <div class="confpass">
                        <label for="confpass">Conferma Password</label>
                        <input class="input-cp" type="password" name="confpass" <?php if(isset($_POST["confpass"])){echo "value=".$_POST["confpass"];} ?>>
                        <img class="visible2" src="Img/Visible.png">
                        <div><span>Le password non coincidono</span></div>
                    </div>
                    <div class="allow"> 
                        <input type='checkbox' name='allow' value="1" <?php if(isset($_POST["allow"])){echo $_POST["allow"] ? "checked" : "";} ?>>
                        <label for='allow'>Accetto i termini e condizioni d'uso di Hilton.</label>
                    </div>
                    <div class="container">
                        <div>
                            <input type="submit" value="Iscriviti"  class="login-button" >
                        </div>
                    </div>
                </form>
                <div class="signup">Hai già un Account?</div>
                <div><a class="signup-button" href="login.php">Accedi!</a></div>
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