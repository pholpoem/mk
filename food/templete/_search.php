<?php require_once("{{TABLE NAME}}_func.php"); ?>
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
<title>Beauty Shop [{{TABLE NAME}}]</title>
</head>

<body>
<h1>{{TABLE NAME}}</h1>
<form action="{{TABLE NAME}}_search.php" method="post">
Search : <input type="text" name="text_to_search"><input type="submit" value="SEARCH" name="btn" class="btn btn-primary">
</form>
<?php
if(isset($_POST['btn'])){
${{TABLE NAME}} = search{{TABLE NAME}}(trim($_POST['text_to_search']));
if (count ( ${{TABLE NAME}} ) > 0) {
	echo "<table class='table table-striped'>";
	echo "<tr>";
	$keys = array_keys ( ${{TABLE NAME}} [0] );
	for($i = 0; $i < count ( $keys ); $i ++) {
		$key = $keys [$i];
		echo "<th>" . $key . "</th>";
	}
	echo "<th>Edit</th>";
	echo "<th>Delete</th>";
	echo "</tr>";
	for($i = 0; $i < count ( ${{TABLE NAME}} ); $i ++) {
		echo "<tr>";
		for($j = 0; $j < count ( $keys ); $j ++) {
			$key = $keys [$j];
			echo "<td>" . ${{TABLE NAME}} [$i] [$key] . "</td>";
		}
		$id = ${{TABLE NAME}} [$i] ['id'];
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
