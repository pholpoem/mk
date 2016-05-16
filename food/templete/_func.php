<?php
function Connect() {
	$servername = "{{DB_SERVER_LOCATION}}";
	$username = "{{DB_SERVER_USERNAMR}}";
	$password = "{{DB_SERVER_PASSWORD}}";
	$dbname = "{{DB_NAME}}";
	
	$conn = new mysqli ( $servername, $username, $password, $dbname );
	mysqli_set_charset ( $conn, "utf8" );
	
	if ($conn->connect_error) {
		die ( "Connection failed: " . $conn->connect_error );
	}
	return $conn;
}
function New{{TABLE NAME}}({{##START LOOP##}}{{EXCEPT LIST}}{{TABLE_PK}},insert_time{{END EXCEPT LIST}}{{SEPERATOR}},{{END SEPERATOR}}${{COLUMN_FEILD}}{{##END LOOP##}}){
	$conn = Connect ();
	
	$sql = "INSERT INTO {{TABLE NAME}} ({{##START LOOP##}}{{EXCEPT LIST}}insert_time{{END EXCEPT LIST}}{{SEPERATOR}},{{END SEPERATOR}}{{COLUMN_FEILD}}{{##END LOOP##}}) VALUES (0,{{##START LOOP##}}{{EXCEPT LIST}}id,insert_time{{END EXCEPT LIST}}{{SEPERATOR}},{{END SEPERATOR}}?{{##END LOOP##}})";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("{{##START LOOP##}}{{EXCEPT LIST}}{{TABLE_PK}},insert_time{{END EXCEPT LIST}}{{SEPERATOR}}{{END SEPERATOR}}{{COLUMN_TYPE}}{{##END LOOP##}}", {{##START LOOP##}}{{EXCEPT LIST}}{{TABLE_PK}},insert_time{{END EXCEPT LIST}}{{SEPERATOR}},{{END SEPERATOR}}${{COLUMN_FEILD}}{{##END LOOP##}});
	
	if ($stmt->execute() === TRUE) {
		header("location:index.php");
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$stmt->close ();
	$conn->close ();
}
function update{{TABLE NAME}}({{##START LOOP##}}{{EXCEPT LIST}}insert_time{{END EXCEPT LIST}}{{SEPERATOR}},{{END SEPERATOR}}${{COLUMN_FEILD}}{{##END LOOP##}}) {
	$conn = Connect ();
	
	$sql = "UPDATE {{TABLE NAME}} SET {{##START LOOP##}}{{EXCEPT LIST}}{{TABLE_PK}},insert_time{{END EXCEPT LIST}}{{SEPERATOR}},{{END SEPERATOR}}{{COLUMN_FEILD}} = ?{{##END LOOP##}} WHERE {{TABLE_PK}} = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("{{##START LOOP##}}{{EXCEPT LIST}}{{TABLE_PK}},insert_time{{END EXCEPT LIST}}{{SEPERATOR}}{{END SEPERATOR}}{{COLUMN_TYPE}}{{##END LOOP##}}i", {{##START LOOP##}}{{EXCEPT LIST}}{{TABLE_PK}},insert_time{{END EXCEPT LIST}}{{SEPERATOR}},{{END SEPERATOR}}${{COLUMN_FEILD}}{{##END LOOP##}},${{TABLE_PK}});
	
	if ($stmt->execute() === TRUE) {
		header ( "location:index.php" );
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$stmt->close ();
	$conn->close ();
}
function getAll{{TABLE NAME}}() {
	$conn = Connect ();
	
	$sql = "SELECT * FROM `{{TABLE NAME}}` ";
	$result = $conn->query($sql);
	
	${{TABLE NAME}} = array ();
	if($result->num_rows > 0)
	{
		while ($row = $result->fetch_assoc () ) {
			${{TABLE NAME}}_row = array (
										{{##START LOOP##}}
										{{SEPERATOR}},
										{{END SEPERATOR}}
										"{{COLUMN_FEILD}}" =>  $row ['{{COLUMN_FEILD}}']
										{{##END LOOP##}}
										);
				array_push ( ${{TABLE NAME}}, ${{TABLE NAME}}_row );
		}
	} else {
		echo "0 result";
		}
	$conn->close ();
	return ${{TABLE NAME}};
}
function get{{TABLE NAME}}By{{TABLE_PK}}(${{TABLE_PK}}) {
	$conn = Connect ();
	
	$sql = "SELECT * FROM {{TABLE NAME}} WHERE {{TABLE_PK}} = ?";
	
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i", ${{TABLE_PK}});
	$stmt->execute();
	$stmt ->bind_result({{##START LOOP##}}{{SEPERATOR}},{{END SEPERATOR}}${{COLUMN_FEILD}}{{##END LOOP##}});
	
	${{TABLE NAME}} = array ();
	while ( $stmt->fetch () ) {
		${{TABLE NAME}}_row = array (
										{{##START LOOP##}}
										{{SEPERATOR}},
										{{END SEPERATOR}}
										"{{COLUMN_FEILD}}" => ${{COLUMN_FEILD}} 
										{{##END LOOP##}}
										);
		array_push ( ${{TABLE NAME}}, ${{TABLE NAME}}_row );
		}
	$conn->close ();
	return ${{TABLE NAME}};
}

function delete{{TABLE NAME}}(${{TABLE_PK}}) {
	$conn = Connect ();
	$sql = "DELETE FROM {{TABLE NAME}} WHERE {{TABLE_PK}}= ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i",${{TABLE_PK}});
	
	if ($stmt->execute() === TRUE) {
		echo "<h3 style='color:red'>ลบข้อมูลเรียบร้อยแล้ว</h3>";
		//header ( "location:index.php" );
	} else {
		echo "Error deleting record: " . $conn->error;
	}
	$stmt->close ();
	$conn->close ();
}

function search{{TABLE NAME}}($name_search) {
	$conn = Connect ();
	
	$sql = "SELECT * FROM `{{TABLE NAME}}` WHERE `name` LIKE ?";
	echo $sql;
	
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s", $name_search);
	$stmt->execute();
	$stmt ->bind_result({{##START LOOP##}}{{SEPERATOR}},{{END SEPERATOR}}${{COLUMN_FEILD}}{{##END LOOP##}});
	
	${{TABLE NAME}} = array ();
	while ( $stmt->fetch () ) {
		${{TABLE NAME}}_row = array (
										{{##START LOOP##}}
										{{SEPERATOR}},
										{{END SEPERATOR}}
										"{{COLUMN_FEILD}}" => ${{COLUMN_FEILD}} 
										{{##END LOOP##}}
										);
			array_push ( ${{TABLE NAME}}, ${{TABLE NAME}}_row );
		}
		$stmt->close ();
	$conn->close ();
	return ${{TABLE NAME}};
}
?>