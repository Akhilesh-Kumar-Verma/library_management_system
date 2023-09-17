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
include("..\\..\\htconfig\\connections.php");
$conn=mysqli_connect($connection['hostName'], $connection['userName'], $connection['password'], $connection['database']);
if(!$conn) {
    die('Connection failed'.
    "Error: ".mysqli_connect_error()."<Br>");
}

$pid=$_GET['pid'];
$bid=$_GET['bid'];
$issue=$_GET['issue'];
$return=$_GET['return'];

$updateReturnDate_sql="UPDATE readers SET date_of_return = DATE '$return' WHERE person_id = $pid AND book_id = $bid AND date_of_issue = DATE '$issue' ;";
$updateCopies_sql="UPDATE books SET copies = copies + 1 WHERE id = $bid ;";
echo "
            <div id='div-query'>
                $updateReturnDate_sql <br>
                $updateCopies_sql <br>
            </div>
            <div id='div-main'>";
if(mysqli_query($conn, $updateReturnDate_sql) && mysqli_query($conn, $updateCopies_sql)) {
    echo "      Record updated sucessfully <br>";
} else {
    echo "      Error: ".mysqli_error($conn)."<br>";
}
echo "
                <a href='return.php'> <button> Return </button> </a>
            </div>
        </div>
    </body>
</html>
";
 ?>
