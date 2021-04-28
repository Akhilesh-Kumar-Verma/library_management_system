
<?php

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

$id=$_POST['id'];

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

	$find_author="SELECT name FROM authors JOIN persons ON authors.author = persons.id WHERE authors.id=$id ;";
	echo ''.
	'<script>'.
	"	document.getElementById('div-query').innerHTML+='$find_author <br>'".
	"</script>";
	$authors=mysqli_query($conn, $find_author);

	echo "Title: ".$result['title']." <br> ";
	echo "ISBN: ".$result['ISBN']." <br> ";
	echo "Edition: ".$result['edition']." <br> ";
  echo "Catogory: ".$result['category']." <br> ";
  echo "Price: ".$result['price']." <br> ";
  echo "Copies: ".$result['copies']." <br> ";
  echo "Shelf: ".$result['shelf']." <br> ";
	echo "Manager: $manager <br>";
	$i=0;
	while($author=mysqli_fetch_assoc($authors)) {
			$i = $i + 1;
			echo "Author $i: ".$author['name']."<br>";
	}

} else {
	die('Database is inconsistent. <br>'.
		'Multiple persons with same id. <br>'
	);
}

echo "
<a href='find_book.php'> <button> Return </button> </a>
</div>
</div>
</body>
</html>
";

 ?>
