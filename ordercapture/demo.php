<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connection.php");?>
<?php require_once("../includes/functions.php");?>
<?php
  $opt = $_GET['opt'];

  $query = "SELECT shopname FROM retailers WHERE area = '{$opt}'";
  $result = mysqli_query($conn, $query);
  confirm_query($result);
  while ($list = mysqli_fetch_assoc($result)) {
      $shop = $list['shopname'] ;
      echo "<option value='".$shop."'>".$shop."</option>";
  }
?>
<?php
if (isset ($conn)){
  mysqli_close($conn);
}
?>