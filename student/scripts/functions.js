//Message Notif
function sweetAlert(type, title, text){
    Swal.fire({
      type: type,
      title: title,
      text: text
    });
    // success, error, warning, info, question
}

//Message Notif
function formAlert(type, title, text, location){
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

function sweetAlertSteps(){

  Swal.mixin({
    // input: 'text',
    showCancelButton: true,
    confirmButtonText: 'Next',
    progressSteps: ['1', '2', '3','4', '5', '6','7']
  }).queue([
    {
      imageUrl: '../images/student/1.png',
      imageWidth: 400,
      imageHeight: 200,
      imageAlt: 'Custom image',
      text:'You can customize your account by clicking this'
    },
    {
      imageUrl: '../images/student/2.png',
      imageWidth: 400,
      imageHeight: 200,
      imageAlt: 'Custom image',
      text:'You can also change your Profile Picture here'
    },
    {
      imageUrl: '../images/student/3.png',
      imageWidth: 400,
      imageHeight: 200,
      imageAlt: 'Custom image',
      text:'Here you will see your Payment Transactions'
    },
    {
      imageUrl: '../images/student/4.png',
      imageWidth: 400,
      imageHeight: 200,
      imageAlt: 'Custom image',
      text:'Here you will see your Lesson'
    },
    {
      imageUrl: '../images/student/5.png',
      imageWidth: 400,
      imageHeight: 200,
      imageAlt: 'Custom image',
      text:'Here you will see your Schedule'
    },
    {
      imageUrl: '../images/student/6.png',
      imageWidth: 400,
      imageHeight: 200,
      imageAlt: 'Custom image',
      text:'Here you will see your Attendance Record'
    },
    {
      imageUrl: '../images/student/7.png',
      imageWidth: 400,
      imageHeight: 200,
      imageAlt: 'Custom image',
      text:'and make sure to read Our Policy'
    }
  ]).then((result) => {
    if (result.value) {
      Swal.fire({
        type: 'success',
        title: 'All done!',
        confirmButtonText: 'Got It'
      })
    }
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