
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
				Find the person by <input type='radio' name='find-person' value='id'> <label for='Find person by ID'> ID </label> <input type='radio' name='find-person' value='name'> <label for='name'> Name </label> <br> <br>
				<span id='form-findPerson'> </span>
			</div>
		</div>
		<script src='static\\find_person.js'> </script>
	</body>
</html>
";

?>
