<?php

require '../vendor/autoload.php';
require '../config.php';
require './csv/csv.php';

use GuzzleHttp\Client;
$client = new GuzzleHttp\Client();
$csv = new Csv();

// Verifica se recebe: export=true
$export = filter_var( !empty($argv[1]) ? ( explode("=", $argv[1])[0] == "export" ) ? explode("=", $argv[1])[1] : false : false , FILTER_VALIDATE_BOOLEAN);

// Open file
$data = json_decode(file_get_contents( PATH.'/'.PATH_PROJECT.'/'.FILE ));
$epSum = 1;

// Start Process
echo PHP_EOL . "Start Process: " . PHP_EOL . PHP_EOL;
echo "Arquivo: " . FILE . PHP_EOL;
echo "Projeto: " . $data->info->name . PHP_EOL.PHP_EOL;

echo "Pastas: " . PHP_EOL;

$list = [ [ "Method", "Status", "Endpoint", "Message" ] ];

foreach( $data->item as $item ){

    echo PHP_EOL . $item->name . PHP_EOL;
    foreach( $item->item as $endpoint ){

            $url = (string) explode( "?", explode ( "}}" , $endpoint->request->url->raw )[1])[0];
            $method = $endpoint->request->method;
            
            try {
                $response = $client->request( $method , HOST.$url, [ 'headers' => HEADER ] );
                $status = $response->getStatusCode();
                $msg = "";
            } catch (Exception $e) {
                $getMessage = (string) explode ("response:\n", $e->getMessage())[1];
                $msg = " - Response: " . trim($getMessage); 
                $status =  $e->getCode();
            }

            echo "  " . $epSum. ". [" . $method ."] - ". $status ." - ". $url . $msg . PHP_EOL;

            if($export){
                $listItem = [ $method, $status, $url, trim($getMessage) ];
                array_push($list, $listItem);
            }

            $epSum++;
            $method = "";
            $status = "";
            $msg = "";

    }
}

if($export) $csv->export($list);

echo PHP_EOL."Finished Process.".PHP_EOL.PHP_EOL;