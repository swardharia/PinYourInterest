<?php
	include('session.php');
	$usern=$_SESSION['login_user'];
	$conn1=$_SESSION['conn'];
	$login=$_SESSION['login_id'];

	$propic = mysqli_query($conn1,"SELECT picture FROM user WHERE id = (SELECT id FROM login WHERE username='$usern')");
	$row1 = mysqli_fetch_assoc($propic);
	$pic = mysqli_query($conn1,"SELECT * FROM pics WHERE photoid in (select bitemid FROM boards WHERE bboardid IN (select boardid from userboard where userid = (select id from login where username='$usern')))");
	$pic2=mysqli_query($conn1,"SELECT * FROM pics WHERE photoid IN ( SELECT bitemid FROM boards WHERE bboardid IN ( SELECT boardid FROM userboard WHERE userid IN ( SELECT id2 FROM followinguser WHERE id1=$login ) ) )
")

//	$comments = mysqli_query($conn1,"select count(cphotoid) from comments group by cphotoid having cphotoid='11'");
?>

<!DOCTYPE html>
<html>
	<head>
	<title>Your Home Page</title>
	<link rel="stylesheet" type="text/css" href="design.css">

	<script type="text/javascript">
	function imag()
	{
		//alert("hell");
		<?php 
		 
		 if(!isset($_COOKIE["pi"]))
		 { 
	
		 }
		 else 
		 {
		 	echo 'alert("cookie value: '.$_COOKIE["pi"].'");';
		 }?> 
	}

	</script>
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
						<input type="submit" value="Edit Profile" style="width:100%; background-color:#123456;color:white;"></input>
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

						<li>
                        <form action="followStream.php" method="post">
                        <input type="submit" value="Follow Stream" style="width:100%; background-color:#123456;color:white;"></input>
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

				<ul>
				
				<li>
				<div class="contents">
					<br><font size="30px">My pictures... </font><br>

					<?php while($row2 = mysqli_fetch_assoc($pic)) {  ?>
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
					<!--	<?php
					//	echo "- Name : " . $row["photoname"] ; ?>	
				-->	</div>
					<?php } ?>
				</div>
				</li>

				<li>
				<div id="ttt">
				<br><font size="30px">My Followings... </font><br>

							<?php while($row3 = mysqli_fetch_assoc($pic2)) {  ?>
							<div class ="fimg">

								<?php
									$up1=mysqli_query($conn1,"SELECT * FROM login WHERE id = {$row3['uploadid']}");
									$up2=mysqli_fetch_assoc($up1);
								?>

								<h3 align="center"><?php echo "Uploader-" . $up2["username"] ;?></h3>
								
								<img src=" <?php echo $row3["photo"]; ?>" ></img>
								<br>
								<ul>
									<li>
									<form action="like.php" method="post">
									<input type="submit" name="like" value="LIKE"></input>
									<input type="hidden" name="pi1" value="<?php echo $row3["photoid"];?>">
									<input type="hidden" name="up1" value="<?php echo $row3["uploadid"];?>">
									</form>
									</li>
									
									<li>

										<like>
											<?php
												$likes = mysqli_query($conn1,"select likes from pics where photoid={$row3['photoid']}");
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
										<input type="hidden" name="pi" value="<?php echo $row3["photoid"];?>">
										<input type="hidden" name="up" value="<?php echo $row3["uploadid"];?>">
										</form>
									</li>
									
									<li>
										<like>
											<?php
												$comments = mysqli_query($conn1,"select count(cphotoid) from comments group by cphotoid having cphotoid={$row3['photoid']}");
												$row5= mysqli_fetch_array($comments);
												echo $row5[0];
												if($row5[0]<1)
													{echo 0;}
											?>
										</like>
									</li>

									<form action="pin.php" method="post">
									<li>
									<div class="control-group">
								 	<label for="sel1">Select Board:</label>
								  	<select class="form-control" name="bdid" id="bdid">

									  	<?php 
									  		$b1 = mysqli_query($conn1,"SELECT * from userboard WHERE userid={$_SESSION['login_id']}");
											
											while ($b2= mysqli_fetch_array($b1)) 
											{ ?>
													<option value="<?php echo $b2['boardid']; ?>"><?php echo $b2['boardname'];?></option>
											<?php	}   ?>	
									    
								  	</select>
								  	<input type="hidden" name="url" value="<?php echo $row3["photo"];?>">
								  	<input type="hidden" name="pid" value="<?php echo $row3["photoid"];?>">
									</div>	
									</li>

									<li>
										<input type="submit" name="pin" value="Pin"></input>	
									</li>
									</form>	

								</ul>
							</div>
							<?php } ?>
				</div>
				
				</li>

				</ul>
		
	</body>
</html>