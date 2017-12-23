<?php require_once("includes/db_connection.php");?>
<?php require_once("includes/functions.php");?>

<?php
	$query = "SELECT * FROM orders ORDER BY id DESC LIMIT 5";
	$result = mysqli_query($conn, $query);
	confirm_query($result);
	while ($list = mysqli_fetch_assoc($result)) {
		
	}
?>