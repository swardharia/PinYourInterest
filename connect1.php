<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password,"pinyourinterest");

// Check connection
if (!$conn) {
    die("Connection failed:" . mysqli_connect_error());
} 
$result = mysqli_query($conn,"select * from pics");

if (mysqli_num_rows($result) > 0) 
{
    // output data of each row
    while($row = mysqli_fetch_assoc($result))
	 {
	echo "id: " . $row["photoid"]. " - name : " . $row["photoname"] ;
	echo '<img src="data:image/jpeg;base64,'.base64_encode($row["photo"]) .'" />';
	//echo '<br>';
    }
} 
else {
    echo "not found";
}
mysqli_close($conn);


//<p>By clicking Register, you agree on our <a href="#">terms and condition</a>.</p>
//border:1px dashed grey;
?>


