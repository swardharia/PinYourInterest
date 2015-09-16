<?php
	include "connect.php";
	session_start();
	$userId=$_SESSION["login_id"];
	$boardid = $_GET["boardid"];
	//echo "$boardid";
	$sql = "select photo from pics,boards where bboardid=? and pics.photoid=boards.bitemid";
	if($res=$conn1->prepare($sql))
	{
		$res->bind_param("i",$boardid);
		$res->execute();
		$res->bind_result($photo);
		while($res->fetch())
		{
			echo '<img src="'.$photo. '"height="200px" width="200px">';
		}

	}

	if(isset($_GET["url"]))
	{

		$url = $_GET["imgurl"];
		$category = $_GET["cat"];
		$boardid = $_GET["boardid"];
		echo $url." ".$category." ".$boardid."---";
		$row1=mysqli_query($conn1,"SELECT Auto_increment FROM information_schema.tables WHERE table_name='pics'");
		$row2=mysqli_fetch_array($row1);
		$row3=$row2[0];

		$sql = "insert into pics values('',?,'',?,0,0,?)";

		if($res = $conn1->prepare($sql))
		{
			$res->bind_param("sii",$url,$category,$userId);
			$res->execute();
			$res->close();
			echo "----board----".$boardid;
			echo "boardpictures.php?boardid=$boardid";
			//header("location: boardpictures.php?boardid=$boardid");
		}

		else
		{
			echo $conn1->error;
		}

		$sql = "insert into boards values('',$boardid,$row3,now())";
		mysqli_query($conn1,$sql);

		header('location:board.php');
		
	}
	
	if(isset($_POST["submit"]))
	{
		
			$directory="images/";
			$target_file=$directory.basename($_FILES["image"]["name"]);
			$category = $_POST["cat"];
			echo $target_file;
			$boardid = $_POST["boardid"];
			$row1=mysqli_query($conn1,"SELECT Auto_increment FROM information_schema.tables WHERE table_name='pics'");
			$row2=mysqli_fetch_array($row1);
			$row3=$row2[0];
		
			$sql = "insert into pics values('',?,'',?,0,0,?)";

			if($res = $conn1->prepare($sql))
			{
				$res->bind_param("sii",$target_file,$category,$userId);
				$res->execute();
				$res->close();
				echo "----board----".$boardid;
			//	header("location: boardpictures.php?boardid=$boardid");
			}

			else
			{
				echo $conn1->error;
			}

			$sql = "insert into boards values('',$boardid,$row3,now())";
			mysqli_query($conn1,$sql);
			
			header('location:board.php');
		}
 

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link href="css/css/bootstrap.min.css" rel="stylesheet">
	<link href="css/css/style.css" rel="stylesheet">
</head>

<body>
<div class="container">
	
	<a id="modal-792883" href="#modal-container" role="button" class="btn btn-success" data-toggle="modal">Pin from URL</a>
			
		<div class="modal fade" id="modal-container" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myModalLabel">
							Pin from URL
						</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" action= "boardpictures.php?boardid=$boardid" method="get">
							<!-- Text input-->
							<div class="control-group">
							 	<label class="control-label" for="textinput">URL</label>
							  	<div class="controls">
							    	<input id="textinput" name="imgurl" type="text" placeholder="Enter URL..." class="input-xlarge" required="">
							   	</div>
							   	<br/>
							   	<input type="hidden" name="boardid" value="<?php echo $boardid ?>"></input>
							   	<div class="control-group">
								  <label for="sel1">Select list:</label>
								  <select class="form-control" name="cat" id="sel1">
								    <option value="1">Sports</option>
								    <option value="2">Dance</option>
								    <option value="3">Music</option>
								  </select>
								  <br>
								  Enter a Tag : <input type = "text" name="tags"/>
								</div>
							  

							</div>

							
					</div>
					<div class="modal-footer">

						 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
						 
						 <input type = "submit" name="url" class="btn btn-primary" value="Save"/>
						
					</div>
					</form>


				</div>
				
			</div>
			
		</div>

		<a id="modal-792883" href="#modal-container-792883" role="button" class="btn btn-success" data-toggle="modal">Pin from Computer</a>
			
		<div class="modal fade" id="modal-container-792883" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myModalLabel">
							Pin from Computer
						</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" enctype="multipart/form-data" action= "boardpictures.php?boardid=$boardid" method="post">
							<!-- Text input-->
							<Upload your Profile Image <i>(.jpg files only)</i><input type="file" name="image" id="image" class="form-control"/><br/>
							
								<br/>
							   	<div class="control-group">
								  <label for="sel1">Select list:</label>
								  <select class="form-control" name="cat" id="sel1">
								    <option value="1">Sports</option>
								    <option value="2">Dance</option>
								    <option value="3">Music</option>								    
								  </select>
								  	<br>
						 		Enter a Tag : <input type = "text" name="tags"/>

								</div>		
								<input type="hidden" name="boardid" value="<?php echo $boardid ?>"></input>
							
					</div>


					<div class="modal-footer">

						 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
						 
						 <input type = "submit" name="submit" class="btn btn-success"/>
						
					</div>


					</form>


				</div>
				
			</div>
			
		</div>
		
		
		<a href="board.php"><button class="btn btn-primary" >Go Back</button></a><br>
		<a href="profile.php"><button class="btn btn-primary">Go To Home Page</button></a><br>

		<form action="delete.php" method="post">
		Enter image to delete :<br><input type="text" name="del"></input>
		<button class="btn btn-primary" name="delb" type="submit" >Delete</button><br>
		</form>


	<script type="text/javascript" src="js/js/jquery.min.js"></script>
	<script type="text/javascript" src="js/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/js/scripts.js"></script>

</body>
</html>
