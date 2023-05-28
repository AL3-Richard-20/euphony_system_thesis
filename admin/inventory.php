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

      <!-- link rel = "stylesheet"  type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/> -->

      <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.css"> -->



      <link rel = "stylesheet"  type="text/css" href = "../includes/style.css">

      <title>Euphony | Inventory</title>

  </head>

	<body>

      <?php include "includes/admin_navigation.php"; ?>

      <div class="margin"></div>

		  <div class="container-fluid">

        <div class="panel panel-default">

          <div class="panel-header">

            <div class="row">

              <div class="col-sm-4">

                  <button type="button" class="btn btn-default btn-lg" style="float: left" onclick="location.href='index.php'"><span class="fa fa-arrow-left"></span></button>

              </div>

              <div class="col-sm-4">

                <div class="text-center">

                  <?php

                    if(isset($_GET['status'])){

                      $the_status = escape($_GET['status']);

                      if($the_status == 'All'){
                        echo "<h3 class='cap'>All Products</h3>";
                      }
                      else if($the_status == 'OnHand'){
                        echo "<h3 class='cap'>Stocks On Hand</h3>";
                      }

                    }
                    else{
                      echo "<h3 class='cap'>Stocks On Hand</h3>";
                    }

                  ?>

                </div>

              </div>

              <div class="col-sm-4"></div>

            </div>

        </div><br>

        <div class="panel-body">

          <div class="row">

            <div class="col-sm-4">

              <div class="text-left">

                <div class="btn-group">
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">

                  Filter <span class="caret"></span></button>

                  <ul class="dropdown-menu" role="menu">
                    <li><a href="inventory.php?status=All" title= "All Product">All</a></li>
                    <li><a href="inventory.php?status=OnHand" title= "All Product">Stocks On Hand</a></li>
                    <li><a href="fast_moving_products.php" title= "Fast Moving Products">Fast Moving</a></li>
                    <li><a href="slow_moving_products.php" title= "Slow Moving Products">Slow Moving</a></li>
                    <li><a href="critical_stocks.php" title= "Critical Stocks">Critical Stocks</a></li>
                  </ul>

                </div>

              </div>

            </div>

            <div class="col-sm-4"></div>

            <div class="col-sm-4">

              <div class = "text-right">

                <div class="btn-group">
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                  More <span class="caret"></span></button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a style = "font-size: 15px;" href="add_product.php" title= "Add">Add new product</a></li>
                    <li><a style = "font-size: 15px;" href="print_stocks_on_hand.php?branchid=<?php echo $branch_id; ?>" title= "Print" target="_blank" id="stockprint">Print Stocks</a></li>
                  </ul>
                </div>

                <div class="btn-group">
                  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                  In & Out <span class="caret"></span></button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a style = "font-size: 15px;" href="stock_in.php" title= "Stock In">Stock In</a> </li>
                    <li><a style = "font-size: 15px;" href="stock_out.php" title= "Stock Out">Stock Out</a> </li>
                  </ul>
                </div>

                <a style = "font-size: 15px;" href="categories.php" title= "Add" class="btn btn-primary btn-sm" >Categories</a> 

              </div>

            </div>

          </div><hr/>

          <div class="row">
            
            <div class="col-sm-12">

              <div class="col-sm-4" style = "border: 2px solid #f4f4f4">

                <div class="text-center">

                  <p>Total Products</p>

                  <?php

                    $query_all_products = productList($branch_id);

                    confirmQuery($query_all_products);

                    $count = mysqli_num_rows($query_all_products);

                    echo "<h3>$count</h3>";

                  ?>

                </div>

              </div>

              <div class="col-sm-4" style = "border: 2px solid #f4f4f4">

                <div class="text-center">

                  <p>In Hand Products</p>

                  <?php

                    $query ="SELECT SUM(Quantity) as InHand FROM prod_invt_tbl ";
                    $query.="WHERE Branch_Id = '$branch_id' AND NOT Quantity = 0";

                    $query_onhand_products = mysqli_query($con, $query);

                    $count1 = mysqli_num_rows($query_onhand_products);

                    if($count1 == 0){

                      echo "<script>document.getElementById('stockprint').className='hidden';</script>";

                    }

                    confirmQuery($query_onhand_products);

                    while($row = mysqli_fetch_assoc($query_onhand_products)){

                      $total_inhand = $row['InHand'];

                      if($total_inhand != NULL){
                        echo "<h3>$total_inhand</h3>";
                      }
                      else{
                        echo "<h3>0</h3>";
                      }
                    }


                  ?>

                </div>

              </div>

              <div class="col-sm-4" style = "border: 2px solid #f4f4f4">

                <div class="text-center">

                  <p>Total Inventory Value</p>
                  
                  <?php

                    $query = "SELECT P.Prod_Id, P.Category_Id, P.Prod_brand, P.Prod_name, P.Prod_price, P.Prod_desc, ";
                    $query .= "P.Prod_image, P.Status, C.Category_Id, C.Category_title, PI.Quantity, B.Branch_Id, ";
                    $query .= "B.Branch_desc, B.Branch_location, B.Branch_image, B.Level, ";
                    $query .= "SUM(P.Prod_price * PI.Quantity) as Final FROM products_tbl as P, ";
                    $query .= "category_tbl as C, prod_invt_tbl as PI, branches_tbl as B WHERE P.Prod_Id = PI.Prod_Id ";
                    $query .= "and P.Category_Id = C.Category_Id and PI.Branch_Id = B.Branch_Id ";
                    $query .= "and PI.Branch_Id = '$branch_id' AND NOT PI.Quantity = 0 AND P.Status_2 = 1";
                    $query_sum = mysqli_query($con, $query);

                    $the_sum = 0;

                    while($row = mysqli_fetch_assoc($query_sum)){

                      $the_final = escape($row['Final']);

                      echo "<h3>".number_format((int)$the_final,2)." PHP</h3>";
                    }

                  ?>

                </div>

              </div>

            </div>

          </div><hr/>

          <div class="row">

            <div class="col-sm-12">

              <div class="table-responsive">

                <table class="table table-bordered" id = "standardAsc">

                  <thead class="cap">
                    <tr>
                      <th>No.</th>
                      <th>Item</th>
                      <th>Brand</th>
                      <th>Price</th>
                      <th>Status</th>
                      <th>Image</th>
                      <th>Stock</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>

                    <?php

                      if(isset($_GET['status'])){

                        $the_status = escape($_GET['status']);

                        if($the_status == 'All'){

                            $query_all_products = productList($branch_id);

                            confirmQuery($query_all_products);

                            $n = 1;

                            while($row = mysqli_fetch_array($query_all_products)){

                                $prod_Id      = escape($row["Prod_Id"]);
                                $prod_name    = escape($row["Prod_name"]);
                                $prod_brand   = escape($row["Prod_brand"]);
                                $prod_price   = escape(number_format($row["Prod_price"],2));
                                $prod_desc    = escape($row["Prod_desc"]);
                                $prod_status  = escape($row["Status"]);
                                $prod_image   = escape($row["Prod_image"]);
                                $prod_quantity = escape($row['Quantity']);

                                echo "<tr>";
                                echo "<td>".$n++."</td>";
                                echo "<td>$prod_name</td>";
                                echo "<td>$prod_brand</td>";
                                echo "<td>$prod_price PHP</td>";
                                echo "<td>$prod_status</td>";
                                echo "<td><center><img src = '../images/products/$prod_image' class = 'imagesize'></center></td>";
                                echo "<td>$prod_quantity</td>";
                                echo "<td>";
                                echo "<a href='edit_product.php?prodid=$prod_Id' title= 'Edit' class='btn btn-primary btn-sm'>Edit</a> ";

                                ?>

                                <a href="#" title="Delete" class="btn btn-danger btn-sm" onclick="deleting('delete_action.php?prodid=<?php echo $prod_Id; ?>');">Delete</a>

                                <?php

                                echo" </td>";
                                echo "</tr>";
                            }
                        }
                        
                        else if($the_status == 'OnHand'){

                          $query_all_products = stocksOnHand($branch_id);

                          confirmQuery($query_all_products);

                          $n = 1;

                          while($row = mysqli_fetch_array($query_all_products)){

                            $prod_Id      = escape($row["Prod_Id"]);
                            $prod_name    = escape($row["Prod_name"]);
                            $prod_brand   = escape($row["Prod_brand"]);
                            $prod_price   = escape(number_format($row["Prod_price"],2));
                            $prod_desc    = escape($row["Prod_desc"]);
                            $prod_status  = escape($row["Status"]);
                            $prod_image   = escape($row["Prod_image"]);
                            $prod_quantity = escape($row['Quantity']);

                            echo "<tr>";
                            echo "<td>".$n++."</td>";
                            echo "<td>$prod_name</td>";
                            echo "<td>$prod_brand</td>";
                            echo "<td>$prod_price PHP</td>";
                            echo "<td>$prod_status</td>";
                            echo "<td><center><img src = '../images/products/$prod_image' class = 'imagesize'></center></td>";
                            echo "<td>$prod_quantity</td>";
                            echo "<td>";
                            echo "<a href='edit_product.php?prodid=$prod_Id' title= 'Edit' class='btn btn-primary btn-sm'>Edit</a> ";

                            ?>

                            <a href="#" title="Delete" class="btn btn-danger btn-sm" onclick="deleting('delete_action.php?prodid=<?php echo $prod_Id; ?>');">Delete</a>

                            <?php

                            echo" </td>";
                            echo "</tr>";
                          }
                        }

                      }

                      else{

                          $query_all_products = stocksOnHand($branch_id);

                          confirmQuery($query_all_products);

                          $n = 1;

                          while($row = mysqli_fetch_array($query_all_products)){

                            $prod_Id      = escape($row["Prod_Id"]);
                            $prod_name    = escape($row["Prod_name"]);
                            $prod_brand   = escape($row["Prod_brand"]);
                            $prod_price   = escape(number_format($row["Prod_price"],2));
                            $prod_desc    = escape($row["Prod_desc"]);
                            $prod_status  = escape($row["Status"]);
                            $prod_image   = escape($row["Prod_image"]);
                            $prod_quantity = escape($row['Quantity']);

                            echo "<tr>";
                            echo "<td>".$n++."</td>";
                            echo "<td>$prod_name</td>";
                            echo "<td>$prod_brand</td>";
                            echo "<td>$prod_price PHP</td>";
                            echo "<td>$prod_status</td>";
                            echo "<td><center><img src = '../images/products/$prod_image' class = 'imagesize'></center></td>";
                            echo "<td>$prod_quantity</td>";
                            echo "<td>";
                            echo "<a href='edit_product.php?prodid=$prod_Id' title= 'Edit' class='btn btn-primary btn-sm'>Edit</a> ";

                            ?>

                            <a href="#" title="Delete" class="btn btn-danger btn-sm" onclick="deleting('delete_action.php?prodid=<?php echo $prod_Id; ?>');">Delete</a>

                            <?php

                            echo" </td>";
                            echo "</tr>";
                          }

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

    <script>
      
      $(document).ready(function(){

        $('#standardAsc').DataTable({
          select: true,
          "order": [[ 0, "asc" ]]
        });

      });

    </script>

	</body>

</html>