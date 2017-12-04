<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'Predis/Autoloader.php';

Predis\Autoloader::register();
print('{"message": "Error: Invalid Credentials"}');
 ?>
