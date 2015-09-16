<?php
	session_start(); // Starting Session
	$error=''; // Variable To Store Error Message
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
			$query1 = mysqli_query($connection,"update login set online=0 where online=1");
			$query = mysqli_query($connection,"insert into login (username,password,online) values ('$username','$password',1)");
			
			if ($query) {
			$_SESSION['login_user']=$username; // Initializing Session
			$_SESSION['conn']=$connection;
			header("location: profile.php"); // Redirecting To Other Page
			} else {
			echo "Error: " . $query . "<br>" . mysqli_error($connection);
			}
			mysqli_close($connection); // Closing Connection

		}
 	}	
 	
?>