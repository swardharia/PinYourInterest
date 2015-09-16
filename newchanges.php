
<?php 
	include('session.php');	
	$usern=$_SESSION['login_user'];
	$conn1=$_SESSION['conn'];
	$usid=$_SESSION['login_id'];
	require_once('file.php');

	$pro = mysqli_query($conn1,"select * from user where id = (select id from login where username='$usern')");
	
	if(isset($_POST['submit']))
	{
			$fn= $_POST['fname'];;
			$ln=$_POST['lname'];
			$dob=$_POST['dob'];
			$directory="profilepic/";
			$target_file=$directory.basename($_FILES["propic"]["name"]);
			//echo $target_file;
			if(move_uploaded_file($_FILES["propic"]["tmp_name"],$target_file))
			{
				fileWrite("---Result---","File moved successfully");
			}
			else
			{
				fileWrite("---Result---","File moving unsuccessful");
			}
		//	$pic=$_REQUEST['propic'];
		//	fileWrite("---comment---",$pic);

		if((mysqli_num_rows($pro))==1)
		{
			mysqli_query($conn1,"UPDATE user SET firstname='$fn',lastname='$ln',picture='$target_file',dob='$dob' WHERE id = (select id from login where username='$usern')");
		}
		else
		{
			mysqli_query($conn1,"INSERT into user(id,firstname,lastname,picture,dob) VALUES ($usid,$fn,$ln,NULL,$dob) ");
		}
	}

	header('location:profile.php');
?>

