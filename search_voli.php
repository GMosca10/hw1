<?php
require_once 'auth.php';


if (!checkAuth())

exit;


voli();

function voli() {
    $client_id = "NM0iPjGIbPiEibIVfhH2mX0koAOwRLoK";
    $client_secret = "GMZpw8qZpA35Or6U";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://test.api.amadeus.com/v1/security/oauth2/token' );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials'); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Basic '.base64_encode($client_id.':'.$client_secret))); 
    $token=json_decode(curl_exec($ch), true);
    curl_close($ch);
    $orig = urlencode($_GET["originLocationCode"]);
    $dest = urlencode($_GET["destinationLocationCode"]);
    $depDate = urlencode($_GET["departureDate"]);
    $adults = urlencode($_GET["adults"]);
    $url = 'https://test.api.amadeus.com/v2/shopping/flight-offers?originLocationCode='.$orig.'&destinationLocationCode='.$dest.'&departureDate='.$depDate.'&adults='.$adults.'&max=10';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$token['access_token'])); 
    $res=curl_exec($ch);
    curl_close($ch);
    echo $res;  
}

?>