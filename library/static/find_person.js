
document.getElementsByName('find-person')[0].checked=true;
document.getElementById('form-findPerson').innerHTML= ""+
	"<form action='person_byID.php' method='post'>"+
	"	<label for='Id of the person'> ID </label> <input type='number' name='id' placeholder='ID'>"+
	"	<input type='submit' value='Search'>"+
	"</form>";

document.getElementsByName('find-person')[0].onclick = function (event) {
	document.getElementById('form-findPerson').innerHTML= ""+
		"<form action='person_byID.php' method='post'>"+
		"	<label for='Id of the person'> ID </label> <input type='number' name='id' placeholder='ID'>"+
		"	<input type='submit' value='Search'>"+
		"</form>";
}

document.getElementsByName('find-person')[1].onclick = function (event) {
	document.getElementById('form-findPerson').innerHTML= ""+
		"<form action='person_byName.php' method='post'>"+
		"	<label for='Name of the person'> Name </label> <input type='text' name='name' placeholder='name'>"+
	 	"	<input type='submit' value='Search'>"+
		"</form>";
}

