<?php
	include('session.php');
	require_once('file.php');
	$conn1=$_SESSION['conn'];
	$userId=$_SESSION["login_id"];
	$boardid = $_POST["bdid"];
	//echo "$boardid";
	

	if(isset($_POST["pin"]))
	{	

		//echo "OOps";
		fileWrite("-----hello----","swar");
		$url = $_POST["url"];
		$row3=$_POST["pid"];
		$boardid = $_POST["bdid"];
		fileWrite("-----hello----",$url.",".$row3.",".$boardid);

		$sql = "INSERT into boards VALUES('',$boardid,$row3,now())";
		$res=mysqli_query($conn1,$sql);
		
	}
	header('location:profile.php');
	
?>