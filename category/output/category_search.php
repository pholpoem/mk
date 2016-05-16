<?php require_once("category_func.php"); ?>
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
<title>Beauty Shop [category]</title>
</head>

<body>
<h1>category</h1>
<form action="category_search.php" method="post">
Search : <input type="text" name="text_to_search"><input type="submit" value="SEARCH" name="btn" class="btn btn-primary">
</form>
<?php
if(isset($_POST['btn'])){
$category = searchcategory(trim($_POST['text_to_search']));
if (count ( $category ) > 0) {
	echo "<table class='table table-striped'>";
	echo "<tr>";
	$keys = array_keys ( $category [0] );
	for($i = 0; $i < count ( $keys ); $i ++) {
		$key = $keys [$i];
		echo "<th>" . $key . "</th>";
	}
	echo "<th>Edit</th>";
	echo "<th>Delete</th>";
	echo "</tr>";
	for($i = 0; $i < count ( $category ); $i ++) {
		echo "<tr>";
		for($j = 0; $j < count ( $keys ); $j ++) {
			$key = $keys [$j];
			echo "<td>" . $category [$i] [$key] . "</td>";
		}
		$id = $category [$i] ['id'];
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
