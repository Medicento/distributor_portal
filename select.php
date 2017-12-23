<?php require_once("includes/db_connection.php");?>
<?php require_once("includes/functions.php");?>

<?php
	$query = "SELECT * FROM orders ORDER BY id DESC";
	$result = mysqli_query($conn, $query);
	confirm_query($result);

	$queryCount = "SELECT COUNT(id) FROM notifications WHERE state = 1";
	$resultCount = mysqli_query($conn, $queryCount);
	confirm_query($resultCount);
	$row = mysqli_fetch_array($resultCount);
	if ($row[0]==0) {
		$total_unread_comments = "";
	} else {
		$total_unread_comments = "data-count='".$row[0]."'";
	}
    

	echo "<div class='dropdown-item text-center'><strong>Notification <span class='fa-stack has-badge' ".$total_unread_comments."></span></strong></div>";
	while ($notification = mysqli_fetch_assoc($result)) {
		
		if ($notification['state']==0) {
			echo "<div class='notif_box'><span class='dropdown-item'><img class='fa-user-img' src='img/".$notification['name'].".png'></img> ".$notification['comment']."</span></div>";
		} else {
			echo "<div class='notif_box active_box'><span class='dropdown-item'><img class='fa-user-img' src='img/".$notification['name'].".png'></img> ".$notification['comment']."</span></div>";
		} 
	}		 
?>