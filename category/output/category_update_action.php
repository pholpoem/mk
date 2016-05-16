<?php
header ( 'Content-Type: text/html; charset=utf-8' );
require_once ("category_func.php");

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
	header ( "location:category_insert_form.php?action=edit&return=1" );
	exit ();
}

updatecategory ($cat_id,$catName);

session_unset ();
session_destroy ();
?>