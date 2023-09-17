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

$bid=$_POST['bid'];
$pid=$_POST['pid'];
$password=$_POST['password'];
$sql_fetchManager="SELECT managedBy FROM books WHERE id=$bid";
echo "
<div id='div-query'>
$sql_fetchManager <br>
</div>
<div id='div-main'>";

$managed_by=mysqli_query($conn, $sql_fetchManager);
echo mysqli_error($conn);
if(mysqli_num_rows($managed_by)==1) {
  $managed_by=mysqli_fetch_assoc($managed_by)['managedBy'];
} else {
  echo "Database has either no book or multiple books for id $bid.";
  die();
}
$sql_password="SELECT password FROM credential WHERE staff_id=$managed_by ;";
echo "\n".
"<script>".
"document.getElementById('div-query').innerHTML+='$sql_password <br>'".
"</script>";

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

$findTransection_sql="SELECT * FROM readers WHERE date_of_return IS NULL AND person_id=$pid AND book_id=$bid ;";
$bookTitle_sql="SELECT title FROM books where id=$bid ;";
$personName_sql="SELECT name FROM persons where id=$pid ;";
echo        "\n".
            "<script>".
            "   document.getElementById('div-query').innerHTML+='$findTransection_sql <br>';";

$result=mysqli_query($conn, $findTransection_sql);
if(!$result) {
    die('Error: '.mysqli_error($conn));
}
if(mysqli_num_rows($result)==1) {
    $issue =mysqli_fetch_assoc($result)['date_of_issue'];
    echo        "Record <br>";
    echo "\n".
                "<script>".
                "   document.getElementById('div-query').innerHTML+='$bookTitle_sql <br>';";

                "   document.getElementById('div-query').innerHTML+='$personName_sql <br>';";
                echo "\n".
                "</script>";
                echo "".
                "Name: ".mysqli_fetch_assoc(mysqli_query($conn, $personName_sql))['name']." <br> ".
                "Title: ".mysqli_fetch_assoc(mysqli_query($conn, $bookTitle_sql))['title']." <br> ".
                "Date of Issue: $issue <br>";
    $return=date("Y-m-d");

    echo
                "Date of Return: $return <br>".
                "Fine: ".max((date_diff(date_create($issue), date_create($return))->format("%a") -15), 0)." <br>
                <a href='update_return.php?bid=$bid&pid=$pid&issue=$issue&return=$return'> <button> All done </button> </a> <br>";
} else if(mysqli_num_rows($result)==0) {
    echo "      No record found.<br>";
} else {
    echo "Error: ".mysqli_error($conn)." <br> ";
}

echo "
              <a href='return.php'> <button> Return </button> </a>
            </div>
        </div>
    </body>
</html>
";'
'
 ?>
