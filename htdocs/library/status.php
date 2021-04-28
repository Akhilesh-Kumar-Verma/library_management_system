
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
		</div>
		<div id='div-main'>
			<form action='issuedBooks.php' method='post'>
				<label for='ID of the person'> ID of the person </label> <input type='number' placeholder='ID' name='id'>
				<input type='submit' value='search'>
			</form>
		</div>
	</body>
</html>
";

?>
