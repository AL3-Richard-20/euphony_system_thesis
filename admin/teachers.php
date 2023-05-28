<?php session_start(); ?>
<?php include "../includes/db.php"; ?>
<?php include "includes/functions.php"; ?>
<?php include "includes/session.php"; ?>

<!DOCTYPE html>

<html lang = "en">

  <head>

    <meta charset = "utf-8">

    <meta name = "viewport" content = "width=device-width, initial-scale=1">

    <link rel = "stylesheet"  type="text/css" href="../assets/bootstrap/3.3.6/css/bootstrap.min.css">

    <link rel = "stylesheet"  type="text/css" href="../assets/font/css/all.min.css">

    <link rel = "stylesheet"  type="text/css" href="../assets/datatables/datatables.min.css"/>

    <link rel = "stylesheet"  type="text/css" href="../assets/sweetalert2/sweetalert2.min.css">



    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

    <!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

    <!-- <link rel = "stylesheet"  type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/> -->

    <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->



    <link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

    <title>Euphony | Teachers</title>

  </head>

  <body>

    <div class="container-fluid">    

      <?php include "includes/admin_navigation.php"; ?>

      <div class = "margin"></div>  

      <div class="panel panel-default">

        <div class="panel-header">

          <div class="row">

            <div class="col-sm-4">

                <button type="button" class="btn btn-default btn-lg" style="float: left" onclick="location.href='index.php'"><span class="fa fa-arrow-left"></span></button>

            </div>

            <div class="col-sm-4">
              <center><h3 class="cap">Teachers List</h3></center>
            </div>

            <div class="col-sm-4"></div>

          </div>

        </div>
        
        <div class="panel-body">
          
          <div class="table">

            <div class="container-fluid">

              <div class="text-right">
                <a onclick="location.href='add_teacher.php';" title="Add" class="btn btn-success btn-sm">Add</a>
              </div><br>                

              <div class="table-responsive">

                <table class="table table-bordered table-hover" id = "standardAsc">

                  <thead class="cap">

                    <tr>

                        <th>No</th>
                        <th>Last</th>
                        <th>First</th>
                        <th>Middle</th>
                        <th>Age</th>
                        <th>Sex</th>
                        <th>Birthdate</th>
                        <th>Address</th>
                        <th>Contact No.</th>
                        <th>Action</th>

                      </tr>
                      
                  </thead>

                  <tbody>

                    <?php 

                        $query = "SELECT T.T_Last_name, T.T_First_name, T.T_Middle_name, T.T_Sex, T.T_Birthdate, ";
                        $query .="T.T_Age, T.T_Address, T.T_Nationality, T.T_Contact_no, T.T_Profile_img, ";
                        $query .="TB.Teacher_Id FROM teacher_tbl as T, teacher_branch_tbl as TB WHERE ";
                        $query .=" T.Teacher_Id = TB.Teacher_Id AND TB.Branch_Id = '{$branch_id}' ";
                        $query .="AND T.Status = 1 ORDER BY T.Teacher_Id DESC";

                        $query_all_teachers = mysqli_query($con, $query);

                        confirmQuery($query_all_teachers);

                        $n = 1;

                        while($row = mysqli_fetch_array($query_all_teachers)){

                          $teacher_Id   = escape($row["Teacher_Id"]);
                          $last_name    = escape($row["T_Last_name"]);
                          $first_name   = escape($row["T_First_name"]);
                          $middle_name  = escape($row["T_Middle_name"]);
                          $age          = escape($row["T_Age"]);
                          $sex          = escape($row["T_Sex"]);
                          $birthdate    = escape($row["T_Birthdate"]);
                          $address      = escape($row["T_Address"]);
                          $contact_no   = escape($row["T_Contact_no"]);

                          echo "<tr>";
                          echo "<td>".$n++."</td>";
                          echo "<td>$last_name</td>";
                          echo "<td>$first_name</td>";
                          echo "<td>$middle_name</td>";
                          echo "<td>$age</td>";
                          echo "<td>$sex</td>";
                          echo "<td>".date('M d, Y', strtotime($birthdate))."</td>";
                          echo "<td>$address</td>";
                          echo "<td>$contact_no</td>";
                          echo "<td>";
                          echo "<a href='edit_teacher.php?teacherid=$teacher_Id' title= 'View' class='btn btn-primary btn-sm'>View</a> ";

                          ?>

                          <a href="#" title="Delete" class="btn btn-danger btn-sm" onclick="deleting('delete_action.php?teacherid=<?php echo $teacher_Id; ?>');">Delete</a>

                          <?php
                          
                          echo" </td>";
                          echo "</tr>";

                        }

                    ?>

                  </tbody>

                </table>

              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

    <script src = "../assets/jquery/1.12.0/jquery.min.js"></script>

    <script src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script src="../assets/datatables/datatables.min.js" type="text/javascript"></script>

    <script src = "../assets/sweetalert2/sweetalert2.min.js"></script>



    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

    <!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->

    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->



    <script src = "../assets/jquery/hotkeys/jquery.hotkeys.js"></script>

    <script src = "scripts/shortcut_keys.js"></script>

    <script src = "scripts/functions.js"></script>

    <script type="text/javascript">
      
      $('#standardAsc').DataTable({
        select: true,
        "order": [[ 0, "asc" ]]
      });

    </script>

  </body>

</html>