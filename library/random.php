
<?php

include('..\\..\\htconfig\\connections.php');
$conn=mysqli_connect($connection['hostName'], $connection['userName'], $connection['password'], $connection['database']);
if(!$conn) {
	die('Connection error: '.mysqli_connect_error());
}

$sql_count="SELECT count(*) FROM books ;";
$count=mysqli_fetch_assoc(mysqli_query($conn, $sql_count))['count(*)'];
$id=mt_rand() % $count + 1;

echo "
<!DOCTYPE html>
<html lang='en'>
	<head>
		<title>Central Library</title>
		<meta charset='utf-8'>
		<link rel='stylesheet' href='.\\static\\style.css'>
	</head>

	<body>";
include(".\\includes\\head.php");
	echo '<div class="div-container">';

include(".\\includes\\nav.php");

include('..\\..\\htconfig\\connections.php');
$conn=mysqli_connect($connection['hostName'], $connection['userName'], $connection['password'], $connection['database']);
if(!$conn) {
	die('Connection failed! <br>'.
		"Error: ".mysqli_connect_error());
}

$book_sql="SELECT * FROM books WHERE id=$id ;";
echo " <div id='div-query'> "."$book_sql"." <br> </div> ";
echo " <div id='div-main'>";
$result=mysqli_query($conn, $book_sql);
if(mysqli_num_rows($result)==0) {
	echo 'No person with this id is found. <br>';
} else if(mysqli_num_rows($result)==1) {
	$result=mysqli_fetch_assoc($result);
	$manager_sql="SELECT name FROM persons WHERE id=".$result["managedBy"]." ;";
	echo "".
	"<script>".
	"	document.getElementById('div-query').innerHTML+='$manager_sql <br>'".
	"</script>";
	$manager = mysqli_fetch_assoc(mysqli_query($conn, $manager_sql))['name'];
	echo "Title: ".$result['title']." <br> ";
	echo "ISBN: ".$result['ISBN']." <br> ";
	echo "Edition: ".$result['edition']." <br> ";
    echo "Catogory: ".$result['category']." <br> ";
    echo "Price: ".$result['price']." <br> ";
    echo "Copies: ".$result['copies']." <br> ";
    echo "Shelf: ".$result['shelf']." <br> ";
	echo "Manager: $manager <br>";
} else {
	die('Database is inconsistent. <br>'.
		'Multiple persons with same id. <br>'
	);
}
echo "
			</div>
		</div>
	</body>
</html>
";

?>
