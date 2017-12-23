<?php require_once("includes/db_connection.php");?>
<?php require_once("includes/functions.php");?>

<?php
	$queryCount = "SELECT COUNT(id) FROM orders WHERE state = 1";
	$resultCount = mysqli_query($conn, $queryCount);
	confirm_query($resultCount);
	$row = mysqli_fetch_array($resultCount);
	
	$queryCost = "SELECT SUM(cost) FROM add_products";
	$resultCost = mysqli_query($conn, $queryCost);
	confirm_query($resultCost);
	$rowCost = mysqli_fetch_array($resultCost);

	echo '<span class="info-box-number"><small>Count</small>&nbsp;'.$row[0].'</span><span class="info-box-number"><small><i class="fa fa-inr"></i></small>&nbsp;'.$rowCost[0].'</span>';
?>