
document.getElementsByName('same-addresses')[0].checked = true;

document.getElementsByName('same-addresses')[1].onclick = function (event) {
	document.getElementById('permanent-address').innerHTML = 'Permanent Address <input name="permanent-address" type="text" class="input" placeholder="permanent address"> <br> <br>';
};

document.getElementsByName('same-addresses')[0].onclick = function (event) {
	document.getElementById('permanent-address').innerHTML = '';
};

document.getElementsByName('add-email')[0].onclick = function (event) {
	document.getElementById('email').innerHTML += '<label for="email" class="label-email"> Email Address </label> <input name="email[]" type="text" class="input" placeholder="email address"> <br> <br>';
}

document.getElementsByName('add-phone')[0].onclick = function (event) {
	document.getElementById('phone').innerHTML += ' <label for="phone-number" class="label-phone"> Phone Number </label> <input name="phone[]" type="text" class="input" placeholder="phone number"> <br> <br> ';
}

/*
document.getElementById('person-entry').onclick=function (event) {
	let name = document.getElementsByName('name')[0].value;
	let current_address = document.getElementsByName('current-address')[0].value;
	let permanent_address;
	if(document.getElementsByName ('same-addresses')[0].checked) {
		permanent_address = current_address;
	} else if (document.getElementsByName('same-addresses')[1].checked) {
		permanent_address = document.getElementsByName('permanent-address')[0].value;
	} else {
		permanent_address = '';
	}
	let dob = document.getElementsByName('dob')[0].value;
	emails=document.getElementsByName('email');
	for (let i=0; i<emails.length; ++i) {
		console.log(emails[i].value);
	}
	phones=document.getElementsByName('phone');
	for (let i=0; i<phones.length; ++i) {
		console.log(phones[i].value);
	}

	console.log(name);
	console.log(current_address);
	console.log(permanent_address);
	console.log(dob);
}
 */

