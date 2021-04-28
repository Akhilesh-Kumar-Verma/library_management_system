
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
				Find book by <input type='radio' name='find-book' value='id'> <label for='Find book by ID'> ID </label> <input type='radio' name='find-book' value='title'> <label for='title'> Title </label> <br> <br>
				<span id='form-findBook'> </span>
			</div>
		</div>
		<script src='static\\find_book.js'> </script>
	</body>
</html>
";

?>
