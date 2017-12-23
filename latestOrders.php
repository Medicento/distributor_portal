<?php require_once("includes/db_connection.php");?>
<?php require_once("includes/functions.php");?>

<?php
	$query = "SELECT * FROM orders ORDER BY id DESC LIMIT 5";
	$result = mysqli_query($conn, $query);
	confirm_query($result);
	while ($list = mysqli_fetch_assoc($result)) { 
		$order_id = $list['order_id'];
		$order_time = $list['order_time'];

		$query_productPharma = "SELECT pharma FROM add_products WHERE order_id = {$order_id}";
        $result_productPharma = mysqli_query($conn, $query_productPharma);
        confirm_query($result_productPharma);
        $product_pharma = mysqli_fetch_assoc($result_productPharma);
        $pharma = $product_pharma['pharma'];
        $label = "";
        $labelState = "";

        if ($list['state']==0) {
        	$label = 'warning';
        	$labelState = 'Pending';
        } elseif ($list['state']==1) {
        	$label = 'success';
        	$labelState = 'Confirmed';
        }

		echo '<tr><td>'.$order_id.'</td><td>'.$pharma.'</td><td><span class="label label-'.$label.'">'.$labelState.'</span></td><td><div class="sparkbar" data-color="#f39c12" data-height="20">'.$order_time.'</div></td></tr>';
	}
?>