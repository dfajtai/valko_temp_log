function get_data(callback){
    $.ajax({
        type: "GET",
        url: 'retrieve_data.php',
        dataType: "json",
        success: function (result) {
            if(typeof callback == "function"){
                callback(result);
            }
        }});
}