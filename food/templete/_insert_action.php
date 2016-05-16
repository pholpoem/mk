<?php
header ( 'Content-Type: text/html; charset=utf-8' );
require_once ("{{TABLE NAME}}_func.php");
session_start ();

{{##START LOOP##}}
{{EXCEPT LIST}}id,insert_time{{END EXCEPT LIST}}
{{SEPERATOR}}
{{END SEPERATOR}}
${{COLUMN_FEILD}} = trim ( $_POST ['{{COLUMN_FEILD}}'] );
{{##END LOOP##}}
$submit = $_POST ['submit'];

{{##START LOOP##}}
{{EXCEPT LIST}}id,insert_time{{END EXCEPT LIST}}
{{SEPERATOR}}
{{END SEPERATOR}}
$_SESSION ["{{COLUMN_FEILD}}"] = ${{COLUMN_FEILD}};
{{##END LOOP##}}

if (! isset ( $submit )) {
	header ( "location:{{TABLE NAME}}_insert_form.php" );
	exit ();
}
{{##START LOOP##}}
if ({{EXCEPT LIST}}{{TABLE_PK}},insert_time{{END EXCEPT LIST}}{{SEPERATOR}}
{{END SEPERATOR}}${{COLUMN_FEILD}} == "") {
	header ( "location:{{TABLE NAME}}_insert_form.php?return={{COLUMN_INDEX}}" );
	exit ();
}
{{##END LOOP##}}

New{{TABLE NAME}} ({{##START LOOP##}}{{EXCEPT LIST}}{{TABLE_PK}},insert_time{{END EXCEPT LIST}}{{SEPERATOR}},{{END SEPERATOR}}${{COLUMN_FEILD}}{{##END LOOP##}});
session_destroy();
?>