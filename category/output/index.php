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
<script type="text/javascript">
$(document).ready(function(){
	loadTable();
});
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Beauty Shop [category]</title>
</head>

<body>
<h1>category</h1>
<div id = "data"></div>
<div id="table"></div>

<button onClick="parent.location='category_insert_form.php'" class="btn btn-success">New category</button>
<button onClick="parent.location='category_search.php'" class="btn btn-success">Search category</button>
</body>
</html>