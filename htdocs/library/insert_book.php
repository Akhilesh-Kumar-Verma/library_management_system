
<?php
echo "
<html lang='en'>
<head>
<meta charser='utf-8'>
<title> Central Library </title>
<link rel=stylesheet href='static\\style.css'
</head>

<body>";
include(".\\includes\\head.php");
echo '<div class="div-container">';
include("includes\\nav.php");

$title=$_POST['title'];
$ISBN=$_POST['ISBN'];
$edition=$_POST['edition'];
$category=$_POST['category'];
$price=$_POST['price'];
$copies=$_POST['copies'];
$shelf=$_POST['shelf'];
$managed_by=$_POST['managedBy'];
$password=$_POST['password'];

// prepare the fields
if($title=="") {
$title='NULL';
} else {
$title='"'.$title.'"';
}

if($ISBN=="") {
$ISBN="NULL";
} else {
$ISBN='"'.$ISBN.'"';
}

if($edition=='') {
$edition='NULL';
} else {
$edition='"'.$edition.'"';
}

if($category=="") {
$category='NULL';
} else {
$category='"'.$category.'"';
}

if($price=='') {
$price='NULL';
} else {
$price='"'.$price.'"';
}

if($copies=="") {
$copies='NULL';
} else {
$copies='"'.$copies.'"';
}

if($shelf=="") {
$shelf='NULL';
} else {
$shelf='"'.$shelf.'"';
}

if($managed_by=="") {
$managed_by="NULL";
}

include('..\\..\\htconfig\\connections.php');
$conn=mysqli_connect($connection['hostName'], $connection['userName'], $connection['password'], $connection['database']);
if(!$conn) {
die('Connection error: '.mysqli_connect_error());
}

$sql_password="SELECT * FROM credential WHERE staff_id=$managed_by ;";
echo "
<div id='div-query'>
$sql_password <br>
</div>
<div id='div-main'>";
$verified=false;
$result=mysqli_query($conn, $sql_password);
$i=mysqli_num_rows($result);
if($i>0) {
  while($i>0) {
    $pass=mysqli_fetch_assoc($result)['password'];
    if($pass==$password) {
      $verified=true;
      break;
    }
    $i=$i-1;
  }
  if(!$verified) {
    echo "Wrong Password" ;
    die();
  }
} else {
die('Something went wrong. <br>'.
'Database is in inconsistent state. <br>'.
'Not exactly one record has maximum id');
}

// prepare the query
$table='books ( title, ISBN, edition, category, price, copies, shelf, managedBy )';
$insertPerson_sql='INSERT INTO '.$table.' VALUES ('.$title.', '.$ISBN.', '.$edition.', '.$category.', '.$price.', '.$copies.', '.$shelf.', '.$managed_by.');';
echo "".
"<script>".
"	document.getElementById('div-query').innerHTML+='$insertPerson_sql <br>'".
"</script>";

// insert the record
if(mysqli_query($conn, $insertPerson_sql)) {
echo 'Record inserted sucessfully <br>';
echo 'ID: '.mysqli_insert_id($conn).' <br> ';
} else {
die('Record insertion failed. <br>'.
'Error: '.mysqli_error($conn)).' <br> ';
}

// fetch the id of the newly inserted record
// To do this we will fetch the maximum id in the table
$fetchID_sql = 'SELECT MAX(id)
FROM books';
echo "".
"<script>".
"	document.getElementById('div-query').innerHTML+='$fetchID_sql <br>'".
"</script>";

$result=mysqli_query($conn, $fetchID_sql);
if(mysqli_num_rows($result)==1) {
$result=mysqli_fetch_assoc($result)['MAX(id)'];
echo 'Book ID is '.$result.' <br> ';
} else {
die('Something went wrong. <br>'.
'Database is in inconsistent state. <br>'.
'Not exactly one record has maximum id');
}

$authors=$_POST['author'];
if (sizeof($authors) > 0) {
foreach ($authors as $author) {
// prepare the phone for insert
if($author=='') {
$author='NULL';
continue;
}
$insertAuthor_sql='INSERT INTO authors (id, author) VALUES ('.
$result.', '.$author.');';
echo "".
"<script>".
"	document.getElementById('div-query').innerHTML+='$insertAuthor_sql <br>'".
"</script>";

if(mysqli_query($conn, $insertAuthor_sql)) {
echo 'Author no.: '.$author.' inserted successfully. <br>';
} else {
echo "Can't insert phone number $author <br>".
'Error: '.mysqli_error($conn);
}
}
}
mysqli_close($conn);

echo "<a href='book_entry.php'> <button> Return </button> </a>";
echo "
</div>
</div>
</body>
</html>
";

?>
