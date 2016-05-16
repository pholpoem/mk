<?php
header ( 'Content-Type: text/html; charset=utf-8' );
session_start ();
error_reporting ( error_reporting () & ~ E_NOTICE );
require_once ("order_func.php");

$isEdit = false;
if (isset ( $_GET ['action'] ) and $_GET ['action'] == "edit") {
	$isEdit = true;
	$id = $_GET ['id'];
	$values = getorderByorder_id ( $id );
	
	if (count ( $values ) > 0) {
		
$order_id = $values [0] ["order_id"];
$table_no = $values [0] ["table_no"];
$status = $values [0] ["status"];
$date_time = $values [0] ["date_time"];
		
		
$_SESSION ["order_id"] = $order_id;
$_SESSION ["table_no"] = $table_no;
$_SESSION ["status"] = $status;
$_SESSION ["date_time"] = $date_time;
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Beauty Shop order</title>
<link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../../css/bootstrap.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../js/jquery-2.2.0.min.js"></script>
<script type="text/javascript" src="../../js/jquery-2.2.0.js"></script>
<script type="text/javascript" src="../../js/func.js"></script>
</head>

<body>
	<div style="margin: 20px">
		<h1>New [order]</h1>
<?php
if ($isEdit) {
	echo "<form action='order_update_action.php' method='post'>";
} else {
	echo "<form action='order_insert_action.php' method='post'>";
}
if ($isEdit) {
	echo "<input type='hidden' name='id' name='id' value='" . $id . "'/>";
	}
?>

<div class="row" style="margin-top: 25px">
    	<div class="col-md-1"><label>order_id : </label></div>
    	<div class="col-md-3"><input type="text" name="order_id" class="form-control"value="<?=$_SESSION["order_id"] ?>" /></div>
</div>
<div class="row" style="margin-top: 25px">
    	<div class="col-md-1"><label>table_no : </label></div>
    	<div class="col-md-3"><input type="text" name="table_no" class="form-control"value="<?=$_SESSION["table_no"] ?>" /></div>
</div>
<div class="row" style="margin-top: 25px">
    	<div class="col-md-1"><label>status : </label></div>
    	<div class="col-md-3"><input type="text" name="status" class="form-control"value="<?=$_SESSION["status"] ?>" /></div>
</div>
<div class="row" style="margin-top: 25px">
    	<div class="col-md-1"><label>date_time : </label></div>
    	<div class="col-md-3"><input type="text" name="date_time" class="form-control"value="<?=$_SESSION["date_time"] ?>" /></div>
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
	echo "<p style='color:red'>กรุณากรอกorder Idด้วยค่ะ</p>";
}
if (isset ( $_GET ['return'] ) and $_GET ['return'] == 1) {
	echo "<p style='color:red'>กรุณากรอกTable Numberด้วยค่ะ</p>";
}
if (isset ( $_GET ['return'] ) and $_GET ['return'] == 2) {
	echo "<p style='color:red'>กรุณากรอกorder Statusด้วยค่ะ</p>";
}
if (isset ( $_GET ['return'] ) and $_GET ['return'] == 3) {
	echo "<p style='color:red'>กรุณากรอกด้วยค่ะ</p>";
}
session_destroy();
?>
</body>
</html>