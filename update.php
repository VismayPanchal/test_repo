<?php

include_once('connection.php');

	$id=$_POST['id'];
	 $checkRecord = mysqli_query($conn,"SELECT * FROM user WHERE id=".$id);
  $totalrows = mysqli_num_rows($checkRecord);

  if($totalrows > 0){
  	$name=$_POST['name'];
  	$email=$_POST['email'];
  	$age=$_POST['age'];
  	$qry= "UPDATE user SET name='$name', email='$email', age='$age' WHERE id='$id'";
  	mysqli_query($conn,$qry);
    echo 1;
    exit;
  }else{
    echo 0;
    exit;
  }


echo 0;
exit;
?>