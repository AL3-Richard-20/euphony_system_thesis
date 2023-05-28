
<?php 

  if(isset($_SESSION['user_role'])){

    if($_SESSION['user_role'] == 'Administrator'){

      header("location: admin/index.php");
    }
    else if($_SESSION['user_role'] == 'Head Administrator'){

      header("location: headadmin/index.php");
    }
    else if($_SESSION['user_role'] == 'Student'){

      header("location: student/index.php");
    }
  }

?>