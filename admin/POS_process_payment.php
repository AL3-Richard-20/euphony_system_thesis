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

  		<title>Euphony | Receipt</title>

  	</head>

  	<body>

    	<?php include "includes/admin_navigation.php"; ?>

    	<?php 

    		if(!isset($_SESSION['salesid'])){

                echo "<script>window.location.href='start_POS.php';</script>";
            }

    		if(isset($_GET['salesid'])){

    			$sales_id = escape($_GET['salesid']);

    			$query = "SELECT * FROM sales_tbl WHERE Sales_Id = '$sales_id' ";
    			$query_transaction = mysqli_query($con, $query);

    			confirmQuery($query_transaction);

    			while($row = mysqli_fetch_assoc($query_transaction)){

    				$trans_date 	= escape($row['Date']);
    				$customer 		= escape($row['Sold_to']);
    				$OR_no			= escape($row['OR_no']);
    				$AR_no			= escape($row['AR_no']);
    				$subtotal 		= escape($row['Subtotal']);
    				$total_discount	= escape($row['Total_discount']);
    				$total 			= escape($row['Total']);
    				$cash 			= escape($row['Cash']);
    				$change 		= escape($row['Cash_change']);
    			}
    		}

    		if(isset($_GET['finish'])){

    			// echo "<script>sweetAlert('success', 'Transaction Finished', 'Successfully Recorded', 'start_POS.php');</script>";

    			$_SESSION['salesid'] = null;

    			if($_SESSION['salesid'] == null){

    				echo "<script>window.location.href='start_POS.php';</script>";
    			}

    		}
    	?>

    	<div class="margin"></div>

    	<div class="container">

    		<div class="panel panel-default">

    			<div class="panel-header">
    				<center><h3 class="cap">Finalize Transaction</h3></center>
    			</div>

    			<div class="panel-body">

    				<div class="col-sm-6">

	    				<div class="table-responsive">
	    					
	    					<table class="table">

	    						<thead class="cap">
	    							<th colspan="2">Info</th>
	    						</thead>

	    						<tbody>
	    							<tr>
	    								<td><strong>Transaction Date: </strong></td>
	    								<td>&nbsp<?php echo date('F d, Y', strtotime($trans_date)); ?></td>
	    							</tr>
	    							<tr>
	    								<td><strong>Customer: </strong></td>
	    								<td>&nbsp<?php echo $customer; ?></td>
	    							</tr>
	    							<tr>
	    								<td><strong>Subtotal: </strong></td>
	    								<td>&nbspP<?php echo number_format($subtotal,2); ?></td>
	    							</tr>
	    							<tr>
	    								<td><strong>Total Discount: </strong></td>
	    								<td><?php echo $total_discount; ?> %</td>
	    							</tr>
	    							<tr>
	    								<td><strong>Total: </strong></td>
	    								<td>&nbspP<?php echo number_format($total,2); ?></td>
	    							</tr>
	    							<tr>
	    								<td><strong>Cash: </strong></td>
	    								<td>&nbspP<?php echo number_format($cash,2); ?></td>
	    							</tr>
	    							<tr>
	    								<td><strong>Change: </strong></td>
	    								<td>&nbspP<?php echo number_format($change,2); ?></td>
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
	    								<td><a href="receipt_or.php?salesid=<?php echo $sales_id; ?>" target="_blank" class="btn btn-primary" id="print">Print</a></td>
	    							</tr>
	    							<tr>
	    								<td><strong>Acknowledgment Receipt: </strong></td>
	    								<td><a href="receipt_ar.php?salesid=<?php echo $sales_id; ?>" target="_blank" class="btn btn-primary" id="print">Print</a></td>
	    							</tr>
	    						</tbody>
	    					</table>

	    				</div>

	    			</div>


	    			<div class="col-sm-12">

	    				<div class="table-responsive">
	    					
	    					<table class="table table-bordered">

	    						<thead class="cap">
	    							<th>No.</th>
	    							<th>Item/s</th>
	    							<th>Quantity</th>
	    							<th>Price</th>
	    						</thead>

	    						<tbody>
	    							
	    							<?php

	    								$query = "SELECT sales_detail.Prod_Id, sales_detail.Price, ";
				                        $query .="sales_detail.Quantity, products_tbl.Prod_name ";
				                        $query .="FROM sales_detail LEFT JOIN products_tbl ";
				                        $query .="ON sales_detail.Prod_Id = products_tbl.Prod_Id WHERE ";
				                        $query .="sales_detail.Sales_Id = '$sales_id' ";

					    				$query_orders = mysqli_query($con, $query);

	    								confirmQuery($query_orders);

	    								$n = 1;

	    								while($row = mysqli_fetch_assoc($query_orders)){

	    									$prod_id          = escape($row['Prod_Id']);
				                            $order_prod_name  = escape($row['Prod_name']);
				                            $order_price      = escape($row['Price']);
				                            $order_quantity   = escape($row['Quantity']);

				                            echo "<tr>";
				                            echo "<td>".$n++."</td>";
				                            echo "<td>$order_prod_name</td>";
				                            echo "<td>$order_quantity</td>";
				                            echo "<td>P".number_format($order_price,2)."</td>";
				                            echo "</tr>";

	    								}
	    							?>

	    						</tbody>
	    					</table>

	    				</div>

	    			</div>

    			</div>

    			<div class="panel-footer">
    				<div class="text-right">
    					<a href="POS.php" class="btn btn-primary btn-lg">Edit</a>
    					<a href='POS_process_payment.php?finish=1' class = "btn btn-success btn-lg">Finish</a>
    				</div>
    			</div>

    		</div>

    	</div>

    	<script src = "../assets/jquery/1.12.0/jquery.min.js"></script>

    	<script src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    	<script type = "text/javascript" src = "../assets/datatables/datatables.min.js"></script>


    	
    	<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

		<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->



		<script src = "../assets/jquery/hotkeys/jquery.hotkeys.js"></script>

		<script src = "scripts/shortcut_keys.js"></script>

   	</body>

</html>