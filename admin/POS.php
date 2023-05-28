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

    <link rel = "stylesheet"  type="text/css" href="../assets/datatables/datatables.min.css"/>

    <link rel = "stylesheet"  type="text/css" href="../assets/sweetalert2/sweetalert2.min.css">

    <script src = "../assets/sweetalert2/sweetalert2.min.js"></script>



    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

    <!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

    <!--  <link rel = "stylesheet"  type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/> -->

    <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css"> -->

    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script> -->



    <script src = "scripts/functions.js"></script>

    <link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

    <title>Euphony | POS (Active)</title>

    <style type="text/css">

      #posinput{
        width: 70px;
      }
      #void{
        background-color: #f200e4;
        border: 1px solid violet;
      }
      .panel:hover {
          box-shadow: none;
      }

    </style>

  </head>

  <body>

    <?php include "includes/admin_navigation.php"; ?>

    <?php

      //===================== Transaction ID ===================== 
      if(!$_SESSION['salesid']){

        echo "<script>window.location.href='start_POS.php';</script>";
      }

      else{

        $session_sales_id = $_SESSION['salesid'];
      }
      //===================== Transaction ID END ===================== 



      
      //===================== Adding an Item to Cart ===================== 
      if(isset($_POST['prodid'])){

        //Inputs
        $the_prod_id      = $_POST['prodid'];
        $the_quantity     = $_POST['quantity'];
        $the_prod_price   = $_POST['prodprice'];
        //Inputs END

        if(!empty($the_quantity)){

          //Query the actual stock
          $query_stock = "SELECT Quantity FROM prod_invt_tbl WHERE Prod_Id = '$the_prod_id' ";
          $query_stock_now = mysqli_query($con, $query_stock);

          confirmQuery($query_stock_now);

          $row = mysqli_fetch_assoc($query_stock_now);

          $prod_stock = escape($row['Quantity']);
          //Query the actual stock END


          //If the input is greater than the actual stock
          if($the_quantity > $prod_stock){

            echo "<script>sweetAlert('error', 'Cannot be done', 'Quantity must be lower than the stock available', 'POS.php');</script>";
          }

          //If NOT
          else{

            //query if product exist on the table
            $query = "SELECT * FROM ";
            $query .="sales_detail WHERE Sales_Id = '$session_sales_id' AND ";
            $query .="Prod_Id = '$the_prod_id' ";

            $if_prod_exist = mysqli_query($con, $query);

            confirmQuery($if_prod_exist);

            $row2 = mysqli_fetch_assoc($if_prod_exist);

            $actual_prod_quantity = escape($row2['Quantity']);

            $count_records = mysqli_num_rows($if_prod_exist);

            if($count_records > 0){

              $formula1         = $actual_prod_quantity + $the_quantity;
              $total_prod_price = $the_prod_price * $formula1;

              $query_update = "UPDATE sales_detail SET Quantity = '$formula1', ";
              $query_update .="Price = '$total_prod_price' ";
              $query_update .="WHERE Sales_Id = '$session_sales_id' AND ";
              $query_update .="Prod_Id = '$the_prod_id' ";

              $query_to_cart = mysqli_query($con, $query_update);

              confirmQuery($query_to_cart);
            }

            else{

              $total_prod_price2 = $the_prod_price * $the_quantity;

              $query1 = "INSERT INTO sales_detail (Sales_Id, Prod_Id, Price, Quantity) ";
              $query1 .="VALUES ('$session_sales_id', '$the_prod_id', '$total_prod_price2', '$the_quantity')";

              $query_to_cart = mysqli_query($con, $query1);

              confirmQuery($query_to_cart);

            }

            //Check if product exist on the table

            //Minus to actual stock
            $formula = $prod_stock - $the_quantity;

            $query2 = "UPDATE prod_invt_tbl SET Quantity = '$formula' ";
            $query2 .="WHERE Prod_Id = '$the_prod_id'";

            $minus_to_stock = mysqli_query($con, $query2);

            confirmQuery($minus_to_stock);

          }

        }

        else{

          echo "<script>sweetAlert('error', '".$the_quantity."', 'Quantity must be lower than the stock available', 'POS.php');</script>";

        }

      }
      //===================== Adding an Item to Cart END ===================== 






      //===================== Editing The Quantity ===================== 
      if(isset($_POST['edited_quantity'])){

        $the_prod_Id  = $_POST['prod_Id'];                       
        $the_sales_Id = $_POST['sales_Id'];                      

        $old_quantity = $_POST['old_quantity'];                  
        $new_quantity = $_POST['edited_quantity'];               



        // Query the actual stock
        $query = "SELECT Quantity FROM prod_invt_tbl WHERE Prod_Id = '$the_prod_Id' ";
        $query_actual_stock = mysqli_query($con, $query);

        confirmQuery($query_actual_stock);

        while($row = mysqli_fetch_assoc($query_actual_stock)){
            $actual_stock = $row['Quantity'];
        }
        // Query the actual stock END


        // If the order quantity is greater than the actual stock
        $the_current_stock = $actual_stock + $old_quantity;

        if($new_quantity > $the_current_stock){

          echo "<script>sweetAlert('error', 'Cannot be done', 'Order quantity must be lower than the stock', 'POS.php');</script>";

        }

        else{

          if($old_quantity > $new_quantity){

            $formula2        = $old_quantity - $new_quantity;  //Remainder
            $update_stock    = $actual_stock + $formula2;
          }

          else if($new_quantity > $old_quantity){

            $formula2       = $new_quantity - $old_quantity;
            $update_stock   = $actual_stock - $formula2;
          }

          $query2 = "UPDATE prod_invt_tbl SET Quantity = '$update_stock' WHERE Prod_Id = '$the_prod_Id' ";
          $query_add_stock = mysqli_query($con, $query2);

          confirmQuery($query_add_stock);

          if($query_add_stock == 1){

            $query3 = "UPDATE sales_detail SET Quantity = '$new_quantity' WHERE Sales_Id = '$the_sales_Id' ";
            $query3 .="AND Prod_Id = '$the_prod_Id'";
            $query_update = mysqli_query($con, $query3);

            confirmQuery($query_update);

            if($query_update == 1){

              echo "<script>sweetAlert('success', 'Successfully Updated', 'You changed the order quantity', 'POS.php');</script>";
              
            }
            
          }

        }
      }
      //===================== Editing The Quantity END ===================== 


      
      //===================== Payment ===================== 
      if(isset($_POST['cash'])){

        $or_no          = escape($_POST['OR_no']);
        $ar_no          = escape($_POST['AR_no']);
        $order_subtotal = escape($_POST['subtotal']);
        $cash_tendered  = escape($_POST['cash']);
        $order_discount = escape($_POST['discount']);
        $order_change   = escape($_POST['change']);
        $order_total    = escape($_POST['final_total']);
        $payment        = escape($_POST['payment']);
        $customer       = escape($_POST['customer']);

        if($order_total > $cash_tendered){

          echo "<script>sweetAlert('error', 'Cannot be done', 'The cash is not enough', 'POS.php');</script>";
        }

        else{

          $query = "UPDATE sales_tbl SET OR_no = '$or_no', AR_no = '$ar_no', ";
          $query .="Subtotal = '$order_subtotal', Total_discount = '$order_discount', ";
          $query .="Total = '$order_total',  Cash = '$cash_tendered', Payment = '$payment', ";
          $query .="Cash_change = '$order_change', randSalt4 = 1, Cashier='$firstname', ";
          $query .="Sold_to = '$customer' ";
          $query .="WHERE Sales_Id = '$session_sales_id' ";

          $query_update_transac = mysqli_query($con, $query);

          confirmQuery($query_update_transac);

          if($query_update_transac == 1){

            echo "<script>sweetAlert('success', 'Payment Success', 'You can now finalize the transaction', 'POS_process_payment.php?salesid=$session_sales_id');</script>";
          }
        }
      }
      //===================== Payment END ===================== 

    ?>

    <div class="margin"></div>

      <div class="container-fluid">
          
          <input type="hidden" id="voidsess" value="<?php echo $session_sales_id; ?>">

          <div class="col-sm-8">
            
              <div class="panel panel-default">
                
                <div class="panel-header"> 
                  <h3 class="cap"> &nbspProduct List</h3>
                </div>

                <div class="panel-body">

                  <table class = "table table-responsive table-bordered table-hover" id= "pos">

                    <thead class="cap">
                      <th>#</th>
                      <th>Item</th>
                      <th>Image</th>
                      <th>Price</th>
                      <th>Stocks</th>
                      <th>Qty <kbd>q</kbd></th>
                      <th>Action</th>
                    </thead>

                    <tbody>
                      
                      <?php

                          $query_products = POSproductList($branch_id);

                          confirmQuery($query_products);

                          $n = 1;

                          while($row = mysqli_fetch_assoc($query_products)){

                            $prod_Id      = escape($row["Prod_Id"]);
                            $prod_name    = escape($row["Prod_name"]);
                            $prod_brand   = escape($row["Prod_brand"]);
                            $prod_price   = escape($row["Prod_price"]);
                            $prod_desc    = escape($row["Prod_desc"]);
                            $prod_status  = escape($row["Status"]);
                            $prod_image   = escape($row["Prod_image"]);
                            $prod_quantity = escape($row['Quantity']);

                            echo "<tr>";
                            echo "<td>".$n++."</td>";
                            echo "<td><a href='edit_product.php?prodid=$prod_Id' target='_blank'>$prod_name</a><center></td>";
                            echo "<td><center><img src='../images/products/$prod_image' class='img-responsive' style='width:30%;'></td>";
                            echo "<td>".number_format($prod_price,2)." PHP</td>";
                            echo "<td>$prod_quantity</td>";
                            echo "<td>";
                            echo "<form method='POST'>";
                            echo "<input type='hidden' class='form-control' name='prodid' value='$prod_Id'>";
                            echo "<input type='hidden' class='form-control' name='prodprice' value='$prod_price'>";
                            echo "<input type='number' class='form-control' name='quantity' value='1' id='posinput' onblur='qtyOut()'>";
                            echo "</td>";
                            echo "<td>";
                            echo "<button type='submit' class='btn btn-success' id='send'>Add</button> "; 
                            echo "</td>";
                            echo "</form>";
                            echo "</tr>";

                          }

                        ?>

                    </tbody>

                  </table>

                 <!--  </form> -->

                  <?php 

                    $query = "SELECT SUM(Quantity) as Cart FROM ";
                    $query .="sales_detail WHERE Sales_Id = '$session_sales_id' ";

                    $query_count = mysqli_query($con, $query);

                    while($row = mysqli_fetch_assoc($query_count)){

                      $order_count = $row['Cart'];

                      if($order_count == NULL){

                        echo "<h3 class='cap'>Cart (0)</h3>";
                      }

                      else{
                        echo "<h3 class='cap'>Cart ($order_count)</h3>";
                      }

                    }

                  ?>

                  <div class="table-responsive">
                    
                    <table class="table table-bordered table-hover">

                      <thead class="cap">
                        
                        <th>#</th>
                        <th>Item</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Action</th>

                      </thead>

                      <tbody>

                        <?php

                          $query = "SELECT sales_detail.Sales_Id, sales_detail.Prod_Id, sales_detail.Price, ";
                          $query .="sales_detail.Quantity, products_tbl.Prod_name, ";
                          $query .="products_tbl.Prod_image ";
                          $query .="FROM sales_detail LEFT JOIN products_tbl ";
                          $query .="ON sales_detail.Prod_Id = products_tbl.Prod_Id WHERE ";
                          $query .="sales_detail.Sales_Id = '$session_sales_id' ";
                          $query .="ORDER BY sales_detail.Prod_Id DESC";

                          $query_all_orders = mysqli_query($con, $query);

                          confirmQuery($query_all_orders);

                          count_records($query_all_orders, "<tr><td colspan='7'><center>No Items</center></td></tr>");

                          $n = 1;

                          while($row = mysqli_fetch_assoc($query_all_orders)){

                            $sales_id         = escape($row['Sales_Id']);
                            $prod_id          = escape($row['Prod_Id']);
                            $order_prod_name  = escape($row['Prod_name']);
                            $order_price      = escape($row['Price']);
                            $order_quantity   = escape($row['Quantity']);
                            $prod_image       = escape($row["Prod_image"]);

                            echo "<form method='POST'>";
                            echo "<tr>";
                            echo "<td>".$n++."</td>";
                            // echo "<td>$prod_id</td>";
                            echo "<td>$order_prod_name</td>";
                            // echo "<td><center><img src='../images/products/$prod_image' class='img-responsive' style='width:30%;'></td>";
                            echo "<td>$order_quantity</td>";
                            echo "<td>".number_format($order_price,2)." PHP</td>";
                            echo "<td>";
                            echo "<a href='' class='btn btn-primary' data-toggle='modal' data-target='#editQuantity$prod_id'>Edit</a> ";

                            ?>

                            <a href="#" title="Delete" class="btn btn-danger btn-sm" onclick="deleting('delete_action.php?delsale=<?php echo $sales_id; ?>&delprod=<?php echo $prod_id; ?>');">Delete</a>

                            <?php

                            echo "</td>";
                            echo "</tr>";

                            include "includes/edit_prod_quan.php";

                            echo "</form>";
                          }


                        ?>

                      </tbody>

                    </table>

                  </div>

                </div>

              </div>

          </div>

          <div class="col-sm-4">
            
            <form method = "POST">

              <div class="panel panel-default">

                <div class="panel-body">

                  <!-- <div class="item">
                    <strong>Transaction date</strong>
                    <input type="text" name="transaction_id" class="form-control" disabled>
                  </div> -->

                  <div class="item">
                    <strong>Cashier</strong>
                    <input type="text" name="cashier" class="form-control" value = "<?php echo $firstname; ?>" disabled>
                  </div>

                  <div class="item">

                    <strong>Customer Name <kbd>C</kbd></strong>

                    <?php 

                      $query_cust = "SELECT * FROM sales_tbl WHERE Sales_Id = '$session_sales_id'";
                      $query_customer_name = mysqli_query($con, $query_cust);

                      confirmQuery($query_customer_name);

                      while($row = mysqli_fetch_assoc($query_customer_name)){

                        $fetched_customer = $row['Sold_to'];

                        echo "<input type='text' name='customer' class='form-control' id='cust_name' value='$fetched_customer' required='required'>";
                      }

                    ?>
                    
                  </div>

                  <div class="item">

                    <strong>Items Ordered</strong>

                    <?php echo "<h2 style='color:green;'>$order_count</h2>"; ?>

                  </div>

                  <div class="text-right">

                    <h3>Subtotal</h3>

                    <h1>
                      <?php 

                          $query_sub_total = "SELECT SUM(Price * Quantity) AS Subtotal FROM sales_detail ";
                          $query_sub_total .="WHERE Sales_Id = '{$session_sales_id}'";

                          $query_sub_total_final = mysqli_query($con, $query_sub_total);

                          while($row = mysqli_fetch_assoc($query_sub_total_final)){

                            $the_subtotal = escape((int)$row['Subtotal']);

                          }
                          echo number_format($the_subtotal,2). " PHP"; 
                      ?>

                    </h1>

                  </div>

                </div>

                <div class="panel-footer">

                  <div class="text-right">

                     <a href="#" title="Void" class="btn btn-primary btn-lg" onclick="voidFunc('delete_action.php?void=<?php echo $session_sales_id; ?>');" id="void">Void <kbd>V</kbd></a>

                    <a href="" class = "btn btn-success btn-lg" data-toggle="modal" data-target="#POSpayment">Pay <kbd>P</kbd></a>

                  </div>

                </div> 

              </div>

              <?php include "includes/POS_payment.php"; ?>

            </form>

        </div>

      </div>

      <script src = "../assets/jquery/1.12.0/jquery.min.js"></script>

      <script src = "../assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

      <script src = "../assets/parsely/parsley.js"></script>

      <script type = "text/javascript" src = "../assets/datatables/datatables.min.js"></script>



      <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

      <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

      <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.js"></script> -->

      <!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->


      
      <script src = "../assets/validator/validator.js"></script>

      <script src = "../assets/validator/validate.js"></script>

      <script src = "../assets/jquery/hotkeys/jquery.hotkeys.js"></script>

      <script src = "scripts/shortcut_keys.js"></script>

      <script>

        $(document).ready(function(){

          $(document).bind('keydown', 'q', function(){

            $("#posinput").val("");
            $("#posinput").focus();

          });

          $(document).bind('keydown', 'c', function(){

            $("#cust_name").focus();

          });

          $(document).bind('keydown', 'p', function(){

            $("#POSpayment").modal();

          });

          $(document).bind('keydown', 'v', function(){

            var session_Id = $('#voidsess').val();

            voidFunc('delete_action.php?void=' + session_Id);

          });

          $('#pos').DataTable({
            select: true,
            "order": [[ 0, "asc" ]],
            "lengthMenu":[[1],[1]],
            "bSort": false
          });

          $('#orno').parsley();

          window.ParsleyValidator.addValidator('checkor', {
            validateString: function(value)
            {
              return $.ajax({
                url:'fetch_or.php',
                method:"POST",
                data:{orno:value},
                dataType:"json",
                success:function(data)
                {
                  return true;
                }
              });
            }
          });

          $('#arno').parsley();

          window.ParsleyValidator.addValidator('checkar', {
            validateString: function(value)
            {
              return $.ajax({
                url:'fetch_ar.php',
                method:"POST",
                data:{arno:value},
                dataType:"json",
                success:function(data)
                {
                  return true;
                }
              });
            }
          });

        });

        $('input').keyup(function(){ // run anytime the value changes

          var discount  = parseFloat($('#discount').val());
          var cash      = parseFloat($('#cash').val()); // convert it to a float
          var subtotal  = parseFloat($('#subtotal').val()); // get value of field
        
          var discounted = cash-((cash * discount) / 100);

          var change = (cash - discounted);

          if(cash > subtotal){

            var formula1 = cash - subtotal;

            var final_change = formula1 + change;

            document.getElementById('change').innerHTML = final_change || 0 + " PHP";
            document.getElementById('change2').value = final_change || 0;

          }

          else{

            document.getElementById('change').innerHTML = change || 0 + " PHP";
            document.getElementById('change2').value = change || 0;
          }

        });

        $('#clear').click(function(){
          
          document.getElementById('orno').value = '';
          document.getElementById('arno').value = '';
          document.getElementById('discount').value = '0';
          document.getElementById('cash').value = '0';
          document.getElementById('change').innerHTML = '0';

        });

        function qtyOut(){

          var posqty = $('#posinput').val();

          if(posqty == ''){

            $('#posinput').val(1);

          }

        }

      </script>

  </body>

</html>