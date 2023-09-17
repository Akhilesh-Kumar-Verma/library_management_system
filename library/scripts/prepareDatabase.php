<?php
echo '
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="..\\static\\style.css">
		<title> Central Library </title>
	</head>
	<body>
		<div class="div-container">
';
include("..\\includes\\nav.php");
echo '
      <div id="div-query">
      </div>
			<div id="div-main">';

include('..\\..\\..\\htconfig\\connections.php');
$conn=mysqli_connect($connection['hostName'], $connection['userName'],
        $connection['password']);
if(!$conn) {
	die('Error in connecting to database: '.mysqli_connect_error().' <br> ');
}

$sql_createDatabase='CREATE DATABASE '.$connection['database'].';';
echo "".
"<script>".
"	document.getElementById('div-query').innerHTML+='$sql_createDatabase <br>'".
"</script>";

if(mysqli_query($conn, $sql_createDatabase)) {
	echo "Database ".$connection["database"]." Created successfully. <br> ";
} else {
	echo "Database ".$connection['database']." creation failed. <br> ".
		"Error: ".mysqli_error($conn).'<br>';
}

mysqli_close($conn);

$conn=mysqli_connect($connection['hostName'], $connection['userName'],
        $connection['password'], $connection['database']);

$tableName='persons';
$attr1='id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY';
$attr2='name VARCHAR(256)';
$attr3='current_address VARCHAR(256)';
$attr4='permanent_address VARCHAR(256)';
$attr5='date_of_birth DATE';
$sql_createTable='CREATE TABLE '.$tableName.' ( '.$attr1.' , '.$attr2.' , '.
$attr3.' , '.$attr4.' , '.$attr5.' ) ;';
echo "".
"<script>".
"	document.getElementById('div-query').innerHTML+='$sql_createTable <br>'".
"</script>";

if(mysqli_query($conn, $sql_createTable)) {
  echo "Table $tableName Created successfully. <br> ";
} else {
  echo "Table $tableName creation failed. <br> ".
  "Error: ".mysqli_error($conn).'<br>';
}

$tableName='emails';
$attr1="id BIGINT";
$attr2="email VARCHAR(256)";
$pk='CONSTRAINT pk_emails PRIMARY KEY (id, email)';
$sql_createTable='CREATE TABLE '.$tableName.' ( '.$attr1.' , '.$attr2.' , '.
$pk.' ) ;';
echo "".
"<script>".
"	document.getElementById('div-query').innerHTML+='$sql_createTable <br>'".
"</script>";

if(mysqli_query($conn, $sql_createTable)) {
  echo "Table $tableName Created successfully. <br> ";
} else {
  echo "Table $tableName creation failed. <br> ".
  "Error: ".mysqli_error($conn).'<br>';
}

$tableName='phones';
$attr1="id BIGINT";
$attr2="phone VARCHAR(256)";
$pk='CONSTRAINT pk_phones PRIMARY KEY (id, phone)';
$sql_createTable='CREATE TABLE '.$tableName.' ( '.$attr1.' , '.$attr2.' , '.
$pk.' ) ;';
echo "".
"<script>".
"	document.getElementById('div-query').innerHTML+='$sql_createTable <br>'".
"</script>";

if(mysqli_query($conn, $sql_createTable)) {
  echo "Table $tableName Created successfully. <br> ";
} else {
  echo "Table $tableName creation failed. <br> ".
  "Error: ".mysqli_error($conn).'<br>';
}

$tableName='books';
$attr1='id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY';
$attr2='title VARCHAR(256)';
$attr3='ISBN BIGINT';
$attr4='edition SMALLINT';
$attr5='category VARCHAR(24)';
$attr6='price INT';
$attr7='copies SMALLINT';
$attr8='shelf VARCHAR(24)';
$attr9='managedBy BIGINT NOT NULL'; // FOREIGN KEY REFERENCES books(id)';
$sql_createTable="CREATE TABLE $tableName ( $attr1, $attr2, $attr3, $attr4, $attr5, $attr6, $attr7, $attr8, $attr9 ) ;";
echo "".
"<script>".
"	document.getElementById('div-query').innerHTML+='$sql_createTable <br>'".
"</script>";

if(mysqli_query($conn, $sql_createTable)) {
  echo "Table $tableName Created successfully. <br> ";
} else {
  echo "Table $tableName creation failed. <br> ".
  "Error: ".mysqli_error($conn).'<br>';
}

$tableName='readers';
$attr1='book_id BIGINT'; // FOREIGN KEY REFERENCES books(id)';
$attr2='person_id BIGINT'; // FOREIGN KEY REFERENCES persons(id)';
$attr3='date_of_issue DATE';
$attr4='date_of_return DATE';
$pk='CONSTRAINT pk_reads PRIMARY KEY (book_id, person_id, date_of_issue)';
$sql_createTable="CREATE TABLE $tableName ( $attr1, $attr2, $attr3, $attr4, $pk ) ;";
echo "".
"<script>".
"	document.getElementById('div-query').innerHTML+='$sql_createTable <br>'".
"</script>";

if(mysqli_query($conn, $sql_createTable)) {
  echo "Table $tableName Created successfully. <br> ";
} else {
  echo "Table $tableName creation failed. <br> ".
  "Error: ".mysqli_error($conn).'<br>';
}

$tableName='authors';
$attr1="id BIGINT UNSIGNED";
$attr2="author BIGINT UNSIGNED";
$pk='CONSTRAINT pk_authors PRIMARY KEY (id, author)';
$sql_createTable='CREATE TABLE '.$tableName.' ( '.$attr1.' , '.$attr2.' , '.$pk.' ) ;';
echo "".
"<script>".
"	document.getElementById('div-query').innerHTML+='$sql_createTable <br>'".
"</script>";

if(mysqli_query($conn, $sql_createTable)) {
  echo "Table $tableName Created successfully. <br> ";
} else {
  echo "Table $tableName creation failed. <br> ".
  "Error: ".mysqli_error($conn).'<br>';
}

$tableName='credential';
$attr1='staff_id BIGINT UNSIGNED';
$attr2='password VARCHAR(256)';
$pk='CONSTRAINT pk_credentials PRIMARY KEY (staff_id, password)';
$sql_createTable="CREATE TABLE $tableName ( $attr1, $attr2, $pk ) ;";
echo "".
"<script>".
"	document.getElementById('div-query').innerHTML+='$sql_createTable <br>'".
"</script>";

if(mysqli_query($conn, $sql_createTable)) {
  echo "Table $tableName Created successfully. <br> ";
} else {
  echo "Table $tableName creation failed. <br> ".
  "Error: ".mysqli_error($conn).'<br>';
}

$insertValues_sql="INSERT INTO credential ( staff_id, password ) VALUES ( ?, ? ) ;";
echo "".
"<script>".
"	document.getElementById('div-query').innerHTML+='$insertValues_sql <br>'".
"</script>";
$insertValues_stmt=mysqli_prepare($conn, $insertValues_sql);
mysqli_stmt_bind_param($insertValues_stmt, 'ss', $staff_id, $password);
$staff_id=1;
$password="staff1";
if(mysqli_stmt_execute($insertValues_stmt)) {
	echo 'successfully inserted record with id '.mysqli_insert_id($conn).'<br>';
} else {
	echo 'Error: '.mysqli_error($conn).'<br>';
}


echo '</div> </div> </body> </html>';

?>
