<?php
	session_start();
	if(session_destroy()) // Destroying All Sessions
	{
		header("Location: first.php"); // Redirecting To Home Page
	}
?>