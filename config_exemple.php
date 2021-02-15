<?php
# CheckAPI
define('PATH', '../projects/');

# Projects Envoriments

# MyProject API - Exemple
define('PATH_PROJECT', 'MY_PROJECT');
define('FILE', "FILE.json");
define('HOST', "http://URL_API");
define('TOKEN', "__TOKEN__");
define('HEADER', [
  'Content-Type' => 'application/json',
  'x-req' => TOKEN
]);