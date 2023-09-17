
document.getElementsByName('add-author')[0].onclick = function (event) {
	document.getElementById('author').innerHTML += '<label for="author" class="label-author"> Author </label> <input name="author[]" type="text" class="input" placeholder="author"> <br> <br>';
}

