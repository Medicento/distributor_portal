<?php require_once("includes/session.php");?>
<?php require_once("includes/db_connection.php");?>
<?php require_once("includes/functions.php");?>
<?php
	$order_id = $_GET['order_id'];

	$query = "UPDATE orders SET state = 1 WHERE order_id = {$order_id}";
	$result = mysqli_query($conn, $query);
	confirm_query($result);
	if ($result) {
		redirect_to("order.php");
	}
?>

<?php
if (isset ($conn)){
  mysqli_close($conn);
}
?>