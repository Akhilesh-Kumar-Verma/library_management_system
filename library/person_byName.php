
<?php

$name=$_POST['name'];

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
    $name='"'.$_POST['name'].'"';
    $person_sql="SELECT * FROM persons WHERE name=$name ;";

	echo " <div id='div-query'> ".
	"$person_sql <br>".
	" </div> ";
	echo " <div id='div-main'>";
    $result=mysqli_query($conn, $person_sql);
    if(!$result) {
        die('Error: '.mysqli_error($conn));
    }

    if(mysqli_num_rows($result)==0) {
    	echo "No person with name $name is found. <br>";
    } else {
        echo ''.
        '<table class="select">'.
        '   <tr>'.
        '       <th> ID </th>'.
        '       <th> Name </th>'.
        '       <th> Current Address </th>'.
        '       <th> Permanent Address </th>'.
        '       <th> Email </th>'.
        '       <th> Phone </th>'.
        '   </tr>';

        while($row=mysqli_fetch_assoc($result)) {
            $id=$row['id'];
			$find_email="SELECT email FROM emails WHERE id=$id ;";
			echo ''.
			'<script>'.
			"	document.getElementById('div-query').innerHTML+='$find_email <br>'".
			"</script>";
			$find_phone="SELECT phone FROM phones WHERE id=$id ;";
			echo "".
			"<script>".
			"	document.getElementById('div-query').innerHTML+='$find_phone <br>'".
			"</script>";
			$phones=mysqli_query($conn, $find_phone);
			$emails=mysqli_query($conn, $find_email);
			echo "".
			"<tr>".
			"     <td> ".$row['id']." </td>".
			"     <td> ".$row['name']." </td>".
			"     <td> ".$row['current_address']." </td>".
			"     <td> ".$row['permanent_address']." </td>".
			"	  <td>";
			while($email=mysqli_fetch_assoc($emails)) {
				  echo $email['email']. ", ";
			}
			echo "".
			"</td>".
			"<td>";
			while($phone=mysqli_fetch_assoc($phones)) {
				  echo $phone['phone']. ", ";
			}
			echo "".
			"</td>".
			"</tr>";
        }
		echo "</table>";
    }
}
echo "<a href='find_person.php'> <button> Return </button> </a> </div> </div> </body> </html>"
 ?>
