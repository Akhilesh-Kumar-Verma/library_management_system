
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

echo "
			<div id='div-main'>
			<form action='tran_return.php' method='post'>
				<label for='person id'> ID of the person </label> <input name='pid' type='number' class='input' placeholder='Person ID'> <br> <br>
				<label for='book id'> ID of the book issued </label> <input name='bid' type='number' class='input' placeholder='Book ID'> <br> <br>
				<label for='password'> password </label> <input name='password' type='password' class='input' placeholder='password of manager'> <br> <br>
				<input type='submit' value='return'>
			</form>
			</div>
		</div>
	</body>
</html>
";

?>
