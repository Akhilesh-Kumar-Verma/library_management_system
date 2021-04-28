
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

$sql_fetchManager="SELECT managedBy, copies FROM books WHERE id=$bid";
echo "
<div id='div-query'>
$sql_fetchManager <br>
</div>
<div id='div-main'>";

$managed_by=mysqli_query($conn, $sql_fetchManager);
if(mysqli_num_rows($managed_by)==1) {
  $managed_by=mysqli_fetch_assoc($managed_by)['managedBy'];
} else {
  echo "Database has either no book or multiple books for id $bid.";
  die();
}
$copies=mysqli_query($conn, $sql_fetchManager);
if(mysqli_num_rows($copies)==1) {
  $copies = mysqli_fetch_assoc($copies)['copies'];
  if($copies<=0) {
    echo "Library has no copy of book to issue.";
    die();
  }
} else {
  echo "";
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


$numberofIssuedBooks_sql="SELECT COUNT(*) FROM readers WHERE person_id = $pid AND date_of_return IS NULL ; ";
$sameIssuedBook_sql="SELECT COUNT(*) FROM readers WHERE book_id = $bid AND person_id = $pid AND date_of_return IS NULL ;";
$date=date('Y-m-d');
$tbl="readers(person_id, book_id, date_of_issue)";
$insertTransection_sql="INSERT INTO $tbl VALUES ($pid, $bid, DATE \"$date\") ;";
$bookTitle_sql="SELECT title FROM books WHERE id=$bid ;";
$personName_sql="SELECT name FROM persons WHERE id=$pid ;";
$updateCopies_sql="UPDATE books SET copies = copies - 1 WHERE id = $bid ;";

echo "\n".
"<script>".
"document.getElementById('div-query').innerHTML+='$personName_sql <br>'".
"</script>";
$name=mysqli_query($conn, $personName_sql);
if(mysqli_num_rows($name)==0) {
  echo "No person with ID $pid is found.";
  die();
}
$name = mysqli_fetch_assoc($name)['name'];
echo "Name: $name <br> ";
echo "\n".
"<script>".
"document.getElementById('div-query').innerHTML+='$numberofIssuedBooks_sql <br>'".
"</script>";
$no=mysqli_fetch_assoc(mysqli_query($conn, $numberofIssuedBooks_sql))['COUNT(*)'];
echo "\n".
"<script>".
"document.getElementById('div-query').innerHTML+='$sameIssuedBook_sql <br>' ".
"</script>";
$same=mysqli_fetch_assoc(mysqli_query($conn, $sameIssuedBook_sql))['COUNT(*)'];
if($no>=5) {
    echo "
               You have issued $no books. <br>";
} else if ($same>=1) {
    echo "You have already issued $same copy of the same book. <br>";
} else {
  echo "\n".
  "<script>".
  "document.getElementById('div-query').innerHTML+='$insertTransection_sql <br>'".
  "</script>";
  echo "\n".
  "<script>".
  "document.getElementById('div-query').innerHTML+='$updateCopies_sql <br>' ".
  "</script>";

    if(mysqli_query($conn, $insertTransection_sql) and mysqli_query($conn, $updateCopies_sql)) {
      echo "\n".
      "<script>".
      "document.getElementById('div-query').innerHTML+='$bookTitle_sql <br>' ".
      "</script>";
        echo "Title: ".mysqli_fetch_assoc(mysqli_query($conn, $bookTitle_sql))['title']. " <br> ".
        "Inserted Record successfully <br>";
    } else {
        echo "Error: ".mysqli_error($conn)." <br> ";
    }
}

echo "
                <a href='issue.php'> <button> Return </button> </a>
            </div>
        </div>
    </body>
</html>
";
 ?>
