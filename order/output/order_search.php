<?php require_once("orders_func.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<style>
th {
	background-color: #4CAF50;
	color: white;
}
</style>
<link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../../css/bootstrap.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../js/jquery-2.2.0.min.js"></script>
<script type="text/javascript" src="../../js/jquery-2.2.0.js"></script>
<script type="text/javascript" src="../../js/func.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Beauty Shop [orders]</title>
</head>

<body>
<h1>orders</h1>
<form action="orders_search.php" method="post">
Search : <input type="text" name="text_to_search"><input type="submit" value="SEARCH" name="btn" class="btn btn-primary">
</form>
<?php
if(isset($_POST['btn'])){
$orders = searchorders(trim($_POST['text_to_search']));
if (count ( $orders ) > 0) {
	echo "<table class='table table-striped'>";
	echo "<tr>";
	$keys = array_keys ( $orders [0] );
	for($i = 0; $i < count ( $keys ); $i ++) {
		$key = $keys [$i];
		echo "<th>" . $key . "</th>";
	}
	echo "<th>Edit</th>";
	echo "<th>Delete</th>";
	echo "</tr>";
	for($i = 0; $i < count ( $orders ); $i ++) {
		echo "<tr>";
		for($j = 0; $j < count ( $keys ); $j ++) {
			$key = $keys [$j];
			echo "<td>" . $orders [$i] [$key] . "</td>";
		}
		$id = $orders [$i] ['id'];
		echo "<td><button onclick = 'edit(".$id.")' class='btn btn-warning'>Edit</button></td>";
		echo "<td><button onclick = 'confirm_delete(".$id.")' class='btn btn-danger'>Delete</button></td>";
		echo "</tr>";
	}
	echo "</table>";
}
 }else{
	echo "กรุณากด Search <br/>";
	}
?>
 <a class="btn btn-default" href="index.php" role="button">BackHome</a>
</body>
</html>
