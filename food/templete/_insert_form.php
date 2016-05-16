<?php
header ( 'Content-Type: text/html; charset=utf-8' );
session_start ();
error_reporting ( error_reporting () & ~ E_NOTICE );
require_once ("{{TABLE NAME}}_func.php");

$isEdit = false;
if (isset ( $_GET ['action'] ) and $_GET ['action'] == "edit") {
	$isEdit = true;
	$id = $_GET ['id'];
	$values = get{{TABLE NAME}}ById ( $id );
	
	if (count ( $values ) > 0) {
		{{##START LOOP##}}
		{{EXCEPT LIST}}id,insert_time{{END EXCEPT LIST}}
		${{COLUMN_FEILD}} = $values [0] ["{{COLUMN_FEILD}}"];
		{{##END LOOP##}}
		
		{{##START LOOP##}}
		{{EXCEPT LIST}}id,insert_time{{END EXCEPT LIST}}
		$_SESSION ["{{COLUMN_FEILD}}"] = ${{COLUMN_FEILD}};
		{{##END LOOP##}}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Beauty Shop {{TABLE NAME}}</title>
<link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../../css/bootstrap.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../js/jquery-2.2.0.min.js"></script>
<script type="text/javascript" src="../../js/jquery-2.2.0.js"></script>
<script type="text/javascript" src="../../js/func.js"></script>
</head>

<body>
	<div style="margin: 20px">
		<h1>New [{{TABLE NAME}}]</h1>
<?php
if ($isEdit) {
	echo "<form action='{{TABLE NAME}}_update_action.php' method='post'>";
} else {
	echo "<form action='{{TABLE NAME}}_insert_action.php' method='post'>";
}
if ($isEdit) {
	echo "<input type='hidden' name='id' name='id' value='" . $id . "'/>";
	}
?>
{{##START LOOP##}}
{{EXCEPT LIST}}id,insert_time{{END EXCEPT LIST}}
<div class="row" style="margin-top: 25px">
    	<div class="col-md-1"><label>{{COLUMN_FEILD}} : </label></div>
    	<div class="col-md-3"><input type="text" name="{{COLUMN_FEILD}}" class="form-control"value="<?=$_SESSION["{{COLUMN_FEILD}}"] ?>" /></div>
</div>
        {{##END LOOP##}}
	<div class="row" style="margin-top: 20px">
		<div class="col-md-1"><input type="submit" name="submit" value="Save"class="btn btn-primary"></div>
</div>
		</form>
		<br />
		<br /> <a class="btn btn-default" href="index.php" role="button">BackHome</a>
	</div>
<?php
{{##START LOOP##}}
{{EXCEPT LIST}}id,insert_time{{END EXCEPT LIST}}
if (isset ( $_GET ['return'] ) and $_GET ['return'] == {{COLUMN_INDEX}}) {
	echo "<p style='color:red'>กรุณากรอก{{COLUMN_COMMENT}}ด้วยค่ะ</p>";
}{{##END LOOP##}}
session_destroy();
?>
</body>
</html>