 <?php

$db_host = "localhost";
$db_user = "templogger";
$db_pass = "Lakat33d.";
$db_name = "templogger";
$table_name = "temp_plot";

// Create connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$urls = [
    'http://10.10.1.200/ipthermo_sbc2/api/ipthermo/measured_datas/now.json',
    // 'http://10.10.1.201/ipthermo_sbc2/api/ipthermo/measured_datas/now.json',
    'http://10.10.1.202/ipthermo_sbc2/api/ipthermo/measured_datas/now.json',
    'http://10.10.1.203/ipthermo_sbc2/api/ipthermo/measured_datas/now.json'
    ];

for ($i=0; $i < count($urls); $i++) {
    $url = $urls[$i];
    // get data
    $json = file_get_contents($url);


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
        $sql = "INSERT INTO ".$table_name." (location, measure, value) VALUES ('".$location ."', '".$measure."', '".$value."')";

        // echo $sql;

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

}




?>
