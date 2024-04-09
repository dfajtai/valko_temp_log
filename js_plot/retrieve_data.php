<?php

use Medoo\Medoo;
session_start();

$table_name = "temp_plot";

if($_GET["num_of_points"]){

    $N = $_POST['num_of_points'];
    if(is_null($database)) {
        require_once 'db_connect.php';
        global $database;
    }


    $res = $database -> select($table_name, '*', ['LIMIT'=>2*$N,'ORDER'=>['id'=>'DESC']]);

    unset($_GET["num_of_points"]);
    echo json_encode($res);
}