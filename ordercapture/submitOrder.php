<?php require_once("includes/session.php");?>
<?php require_once("includes/db_connection.php");?>
<?php require_once("includes/functions.php");?>

<?php
	$order_id = $_GET['order_id'];
	date_default_timezone_set('Asia/Calcutta');
    $order_time = date("F j, Y, g:i a");

	$query = "INSERT INTO orders (order_id, order_time) VALUES({$order_id}, '{$order_time}')";
	$result = mysqli_query($conn, $query);
	confirm_query($result);
	if ($result) {
		redirect_to("index.php");
	}
?>
<?php
if (isset ($conn)){
  mysqli_close($conn);
}
?>