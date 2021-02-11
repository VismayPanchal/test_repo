<?php

$hostname="localhost";
$user="vismay";
$password="vismay";
$database="user";

$conn=new mysqli($hostname,$user,$password,$database);
if($conn->connect_error)
{
	echo "not connected";
}
else
{
	//echo "conn";
}
?>