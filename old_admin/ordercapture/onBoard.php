<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connection.php");?>
<?php require_once("../includes/functions.php");
      require_once ('../includes/_reduse.php');
?>
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
    if (isset($_POST['submit'])) {



      $valid_exts = array('jpeg', 'jpg', 'JPEG', 'JPG','pdf','PDF');
          $ext1 = strtolower(pathinfo($_FILES['file1']['name'], PATHINFO_EXTENSION));
          $ext2 = strtolower(pathinfo($_FILES['file2']['name'], PATHINFO_EXTENSION));
          $ext3 = strtolower(pathinfo($_FILES['file3']['name'], PATHINFO_EXTENSION));
          $ext4 = strtolower(pathinfo($_FILES['file4']['name'], PATHINFO_EXTENSION));
          
          if (in_array($ext1, $valid_exts))
          {
            $path     = 'images/'.rand(1, 9999).'_'.time().'.'.$ext1;   // File store in image folder
            
            $img_name1 = compress_image($_FILES["file1"]["tmp_name"], $path, 95); // Compress File in KB, (Here 10 is a percentege size of total size orginal file)
          $img_name_1 = explode("images/", $img_name1);
            
          }
           if (in_array($ext2, $valid_exts))
          {
            $path     = 'images/'.rand(1, 9999).'_'.time().'.'.$ext2;   // File store in image folder
            
            $img_name1 = compress_image($_FILES["file2"]["tmp_name"], $path, 95); // Compress File in KB, (Here 10 is a percentege size of total size orginal file)
          $img_name_2 = explode("images/", $img_name1);
            
          }
           if (in_array($ext3, $valid_exts))
          {
            $path     = 'images/'.rand(1, 9999).'_'.time().'.'.$ext3;   // File store in image folder
            
            $img_name1 = compress_image($_FILES["file3"]["tmp_name"], $path, 95); // Compress File in KB, (Here 10 is a percentege size of total size orginal file)
          $img_name_3 = explode("images/", $img_name1);
            
          }
           if (in_array($ext4, $valid_exts))
          {
            $path     = 'images/'.rand(1, 9999).'_'.time().'.'.$ext4;   // File store in image folder
            
            $img_name1 = compress_image($_FILES["file4"]["tmp_name"], $path, 95); // Compress File in KB, (Here 10 is a percentege size of total size orginal file)
          $img_name_4 = explode("images/", $img_name1);
            
          }

        $orgnsName = $_POST['orgnsName'];
        $signDate = $_POST['signDate'];
        $orgnsAddress = $_POST['orgnsAddress'];
        $conName = $_POST['conName'];
        $conDesig = $_POST['conDesig'];
        $conPhone = $_POST['conPhone'];
        $conMail = $_POST['conMail'];
        $drugLicense = $_POST['drugLicense'];
        $gstno = $_POST['gstno'];
        $timing = $_POST['timing'];
        $legalStatus = $_POST['legalStatus'];
        
        $query = "INSERT INTO `onboard`(`orgnsName`, `signDate`, `orgnsAddress`, `conName`, `conDesig`, `conPhone`, `conMail`,
         `drugLicense`, `gstno`, `timing`, `legalStatus`, `file1`, `file2`, `file3`, `file4`)
          VALUES ('{$orgnsName}', '{$signDate}', '{$orgnsAddress}','{$conName}', '{$conDesig}', '{$conPhone}','{$conMail}', '{$drugLicense}', '{$gstno}', '{$timing}', '{$legalStatus}', '{$img_name_1[1]}', '{$img_name_2[1]}', '{$img_name_3[1]}', '{$img_name_4[1]}')";
          echo $query;
         // die;
        $result = mysqli_query($conn, $query);
        confirm_query($result);
        if ($result) {
          redirect_to("onBoard.php?state=1");
        }

     
      
    }
?>
<?php
  if (isset($_GET['state'])) {
    $state = $_GET['state'];
  } else {
    $state = 0;
  }
  if ($state == 1) {
        $view_note = "";
        $acct_note = '<span>On Boarded</span>';
    } else {
        $view_note = "style='display:none;'";
        $acct_note = "";
    }
?>
<?php
    $queryArea = "SELECT DISTINCT (area) FROM retailers";
    $resultArea = mysqli_query($conn, $queryArea);
    confirm_query($resultArea);
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
        <li>
          <a href="addRetailer.php">
            <i class="fa fa-plus"></i>
            <span>Add Retailers</span>
          </a>
        </li>
        <li>
          <a href="onBoard.php">
            <i class="fa fa-plus"></i>
            <span>On Boarding</span>
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
        On Boarding
        <small>Add On Boarding</small>
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
                        <form role="form" method="post"  enctype="multipart/form-data" action="onBoard.php" >
                          <div class="box-body">
                            <div class="form-group col-lg-6">
                              <label for="area">Name Of Organisation</label>
                                <input type="text" name="orgnsName" class="form-control" required>
                            </div>
                            <div class="form-group col-lg-6">
                              <label for="pharmacy">Date Of Signing</label>
                                <input type="Date" name="signDate" class="form-control"  required>
                            </div>
                            <div class="form-group col-lg-12">
                              <label for="slot">Organisation Address</label>
                                <textarea name="orgnsAddress" class="form-control" ></textarea> 
                            </div>
                             
                            <div class="form-group col-lg-6">
                              <label for="area">Name Of Contact Person</label>
                                <input type="text" name="conName" class="form-control" required>
                            </div>
                            <div class="form-group col-lg-6">
                              <label for="area">Designation</label>
                                <input type="text" name="conDesig" class="form-control" required>
                            </div>
                            <div class="form-group col-lg-6">
                              <label for="area">Contact Number</label>
                                <input type="text" name="conPhone" class="form-control" required>
                            </div>
                            <div class="form-group col-lg-6">
                              <label for="area">E-mail</label>
                                <input type="E-mail" name="conMail" class="form-control" required>
                            </div>
                            <div class="form-group col-lg-6">
                              <label for="area">Drug License No.</label>
                                <input type="text" name="drugLicense" class="form-control" required>
                            </div>
                            <div class="form-group col-lg-6">
                              <label for="area">GST No.</label>
                                <input type="E-mail" name="gstno" class="form-control" required>
                            </div>
                             <div class="form-group col-lg-6">
                              <label for="area">Delivery Timing</label>
                                <select name="timing" class="form-control" id="optionA" required>
                                    <option selected disabled>Select your option</option>
                                    
                                      <option value="10.00 am - 12.30 pm">10.00 am - 12.30 pm</option>
                                      <option value="4.00 pm - 6.30 pm">4.00 pm - 6.30 pm</option>
                                          
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                              <label for="area">Legal Status</label>
                                <select name="legalStatus" class="form-control" id="optionA" required>
                                    <option selected disabled>Select your option</option>
                                    
                                      <option value="Prop">Prop</option>
                                      <option value="Pvt Ltd">Pvt Ltd</option>
                                      <option value="LTD">LTD</option>
                                      <option value="Parnership">Parnership</option>
                                      <option value="PSU">PSU</option>
                                          
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                              <label for="area">Drug license</label>
                              <input type="file" name="file1">
                            </div>
                             <div class="form-group col-lg-3">
                              <label for="area">Cancelled bill</label>
                              <input type="file" name="file2">
                            </div>
                             <div class="form-group col-lg-3">
                              <label for="area">Visiting card</label>
                              <input type="file" name="file3">
                            </div>
                             <div class="form-group col-lg-3">
                              <label for="area">Agreement</label>
                              <input type="file" name="file4">
                            </div>
                             <div class="form-group col-lg-12">
                              <label for="area">&nbsp;</label>
                                
                            </div>
                            <div class="form-group col-lg-12">
                                <input class="form-control btn-primary btn-lg" type="submit" name="submit" value="Submit">
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