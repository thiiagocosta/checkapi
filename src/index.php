<?php

require '../vendor/autoload.php';
use GuzzleHttp\Client;

// Open file
$file = "SAS.json";
$host = "http://...";
$data = json_decode(file_get_contents( 'upload/' . $file ));
$epSum = 1;

$headers = [
    'Content-Type' => 'application/json',
    'x-req' => 'TOKEN'
];

$client = new GuzzleHttp\Client();

// Start Process
echo PHP_EOL . "Iniciando Processo: " . PHP_EOL . PHP_EOL;
echo "Arquivo: " . $file . PHP_EOL;
echo "Projeto: " . $data->info->name . PHP_EOL.PHP_EOL;

echo "Pastas: " . PHP_EOL;
foreach( $data->item as $item ){

    echo PHP_EOL . $item->name . PHP_EOL;

    foreach( $item->item as $endpoint ){

            $url = (string) explode( "?", explode ( "}}" , $endpoint->request->url->raw )[1])[0];
            $method = $endpoint->request->method;
            
            try {
                $response = $client->request( $method , $host.$url, [ 'headers' => $headers ] );
                $status = $response->getStatusCode();
                $msg = "";
            } catch (Exception $e) {
                $getMessage = (string) explode ("response:\n", $e->getMessage())[1];
                $msg = " - Response: " . trim($getMessage); 
                $status =  $e->getCode();
            }

            echo "  " . $epSum . ". [" . $method . "] - " . $url . " - Status: " . $status . $msg . PHP_EOL;
            $epSum++;
            $method = "";
            $status = "";
            $msg = "";

    }
}

echo PHP_EOL."Processo Finalizado.".PHP_EOL.PHP_EOL;