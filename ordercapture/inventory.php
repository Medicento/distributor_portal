<?php require_once("includes/session.php");?>
<?php require_once("includes/db_connection.php");?>
<?php require_once("includes/functions.php");?>

<?php
    $order_id = $_GET['order_id'];
    $pharma = $_GET['pharma'];
    //echo $order_id;
    if (isset($_POST['addProduct'])) {
        $product = mysqli_real_escape_string($conn, htmlspecialchars($_POST['product']));
        $quantity = $_POST['quantity'];
        $tempProduct = '"'.$product.'"';

        $query_findPrice = "SELECT price FROM products WHERE product = '{$tempProduct}'";
        $result_find = mysqli_query($conn, $query_findPrice);
        confirm_query($result_find);
        $listCost = mysqli_fetch_assoc($result_find);
        $costPrice = $listCost['price'];
        //$tempPrice = explode('"', $costPrice);
        //echo count($tempPrice);
        if (preg_match('/"([^"]+)"/', $costPrice, $m)) {
            $finalCost = (float)$m[1];   
        } else {
            $finalCost = 0;
           //preg_match returns the number of matches found, 
           //so if here didn't match pattern
        }

        $cost = $quantity * $finalCost;

        $query_addProduct = "INSERT INTO add_products (order_id, product, quantity, cost, pharma) VALUES ({$order_id}, '{$product}', {$quantity}, '{$cost}', '{$pharma}')";
        $result_addProduct = mysqli_query($conn, $query_addProduct);
        confirm_query($result_addProduct);
    }

    $query_showProduct = "SELECT * FROM add_products WHERE order_id = {$order_id} ORDER BY id DESC";
    $result_showProduct = mysqli_query($conn, $query_showProduct);
    confirm_query($result_showProduct);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Medicento | Live Inventory</title>
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
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script>
  $(document).ready(function() {
    $( "#codingSkills" ).autocomplete({
      source: 'search.php'
    });
  });
  </script>
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
        <li class="active">
          <a href="inventory.php">
            <i class="fa fa-bank"></i>
            <span>Inventory</span>
          </a>
        </li>
        <li>
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
        Inventory
        <small>Add, delete and update products</small>
      </h1>
    </section><br>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="container">
          <div class="row">
            <div class="col-lg-10">
                <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Add Product</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="inventory.php?order_id=<?php echo $order_id ?>&pharma=<?php echo $pharma ?>" >
                      <div class="box-body">
                        <div class="form-group col-lg-4">
                          <label for="product">Product</label>
                            <input type="text" class="form-control" id="codingSkills" name="product" required placeholder="Enter the name of the product">
                        </div>
                        <div class="form-group col-lg-4">
                          <label for="cost">Quantity</label>
                          <input type="number" class="form-control" id="quantity" name="quantity" required placeholder="Enter the quantity of the product" min="1">
                        </div>
                        
                      <div class="form-group col-lg-4">
                        <label for="submit">Press add to add this product</label>
                        <button type="submit" id="submit" name="addProduct" class="btn btn-block btn-success">Add</button>
                      </div>
                    </form>
                </div>
            </div>
      
    
   
    </div>
     
          <div class="row">
        <div class="col-xs-10">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">List of Products</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th class="text-center">Product</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Cost</th>
                        <th class="text-center">Action</th>
                      </tr>
                      </thead>
                      <tbody>
                          <?php
                              while ($productList = mysqli_fetch_assoc($result_showProduct)) { ?>
                                  <tr>
                                    <td><?php echo $productList['product']; ?></td>
                                    <td><?php echo $productList['quantity']; ?></td>
                                    <td><?php echo $productList['cost']; ?></td>
                                    <td class="text-center" >
                                      <a href="deleteProduct.php?product_id=<?php echo $productList['id']; ?>&order_id=<?php echo $order_id ?>" onclick="return confirm('Are you sure you want to delete this product?');"><i class="fa fa-close"></i> </a>
                                    </td>
                                  </tr>
                                  <?php
                              }
                          ?>
                      </tbody>
                    </table>
              <br><hr>
              <div class="row">
                <div class="col-lg-12 text-center">
                    <a href="submitOrder.php?order_id=<?php echo $order_id ?>">
                        <button class="btn btn-success">Submit</button>
                    </a>
                </div>  
              </div>
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
    <strong>Copyright &copy; 2017-2018 <a href="http://www.medicento.com/">medicento</a></strong> All rights
    reserved.
  </footer>
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>

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

</body>
</html>
<?php
if (isset ($conn)){
  mysqli_close($conn);
}
?>