<?php
	include('session.php');
	require_once('file.php');
	$usern=$_SESSION['login_user'];
	$conn1=$_SESSION['conn'];


	if(isset($_POST['commt']))
{
	$upl=$_SESSION['up'];
	$pdl=$_SESSION['pi'];
	$com=$_POST['commt'];
	$myfile1 = fopen("newfile1.txt", "w") or die("Unable to open file!");
//fwrite($myfile, $cmm);


	$comuser=mysqli_query($conn1,"SELECT id FROM login WHERE username='$usern'");
	$row1=mysqli_fetch_array($comuser);


fwrite($myfile1, "..upid".$upl);
fwrite($myfile1, "..pd".$pdl);
fileWrite("---comment---",$row1[0]);
fwrite($myfile1, "..comment".$com);
fwrite($myfile1, "..comuser".$row1[0]);

   mysqli_query($conn1,"INSERT into comments(cuploaderid,cphotoid,comuserid,comment,commenttime) VALUES($upl,$pdl,$row1[0],'$com',now())");
	
//fwrite($myfile, $cmm);
fclose($myfile1);
   header('location:comment.php');
}
?>