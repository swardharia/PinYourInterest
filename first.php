<?php
	include('login.php'); // Includes Login Script
	 
	 
	if(isset($_SESSION['login_user']))
	{
	header("location: profile.php");
	}
?>
 
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="design.css">
 
<div class="testbox">
 
  <div id="pin"> </div>
  <h1>Sign - In</h1>
 	
  <form action="" method="post">
      
  
<br> <h4 align="center">UserName :  <br><input type="text" name="username" id="username" placeholder="Email" required/></h4>
 <!-- <label id="icon" for="name"><i class="icon-user"></i></label>       -->
 <!-- <input type="text" name="name" id="name" placeholder="Name" required/> -->
 <!-- <label id="icon" for="name"><i class="icon-shield"></i></label>-->
<br><h4 align="center">Password :  <br><input type="password" name="password" id="password" placeholder="Password" required/></h4>
   
 	<p>Not a member ? <br><a href="second.php"> Sign - Up  </a></p>
  <logt> <input type="submit" name="submit" value="Login" > </logt>

   <span><?php echo $error; ?></span>
  </form>
  

</div>
</body>