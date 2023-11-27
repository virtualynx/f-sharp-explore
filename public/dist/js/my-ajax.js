//depends on my-alert.js

const myAjaxCompleteCallback = () => {
    $(".preloader-it").hide();
};

const myAjaxErrorHandler = (jqXHR, errorThrown, textStatus) => {
    // alert('status: '+jqXHR.status+', '+textStatus);
    myAlert('status: '+jqXHR.status+', '+textStatus, 'error');
    console.log(jqXHR.responseText);
};

/**
    $.ajax({
        type: "delete",
        data: {msisdn: msisdn},
        cache: false,
        url: "{{ route('api_tracked_number_delete') }}",
        dataType: "json",
        success: function (response, status) {
            if(status == 'success' && response.status == 0){
                alert('Hapus nomor berhasil');
            }
        },
        error: ajaxErrorHandler,
        complete: function(){
            $(".preloader-it").hide();
            table_tracked.draw();
        }
    });
 */

function request(ajaxObj, loadAnimation = true){
    if(!ajaxObj.dataType){
        ajaxObj.dataType = 'json';
    }
    if(!ajaxObj.error){
        ajaxObj.error = myAjaxErrorHandler;
    }
    if(!ajaxObj.complete){
        ajaxObj.complete = myAjaxCompleteCallback;
    }
    ajaxObj.cache = false;

    if(loadAnimation){
        $(".preloader-it").show();
    }

    $.ajax(ajaxObj);
}

function get(ajaxObj, loadAnimation = true){
    ajaxObj.type = 'get';
    request(ajaxObj, loadAnimation);
}

function post(ajaxObj, loadAnimation = true){
    ajaxObj.type = 'post';
    request(ajaxObj, loadAnimation);
}