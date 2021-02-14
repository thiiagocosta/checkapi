<?php

class Csv
{

    public function export( array $list ) : void 
    {
    
      try{
        if( !empty($list) ){
          $fp = fopen( PATH.'/'.PATH_PROJECT.'/'.date('YmdHis_').'result.csv', 'w');
          foreach ($list as $fields) {
              fputcsv($fp, $fields, $delimiter = ';');
          }
          fclose($fp);

          echo PHP_EOL.PHP_EOL."EXPORT";
          echo PHP_EOL."File: " .PATH_PROJECT.'/'.date('YmdHi_').'result.csv'.PHP_EOL.PHP_EOL;    
        }
      } catch (Exception $e) {
          echo '[error][Csv][export] Exception: ',  $e->getMessage(), PHP_EOL;
      }

    }
}