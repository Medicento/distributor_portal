<?php require_once("includes/session.php");?>
<?php require_once("includes/db_connection.php");?>
<?php require_once("includes/functions.php");
//get search term
$searchTerm = $_GET['term'];
//get matched data from skills table
$sql =$conn->query("SELECT * FROM products WHERE product LIKE '%".$searchTerm."%' ORDER BY product ASC LIMIT 0,10");
while ($row = @mysqli_fetch_array($sql)) {
    $data[] = trim($row['product'],'"');
}

//return json data
echo json_encode($data);
?>