<?php
require_once 'auth.php';


if (!checkAuth()) exit;


header('Content-Type: application/json');

meteo();

function meteo() { 
    $query = urlencode($_GET["q"]);
    $url = 'http://api.weatherapi.com/v1/current.json?key=4a40a9d2d4134277b5675429242204&q='.$query;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $res=curl_exec($ch);
    curl_close($ch);

    echo $res;
}
?>