<?php session_start(); ?>
<?php include "includes/db.php"; ?>
<?php include "includes/functions.php"; ?>
<?php include "includes/sessions.php"; ?>

<!DOCTYPE html>

<html lang = "en">

  <head>

    <meta charset = "utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">



    <link rel = "stylesheet" href = "assets/bootstrap/3.3.6/css/bootstrap.min.css">

    <link rel = "stylesheet" href = "assets/animate/animate.min.css">

    <link rel = "stylesheet" href = "assets/font/css/all.min.css">

    <link rel = "stylesheet" href = "assets/slick/slick.css">

    <link rel = "stylesheet" href = "assets/slick/slick-theme.css">



    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

    <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css"> -->

    <!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

    <!--  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css"> -->

    <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css"> -->



    <link rel = "stylesheet" href = "assets/owl/owl.carousel.min.css">

    <link rel = "stylesheet" href = "assets/owl/owl.theme.default.min.css">

    <link rel = "stylesheet" href = "includes/style.css">

    <title>Euphony Music Center & Studio</title>

    <!-- Developer: Richard Altre -->

  </head>



  <!---Body--->
	<body id="myPage" data-target=".navbar" data-offset="60">

    <?php include "includes/navigation.php"; ?>

    <div class="container-fluid jumbotron text-center">

      <div class="row" id="center-pos">

        <div class="col-sm-12 animated fadeIn">

          <center>
            <img src="images/default/Euphony_Logo_3.png" class="img-responsive company_logo">
          </center>

        </div>

        <div class= "col-md-12 animated fadeIn delay-1s">

            <h1 class="cap" style="color:grey">Euphony Music Center & Studio</h1>

            <br><button class="btn_2" onclick = "location.href ='login.php';">Log In</button>
            <button class="btn_1" onclick = "location.href ='registration_branch.php';">Register</button>

        </div>

      </div>

    </div>



    <!-- About Us -->
    <section class = "container" id ="AboutUs"><br><br>

      <center><h3 id="h3" class="cap">About Us</h3></center>

      <div class="row">

        <div class="col-md-6">

          <div class="wow slideInLeft">

            <?php

              $query = "SELECT * FROM about_us_tbl WHERE Id = 1";
              $query_image = mysqli_query($con, $query);

              while($row = mysqli_fetch_assoc($query_image)){

                $content  = $row['Content'];
                $image    = escape($row['Image']);

                echo "<center>";
                echo "<a href='images/about/$image'>";
                echo "<img src = 'images/about/$image' class = 'img-responsive' id='aboutus_img'><br>";
                echo "</a>";
                echo "</center>";
              }

            ?>

          </div>

        </div>

        <div class="col-md-6">

          <div class="wow slideInRight">

            <div class="single-item">

              <div class="container">

                <?php

                  if(isset($content)){
                    echo "<p style='white-space: pre-wrap;'>$content</p>";
                  }

                ?>

              </div>

              <?php 

                $query = "SELECT * FROM about_us_tbl WHERE Image = ''";
                $query_contents = mysqli_query($con, $query);

                while($row = mysqli_fetch_assoc($query_contents)){

                  $title    = escape($row['Title']);
                  $content2 = escape($row['Content']);

                  echo "<div class='container'>";
                  echo "<h3>$title</h3>";
                  echo "<p style='white-space: pre-wrap;'>$content2</p>";
                  echo "</div>";
                }

              ?>

            </div>

          </div>

        </div>

      </div>

    </section>
    <!-- About Us END -->



    <!-- Services Offered -->
    <section class="container" id="Services"><br><br><br>

      <div class="text-center">
        <h3 id = "h3" class="cap">What we offer</h3>
        <button class = "btn_1" onclick="location.href = 'services_offered.php';"><span>View All</span></button>
      </div>

      <div class="owl-carousel">

        <?php 

          $query = "SELECT Lesson_Id, Lesson_desc, Amount, ";
          $query .="No_of_lesson, Cover_image FROM lessons_tbl ";
          $query .="WHERE Status = 1 LIMIT 4";

          $query_all_lessons = mysqli_query($con, $query);

          while($row = mysqli_fetch_assoc($query_all_lessons)){

            $lesson_Id      = $row['Lesson_Id'];
            $lesson_desc    = $row['Lesson_desc'];
            $lesson_amount  = $row['Amount'];
            $no_of_lesson   = $row['No_of_lesson'];
            $cover_image    = $row['Cover_image'];

            echo "<div class='panel panel-default'>";
            echo "<div class='panel-body'>";
            echo "<img src='images/lessons/Cover/$cover_image' alt='image'><br>";
            echo "<p><a href='lesson_info.php?lessonid=$lesson_Id' style='color:black'><b>$lesson_desc - $no_of_lesson Lessons</b></a></p>";
            echo "<p>Price - <span style='color: green'>".number_format($lesson_amount,2)." PHP</span></p>";
            echo "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i>";
            echo "</div>";
            echo "</div>";

          }

        ?>

      </div> 

    </section>
    <!-- Services Offered END-->



    <!-- Products -->
    <section class="container" id="Products"><br><br>

      <div class="text-center">

        <h3 id="h3" class="cap">Our Products</h3>

        <button class="btn_1" onclick="location.href='all_products.php';">
          <span>View All</span>
        </button>

      </div>

      <div class = "container wow zoomIn">
        
        <?php

          $query = "SELECT Prod_Id, Prod_name, Prod_price, Prod_image, ";
          $query .="Status FROM products_tbl WHERE randSalt3 = 1 ";
          $query .="ORDER BY Prod_Id ASC LIMIT 6";

          $result         = mysqli_query($con,$query);
          $count_records  = mysqli_num_rows($result);

          confirmQuery($result);

          if($count_records > 0){

            while($row = mysqli_fetch_array($result)){

              $prod_Id     = $row['Prod_Id'];
              $prod_name   = $row['Prod_name'];
              $prod_price  = number_format($row['Prod_price']);
              $prod_image  = $row['Prod_image'];
              $prod_status = $row['Status'];

              echo "<div class='col-sm-4'>";
              echo "<div class='panel panel-default text-center'>";
              echo "<div class='panel-body'>";
              echo "<center><img src='images/products/".$prod_image."' class = 'img-responsive' id='sampleSize'></center>";
              echo "<p>".$prod_price." PHP</p>";
              echo "</div>";
              echo "<div class='panel-footer'>";
              echo "<center><strong><a href='product_details.php?prodid=".$prod_Id."'><p class='ellip'>".$prod_name."</p></a></strong></center>";
              echo "<center><p><em>".$prod_status."</em></p><center>";
              echo "</div>";
              echo "</div>";
              echo "</div>";
            }

          }

          else{

            echo "<center><h3>No Records</h3></center>";
          }

        ?>

      </div>

    </section>
     <!--Products END-->



    <!-- Branches -->
    <section class="container" id="Branches"><br><br><br>

      <div class="text-center">

        <h3 id = "h3" class="cap">Branches</h3>

        <button class = "btn_1" onclick="location.href = 'gallery.php';">
          <span>Gallery</span>
        </button>

      </div><br>

      <div class="container slideanim">

        <?php

          $query = "SELECT Branch_Id, Branch_desc, Branch_location, ";
          $query .="Branch_image FROM branches_tbl WHERE randSalt3 = 1";

          $result = mysqli_query($con, $query);
          $count_records  = mysqli_num_rows($result);

          if($count_records > 0){

            while($row = mysqli_fetch_array($result)){

              $branchid     = escape($row["Branch_Id"]);
              $branchdesc   = escape($row["Branch_desc"]);
              $branchlocation = escape($row["Branch_location"]);
              $branch_image = escape($row["Branch_image"]);

              echo "<div class='text-center'>";
              echo "<div class='col-sm-4'>";
              echo "<div class='thumbnail'>";
              echo "<img src='images/branches/".$branch_image."' alt='image' class='img-responsive'>";
              echo "<br>";
              echo "<p class='ellip'><b>".$branchdesc."</b></p>";
              echo "<p class='ellip'>".$branchlocation."</p><br>";
              echo "</div>";
              echo "</div>";
              echo "</div>";

            }
          }

          else if($count_records == NULL){

            echo "<center><h3>No Records</h3></center>";
          }

        ?>

      </div>

    </section>
    <!-- Branches END-->



    <!-- Contact Us -->
    <section class="container-fluid" id ="ContactUs"><br><br><br>

      <center><h3 id="h3" class="cap">Contact Us</h3></center>

      <div class = "container-fluid wow fadeIn">

        <div>

          <?php

            $query = "SELECT Branch_desc, Branch_location, Phone_no, Email, ";
            $query .="Branch_image_2 FROM branches_tbl WHERE randSalt3 = 1";

            $result = mysqli_query($con, $query);
            $count_records  = mysqli_num_rows($result);

            if($count_records > 0){

              while($row = mysqli_fetch_array($result)){

                  $branch_desc     = escape($row["Branch_desc"]);
                  $branch_location = escape($row["Branch_location"]);
                  $contact_number  = escape($row['Phone_no']);
                  $contact_email   = escape($row['Email']);
                  $branch_image_2  = escape($row['Branch_image_2']); 

                  echo "<div class='col-sm-4'>";
                  echo "<div class='thumbnail' id='contact_box'>";
                  echo "<img src='images/contact/". $branch_image_2 ."'' class ='img-responsive' id = 'labelsize'>";
                  echo "<center><h4><b>".$branch_desc."</b></h4></center><br>";

                  echo "<div class='row'>";
                  echo "<div class='col-sm-2'>";
                  echo "<center><span id='contactlogo'>";
                  echo "<i class='fa fa-mobile-alt'></i></span></center>";
                  echo "</div>";
                  echo "<div class='col-sm-10'>";
                  echo "<p><b>Phone</b></p>";
                  echo "<p>".$contact_number."</p>";
                  echo "</div>";
                  echo "</div>";

                  echo "<div class='row'>";
                  echo "<div class='col-sm-2'>";
                  echo "<center><span id='contactlogo'>";
                  echo "<i class='fa fa-envelope'></i></span></center>";
                  echo "</div>";
                  echo "<div class='col-sm-10'>";
                  echo "<p><b>Email</b></p>";
                  echo "<p class='ellip'>".$contact_email."</p>";
                  echo "</div>";
                  echo "</div>";

                  echo "<div class='row'>";
                  echo "<div class='col-sm-2'>";
                  echo "<center><span id='contactlogo'>";
                  echo "<i class='fa fa-home'></i></span></center>";
                  echo "</div>";


                  echo "<div class='col-sm-10'>";
                  echo "<p><b>Address</b></p>";
                  echo "<p class='ellip'>".$branch_location."</p>";
                  echo "</div>";
                  echo "</div>";
                  echo "</div>";
                  echo "</div>"; 
              }
              
            }

            else if($count_records == NULL){

              echo "<center><h3>No Records</h3></center>";
            }

          ?>

        </div>

      </div>

    </section>
    <!-- Contact Us END-->

    <div class="container">

      <!-- Up Arrow -->
      <a class="up-arrow" href="#myPage">

          <i class="fa fa-angle-up" style = "font-size: 20px;"></i>

      </a>
      <!-- Up Arrow END-->

    </div>

    <script src = "assets/jquery/1.12.0/jquery.min.js"></script>

    <script src = "assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script src = "assets/js/wow.min.js"></script>

    <script src = "assets/owl/owl.carousel.min.js"></script>

    <script src = "assets/slick/slick.min.js"></script>



    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script> -->

    <!--  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script> -->

    <script src = "scripts/main.js"></script>

    
    <!-- Remove this when hosting -->
    <script src = "assets/js/plugins.js"></script>
    <script src = "assets/js/popover.js"></script>

	</body>
  <!---Body END--->

  <!---Include--->
  <?php include "includes/footer.php"; ?>
  <!---Include--->

</html>
