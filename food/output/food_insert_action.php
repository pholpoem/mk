<?php
header ( 'Content-Type: text/html; charset=utf-8' );
require_once ("food_func.php");
session_start ();

$food_id = trim ( $_POST ['food_id'] );
$foodName = trim ( $_POST ['foodName'] );
$description = trim ( $_POST ['description'] );
$price = trim ( $_POST ['price'] );
$image = trim ( $_POST ['image'] );
$cat_id = trim ( $_POST ['cat_id'] );
$submit = $_POST ['submit'];

$_SESSION ["food_id"] = $food_id;
$_SESSION ["foodName"] = $foodName;
$_SESSION ["description"] = $description;
$_SESSION ["price"] = $price;
$_SESSION ["image"] = $image;
$_SESSION ["cat_id"] = $cat_id;

if (! isset ( $submit )) {
	header ( "location:food_insert_form.php" );
	exit ();
}
if ($foodName == "") {
	header ( "location:food_insert_form.php?return=1" );
	exit ();
}
if ($description == "") {
	header ( "location:food_insert_form.php?return=2" );
	exit ();
}
if ($price == "") {
	header ( "location:food_insert_form.php?return=3" );
	exit ();
}
if ($image == "") {
	header ( "location:food_insert_form.php?return=4" );
	exit ();
}
if ($cat_id == "") {
	header ( "location:food_insert_form.php?return=5" );
	exit ();
}

Newfood ($foodName,$description,$price,$image,$cat_id);
session_destroy();
?>