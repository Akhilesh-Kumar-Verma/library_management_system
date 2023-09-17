
<?php

echo "
<!DOCTYPE html>
<html lang='en'>
	<head>
		<title>Central Library</title>
		<meta charset='utf-8'>
		<link rel='stylesheet' href='.\\static\\style.css'>
		<link rel='stylesheet' href='.\\static\\person_entry.css'>
	</head>

	<body>";
include(".\\includes\\head.php");
	echo '<div class="div-container">';

include(".\\includes\\nav.php");

echo "
			<div id='div-main'>
			<form action='insert_person.php' method='post'>
				<label for='name'> Name of the person </label> <input name='name' type='text' class='input' placeholder='name'> <br> <br>
				<label for='current-address'> Current Address </label> <input name='current-address' type='text' class='input' placeholder='curent address'> <br> <br>
				Do you have same permanemt address <input type='radio' name='same-addresses' value='yes'> <label for='yes'> yes </label> <input type='radio' name='same-addresses' value='no'> <label for='no'> no </label> <br> <br>
				<span id='permanent-address'> </span>

				<span id = 'email'>
					<label for=\"email\" class=\"label-email\"> Email Address </label> <input name=\"email[]\" type=\"text\" class=\"input\" placeholder=\"email address\"> <br> <br>
				</span>
				<input type='button' name='add-email' value='Add email address'> <br> <br>
				<span id = 'phone'>
					<label for=\"phone-number\" class=\"label-phone\"> Phone Number </label> <input name=\"phone[]\" type=\"text\" class=\"input\" placeholder=\"phone number\"> <br> <br>
				</span>

				<input type='button' name='add-phone' value='Add phone number'> <br> <br>
				<label for='date-of-birth'> Date of Birth </label> <input name='dob' type='date' class='input' placeholder='date of birth'> <br> <br>

				<input type='submit'>
			</form>
			</div>
		</div>
		<script src='static\\person_entry.js'> </script>
	</body>
</html>
";

?>
