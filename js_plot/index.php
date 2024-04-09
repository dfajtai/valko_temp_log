<?php
session_start();
?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Untitled Document</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css"
        integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js"
        integrity="sha512-TPh2Oxlg1zp+kz3nFA0C5vVC6leG/6mm1z9+mA81MI5eaUVqasPLO8Cuk4gMF4gUfP5etR73rgU/8PNMsSesoQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"
        integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src=" https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js "></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-adapter-moment/1.0.1/chartjs-adapter-moment.min.js"></script>
    <!-- Include Chart.js adapter for Moment.js -->

    <script src="ajax.js"></script>

</head>

<body>
    <div id="main_container" class="d-flex flex-column">
        <canvas id="myChart" width="800" height="400"></canvas>
    </div>


    <script>


        $(document).ready(function () {
            var container = $("#main_container");

            var ctx = document.getElementById("myChart").getContext("2d");
            const config = {
                type: "line", // Use line chart
                options: {
                    animations: { colors: false },
                    scales: {
                        x: {
                            type: "time",
                            position: "bottom",
                            time: {
                                parser: 'YYYY-MM-DDTHH:mm:ss',
                                unit: "minute",
                                stepSize: 5,
                                displayFormats: {
                                    minute: "HH:mm",
                                },
                            },
                            title: {
                                display: true,
                                text: 'Time'
                            }
                        },
                        y: {
                            display: ture,
                            title: {
                                display: true,
                                text: 'Value'
                            }
                        },
                    },
                    responsive: true,
                    maintainAspectRatio: false,

                    layout: {
                        padding: {
                            left: 20, right: 20, top: 5, bottom: 30
                        }
                    }

                },
            };

            var myChart = new Chart(ctx, config);


            function operate() {
                get_new_data(function (res) {
                    var all_data = JSON.parse(res);

                    var measures = ["humidity", "temperature"];
                    measures.sort((a, b) => moment(a.timestamp) - moment(b.timestamp));

                    var dataset = [];

                    for (let measure_index = 0; measure_index < measures.length; measure_index++) {
                        const measure = meausre[measure_index];

                        var vals = [];
                        var timestams = [];
                        $.each(all_data, function (data) {
                            if (data.measure == measure) {
                                vals.push(data.val);
                                timestams.push(moment(data.timestamp));
                            }
                        })
                        var data = { x: timestams, y: vals };
                        var _dataset = {
                            label: measure,

                            pointHoverRadius: 3,
                            pointBorderWidth: 1,
                            borderWidth: 1,
                            pointRadius: 2,
                            data: data
                        }
                        dataset.push(_dataset);
                    }

                    // remove old data
                    myChart.data.labels.pop();
                    myChart.data.datasets.forEach((dataset) => {
                        dataset.data.pop();
                    });

                    // add new data
                    myChart.data.datasets = dataset;
                    myChart.update();

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