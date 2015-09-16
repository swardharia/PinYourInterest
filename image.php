<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password,"pinyourinterest");

// Check connection
if (!$conn) {
    die("Connection failed:" . mysqli_connect_error());
} 
$result = mysqli_query($conn,"select * from pics");
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="generator" content="CoffeeCup HTML Editor (www.coffeecup.com)">
    <meta name="dcterms.created" content="Thu, 23 Apr 2015 06:19:41 GMT">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title></title>
    <link rel="stylesheet" type="text/css" href="design.css">
    <!--[if IE]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
  <body>
<?php while($row = mysqli_fetch_assoc($result)) {
 ?>
<div id="imge">
<img src=" <?php echo $row["photo"]; ?>" width="200px" height="200px">
<br>
<br>
<?php echo "-id : " . $row["photoid"] ;?>
<br>
<?php
echo "- name : " . $row["photoname"] ; ?>
</div>
<?php } ?>
  </body>
</html>