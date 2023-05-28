
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

function sweetAlertParam(type, title, text, confirmbtnText, cancelbtnText, content1, content2, content3, location1, location2){
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false,
    })

    swalWithBootstrapButtons.fire({
      title: title,
      text: text,
      type: type,
      showCancelButton: true,
      confirmButtonText: confirmbtnText, 
      cancelButtonText: cancelbtnText,
      reverseButtons: false
    }).then((result) => {
      if (result.value) {
        swalWithBootstrapButtons.fire(
          content1,
          content2,
          'success'
        ).then(function(){
            window.location.href=location1;
        })
      } else if (
        // Read more about handling dismissals
        result.dismiss === Swal.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Cancelled',
          content3,
          'error'
        ).then(function(){
            window.location.href=location2;
        })
      }
    })
}

function sweetAlertParam2(type, title, text, confirmbtnText, cancelbtnText, content1, content2, location){
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success' ,
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false,
    })

    swalWithBootstrapButtons.fire({
      title: title,
      text: text,
      type: type,
      showCancelButton: true,
      confirmButtonText: confirmbtnText, 
      cancelButtonText: cancelbtnText,
      reverseButtons: false
    }).then((result) => {
      if (result.value) {
        swalWithBootstrapButtons.fire(
          content1,
          content2,
          'success'
        ).then(function(){
            window.location.href=location;
        })
      } 


      // else if (
      //   // Read more about handling dismissals
      //   result.dismiss === Swal.DismissReason.cancel
      // ) {
      //   swalWithBootstrapButtons.fire(
      //     'Cancelled',
      //     content3,
      //     'error'
      //   ).then(function(){
      //       window.location.href=location2;
      //   })
      // }
    })
}

function sweetAlertSide(type, title){

  const Toast = Swal.mixin({
    toast: true,
    position: 'bottom-end',
    showConfirmButton: false,
    timer: 3000
  });

  Toast.fire({
    type: type,
    title: title
  })

}

function trigger(){

  sweetAlertParam2('warning', 'Do you want to Log Out?', 'This cannot be undone', 'Yes ', 'No', 'Log Out Successfully', ' ', '../includes/logout.php');
  
}

function deleting(location){

  sweetAlertParam2('question', 'Do you want to delete?', 'This cannot be undone', 'Yes ', 'No', 'Successfully Removed', ' ', location);
  
}

function voidFunc(location){

  sweetAlertParam2('question', 'Do you want to cancel the transaction?', 'This cannot be undone', 'Yes ', 'No', 'Session was closed', ' ', location);
  
}

function limitText(limitField, limitCount, limitNum){

  if(limitField.value.length > limitNum){

    limitField.value = limitField.value.substring(0, limitNum);
  }

  else{
    limitCount.value = limitNum - limitField.value.length;
  }
}