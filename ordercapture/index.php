<?php require_once("includes/session.php");?>
<?php require_once("includes/db_connection.php");?>
<?php require_once("includes/functions.php");?>

<?php
    $x = 6; // Amount of digits
    $min = pow(10,$x);
    $max = pow(10,$x+1)-1;
    $order_id = rand($min, $max);
?>
<?php
    if (isset($_POST['submit'])) {
        $pharma = $_POST['pharma'];
        redirect_to("inventory.php?order_id=".$order_id."&pharma=".$pharma);
    }
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
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active">
          <a href="index.php">
            <i class="fa fa-dashboard"></i> <span>New Order</span>
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
      <div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">
                    <!-- form start -->
                    <p class="text-center">
                        <form role="form" method="post" action="index.php" >
                          <div class="box-body">
                            <div class="form-group col-lg-12">
                              <label for="pharmacy">Select Pharmacy</label>
                                <select name="pharmacy" onchange="pharmaData();" class="form-control" id="pharmaSelect" required>
                                    <option selected disabled>Select your option</option>
                                    <option value="4505">Balaji Medicals and General store </option>
                                    <option value="4506">Mehtab Pharma </option>
                                    <option value="4507">Swati Medicals and general Stores </option>
                                    <option value="4509">Garuda Pharma </option>
                                    <option value="4511">Prema Medicals</option>
                                    <option value="4512">New Life Medicals </option>
                                    <option value="4513">Shifaa Medical & General stores </option>
                                    <option value="4514">NRS Green Plus Pharma </option>
                                    <option value="4515">Alpha Medicals</option>
                                    <option value="4516">Care Chemist</option>
                                    <option value="4517">Green Plus</option>
                                    <option value="4518">Standard Medicals and General Store</option>
                                    <option value="4519">Medicure Pharma</option>
                                    <option value="4520">Sri Sai Medicals and Genarel Store </option>
                                </select>
                            </div>
                            <input type="text" name="pharma" id="pharma" style="display: none;">
                            <p id="pharmaDetail">
                             
                            </p>
                            <div class="form-group col-lg-12">
                                <input class="form-control btn-primary btn-lg" type="submit" name="submit" value="New Order">
                            </div>
                        </form>
                        
                        
                    </p>
                </div>
            </div>
      </div>
      <hr>
     
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
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script>
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!

    var yyyy = today.getFullYear();
    if(dd<10){
        dd='0'+dd;
    } 
    if(mm<10){
        mm='0'+mm;
    } 
    var today = dd+'/'+mm+'/'+yyyy;
    document.getElementById("date").innerHTML = today;
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
<script type="text/javascript">
    function pharmaData(){
        var pharmaCode = document.getElementById("pharmaSelect").value;
        if (pharmaCode == 4505) {
            document.getElementById("pharmaDetail").innerHTML = "Balaji Medicals and General store"
            document.getElementById("pharma").value = "Balaji Medicals and General store"
        } else if (pharmaCode == 4506) {
            document.getElementById("pharmaDetail").innerHTML = "Mehtab Pharma"
            document.getElementById("pharma").value = "Mehtab Pharma"
        } else if (pharmaCode == 4507) {
            document.getElementById("pharmaDetail").innerHTML = "Swati Medicals and general Stores"
            document.getElementById("pharma").value = "Swati Medicals and general Stores"
        } else if (pharmaCode == 4509) {
            document.getElementById("pharmaDetail").innerHTML = "garuda pharma"
            document.getElementById("pharma").value = "garuda pharma"
        } else if (pharmaCode == 4511) {
            document.getElementById("pharmaDetail").innerHTML = "Prema medicals"
            document.getElementById("pharma").value = "Prema medicals"
        } else if (pharmaCode == 4512) {
            document.getElementById("pharmaDetail").innerHTML = "New Life Medicals"
            document.getElementById("pharma").value = "New Life Medicals"
        } else if (pharmaCode == 4513) {
            document.getElementById("pharmaDetail").innerHTML = "Shifaa Medical & General stores"
            document.getElementById("pharma").value = "Shifaa Medical & General stores"
        } else if (pharmaCode == 4514) {
            document.getElementById("pharmaDetail").innerHTML = "NRS green plus pharma"
            document.getElementById("pharma").value = "NRS green plus pharma"
        } else if (pharmaCode == 4515) {
            document.getElementById("pharmaDetail").innerHTML = "Alpha medicals"
            document.getElementById("pharma").value = "Alpha medicals"
        } else if (pharmaCode == 4516) {
            document.getElementById("pharmaDetail").innerHTML = "care Chemist"
            document.getElementById("pharma").value = "care Chemist"
        } else if (pharmaCode == 4517) {
            document.getElementById("pharmaDetail").innerHTML = "Green Plus"
            document.getElementById("pharma").value = "Green Plus"
        } else if (pharmaCode == 4518) {
            document.getElementById("pharmaDetail").innerHTML = "Standard medicals and General Store"
            document.getElementById("pharma").value = "Standard medicals and General Store"
        } else if (pharmaCode == 4519) {
            document.getElementById("pharmaDetail").innerHTML = "Medicure Pharma"
            document.getElementById("pharma").value = "Medicure Pharma"
        } else if (pharmaCode == 4520) {
            document.getElementById("pharmaDetail").innerHTML = "Sri sai medicals and genarel store"
            document.getElementById("pharma").value = "Sri sai medicals and genarel store"
        }
    }
</script>

</body>
</html>
<?php
if (isset ($conn)){
  mysqli_close($conn);
}
?>