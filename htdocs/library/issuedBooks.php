
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

$readers_sql="SELECT * FROM readers JOIN books ON book_id=id WHERE person_id=$id;";
echo " <div id='div-query'> "."$readers_sql"." </div> ";
echo " <div id='div-main'>";
$result=mysqli_query($conn, $readers_sql);
if(mysqli_num_rows($result)>0) {
    echo ''.
    '<table class="select">'.
    '   <tr>'.
    '       <th> Book ID </th>'.
    '       <th> Title </th>'.
    '       <th> Date of Issue </th>'.
    '       <th> Date of Return </th>'.
    '       <th> Fine </th>'.
    '   </tr>';

    while($row=mysqli_fetch_assoc($result)) {
        echo "".
        "<tr>".
        "     <td> ".$row['book_id']." </td>".
        "     <td> ".$row['title']." </td> ".
        "     <td> ".$row['date_of_issue']." </td>";
        if($row['date_of_return']=="") {
            echo "<td> Not returned yet";
            echo "<td> ".max(date_diff(date_create($row['date_of_issue']), date_create("now"))->format("%a"), 0)." yet </td>";
        } else {
            echo
            "     <td> ".$row['date_of_return']." </td>";
            echo "<td> ".max(date_diff(date_create($row['date_of_issue']), date_create($row['date_of_return']))->format("%a"), 0)." </td>";
        }
        echo "    </tr>";
    }
    echo "</table>";
} else if(mysqli_num_rows($result)==0) {
    echo "no records found";
} else {
	die('Database is inconsistent. <br>');
}
echo "
					<br> <a href='status.php'> <button> Return </button> </a>
			</div>
		</div>
	</body>
</html>
";
 ?>
