<?php 
$db_host = "localhost";
$db_user = "templogger";
$db_pass = "Lakat33d.";
$db_name = "templogger";


require_once(__DIR__.'/vendor/autoload.php');
use Medoo\Medoo;

try{
  $database = new Medoo([
    // required
    'database_type' => 'mysql',
    'database_name' => $db_name,
    'server' => $db_host,
    'username' => $db_user,
    'password' => $db_pass,
    // [optional]
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_general_ci',

    'logging' => true,

    'option' => [
      PDO::ATTR_CASE => PDO::CASE_NATURAL
    ],
    'command' => [
      'SET SQL_MODE=ANSI_QUOTES'
    ]
  ]);
  // echo "Connection succeed";
}catch(PDOException $e){
  echo "Connection failed : ". $e->getMessage();
}