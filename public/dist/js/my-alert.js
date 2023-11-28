// depends on jquery.toast.js

function myAlert(message, type = 'info', position = 'top-right'){
    let toastObj = {
        icon: 'info',
        heading: 'Info',
        text: message,
        position: position,
        showHideTransition: 'fade',
        loaderBg: '#2aebf5',
        hideAfter: 5000
    };

    type = type.toLowerCase();

    if(type === 'info'){
        toastObj.bgColor = '#1cc3d9';
    }else if(type === 'error'){
        toastObj.heading = 'Opps! something wents wrong';
        toastObj.loaderBg = '#fa4416';
        toastObj.icon = 'error';
        toastObj.hideAfter = false;
    }else if(type === 'warning'){
        toastObj.heading = 'Warning';
        toastObj.loaderBg = '#fec107';
        toastObj.icon = 'warning';
        toastObj.hideAfter = 3500;
    }else if(type === 'success'){
        toastObj.heading = 'Success';
        toastObj.loaderBg = '#63f233';
        toastObj.icon = 'success';
        toastObj.hideAfter = 2000;
    }

    $.toast().reset('all');
    $.toast(toastObj);
}