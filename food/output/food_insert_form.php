<?php
session_start ();
header ( 'Content-Type: text/html; charset=utf-8' );
error_reporting ( error_reporting () & ~ E_NOTICE );
require_once ("food_func.php");

$isEdit = false;
if (isset ( $_GET ['action'] ) and $_GET ['action'] == "edit") {
	$isEdit = true;
	$food_id = $_GET ['food_id'];
	$values = getfoodByfood_id ( $food_id );
	
	if (count ( $values ) > 0) {
		
		$food_id = $values [0] ["food_id"];
		$foodName = $values [0] ["foodName"];
		$description = $values [0] ["description"];
		$price = $values [0] ["price"];
		$image = $values [0] ["image"];
		$cat_id = $values [0] ["cat_id"];
		
		
		$_SESSION ["food_id"] = $food_id;
		$_SESSION ["foodName"] = $foodName;
		$_SESSION ["description"] = $description;
		$_SESSION ["price"] = $price;
		$_SESSION ["image"] = $image;
		$_SESSION ["cat_id"] = $cat_id;
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Beauty Shop food</title>
<link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../../css/bootstrap.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../js/jquery-2.2.0.min.js"></script>
<script type="text/javascript" src="../../js/jquery-2.2.0.js"></script>
<script type="text/javascript" src="js/func.js"></script>
</head>

<body>
	<div style="margin: 20px">
		<h1>New [food]</h1>
<?php
if ($isEdit) {
	echo "<form action='food_update_action.php' method='post'>";
} else {
	echo "<form action='food_insert_action.php' method='post'>";
}
if ($isEdit) {
	echo "<input type='hidden' name='id' id='id' value='" . $food_id . "'/>";
	}
?>

<input type="hidden" name="food_id" class="form-control"value="<?=$_SESSION["food_id"] ?>" />
<div class="row" style="margin-top: 25px">
    	<div class="col-md-2"><label>foodName : </label></div>
    	<div class="col-md-3"><input type="text" name="foodName" class="form-control"value="<?=$_SESSION["foodName"] ?>" /></div>
</div>
<div class="row" style="margin-top: 25px">
    	<div class="col-md-2"><label>description : </label></div>
    	<div class="col-md-3"><input type="text" name="description" class="form-control"value="<?=$_SESSION["description"] ?>" /></div>
</div>
<div class="row" style="margin-top: 25px">
    	<div class="col-md-2"><label>price : </label></div>
    	<div class="col-md-3"><input type="text" name="price" class="form-control"value="<?=$_SESSION["price"] ?>" /></div>
</div>
<div class="row" style="margin-top: 25px">
    	<div class="col-md-2"><label>image : </label></div>
    	<div class="col-md-3"><input type="text" name="image" class="form-control"value="<?=$_SESSION["image"] ?>" /></div>
</div>
<div class="row" style="margin-top: 25px">
    	<div class="col-md-2"><label>cat_id : </label></div>
    	<div class="col-md-3"><input type="text" name="cat_id" class="form-control"value="<?=$_SESSION["cat_id"] ?>" /></div>
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
	echo "<p style='color:red'>กรุณากรอกFood Idด้วยค่ะ</p>";
}
if (isset ( $_GET ['return'] ) and $_GET ['return'] == 1) {
	echo "<p style='color:red'>กรุณากรอกFood Nameด้วยค่ะ</p>";
}
if (isset ( $_GET ['return'] ) and $_GET ['return'] == 2) {
	echo "<p style='color:red'>กรุณากรอกDescripntionด้วยค่ะ</p>";
}
if (isset ( $_GET ['return'] ) and $_GET ['return'] == 3) {
	echo "<p style='color:red'>กรุณากรอกFood Priceด้วยค่ะ</p>";
}
if (isset ( $_GET ['return'] ) and $_GET ['return'] == 4) {
	echo "<p style='color:red'>กรุณากรอกFood Imageด้วยค่ะ</p>";
}
if (isset ( $_GET ['return'] ) and $_GET ['return'] == 5) {
	echo "<p style='color:red'>กรุณากรอกCategory Idด้วยค่ะ</p>";
}
session_destroy();
?>
</body>
</html>