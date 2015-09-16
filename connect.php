<?php
$servername="localhost";
$username="root";
$password="";
$dbname='pinyourinterest';
$conn1= new mysqli($servername,$username,$password,$dbname);
if($conn1->connect_error)
{
die("Connection Failed : ". $conn1->connect_error);
}
?>