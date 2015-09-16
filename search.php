<?php
	include('session.php');
	include('connect.php');
	require_once('file.php');
	$usern=$_SESSION['login_user'];
	$conn1=$_SESSION['conn'];
	$quer=$_POST['stext'];

	$propic = mysqli_query($conn1,"select picture from user where id = (select id from login where username='$usern')");
	$row1 = mysqli_fetch_assoc($propic);

	$serres = "";

    if($_POST["search"] && isset($_POST['sbutton'])) 
    {          
        $serres = $_POST["search"]; 
        fileWrite("---t---",$serres);
	    if($serres=="t")
	    {
		$tags = mysqli_query($conn1,"SELECT * FROM pics WHERE photoid IN (SELECT picid FROM pictags WHERE tagid in (SELECT tagid FROM tags WHERE tagname LIKE '%".$quer."%'))");
		fileWrite("---t---","inside");
		}

		elseif ($serres=="u") {
			$tags=mysqli_query($conn1,"SELECT * FROM user WHERE firstname LIKE '%".$quer."%' OR lastname LIKE '%".$quer."%'");
			fileWrite("---u---","inside");
		}

	}

?>

<!DOCTYPE html>
<html>
	<head>
	<title>Search Page</title>
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

					<?php 

					if($serres=="t") {

					while($row2 = mysqli_fetch_assoc($tags)) {  ?>
					
					<div class ="imge">
						<h3 align="center"><?php echo "- " . $row2["photoname"] ;?></h3>
						
						<img src=" <?php echo $row2["photo"]; ?>" ></img>
						<br>
						<ul>
							<li>
							<form action="like.php" method="post">
							<input type="submit" name="like" value="LIKE"></input>
							<input type="hidden" name="pi1" value="<?php echo $row2["photoid"];?>">
							<input type="hidden" name="up1" value="<?php echo $row2["uploadid"];?>">
							</form>
							</li>
							
							<li>

								<like>
									<?php
										$likes = mysqli_query($conn1,"select likes from pics where photoid={$row2['photoid']}");
										$row4= mysqli_fetch_array($likes);
										echo $row4[0]; 		
										if($row4[0]<1)
											{echo 0;}
										?>
								</like>
							</li>

							<li>
								<form action="comment.php" method="post">
							<!--	<a href="comment.php?phid=<?php echo $row2["photoid"]; ?>">   -->
								<input type="submit" id="comment" value="COMMENT"></input>
								<input type="hidden" name="pi" value="<?php echo $row2["photoid"];?>">
								<input type="hidden" name="up" value="<?php echo $row2["uploadid"];?>">
								</form>
							</li>
							
							<li>
								<like>
									<?php
										$comments = mysqli_query($conn1,"select count(cphotoid) from comments group by cphotoid having cphotoid={$row2['photoid']}");
										$row3= mysqli_fetch_array($comments);
										echo $row3[0];
										if($row3[0]<1)
											{echo 0;}
									?>
								</like>
							</li>
								
						</ul>
				    </div>
					<?php } }

					else if($serres=="u") {

					while($row2 = mysqli_fetch_assoc($tags)) {  
					$fol= mysqli_query($conn1,"SELECT * FROM followinguser WHERE id1 =".$_SESSION['login_id']." AND id2 ={$row2['id']}");
					$nfol=mysqli_num_rows($fol); 
					?>
					<div class ="imge">
						<a href=""><h3 align="center"><?php echo "- " . $row2["firstname"] ." ". $row2["lastname"];?></h3></a>
						
						<img src=" <?php echo $row2["picture"]; ?>" ></img>
						<br>
						<ul>
							
							<li>
								D.O.B-<?php echo $row2["dob"]; ?>
							</li>
							<?php if($nfol==0){ ?>
							<form action="follow.php" method="post">
							<li>
							<input type="submit" value="Follow" name="follow">
							<input type="hidden" name="id2" value="<?php echo $row2['id']; ?>" >
							</li>
							</form>
							<?php }?>
						</ul>
				    </div>
					<?php } }?>

				</div>
		
	</body>
</html>