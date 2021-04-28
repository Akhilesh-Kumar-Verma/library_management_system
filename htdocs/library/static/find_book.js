
document.getElementsByName('find-book')[1].checked=false;
document.getElementsByName('find-book')[0].checked=true;
document.getElementById('form-findBook').innerHTML= ""+
	"<form action='book_byID.php' method='post'>"+
	"	<label for='Id of the Book'> ID </label> <input type='number' name='id' placeholder='ID'>"+
	"	<input type='submit' value='Search'>"+
	"</form>";

document.getElementsByName('find-book')[0].onclick = function (event) {
	document.getElementById('form-findBook').innerHTML= ""+
		"<form action='book_byID.php' method='post'>"+
		"	<label for='Id of the book'> ID </label> <input type='number' name='id' placeholder='ID'>"+
		"	<input type='submit' value='Search'>"+
		"</form>";
}

document.getElementsByName('find-book')[1].onclick = function (event) {
	document.getElementById('form-findBook').innerHTML= ""+
		"<form action='book_byName.php' method='post'>"+
		"	<label for='Name of the book'> Title </label> <input type='text' name='title' placeholder='title'>"+
	 	"	<input type='submit' value='Search'>"+
		"</form>";
}
