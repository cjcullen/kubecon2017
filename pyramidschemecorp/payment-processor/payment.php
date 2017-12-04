<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'Predis/Autoloader.php';

Predis\Autoloader::register();

if (isset($_GET['cmd']) === true) {
  $host = 'redis-master';
  header('Content-Type: application/json');
  if ($_GET['cmd'] == 'makepayment') {
    if (isset($_GET['accountnumber']) === false || isset($_GET['amount']) === false) {
      print('{"message": "Error: accountnumber or amount not specified"}');
    } else {
      $acctno = $_GET['accountnumber'];
      $amount = $_GET['amount'];
      print('{"message": "Successfully made payment of $' . $amount . ' to account number ' . $acctno . '"}');
    }
  }
} else {
  print('{"message": "Error: \'cmd\' not specified. Known commands: \'canceltransaction\',\'makepayment\'"}');
} ?>
