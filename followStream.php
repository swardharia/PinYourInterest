<!DOCTYPE html>
<html lang="en">
<head>
	<link href="css/css/bootstrap.min.css" rel="stylesheet">
	<link href="css/css/style.css" rel="stylesheet">
</head>

<body>
<div class="container">
	
	<a id="modal-792883" href="#modal-container-792883" role="button" class="btn btn-success" data-toggle="modal">Follow A New Stream</a>
			
		<div class="modal fade" id="modal-container-792883" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myModalLabel">
							Follow Stream
						</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" action= "board.php" method="get">
							<!-- Text input-->
							<div class="control-group">
							 	<label class="control-label" for="textinput">Name</label>
							  	<div class="controls">
							    	<input id="textinput" name="boardName" type="text" placeholder="Stream Name" class="input-xlarge" required="">
							    
							  	</div>
								
								<div class="control-group">
								  	<label for="sel1">Select list:</label>
								  	<select class="form-control" name="cat" id="sel1">
								    <option value="1">Sports</option>
								    <option value="2">Dance</option>
								    <option value="3">Music</option>
								    
								  </select>
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

		
		

	<script type="text/javascript" src="js/js/jquery.min.js"></script>
	<script type="text/javascript" src="js/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/js/scripts.js"></script>

					<a href="profile.php"><button class="btn btn-primary">Go To Home Page</button></a><br>
</body>
</html>

