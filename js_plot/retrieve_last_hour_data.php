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

$query_string = "SELECT DATE(timestamp) as 'date', HOUR(timestamp) as 'hour', measure as 'measure', location as 'location', AVG(value) as 'mean', MIN(value) as 'min', MAX(value) as 'max' FROM ".$table_name." WHERE timestamp > SUBTIME(NOW(),'168:00:00') GROUP BY measure, location, DATE(timestamp), HOUR(timestamp)";
$res = $database -> query($query_string)->fetchAll();

unset($_GET["num_of_points"]);
echo json_encode($res);