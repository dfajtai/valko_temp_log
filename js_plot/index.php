<?php
session_start();
?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Untitled Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />

    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.30.1/moment.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-color/2.1.2/jquery.color.min.js"></script>


    <script src=" https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js "></script>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-adapter-moment/1.0.1/chartjs-adapter-moment.min.js"></script> <!-- Include Chart.js adapter for Moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"></script>


    <!-- Include Chart.js adapter for Moment.js -->

    <script src="ajax.js"></script>
    <script src="plot_functions.js"></script>
</head>

<body>
    <div id="main_container" class="d-flex flex-column">
        <div class="h1" style="display: flex;
  flex-direction: column;
  justify-content: center;
  text-align: center;">Last week</div>
        <div><canvas id="week_plot" style="height:400px"></canvas></div>
        
    </div>
    <div id="main_container" class="d-flex flex-column">
        <div class="h1" style="display: flex;
  flex-direction: column;
  justify-content: center;
  text-align: center;">Last hour</div>
        <div><canvas id="hour_plot" style="height:400px"></canvas></div>
        
    </div>


    <script>
        function generateDistinctColors(count, saturation= 0.80, lightness = 0.65, alpha = 1) {
                var colors = [];
                for (var i = 0; i < count; i++) {
                    var color = $.Color({ hue: i * (360 / count), saturation: saturation, lightness: lightness});
                    colors.push(color.alpha(alpha));
                }
                return colors;
            }

        var myColors = generateDistinctColors(4);

        $(document).ready(function () {
            var container = $("#main_container");
            var hour_plot = init_hour_plot("hour_plot");
            var week_plot = init_week_plot("week_plot");
            

            function operate() {
                update_hour_plot(hour_plot);
                update_week_plot(week_plot);
            }
            operate();
            setInterval(() => {
                operate();
            }, 60000);

        })

    </script>

</body>

</html>