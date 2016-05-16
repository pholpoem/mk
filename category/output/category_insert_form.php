<?php
header ( 'Content-Type: text/html; charset=utf-8' );
session_start ();
error_reporting ( error_reporting () & ~ E_NOTICE );
require_once ("category_func.php");

$isEdit = false;
if (isset ( $_GET ['action'] ) and $_GET ['action'] == "edit") {
	$isEdit = true;
	$id = $_GET ['id'];
	$values = getcategoryById ( $id );
	
	if (count ( $values ) > 0) {
		
$cat_id = $values [0] ["cat_id"];
$catName = $values [0] ["catName"];
		
		
$_SESSION ["cat_id"] = $cat_id;
$_SESSION ["catName"] = $catName;
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Beauty Shop category</title>
<link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../../css/bootstrap.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../js/jquery-2.2.0.min.js"></script>
<script type="text/javascript" src="../../js/jquery-2.2.0.js"></script>
<script type="text/javascript" src="../../js/func.js"></script>
</head>

<body>
	<div style="margin: 20px">
		<h1>New [category]</h1>
<?php
if ($isEdit) {
	echo "<form action='category_update_action.php' method='post'>";
} else {
	echo "<form action='category_insert_action.php' method='post'>";
}
if ($isEdit) {
	echo "<input type='hidden' name='id' name='id' value='" . $id . "'/>";
	}
?>

<div class="row" style="margin-top: 25px">
    	<div class="col-md-1"><label>cat_id : </label></div>
    	<div class="col-md-3"><input type="text" name="cat_id" class="form-control"value="<?=$_SESSION["cat_id"] ?>" /></div>
</div>
<div class="row" style="margin-top: 25px">
    	<div class="col-md-1"><label>catName : </label></div>
    	<div class="col-md-3"><input type="text" name="catName" class="form-control"value="<?=$_SESSION["catName"] ?>" /></div>
</div>
	<div class="row" style="margin-top: 20px">
		<div class="col-md-1"><input type="submit" name="submit" value="Save"class="btn btn-primary"></div>
</div>
		</form>
		<br />
		<br /> <a class="btn btn-default" href="index.php" role="button">BackHome</a>
	</div>
<?php

if (isset ( $_GET ['return'] ) and $_GET ['return'] == 0) {
	echo "<p style='color:red'>กรุณากรอกCategory Idด้วยค่ะ</p>";
}
if (isset ( $_GET ['return'] ) and $_GET ['return'] == 1) {
	echo "<p style='color:red'>กรุณากรอกCategory Nameด้วยค่ะ</p>";
}
session_destroy();
?>
</body>
</html>