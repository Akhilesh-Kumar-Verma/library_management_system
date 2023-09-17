
<?php

echo "
<!DOCTYPE html>
<html lang='en'>
	<head>
		<title>Central Library</title>
		<meta charset='utf-8'>
		<link rel='stylesheet' href='.\\static\\style.css'>
		<link rel='stylesheet' href='.\\static\\book_entry.css'>
	</head>

	<body>";
include(".\\includes\\head.php");
	echo '<div class="div-container">';

include(".\\includes\\nav.php");

echo "
			<div id='div-main'>
			<form action='insert_book.php' method='post'>
				<label for='title'> Title of the book </label> <input name='title' type='text' class='input' placeholder='title'> <br> <br>
				<label for='ISBN'> ISBN </label> <input name='ISBN' type='text' class='input' placeholder='ISBN'> <br> <br>
				<label for='Edition'> Edition </label> <input name='edition' type='text' class='input' placeholder='edition'> <br> <br>
				<label for='Category'> Category </label> <input name='category' type='text' class='input' placeholder='category'> <br> <br>
				<label for='Price'> Price </label> <input name='price' type='text' class='input' placeholder='price'> <br> <br>
				<label for='Copies'> Copies </label> <input name='copies' type='text' class='input' placeholder='copies'> <br> <br>
				<label for='Shelf'> Shelf </label> <input name='shelf' type='text' class='input' placeholder='shelf number'> <br> <br>
				<span id = 'author'>
					<label for=\"author\" class=\"label-author\"> Author </label> <input name=\"author[]\" type=\"number\" class=\"input\" placeholder=\"author\"> <br> <br>
				</span>
				<input type='button' name='add-author' value='Add Author'> <br> <br>
				<label for='manager'> Managed By </label> <input name='managedBy' type='text' class='input' placeholder='manager id'> <br> <br>
				<label for='password'> Password </label> <input name='password' type='password' class='input' placeholder='password of manager'> <br> <br>
				<input type='submit'>
			</form>
			</div>
		</div>
		<script src='static\\book_entry.js'> </script>
	</body>
</html>
";

 ?>
