<?php
	session_start(); // Starting Session
	$error=''; // Variable To Store Error Message
	require_once('file.php');
	if (isset($_POST['submit']))
	 {
		if (empty($_POST['username']) || empty($_POST['password'])) 
		{
			$error = "Username or Password is invalid";
		}
		else
		{
			// Define $username and $password
			$username=$_POST['username'];
			$password=$_POST['password'];
			// Establishing Connection with Server by passing server_name, user_id and password as a parameter
			$connection = mysqli_connect("localhost", "root", "","pinyourinterest");
			 
			// SQL query to fetch information of registerd users and finds user match.
			$query = mysqli_query($connection,"select * from login where password='$password' AND username='$username'");
			$rows = mysqli_num_rows($query);
			$rows1=mysqli_fetch_assoc($query);
			if ($rows == 1) {
			$_SESSION['login_user']=$username; // Initializing Session
			$_SESSION['login_id']=$rows1['id'];
			header("location: profile.php"); // Redirecting To Other Page
			} else {
			$error = "<script>alert('Username or Password invalid..')</script>";

			}
			mysqli_close($connection); // Closing Connection

		}
 	}	

?>