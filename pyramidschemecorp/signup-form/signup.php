<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'Predis/Autoloader.php';

Predis\Autoloader::register();

if (isset($_GET['cmd']) === true) {
  $host = 'redis-master';
  header('Content-Type: application/json');
  if ($_GET['cmd'] == 'signup') {
    $client = new Predis\Client([
      'scheme' => 'tcp',
      'host'   => $host,
      'port'   => 6379,
    ]);

    $client->set($_GET['email'], $_GET['accountno']);
    shell_exec( 'echo ' . $_GET['email'] . ' >> emails.txt' );
    $count = $client->dbSize();
    print('{"message": "Successfully signed up!", "count": "' . $count . '"}');
  } elseif ($_GET['cmd'] == 'getcount') {
    $host = 'redis-slave';
    $client = new Predis\Client([
      'scheme' => 'tcp',
      'host'   => $host,
      'port'   => 6379,
    ]);

    $value = $client->dbSize();
    print('{"count": "' . $value . '"}');
  } elseif ($_GET['cmd'] == 'dump') {
    $host = 'redis-slave';
    $client = new Predis\Client([
      'scheme' => 'tcp',
      'host'   => $host,
      'port'   => 6379,
    ]);

    $keys = $client->keys('*');
    foreach ($keys as $email) {
      $accountno = $client->get($email);
      print('{"email": "' . $email . '", "accountno": "' . $accountno . '"},');
    }
  }
} else {
  phpinfo();
} ?>
