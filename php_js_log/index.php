<?php 
    session_start();
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js" integrity="sha512-TPh2Oxlg1zp+kz3nFA0C5vVC6leG/6mm1z9+mA81MI5eaUVqasPLO8Cuk4gMF4gUfP5etR73rgU/8PNMsSesoQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="ajax.js"></script>

</head>

<body>
    <div id="main_container" class="d-flex flex-column">

    </div>

	
<script>
$(document).ready(function(){
    var container = $("#main_container");
    function operate(){
        get_new_data(function(data){
            var info = JSON.parse(data);
            // console.log(info);
            var _data = info.procontrol.data.measured_datas.sensors;
            var db_data = [];
            _data.forEach((d) => {
                db_data.push({measure:d.measure_type, location:d.name, value:d.value});
            });
            console.log(JSON.stringify(db_data));
            push_new_data(db_data,function(){
                console.log("data sent");
            });
        })
    }
    operate();
    setInterval(() => {
        operate();
    }, 60000);

})

</script>	

</body>
</html>