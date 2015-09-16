<?php
	include('session.php');
	include('connect.php');
	require_once('file.php');
	$usern=$_SESSION['login_user'];
	$conn1=$_SESSION['conn'];
	$id11=$_SESSION['login_id'];
	$id22=$_POST['id2'];

	fileWrite("---id1--",$id11);
	//fileWrite("---id2--",$id22);

    if(isset($_POST['follow'])) 
    {          
        $insfol=mysqli_query($conn1,"INSERT into followinguser(id1,id2) VALUES ($id11,$id22)");
	}

	header('location:profile.php');
?>
