<?php session_start(); ?>
<?php include "../includes/db.php"; ?>
<?php include "includes/functions.php"; ?>
<?php include "includes/session.php"; ?>

<!DOCTYPE html>

<html lang = "en">

  	<head>

        <meta charset = "utf-8">

        <meta name = "viewport" content = "width=device-width, initial-scale=1">



        <link rel = "stylesheet"  type="text/css" href = "../assets/bootstrap/3.3.6/css/bootstrap.min.css">

        <link rel = "stylesheet"  type="text/css" href = "../assets/font/css/all.min.css">

        <link rel = "stylesheet" type="text/css" href = "../assets/sweetalert2/sweetalert2.min.css">

        <script src = "../assets/sweetalert2/sweetalert2.min.js"></script>



        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

        <!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

        <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->

        <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->



        <script src = "scripts/functions.js"></script>

        <link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

    	<title>Euphony | POS</title>

  	</head>

  	<body>

    	<?php include "includes/admin_navigation.php"; ?>

    	<?php

            if(isset($_SESSION['salesid'])){

                echo "<script>window.location.href='POS.php';</script>";
            }

    		if(isset($_POST['firstname'])){

                $cust_firstname    = $_POST['firstname'];
                $cust_middlename   = escape($_POST['middlename']);
                $cust_lastname     = escape($_POST['lastname']);

                $customer_name     = "" .$cust_firstname. " " .$cust_middlename. " " .$cust_lastname. "";

    			$query = "INSERT INTO sales_tbl (Branch_Id, Date, Sold_to) ";
    			$query .="VALUES ('$branch_id', curdate(), '$customer_name') ";

    			$query_start_transc = mysqli_query($con, $query);

    			$last_id = mysqli_insert_id($con);

    			$_SESSION['salesid'] = $last_id;

    			confirmQuery($query_start_transc);

    			if($query_start_transc == 1){

    				echo "<script>sweetAlert('success', 'Transaction Started', 'You can start now', 'POS.php');</script>";
    			}
    		}
    	?>

    	<div class="margin"></div>

    	<div class="container">
    		
    		<div class="col-sm-2"></div>

    		<div class="col-sm-8">

    			<form method = "POST" novalidate>

		    		<div class="panel panel-default">

		    			<div class="panel-body">

                            <div class="row">
                                <div class="col-sm-2">
                                    <center><img src="../images/default/POS2.png" style="height:70px"></center>
                                </div>
                                <div class="col-sm-10">
                                    <h3 class="cap">Point of Sales</h3>
                                </div>
                            </div><br>

                            <p>Customer Fullname</p><br>

                            <div class="row">

                                <div class="col-sm-4">
                                    <div class="item"> 
                                        <p>Last Name</p> 
                                        <input type="text" name="lastname" class="form-control" placeholder="Dela Cruz" required="required">
                                    </div>
                                </div>

                                <div class="col-sm-4">
        		    				<div class="item">	
                                        <p>First Name</p>
        		    					<input type="text" name="firstname" class="form-control" placeholder="Juan" required="required">
        		    				</div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="item">
                                        <p>Middle Initial</p>  
                                        <input type="text" name="middlename" class="form-control" placeholder="M." required="required">
                                    </div>
                                </div>

                            </div>

                            <div class="text-right">
                                <button type = "submit" class = "btn btn-success" id="send">Start Transaction</button>
                            </div>

		    			</div>

		    		</div>

	    		</form>

	    	</div>

    		<div class="col-sm-2"></div>

    	</div>

        <script src = "../assets/jquery/1.12.0/jquery.min.js"></script>

        <script src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>



        <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

        <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->



        <script src = "../assets/validator/validator.js"></script>

        <script src = "../assets/validator/validate.js"></script>

        <script src = "../assets/jquery/hotkeys/jquery.hotkeys.js"></script>

        <script src = "scripts/shortcut_keys.js"></script>

	</body>

</html>