
<?php

$title=$_POST['title'];

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
if($name="") {
    echo 'No name enterred.';
} else {
    $title='"'.$_POST['title'].'"';
    $person_sql="SELECT * FROM books WHERE title=$title";

	echo " <div id='div-query'> ".
	"$person_sql <br>".
	" </div> ";
	echo " <div id='div-main'>";
    $result=mysqli_query($conn, $person_sql);
    if(!$result) {
        die('Error: '.mysqli_error($conn));
    }

    if(mysqli_num_rows($result)==0) {
    	echo "No book with title $title is found. <br>";
    } else {
        echo ''.
        '<table class="select">'.
        '   <tr>'.
        '       <th> ID </th>'.
        '       <th> Title </th>'.
        '       <th> ISBN </th>'.
        '       <th> Edition </th>'.
        '       <th> Category </th>'.
        '       <th> Price </th>'.
        '       <th> Copies </th>'.
        '       <th> Shelf </th>'.
		'		<th> Manager </th>'.
        '       <th> Author </th>'.
        '   </tr>';

        while($row=mysqli_fetch_assoc($result)) {
            $id=$row['id'];
			$manager_sql="SELECT name FROM persons WHERE id=".$row["managedBy"]." ;";
			echo "".
			"<script>".
			"	document.getElementById('div-query').innerHTML+='$manager_sql <br>'".
			"</script>";
			$manager=mysqli_fetch_assoc(mysqli_query($conn, $manager_sql))['name'];
			$find_author="SELECT name FROM authors JOIN persons ON authors.author = persons.id WHERE authors.id=$id ;";
			echo ''.
			'<script>'.
			"	document.getElementById('div-query').innerHTML+='$find_author <br>'".
			"</script>";
			$authors=mysqli_query($conn, $find_author);
			echo "".
			"<tr>".
			"     <td> ".$row['id']." </td>".
			"     <td> ".$row['title']." </td>".
			"     <td> ".$row['ISBN']." </td>".
			"     <td> ".$row['edition']." </td>".
      "     <td> ".$row['category']." </td>".
      "     <td> ".$row['price']." </td>".
      "     <td> ".$row['copies']." </td>".
      "     <td> ".$row['shelf']." </td>".
			"	  	<td> $manager </td>".
			"	  	<td>";
			while($author=mysqli_fetch_assoc($authors)) {
				  echo $author['name']. ", ";
			}
			echo "".
			"</td>".
			"</tr>";
        }
		echo "</table>";
    }
}

echo "
<a href='find_book.php'> <button> Return </button> </a>
</div>
</div>
</body>
</html>
";

 ?>
