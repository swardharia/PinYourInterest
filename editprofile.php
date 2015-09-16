
<?php 
	include('session.php');	
	$usern=$_SESSION['login_user'];
	$conn1=$_SESSION['conn'];
	$usid=$_SESSION['login_id'];

	$pro = mysqli_query($conn1,"select * from user where id = (select id from login where username='$usern')");

	if((mysqli_num_rows($pro))==1)
	{
	
	$row1 = mysqli_fetch_assoc($pro);

	$fn= $row1['firstname'];;
	$ln=$row1['lastname'];
	$dob=$row1['dob'];
	$pic=$row1['picture'];
	}

	else
	{
		$fn= "First Name";
		$ln="Last Name";
		$dob="yyyy-mm-dd";
		//$pic=NULL;
	}

?>

<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="design.css">
 
<div class="testbox">
 
  <h1>Profile</h1>
 	
  <form action="newchanges.php" method="post" enctype="multipart/form-data">
      
  
		<br> <h4 align="center">First Name :  <br><input type="text" name="fname" id="fname" value='<?php echo $fn;?>' required/></h4>
		<br> <h4 align="center">Last Name :  <br><input type="text" name="lname" id="lname" value='<?php echo $ln;?>' required/></h4>
		<br><h4 align="center">Date Of Birth :  <br><input type="text" name="dob" id="idob" value='<?php echo $dob;?>' required/></h4>
		<br><h4 align="center">Profile Picture :  <br><input type="file" name="propic" id="propic" accept="image/jpeg,image/png" /></h4>
	 	<div class="logt"> <input type="submit" name="submit" value="Save" > </div>
	  			 
	
  </form>
  

</div>
</body>