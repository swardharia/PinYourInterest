<?php
	include('session.php');
	include "connect.php";
	$usern=$_SESSION['login_user'];
	$conn1=$_SESSION['conn'];


	if(isset($_POST['delb']))
	{

	$name=$_POST['del'];
	$path="images/".$name.".jpg";
	$ch=mysqli_query("SET foreign_key_checks = 0");
	$comuser=mysqli_query($conn1,"DELETE FROM boards WHERE bitemid=(SELECT photoid from pics where photo='$path' ");
	//echo "hello".$path;
	}
	header('location:board.php');
?>