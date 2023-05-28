
//Message Notif
function loginAlert(type, title, text){
    Swal.fire({
      type: type,
      title: title,
      text: text
    });
    // success, error, warning, info, question
}

//Message Notif
function sweetAlert(type, title, text, location){
    Swal.fire({
      type: type,
      title: title,
      text: text
    }).then(function(){
        window.location.href=location;
    });
    // success, error, warning, info, question
}