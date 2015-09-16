<?php

	// Establishing Connection with Server by passing server_name, user_id and password as a parameter
	$connection = mysqli_connect("localhost", "root", "","pinyourinterest");
	 
	session_start();// Starting Session
	// Storing Session
	$user_check=$_SESSION['login_user'];
	// SQL Query To Fetch Complete Information Of User
	 
	$ses_sql=mysqli_query($connection,"select username from login where username='$user_check'");
	$row = mysqli_fetch_assoc($ses_sql);
	 
	$login_session =$row['username'];
	$_SESSION['conn']=$connection;
	if(!isset($login_session))
	{
		mysqli_close($connection); // Closing Connection
		//header('Location: first.php'); // Redirecting To Home Page
	}
	//session_destroy();

?>