
<?php
echo "
<html lang='en'>
    <head>
        <meta charser='utf-8'>
        <title> Central Library </title>
        <link rel=stylesheet href='static\\style.css'
    </head>

    <body>";
  include(".\\includes\\head.php");
  	echo '<div class="div-container">';
include("includes\\nav.php");

$name=$_POST['name'];
$current_address=$_POST['current-address'];
$cond = $_POST['same-addresses'];
if ($cond=='no') {
	$permanent_address=$_POST['permanent-address'];
} else if ($cond=='yes') {
	$permanent_address=$_POST['current-address'];
} else {
	die('Something went wrong');
}
$dob=$_POST['dob'];

include('..\\..\\htconfig\\connections.php');
$conn=mysqli_connect($connection['hostName'], $connection['userName'], $connection['password'], $connection['database']);
if(!$conn) {
	die('Connection error: '.mysqli_connect_error());
}

// prepare the fields
if($name=="") {
	$name='NULL';
} else {
	$name='"'.$name.'"';
}

if($current_address=="") {
	$current_address="NULL";
} else {
	$current_address='"'.$current_address.'"';
}

if($permanent_address=='') {
	$permanent_address='NULL';
} else {
	$permanent_address='"'.$permanent_address.'"';
}

if($dob=="") {
	$dob='NULL';
} else {
	$dob='DATE "'.$dob.'"';
}

// prepare the query
$table='persons (name, current_address, permanent_address, date_of_birth)';
$insertPerson_sql='INSERT INTO '.$table.' VALUES ('.$name.', '.$current_address.', '.$permanent_address.', '.$dob.');';
echo "
<div id='div-query'>
	$insertPerson_sql <br>
</div>
<div id='div-main'>";

// insert the record
if(mysqli_query($conn, $insertPerson_sql)) {
	echo 'ID: '.mysqli_insert_id($conn).' <br> ';
	echo 'Record inserted sucessfully <br> ';

} else {
	die('Record insertion failed. <br>'.
	'Error: '.mysqli_error($conn)).' <br> ';
}

// fetch the id of the newly inserted record
// To do this we will fetch the maximum id in the table
$fetchID_sql = 'SELECT MAX(id)
	FROM persons';
$result=mysqli_query($conn, $fetchID_sql);
if(mysqli_num_rows($result)==1) {
	$result=mysqli_fetch_assoc($result)['MAX(id)'];
} else {
	die('Something went wrong. <br>'.
		'Database is in inconsistent state. <br>'.
		'Not exactly one record has maximum id');
}

$emails=$_POST['email'];
if (sizeof($emails) > 0) {
	foreach ($emails as $email) {
		// prepare the email for insert
		if($email=='') {
			$email='NULL';
			continue;
		} else {
			$email='"'.$email.'"';
		}

		$insertEmail_sql='INSERT INTO emails (id, email) VALUES ('.
			$result.', '.$email.');';
      echo "".
    	"<script>".
    	"	document.getElementById('div-query').innerHTML+='$insertEmail_sql <br>'".
    	"</script>";
		if(mysqli_query($conn, $insertEmail_sql)) {
			echo 'Email id: '.$email.' inserted successfully. <br> ';
		} else {
			echo 'Can\'t insert email '.$email.' <br> ';
		}
	}
}

$phones=$_POST['phone'];
if (sizeof($phones) > 0) {
	foreach ($phones as $phone) {
		// prepare the phone for insert
		if($phone=='') {
			$phone='NULL';
			continue;
		} else {
			$phone='"'.$phone.'"';
		}
		$insertPhone_sql='INSERT INTO phones (id, phone) VALUES ('.
			$result.', '.$phone.');';
      echo "".
    	"<script>".
    	"	document.getElementById('div-query').innerHTML+='$insertPhone_sql <br>'".
    	"</script>";
		if(mysqli_query($conn, $insertPhone_sql)) {
			echo 'Phone no.: '.$phone.' inserted successfully. <br>';
		} else {
			echo "Can't insert phone number $phone <br>/.";
		}
	}
}

echo "
                <a href='person_entry.php'> <button> Return </button> </a>
            </div>
        </div>
    </body>
</html>
";
mysqli_close($conn);

?>
