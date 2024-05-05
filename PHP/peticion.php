<?php
require_once "vendor/autoload.php";
require_once "config.php";

use GuzzleHttp\Client;
 
$client = new Client([
    // Base URI is used with relative requests
    'base_uri' => 'https://www.alphavantage.co',
]);
 
$response = $client->request('GET', '/query', [
    'query' => [
        'function' => 'NEWS_SENTIMENT',
        'limit'=> '5',
        'apikey' => 'E8RXMBZHG8VK8TC4',
    ]
]);


$body = $response->getBody();
$arr_body = json_decode($body);
pr($arr_body);

function pr($arr){
    echo "<pre>";print_r($arr);echo"</pre>";
}

    // Escribir el JSON en un archivo separado
    $json_file = 'feed_data.json';
    file_put_contents($json_file, json_encode($arr_body, JSON_PRETTY_PRINT));

    // Mostrar un mensaje de éxito
    echo "JSON almacenado en '$json_file' correctamente.";
