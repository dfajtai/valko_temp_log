function init_hour_plot(container_name) {
    var ctx = document.getElementById(container_name).getContext("2d");
    const config = {
        type: "line", // Use line chart
        data: { datasets: [] },
        options: {
            animations: { colors: false },
            scales: {
                x: {
                    type: "time",
                    position: "bottom",
                    time: {
                        parser: 'HH:mm:ss',
                        minUnit: "minute",
                        // stepSize: 1,
                        displayFormats: {
                            minute: "HH:mm",
                        },
                    },
                    suggestedMin: "00:00:00",
                    suggestedMax: "23:59:00",
                    title: {
                        display: true,
                        text: 'Time'
                    }
                },
                y: {
                    display: true,
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
    return myChart;

}

function update_hour_plot(hour_plot) {
    get_new_data(function (all_data) {
        // console.log(all_data);
        var measures = ["humidity", "temperature"];
        var locations = ["Diag", "Fektet", "PET", "Onko"];
        all_data.sort((a, b) => moment(a.timestamp) - moment(b.timestamp));

        var dataset = [];
        var min_time = all_data[0].timestamp;
        var max_time = all_data[all_data.length - 1].timestamp;


        for (let measure_index = 0; measure_index < measures.length; measure_index++) {
            const measure = measures[measure_index];
            for (let loc_index = 0; loc_index < locations.length; loc_index++) {
                const location = locations[loc_index];
                var data = [];

                $.each(all_data, function (idx, _data) {
                    if (_data.measure == measure && _data.location.includes(location)) {
                        data.push({ x: moment(_data.timestamp), y: parseFloat(_data.value) });
                    }
                })


                var _dataset = {
                    label: `${location} - ${measure}`,
                    borderDash: measure == "temperature" ? [0] : [5],
                    borderColor: myColors[loc_index],
                    backgroundColor: myColors[loc_index],
                    pointHoverRadius: 3,
                    pointBorderWidth: 1,
                    borderWidth: 1,
                    pointRadius: 2,
                    data: data
                }
                dataset.push(_dataset);
            }

        }

        // remove old data
        hour_plot.data.labels.pop();
        hour_plot.data.datasets.forEach((dataset) => {
            dataset.data.pop();
        });

        // add new data
        hour_plot.data.datasets = dataset;

        hour_plot.options.scales.x.suggestedMin = moment(min_time);
        hour_plot.options.scales.x.suggestedMax = moment(max_time);
        // myChart.update('none');
        hour_plot.update();
        // console.log(myChart.data.datasets);


    })
}


function init_week_plot(container_name) {
    var ctx = document.getElementById(container_name).getContext("2d");
    const config = {
        type: "line", // Use line chart
        data: { datasets: [] },
        options: {
            animations: { colors: false },
            scales: {
                x: {
                    type: "time",
                    position: "bottom",
                    time: {
                        parser: 'MM.DD HH',
                        minUnit: "hour",
                        stepSize: 3,
                        displayFormats: {
                            hour: "MM.DD HH:mm",
                        },
                    },
                    title: {
                        display: true,
                        text: 'Time'
                    }
                },
                y: {
                    display: true,
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
    return myChart;
}

function update_week_plot(week_plot) {
    get_weekly_data(function (all_data) {
        // console.log(all_data);
        var measures = ["humidity", "temperature"];
        var locations = ["Diag", "Fektet", "PET", "Onko"];

        var dataset = [];
        var N = 0;

        var min_time = null;
        var max_time = null;

        for (let measure_index = 0; measure_index < measures.length; measure_index++) {
            const measure = measures[measure_index];
            for (let loc_index = 0; loc_index < locations.length; loc_index++) {
                const location = locations[loc_index];

                var data = [];

                $.each(all_data, function (idx, _data) {
                    if (_data.measure == measure && _data.location.includes(location)) {
                        let timestamp = moment(_data.date, "YYYY-MM-DD").add(parseInt(_data.hour), "hours");
                        if(min_time==null) min_time = timestamp;
                        if(max_time==null) max_time = timestamp;

                        min_time = timestamp<min_time ? timestamp : min_time;
                        max_time = timestamp>max_time ? timestamp : max_time;


                        data.push({ x: moment(timestamp), y: parseFloat(_data.mean) });
                    }
                })

                data = data.sort((a, b) => a.x - b.x);

                var _dataset = {
                    label: `${location} - ${measure}`,
                    borderDash: measure == "temperature" ? [0] : [5],
                    borderColor: myColors[loc_index],
                    backgroundColor: myColors[loc_index],
                    pointHoverRadius: 3,
                    pointBorderWidth: 1,
                    borderWidth: 1,
                    pointRadius: 2,
                    data: data
                }
                dataset.push(_dataset);

            }

        }

        // remove old data
        week_plot.data.labels.pop();
        week_plot.data.datasets.forEach((dataset) => {
            dataset.data.pop();
        });

        // add new data
        week_plot.data.datasets = dataset;

        week_plot.options.scales.x.suggestedMin = moment(min_time);
        week_plot.options.scales.x.suggestedMax = moment(max_time);
        // myChart.update('none');
        week_plot.update();
        // console.log(myChart.data.datasets);



    })
}