<?php

use Medoo\Medoo;
session_start();

$table_name = "temp_plot";

if($_POST["data"]){

    $data = $_POST['data'];
    if(is_null($database)) {
        require_once 'db_connect.php';
        global $database;
    }


    $res = $database -> insert($table_name, $data);

    unset($_POST['data']);
    echo json_encode($res);
}
