function get_new_data(callback){
    $.ajax({
        type: "GET",
        url: 'retrieve_data.php',
        dataType: "json",
        data:({"data":null}),
        success: function (result) {
            if(typeof callback == "function"){
                callback(result);
            }
        }});
}

function push_new_data(data, callback = null ,return_ajax = false) {
    if(callback === null){
        callback = function(){};
    }
    var ajax = $.ajax({
        type: "POST",
        url: 'temp_push.php',
        // dataType: "json",
        data:({"data":data}),
        success: function(result){
            callback();
        }
    });
    if(return_ajax) return ajax;
    $.when(ajax);
}

