<?php

use Medoo\Medoo;
session_start();

$table_name = "temp_plot";
if(!isset($database)){
    require_once 'db_connect.php';
    global $database;
}

if(is_null($database)) {
    require_once 'db_connect.php';
    global $database;
}


$query_string = "SELECT * FROM ".$table_name." WHERE timestamp > SUBTIME(NOW(),'01:00:00')";
$res = $database -> query($query_string)->fetchAll();



echo json_encode($res);