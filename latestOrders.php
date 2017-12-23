<?php require_once("includes/db_connection.php");?>
<?php require_once("includes/functions.php");?>

<?php
	$query = "SELECT * FROM orders ORDER BY id DESC LIMIT 5";
	$result = mysqli_query($conn, $query);
	confirm_query($result);
	while ($list = mysqli_fetch_assoc($result)) { ?>
		
		<tr>
            <td>
            	<a href="#"><?php echo $list['order_id']; ?></a>
            </td>
            <td>Mehtab Pharma</td>
            <td><span class="label label-warning">Pending</span></td>
            <td>
              	<div class="sparkbar" data-color="#f39c12" data-height="20">9:10 AM | 7-01-17</div>
            </td>
        </tr>
	<?php
		
	}
?>