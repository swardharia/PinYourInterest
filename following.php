<?php
	include('session.php');
	include('connect.php');
	require_once('file.php');
	$usern=$_SESSION['login_user'];
	//$conn1=$_SESSION['conn'];
	$login=$_SESSION['login_id'];

	$sql="SELECT * FROM user WHERE id IN (SELECT id2 from followinguser WHERE id1=".$login.")";
	$following = mysqli_query($conn1,$sql);
	$propic = mysqli_query($conn1,"SELECT picture FROM user WHERE id = (SELECT id FROM login WHERE username='$usern')");
	$row1 = mysqli_fetch_assoc($propic);
?>

<!DOCTYPE html>
<html>
	<head>
	<title>Your Home Page</title>
	<link rel="stylesheet" type="text/css" href="design.css">
	</head>
	<body>

				<div class ="profile">
					<imgd><img src="<?php echo $row1['picture'] ?>" width="200px" height="100%" alt="NO IMAGE">
					<nv>
					<ul>
					
						<li>
						<form action="profile.php" method="post">
						<input type="submit" value="Home" style="width:100%; background-color:#123456;color:white;"></input>
						</form>
						</li>	

						<li>
						<form action="editprofile.php" method="post">
						<input type="submit" value="Edit" style="width:100%; background-color:#123456;color:white;"></input>
						</form>
						</li>	
						
						<li>
						<form action="following.php" method="post">
		    			<input type="submit" value="Following" style="width:100%; background-color:#123456;color:white;"></input>
		    			</form>
						</li>

						<li>
						<form action="board.php" method="post">
		    			<input type="submit" value="Boards" style="width:100%; background-color:#123456;color:white;"></input>
		    			</form>
						</li>
					
					</ul>
					</nv>
					</imgd>
					<usernam> <?php echo $login_session; ?></usernam>
					<form action="search.php" method="post">
					<input type= "text" placeholder = "Search" name="stext">
					<class="btn-group profileinfo">
		    		<input type="submit" name="sbutton" value="Search"></input>
		    		<input type="radio" name="search" value="u" > <font color="white">Users </input>
		    		<input type="radio" name="search" value="t" > Tags </font></input>
		    		</form>
		    		
					<logoutb><a href="logout.php">Log Out</a></logoutb>
				</div>
				
				<div class="contents">

					<?php while( $row2 = mysqli_fetch_assoc( $following )) {  ?>
					<div class ="imge">
						<h3 align="center"><?php echo "- " . $row2["firstname"] ." ". $row2["lastname"];?></h3>
						
						<img src=" <?php echo $row2["picture"]; ?>" ></img>
						<br>
						<ul>
							
							<li>
								D.O.B-<?php echo $row2["dob"]; ?>
							</li>
							
						</ul>
				    </div>
					<?php } ?>
				</div>
		
	</body>
</html>