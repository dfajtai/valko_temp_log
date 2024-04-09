<?php
session_start();

// if(isset($_GET['table_name'])){ 
if(isset($_GET['data'])){
    $vals = file_get_contents( 'http://10.10.1.200/ipthermo_sbc2/api/ipthermo/measured_datas/now.json' );
    echo json_encode($vals);
}