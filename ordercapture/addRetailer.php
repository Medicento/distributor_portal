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
  if (isset($_GET['state'])) {
    $state = $_GET['state'];
  } else {
    $state = 0;
  }
  if ($state == 1) {
        $view_note = "";
        $acct_note = '<span>Retailer Added</span>';
    } else {
        $view_note = "style='display:none;'";
        $acct_note = "";
    }
?>
<?php
    if (isset($_POST['submit'])) {
        $shopname = $_POST['shopname'];
        if (isset($_POST['address'])) {
            $address = $_POST['address'];
        } else {
            $address = "";
        }
        $area = strtoupper($_POST['area']);
        if (isset($_POST['owner'])) {
            $owner = $_POST['owner'];
        } else {
            $owner = "";
        }
        if (isset($_POST['phno'])) {
            $phno = $_POST['phno'];
        } else {
            $phno = "";
        }
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
        } else {
            $email = "";
        }
        if (isset($_POST['gstNo'])) {
            $gstNo = $_POST['gstNo'];
        } else {
            $gstNo = "";
        }
        if (isset($_POST['dlNo'])) {
            $dlNo = $_POST['dlNo'];
        } else {
            $dlNo = "";
        }

        $query = "INSERT INTO retailers (shopname, address, area, owner, phno, email, gstNo, dlNo) VALUE('{$shopname}', '{$address}', '{$area}', '{$owner}', '{$phno}', '{$email}', '{$gstNo}', '{$dlNo}')";
        $result = mysqli_query($conn, $query);
        confirm_query($result);
        if ($result) {
            redirect_to("addRetailer.php?state=1");
        }
    }
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
          <a href="orders.php">
            <i class="fa fa-calendar"></i>
            <span>Orders</span>
          </a>
        </li>
        <li class="active">
          <a href="addRetailer.php">
            <i class="fa fa-plus"></i>
            <span>Add Retailers</span>
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
        Add Retailers
        <small>Add new retailers</small>
      </h1>
    </section><br>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
            <div class="col-lg-12">
              <div <?php echo $view_note; ?> class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong><?php echo $acct_note; ?></strong> 
                        </div>
                    </div>
                </div>
                <div class="box box-primary">
                    <!-- form start -->
                    <p class="text-center">
                        <form role="form" method="post" action="addRetailer.php" >
                          <div class="box-body">
                            <div class="form-group col-lg-12">
                              <label for="shopname">Shop Name</label>
                                <input type="text" name="shopname" class="form-control" required id="shopname">
                            </div>
                            <div class="form-group col-lg-12">
                              <label for="address">Address</label>
                                <input type="text" name="address" class="form-control" id="address">
                            </div>
                            <div class="form-group col-lg-12">
                              <label for="area">Area</label>
                                <input type="text" name="area" class="form-control" required id="area">
                            </div>
                            <div class="form-group col-lg-12">
                              <label for="owner">Owner</label>
                                <input type="text" name="owner" class="form-control" id="owner">
                            </div>
                            <div class="form-group col-lg-12">
                              <label for="phno">Phone Number</label>
                                <input type="text" name="phno" class="form-control" id="phno">
                            </div>
                            <div class="form-group col-lg-12">
                              <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email">
                            </div>
                            <div class="form-group col-lg-12">
                              <label for="gstNo">GST Number</label>
                                <input type="text" name="gstNo" class="form-control" id="gstNo">
                            </div>
                            <div class="form-group col-lg-12">
                              <label for="dlNo">DL Number</label>
                                <input type="text" name="dlNo" class="form-control" id="dlNo">
                            </div>
                            <div class="form-group col-lg-12">
                                <input class="form-control btn-success btn-lg" type="submit" name="submit" value="Submit">
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
    <strong>Copyright &copy; 2017-2018 <a href="http:medicento.com/">medicento</a></strong> All rights
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
<script type="text/javascript">
   function update(str)
   {
      var xmlhttp;

      if (window.XMLHttpRequest)
      {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
      }
      else
      {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      } 

      xmlhttp.onreadystatechange = function() {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
          document.getElementById("data").innerHTML = xmlhttp.responseText;
        }
      }

      xmlhttp.open("GET","demo.php?opt="+str, true);
      xmlhttp.send();
  }
</script>

</body>
</html>
<?php
if (isset ($conn)){
  mysqli_close($conn);
}
?>