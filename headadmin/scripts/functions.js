
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

function sweetAlertParam(type, title, text, confirmbtnText, cancelbtnText, content1, content2, location){
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

function cropImage(width, height, type, url, path){

  //Profile Picture
  $uploadCrop = $('#upload-demo').croppie({
      viewport: {
          width: width,
          height: height,
          type: type
      },
      boundary: {
          width: 300,
          height: 300
      }
  });


  //Button (Displays the image)
  $('#upload').on('change', function () { 
    var reader = new FileReader();
      reader.onload = function (e) {
        $uploadCrop.croppie('bind', {
          url: e.target.result
        }).then(function(){
          console.log('jQuery bind complete');
        });
        
      }
      reader.readAsDataURL(this.files[0]);
  });


  $('.change_profile_btn').on('click', function (ev) {

    $uploadCrop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function (resp) {


      $.ajax({
        url: url,
        type: "POST",
        data: {"image":resp},
        success: function (data) {

          window.location.href=path;

        }
      });

    });
    
  });
  //Profile Picture END

}

function trigger(){

  sweetAlertParam('warning', 'Do you want to Log Out?', 'This cannot be undone', 'Yes ', 'No', 'Log Out Successfully', ' ', '../includes/logout.php');
  
}

function deleting(location){

  sweetAlertParam('question', 'Do you want to delete?', 'This cannot be undone', 'Yes ', 'No', 'Successfully Removed', ' ', location);
  
}

function limitText(limitField, limitCount, limitNum){

  if(limitField.value.length > limitNum){

    limitField.value = limitField.value.substring(0, limitNum);
  }

  else{
    limitCount.value = limitNum - limitField.value.length;
  }
}

