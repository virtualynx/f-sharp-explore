const ajaxErrorHandler = (jqXHR, errorThrown, textStatus) => {
    alert('status: '+jqXHR.status+', '+textStatus);
    console.log(jqXHR.responseText);
};