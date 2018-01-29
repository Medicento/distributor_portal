<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connection.php");?>
<?php require_once("../includes/functions.php");?>

<?php
	$order_id = $_GET['order_id'];
	$slot = $_GET['slot'];
	date_default_timezone_set('Asia/Calcutta');
    $order_time = date("F j, Y, g:i a");

	$query = "INSERT INTO orders (order_id, order_time, slot) VALUES({$order_id}, '{$order_time}', {$slot})";
	$result = mysqli_query($conn, $query);
	confirm_query($result);
	if ($result) {
		redirect_to("index.php?state=1");
	}
?>
<?php
if (isset ($conn)){
  mysqli_close($conn);
}
?>