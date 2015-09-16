<?php
	include('session.php');
	require_once('file.php');
	$usern=$_SESSION['login_user'];
	$conn1=$_SESSION['conn'];



	if(isset($_POST['like']))
	{
	$pdl=$_POST['pi1'];

		$res1= mysqli_query($conn1,"UPDATE pics SET likes=likes+1 WHERE photoid='$pdl'");
		

   header('location:profile.php');
	}
?>