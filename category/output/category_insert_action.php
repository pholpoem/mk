<?php
header ( 'Content-Type: text/html; charset=utf-8' );
require_once ("category_func.php");
session_start ();

$cat_id = trim ( $_POST ['cat_id'] );
$catName = trim ( $_POST ['catName'] );
$submit = $_POST ['submit'];

$_SESSION ["cat_id"] = $cat_id;
$_SESSION ["catName"] = $catName;

if (! isset ( $submit )) {
	header ( "location:category_insert_form.php" );
	exit ();
}
if ($catName == "") {
	header ( "location:category_insert_form.php?return=1" );
	exit ();
}

Newcategory ($catName);
session_destroy();
?>