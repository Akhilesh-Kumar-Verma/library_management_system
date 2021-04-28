
<?php

/*
 * nav.php
 *
 * Created on : 28-March-2021
 *     Author : Akhilesh Kumar Verma
 */

echo '

<div id="div-nav">
	<nav>
		<ul class="vector" id="ul-nav">
			<li> <a href="\\library\\"> Home Page </a> </li>
			<li> <a href="\\library\\about.php"> About Us </a> </li>
			<li> <a href="\\library\\contents.php"> Contents </a> </li>
			<li> <a href="\\library\\events.php"> Current Events </a> </li>
			<li> <a href="\\library\\random.php"> Random Book </a> </li>
			<li> <a href="\\library\\contact.php"> Contact Us </a> </li>
		</ul>
	</nav>
	<hr>
	<nav>
		<ul class="vector" id="ul-entry">
			<header class="list"> Entry Pages </header>
			<li> <a href="\\library\\person_entry.php"> person </a> </li>
			<li> <a href="\\library\\book_entry.php"> book </a> </li>
		</ul>
	</nav>
	<hr>
	<nav>
		<ul class="vector" id="ul-query">
			<header class="list"> Query Pages </header>
			<li> <a href="\\library\\find_person.php"> Find Person </a> </li>
			<li> <a href="\\library\\find_book.php"> Find Book </a> </li>
		</ul>
	</nav>
	<hr>
	<nav>
		<ul class="vector" id="ul-transection">
			<header class="list"> Transection Pages </header>
			<li> <a href="\\library\\issue.php"> Issue Book </a> </li>
			<li> <a href="\\library\\return.php"> Return Book </a> </li>
			<li> <a href="\\library\\status.php"> Issued Books </a> </li>
		</ul>
	</nav>
</div>

';

?>
