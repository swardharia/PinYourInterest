<!DOCTYPE html>
<html lang="en">
<head>
	<link href="css/css/bootstrap.min.css" rel="stylesheet">
	<link href="css/css/style.css" rel="stylesheet">
</head>

<body>
<div class="container">
	
	<a id="modal-792883" href="#modal-container-792883" role="button" class="btn btn-success" data-toggle="modal">Create A New Board</a>
			
		<div class="modal fade" id="modal-container-792883" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myModalLabel">
							Create Board
						</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" action= "board.php" method="get">
							<!-- Text input-->
							<div class="control-group">
							 	<label class="control-label" for="textinput">Name</label>
							  	<div class="controls">
							    	<input id="textinput" name="boardName" type="text" placeholder="Name of Board" class="input-xlarge" required="">
							    
							  	</div>
							</div>

							
					</div>
					<div class="modal-footer">

						 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
						 
						 <input type = "submit" name="createBoard" class="btn btn-primary" value="Save"/>
						
					</div>
					</form>


				</div>
				
			</div>
			
		</div>
		
		<a href="profile.php"><button class="btn btn-primary" >Go To Home Page</button></a><br>
		
		

	<script type="text/javascript" src="js/js/jquery.min.js"></script>
	<script type="text/javascript" src="js/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/js/scripts.js"></script>

</body>
</html>

<?php
	include "connect.php";

	session_start();
	$user = $_SESSION["login_user"];                                           
	$userId = $_SESSION["login_id"];

	

	if(isset($_GET["createBoard"]))
	{
		
		$boardname = $_GET["boardName"];

		$sql = "insert into userboard values(?,'',?)";

		if($res = $conn1->prepare($sql))
		{
			$res->bind_param("is",$userId,$boardname);
			$res->execute();
			$res->close();
		}

		else
			echo $conn1->errror;
		
	}

	$sql = "select boardname,boardid from userboard where userid = ?";

		if($res = $conn1->prepare($sql))
		{
			$res->bind_param("i",$userId);
			$res->execute();
			$res->bind_result($boardname,$boardid);
			while($res->fetch())
			{
				echo "Board Name : ";
				echo "<div>
						<a href='boardpictures.php?boardid=$boardid'>$boardname</a></div>";
						echo "<br>";

			}

			$res->close();
		}

		else
			echo $conn1->errror;


?>

