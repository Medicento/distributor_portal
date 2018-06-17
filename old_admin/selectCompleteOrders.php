<?php require_once("includes/db_connection.php");?>
<?php require_once("includes/functions.php");?>

<?php
	$queryCount = "SELECT COUNT(id) FROM orders WHERE state = 1";
	$resultCount = mysqli_query($conn, $queryCount);
	confirm_query($resultCount);
	$row = mysqli_fetch_array($resultCount);

	$queryComp = "SELECT order_id FROM orders WHERE state = 1";
	$resultComp = mysqli_query($conn, $queryComp);
	confirm_query($resultComp);
	$compCost = 0;
	while ($compList = mysqli_fetch_assoc($resultComp)) {
		$order = $compList['order_id'];
		$queryCurrent = "SELECT SUM(cost) FROM add_products WHERE order_id = '{$order}'";
		$resultCurrent = mysqli_query($conn, $queryCurrent);
		confirm_query($resultCurrent);
		$rowCost = mysqli_fetch_array($resultCurrent);
		$compCost += $rowCost[0];
	}

	echo '<span class="info-box-number"><small>Count</small>&nbsp;'.$row[0].'</span><span class="info-box-number"><small><i class="fa fa-inr"></i></small>&nbsp;'.$compCost.'</span>';
?>