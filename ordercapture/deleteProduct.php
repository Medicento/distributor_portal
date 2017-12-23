<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connection.php");?>
<?php require_once("../includes/functions.php");?>

<?php
	$product_id = $_GET['product_id'];
	$order_id = $_GET['order_id'];

	$query = "DELETE FROM add_products WHERE id = {$product_id}";
	$result = mysqli_query($conn, $query);
	confirm_query($result);
	if ($result) {
		redirect_to("inventory.php?order_id=".$order_id);
	}
?>
<?php
if (isset ($conn)){
  mysqli_close($conn);
}
?>