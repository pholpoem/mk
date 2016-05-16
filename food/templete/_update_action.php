<?php
header ( 'Content-Type: text/html; charset=utf-8' );
require_once ("{{TABLE NAME}}_func.php");

{{##START LOOP##}}
{{EXCEPT LIST}}insert_time{{END EXCEPT LIST}}
{{SEPERATOR}}
{{END SEPERATOR}}
${{COLUMN_FEILD}} = trim ( $_POST ['{{COLUMN_FEILD}}'] );
{{##END LOOP##}}
$submit = $_POST ['submit'];

{{##START LOOP##}}
{{EXCEPT LIST}}insert_time{{END EXCEPT LIST}}
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
	header ( "location:{{TABLE NAME}}_insert_form.php?action=edit&return={{COLUMN_INDEX}}" );
	exit ();
}
{{##END LOOP##}}

update{{TABLE NAME}} ({{##START LOOP##}}{{EXCEPT LIST}}insert_time{{END EXCEPT LIST}}{{SEPERATOR}},{{END SEPERATOR}}${{COLUMN_FEILD}}{{##END LOOP##}});

session_unset ();
session_destroy ();
?>