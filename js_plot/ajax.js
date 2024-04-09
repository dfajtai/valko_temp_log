function get_new_data(callback){
    $.ajax({
        type: "GET",
        url: 'retrieve_last_data.php',
        dataType: "json",

        success: function (result) {
            if(typeof callback == "function"){
                callback(result);
            }
        }});
}

function get_weekly_data(callback){
    $.ajax({
        type: "GET",
        url: 'retrieve_last_hour_data.php',
        dataType: "json",

        success: function (result) {
            if(typeof callback == "function"){
                callback(result);
            }
        }});
}