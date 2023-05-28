<?php session_start(); ?>
<?php include "../includes/db.php"; ?>
<?php include "includes/functions.php"; ?>
<?php include "includes/session.php"; ?>

<!DOCTYPE html>

<html lang = "en">

  <head>

    <meta charset = "utf-8">

    <meta name = "viewport" content = "width=device-width, initial-scale=1">



    <link rel = "stylesheet" type="text/css" href = "../assets/bootstrap/3.3.6/css/bootstrap.min.css">

    <link rel = "stylesheet" type="text/css" href = "../assets/font/css/all.min.css">

    <link rel = "stylesheet" type="text/css" href="../assets/datatables/datatables.min.css"/>

    <link rel = "stylesheet" type="text/css" href="../assets/sweetalert2/sweetalert2.min.css">



    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

    <!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

    <!-- <link rel = "stylesheet"  type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/> -->

    <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->



    <link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

    <title>Euphony | Students</title>

  </head>

  <body>

    <?php 

      if(isset($_POST['stud_status'])){

        $stud_status = escape($_POST['stud_status']);

        if($stud_status == "All"){
          echo "<script>location.href='students.php';</script>";
        }
        else{
          echo "<script>location.href='students.php?status=$stud_status';</script>";
        }

      }

    ?>

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
              <center><h3 class="cap">Student List</h3></center>
            </div>

            <div class="col-sm-4"></div>

          </div>

        </div>
      
        <div class="panel-body">
          
          <div class = "Table">

            <div class="container-fluid">

              <div class="row">

              <form method="POST">
                <div class="col-sm-4">  
                  <select class="form-control input-sm" name="stud_status">
                    <option value="All">Filter Here</option>
                    <option value="Official">Official</option>
                    <option value="Pending">Pending</option>
                    <option value="Declined">Declined</option>
                  </select>
                </div>

                <div class="col-sm-4">
                  <button class="btn btn-primary" id="send">Apply</button>
                </div>
              </form>

                <div class="col-sm-4">
                  <div class="text-right">
                    <a href="add_new_student.php" title="Add" class="btn btn-success btn-sm">Add</a>
                  </div><br>
                </div>

              </div>

              <div class="table-responsive">

                <table class = "table table-bordered table-hover" id="standardAsc">

                  <thead class="cap">

                    <tr>
                      <th>No</th>
                      <th>Last</th>
                      <th>First</th>
                      <th>Middle</th>
                      <th>Sex</th>
                      <th>Address</th>
                      <th>Contact No.</th>
                      <th>Lesson</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>

                  </thead>

                  <tbody>
                    
                    <?php 

                        if(isset($_GET['status'])){

                          $the_status = escape($_GET['status']);

                          $query = "SELECT U.User_Id, U.Last_name, U.First_name, ";
                          $query .= "U.Middle_name, U.Address, U.Contact_no, ";
                          $query .= "U.Sex, SS.Status FROM user_info_tbl as U, ";
                          $query .= "stud_status_tbl as SS WHERE ";
                          $query .= "SS.User_Id = U.User_Id AND ";
                          $query .= "SS.Status = '{$the_status}' AND ";
                          $query .= "U.Branch_Id = '{$branch_id}' AND ";
                          $query .= "U.Status = 1 ORDER BY SS.User_Id DESC ";
                        }

                        else if(!isset($_GET['status'])){

                          $query = "SELECT U.User_Id, U.Last_name, U.First_name, U.Middle_name, U.Address, ";
                          $query .= "U.Contact_no, U.Sex, SS.Status ";
                          $query .= "FROM user_info_tbl as U, ";
                          $query .= "stud_status_tbl as SS WHERE U.User_Id = ";
                          $query .= "SS.User_Id AND U.Status = 1 AND ";
                          $query .= "U.Branch_Id = '{$branch_id}' ORDER BY SS.User_Id DESC";

                        }

                        $query_all_students = mysqli_query($con, $query);

                        confirmQuery($query_all_students);

                        $n = 1;

                        while($row = mysqli_fetch_array($query_all_students)){

                          $user_id      = escape($row['User_Id']);
                          $last_name    = escape($row["Last_name"]);
                          $first_name   = escape($row["First_name"]);
                          $middle_name  = escape($row["Middle_name"]);
                          $sex          = escape($row["Sex"]);
                          $address      = escape($row["Address"]);
                          $mobile_no    = escape($row["Contact_no"]);
                          $status       = escape($row["Status"]);

                          echo "<tr>";
                          echo "<td>".$n++."</td>";
                          echo "<td>$last_name</td>";
                          echo "<td>$first_name</td>";
                          echo "<td>$middle_name</td>";
                          echo "<td>$sex</td>";
                          echo "<td><p class='ellip'>$address</p></td>";
                          echo "<td>$mobile_no</td>";

                          $query2 = "SELECT lessons_tbl.Lesson_desc FROM ";
                          $query2 .="selected_class_tbl LEFT JOIN lessons_tbl ";
                          $query2 .="ON selected_class_tbl.Lesson_Id = ";
                          $query2 .="lessons_tbl.Lesson_Id WHERE selected_class_tbl.";
                          $query2 .="User_Id = '$user_id' ";

                          $query_lesson = mysqli_query($con, $query2);

                          confirmQuery($query_lesson);

                          $row = mysqli_fetch_assoc($query_lesson);

                          $count = mysqli_num_rows($query_lesson);

                          if($count > 0){

                            $lesson = escape($row['Lesson_desc']); 

                            echo "<td>$lesson</td>";

                          }

                          else{

                            echo "<td><center>-----</center></td>";
                            
                          }

                          if($status == 'Official'){
                              echo "<td><p class = 'label label-success'>$status</p></td>";
                          }

                          else if($status == 'Pending'){
                              echo "<td><p class = 'label label-info'>$status</p></td>";
                          }

                          else if($status == 'Declined'){
                              echo "<td><p class = 'label label-danger'>$status</p></td>";
                          }
                          
                          echo "<td>";
                          echo "<a href='edit_student.php?userid=$user_id' title= 'Edit' class='btn btn-primary btn-sm'>View</a> ";

                          ?>

                          <a href="#" title="Delete" class="btn btn-danger btn-sm" onclick="deleting('delete_action.php?studid=<?php echo $user_id; ?>');">Delete</a>

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

    <script type = "text/javascript" src = "../assets/datatables/datatables.min.js"></script> 

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