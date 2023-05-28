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



		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

  		<title>Euphony | Receipt</title>

  	</head>

  	<body>

    	<?php 

    		if(isset($_GET['transid'])){

    			$trans_id = escape($_GET['transid']);

    			$query = "SELECT * FROM stud_balances WHERE Transaction_Id = '$trans_id' ";
    			$query_transaction = mysqli_query($con, $query);

    			confirmQuery($query_transaction);

    			while($row = mysqli_fetch_assoc($query_transaction)){

    				$stud_Id		= escape($row['User_Id']);
    				$trans_date 	= escape($row['Date']);
    				$OR_no			= escape($row['OR_no']);
    				$AR_no			= escape($row['AR_no']);
    				$balance 		= escape($row['The_balance']);
    				$cash 			= escape($row['Cash_tendered']);
    				$change 		= escape($row['The_change']);
    				$discount 		= escape($row['Discount']);
    				$total_balance 	= escape($row['Total_balance']);
    			}
    		}

    		// if(isset($_GET['finish'])){

    		// 	echo "<script>sweetAlert('success', 'Transaction Finished', 'Successfully Recorded', 'start_POS.php');</script>";

    		// 	$_SESSION['salesid'] = null;

    		// }
    	?>

    	<div class="container">

    		<?php include "includes/admin_navigation.php"; ?>

    		<div class="margin"></div>

    		<div class="panel panel-default">

    			<div class="panel-header">
    				<center><h3 class="cap">Finalize Transaction</h3></center>
    			</div>

    			<div class="panel-body">

    				<div class="row">

	    				<div class="col-sm-6">

		    				<div class="table-responsive">
		    					
		    					<table class="table">
		    						<thead class="cap">
		    							<th colspan="2">Information</th>
		    						</thead>
		    						<tbody>
		    							<tr>
		    								<td><strong>Balance: </strong></td>
		    								<td>&nbsp<?php echo number_format($balance,2); ?> php</td>
		    							</tr>
		    							<tr>
		    								<td><strong>Total Discount: </strong></td>
		    								<td>&nbsp<?php echo number_format($discount,2); ?> php</td>
		    							</tr>
		    							<tr>
		    								<td><strong>Cash: </strong></td>
		    								<td>&nbsp<?php echo number_format($cash,2); ?> php</td>
		    							</tr>
		    							<tr>
		    								<td><strong>Change: </strong></td>
		    								<td>&nbsp<?php echo number_format($change,2); ?> php</td>
		    							</tr>
		    							<tr>
		    								<td><strong>Total Balance: </strong></td>
		    								<td>&nbsp<?php echo number_format($total_balance,2); ?> php</td>
		    							</tr>
		    						</tbody>
		    					</table>

		    				</div>

		    			</div>

		    			<div class="col-sm-6">

		    				<div class="table-responsive">
		    					
		    					<table class="table">
		    						<thead class="cap">
		    							<th colspan="2">Receipt</th>
		    						</thead>
		    						<tbody>
		    							<tr>
		    								<td><strong>Official Receipt: </strong></td>
		    								<td><a href="SB_receipt_or.php?transid=<?php echo $trans_id; ?>" target="_blank" class="btn btn-primary" id="print">Print</a></td>
		    							</tr>
		    							<tr>
		    								<td><strong>Acknowledgment Receipt: </strong></td>
		    								<td><a href="SB_receipt_ar.php?transid=<?php echo $trans_id; ?>" target="_blank" class="btn btn-primary" id="print">Print</a></td>
		    							</tr>
		    						</tbody>
		    					</table>

		    				</div>

		    			</div>

	    			</div>

	    			<!-- <div class="row">
	    				<div class="well">
	    					<div class="row">
	    						<div class="col-sm-12">
		    						<h3>Steps</h3>
		    					</div>
	    						<div class="col-sm-4">
	    							<h4><b>1</b> Check the Information</h4>
	    						</div>
	    						<div class="col-sm-4">
	    							<h4><b>2</b> Print Official Receipt and Acknowledgement Receipt</h4>
	    						</div>
	    						<div class="col-sm-4">
	    							<h4><b>3</b> Finish the transaction</h4>
	    						</div>
	    					</div>
	    				</div>
	    			</div> -->

    			</div>

    			<div class="panel-footer">
    				<div class="text-right">
    					<a href="#" class = "btn btn-primary btn-lg">Edit</a>
    					<a href='edit_student.php?userid=<?php echo $stud_Id;?>' class = "btn btn-success btn-lg">Finish</a>
    				</div>
    			</div>

    		</div>

    	</div>

    	<script src = "../assets/jquery/1.12.0/jquery.min.js"></script>

    	<script src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>


    	
		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<script src = "../assets/jquery/hotkeys/jquery.hotkeys.js"></script>

		<script src = "scripts/shortcut_keys.js"></script>

   	</body>

</html>