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
        <link rel="stylesheet" href="profile.css">
        <title>Profilo</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src='profile.js' defer></script>
        <meta charset="utf-8">
    </head>
    <body>
   <section>
        <h1 class="text">Benvenuto nel tuo profilo <?php echo $userinfo['username']; ?>!</h1>
        <div class="img-container"><img class="Img" src="Img/Profile.png"></div>
        <div class="text-dati">I tuoi dati</div>
        <div class="dati">Nome: <?php echo $userinfo['nome']; ?></div>
        <div class="dati">Cognome: <?php echo $userinfo['cognome']; ?></div>
        <div class="dati">Data di nascita: <?php echo $userinfo['data_nascita']; ?></div>
        <div class="dati">E-mail: <?php echo $userinfo['email']; ?></div>
        <div class="dati">Username: <?php echo $userinfo['username']; ?></div>

        <div class="text2">Queste sono le immagini che hai messo nei preferiti</div>
        <div id="results">
                
        </div>
        <div class="back-container">
        <a href="home.php"><div class="back-button">Torna alla home</div></a>
        </div>
        <div class="line"></div>
    </section>
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