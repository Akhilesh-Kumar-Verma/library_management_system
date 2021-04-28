
<?php
echo '
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href=".\\static\\style.css">
		<title> Central Library </title>
	</head>
	<body>';
include(".\\includes\\head.php");
	echo '<div class="div-container">';
include(".\\includes\\nav.php");
echo '<div id="div-query">
			</div>
			<div id="div-main">';

$books = "SELECT * FROM books ;";
echo "<script>".
"document.getElementById('div-query').innerHTML += '$books <br>';".
"</script>";
include('..\\..\\htconfig\\connections.php');
$conn=mysqli_connect($connection['hostName'], $connection['userName'], $connection['password'], $connection['database']);
if(!$conn) {
	die('Connection failed! <br>'.
		"Error: ".mysqli_connect_error());
}

$result=mysqli_query($conn, $books);
if(mysqli_num_rows($result)>0) {
	echo
	"<table>".
	"<tr>".
	"<th> ID </th>".
	"<th> Title </th>".
	"<th> Copies </th>".
	"<th> Shelf </th>".
	"</tr>";
	while($row = mysqli_fetch_assoc($result)) {
		echo
		"<tr>".
		"<th> ".$row['id']."</th>".
		"<th>".$row['title']."</th>".
		"<th>".$row['copies']."</th>".
		"<th>".$row['shelf']."</th>".
		"</tr>";

	}
}

echo '
			</div>
		</div>
	</body>
</html>
';

?>
