<?php
	include('session.php');
	$usern=$_SESSION['login_user'];
	$conn1=$_SESSION['conn'];

  if(isset($_POST['pi']) && isset($_POST['up']))
	{
		$pd=$_POST['pi'];
		$upd=$_POST['up'];
		$_SESSION['up']=$upd;
		$_SESSION['pi']=$pd;
	}
	else{$pd=$_SESSION['pi'];
		$upd=$_SESSION['up'];}
   $pic = mysqli_query($conn1,"SELECT * FROM pics WHERE photoid=$pd");
	$row = mysqli_fetch_assoc($pic);
	$coms= mysqli_query($conn1,"SELECT * FROM comments WHERE cphotoid=$pd AND cuploaderid =$upd ORDER BY commenttime ");
?>

<script type="text/javascript">
	addcom()
	{

	}
</script>
	

<html>
	<head>
	<title>Comment Page</title>
	<link rel="shortcut icon" href="../favicon.ico"> 
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
	
	
	<link rel="stylesheet" type="text/css" href="styles.css">
	</head>
	<form action="addComm.php" method="POST" ></form>
	<body>
			<div class="center-block">
				<div class="detailBox">
				    <div class="titleBox">
				      <label>Comments</label>
				      <div id="back"><a href="profile.php"><button class="btn btn-primary">Go Back to Profile !</button></a></div>
				    </div>
				    <div class="commentBox">
				        <img src="<?php echo $row["photo"]; ?>" style="height:200px; width:250px; margin-left:175px"/>
				    </div>
				    <div class="actionBox">
				        <ul class="commentList">
				            <li>
				                <div class="commenterImage">
				                  <img src="http://lorempixel.com/50/50/people/6" />
				                </div>
				                <div class="commentText">
				                    <p class="">Hello this is a test comment.</p> <span class="date sub-text">on March 5th, 2014</span>

				                </div>
				            </li>
				            <?php while($row2 = mysqli_fetch_assoc($coms)) {  ?>
				            <li>
				                <div class="commenterImage">
				                <?php $compic=mysqli_query($conn1,"SELECT picture FROM user WHERE id = '{$row2['comuserid']}' ");
				                		$row3=mysqli_fetch_array($compic);
				                		?>
				                  <img src="<?php echo $row3[0];?>" />
				                </div>
				                <div class="commentText">
				                    <p class=""><?php echo $row2['comment'];?></p> <span class="date sub-text">on March 5th, 2014</span>

				                </div>
				            </li>
				             <?php } ?>
				        </ul>
				        <form class="form-inline" role="form" action="addComm.php" method="post">
				            <div class="form-group">
				                <input class="form-control" type="text" placeholder="Your comments" name="commt">
				            </div>
				            <div class="form-group">
				                <button class="btn btn-primary" type="submit" name="add">Add</button>
				            </div>
				        </form>
				        <input type="hidden" name="pi" value="<?php echo $pd?>"></input>
				    </div>
				</div>
			</div>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	</body>
</html>

