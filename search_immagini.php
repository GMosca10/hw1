<?php
require_once 'auth.php';


if (!checkAuth()) exit;


header('Content-Type: application/json');

immagini();

function immagini() { 
    $query = urlencode($_GET["q"]);
    $url = 'https://pixabay.com/api/?key=44175836-cf01c95edd66b659672669ca8&q='.$query;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $res=curl_exec($ch);
    curl_close($ch);

    echo $res;
}
?>