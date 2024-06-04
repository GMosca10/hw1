<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }
?>

<html>
    <?php 
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        $userid = mysqli_real_escape_string($conn, $userid);
        $query = "SELECT * FROM users WHERE id = $userid";
        $res_1 = mysqli_query($conn, $query);
        $userinfo = mysqli_fetch_assoc($res_1);   
    ?>
    <head>
        <link rel="icon" type="image/jpg" href="Img/Favicon.jpg">
        <link rel="stylesheet" href="meteo.css">
        <title>Hilton-Meteo</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="meteo.js" defer></script>
        <meta charset="UTF-8">
    </head>
    <body>
    <section>
        <div class="title">Hilton-Meteo<div>
        <img class="meteo" src = "Img/meteo.png">
        <div class="meteo-search">
                <form id="form-meteo">
                    <input type="text" id="city" placeholder="Inserisci la città desiderata">
                    <input type="submit" id="submit" value="Cerca">
                </form>
        </div>
        <div id="weather-info"></div>

        <div class="back-container">
        <a href="home.php"><div class="back-button">Torna alla home</div></a>
        </div>
    </section>
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