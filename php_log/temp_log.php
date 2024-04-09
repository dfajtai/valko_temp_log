 <?php

$db_host = "localhost";
$db_user = "templogger";
$db_pass = "Lakat33d.";
$db_name = "templogger";

// Create connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


// get data
$json = file_get_contents('http://10.10.1.200/ipthermo_sbc2/api/ipthermo/measured_datas/now.json');


$all_data = json_decode($json, true);
// echo json_encode($all_data);

//data parse 1
$data = $all_data["procontrol"]["data"]["measured_datas"]["sensors"];

for ($x = 0; $x < count($data); $x++) {

    // data parse 2
    $location = $data[$x]["name"];
    $measure = $data[$x]["measure_type"];
    $value = $data[$x]["value"];

    // post data
    $sql = "INSERT INTO temp_plot (location, measure, value) VALUES ('".$location ."', '".$measure."', '".$value."')";

    // echo $sql;

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}



?>
