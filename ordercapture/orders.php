<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connection.php");?>
<?php require_once("../includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php
    $current_user = $_SESSION["username"];
    $name_query = "SELECT * FROM users WHERE username = '{$current_user}' LIMIT 1";
    $name_result = mysqli_query($conn, $name_query);
    confirm_query($name_result);
    $name_title = mysqli_fetch_assoc($name_result);
    $first_name = explode(" ", $name_title['name']);
?>

<?php

    $query_showProduct = "SELECT * FROM orders ORDER BY id DESC";
    $result_showProduct = mysqli_query($conn, $query_showProduct);
    $result_showModal = mysqli_query($conn, $query_showProduct);
    confirm_query($result_showModal);
    confirm_query($result_showProduct);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>medicento | Live Inventory</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>M</b>DT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">Medicento</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown tasks-menu">
            <a href="../logout.php" class="dropdown-toggle">
              <i class="fa fa-sign-out"></i>
            </a>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs"><?php echo htmlentities($first_name[0]); ?></span>
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="index.php">
            <i class="fa fa-dashboard"></i> <span>New Order</span>
          </a>
        </li>
        <li>
          <a href="inventory.php">
            <i class="fa fa-bank"></i>
            <span>Inventory</span>
          </a>
        </li>
        <li class="active">
          <a href="orders.php">
            <i class="fa fa-calendar"></i>
            <span>Orders</span>
          </a>
        </li>
        </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Orders
        <small>orders placed</small>
      </h1>
    </section><br>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      
      <div class="container">
          <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">List of Orders</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th class="text-center">Order No.</th>
                  <th class="text-center">Pharmacy</th>
                  <th class="text-center">Quantity</th>
                  <th class="text-center">Cost</th>
                  <th class="text-center">Order Time</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        while ($productList = mysqli_fetch_assoc($result_showProduct)) { ?>
                            <tr>
                              <td>
                                  <a href="#" data-toggle="modal" data-target="#order<?php echo $productList['order_id']; ?>">
                                      <?php echo $productList['order_id']; ?>
                                  </a>
                              </td>
                              <?php 
                                $query_productPharma = "SELECT pharma FROM add_products WHERE order_id = {$productList['order_id']}";
                                $result_productPharma = mysqli_query($conn, $query_productPharma);
                                confirm_query($result_productPharma);
                                $product_pharma = mysqli_fetch_assoc($result_productPharma);

                                $query_productQuantity = "SELECT SUM(quantity) FROM add_products WHERE order_id = {$productList['order_id']}";
                                $result_productQuantity = mysqli_query($conn, $query_productQuantity);
                                confirm_query($result_productQuantity);
                                $totalQuantity = mysqli_fetch_array($result_productQuantity);

                                $query_productCost = "SELECT SUM(cost) FROM add_products WHERE order_id = {$productList['order_id']}";
                                $result_productCost = mysqli_query($conn, $query_productCost);
                                confirm_query($result_productCost);
                                $totalCost = mysqli_fetch_array($result_productCost);
                              ?>
                              <td><?php echo $product_pharma['pharma'] ?></td>
                              <td><?php echo $totalQuantity[0]; ?></td>
                              <td><?php echo $totalCost[0]; ?></td>
                              <td><?php echo $productList['order_time']; ?></td>
                            </tr>
                            <?php
                        }
                    ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      </div>
    </section>
    <!-- /.content -->
  </div>


  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2017-2018 <a href="http://prashantkbhardwaj.github.io/">Prashant Bhardwaj</a></strong> All rights
    reserved.
  </footer>
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>

<?php
    while ($modalList = mysqli_fetch_assoc($result_showModal)) { ?>
            <div class="modal fade" id="order<?php echo $modalList['order_id']; ?>" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title text-center">Order ID <?php echo $modalList['order_id']; ?></h4>
                            <?php
                                $query_modalPharma = "SELECT pharma FROM add_products WHERE order_id = {$modalList['order_id']}";
                                $result_modalPharma = mysqli_query($conn, $query_modalPharma);
                                confirm_query($result_modalPharma);
                                $modalPharma = mysqli_fetch_assoc($result_modalPharma);

                                $query_modalDetails = "SELECT * FROM add_products WHERE order_id = {$modalList['order_id']}";
                                $result_modalDetails = mysqli_query($conn, $query_modalDetails);
                                confirm_query($result_modalDetails);
                            ?>
                            <h5 class="text-center"><?php echo $modalPharma['pharma']; ?></h5>
                        </div>
                        <div class="modal-body">
                            <p>
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                      <th class="text-center">Product</th>
                                      <th class="text-center">Quantity</th>
                                      <th class="text-center">Cost</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            while ($modalList = mysqli_fetch_assoc($result_modalDetails)) { ?>
                                                <tr>
                                                  <td><?php echo $modalList['product']; ?></td>
                                                  <td><?php echo $modalList['quantity']; ?></td>
                                                  <td><?php echo $modalList['cost']; ?></td>
                                                </tr>
                                                <?php
                                            }
                                        ?>
                                    </tbody>
                                  </table>
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-lg btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>          
                </div>
            </div> <!-- end of single modal -->

        <?php
    }
?>

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  

</body>
</html>
<?php
if (isset ($conn)){
  mysqli_close($conn);
}
?>