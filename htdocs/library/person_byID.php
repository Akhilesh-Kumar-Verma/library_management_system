
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

$person_sql="SELECT * FROM persons WHERE id=$id ;";
echo " <div id='div-query'> "."$person_sql"." <br></div> ";
echo " <div id='div-main'>";
$result=mysqli_query($conn, $person_sql);
if(mysqli_num_rows($result)==0) {
	echo 'No person with this id is found. <br>';
} else if(mysqli_num_rows($result)==1) {
	$result=mysqli_fetch_assoc($result);
	echo "Name: ".$result['name']." <br> ";
	echo "Current address: ".$result['current_address']." <br> ";
	echo "Permanent address: ".$result['permanent_address']." <br> ";
	echo "Date of birth: ".$result['date_of_birth']."<br>";
	$date=date("Y-m-d");
	echo "Date: $date <br> ";
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
	$i=0;
	while($email=mysqli_fetch_assoc($emails)) {
			$i = $i + 1;
			echo "Email $i: ".$email['email']."<br>";
	}
	$i=0;
	while($phone=mysqli_fetch_assoc($phones)) {
			$i = $i + 1;
			echo "Phone $i: ".$phone['phone']."<br>";
	}

} else {
	die('Database is inconsistent. <br>'.
		'Multiple persons with same id. <br>'
	);
}
echo "
					<a href='find_person.php'> <button> Return </button> </a>
			</div>
		</div>
	</body>
</html>
";
 ?>
