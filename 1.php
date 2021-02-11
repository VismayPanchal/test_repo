<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript">
		function clear()
		{
			document.getElementById("cform").reset();
		}
	</script>
	<style type="text/css">
		td
		{
			padding: 10px;
		}
	div
		{
			position: fixed;
		}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script>
		$(document).ready(function(){
		

			 $('.delete').click(function(){
   				var el = this;
  
   // Delete id
   var deleteid = $(this).data('id');
 
   var confirmalert = confirm("Are you sure?");
   if (confirmalert == true) {
      // AJAX Request
      $.ajax({
        url: 'fetch.php',
        type: 'POST',
        data: { id:deleteid },
        success: function(response){

          if(response == 1){
	    // Remove row from HTML Table
	   // $(el).closest('tr').css('background','tomato');
	    $(el).closest('tr').fadeOut(800,function(){
	       $(this).remove();
	    });
          }else{
	    alert('Invalid ID.');
          }

        }
      });
   }

 });
			 $('.update').click(function(){
			 	var updateid = $(this).data('id');
			 	var updatename = $('#name').val();
			 	var updateemail = $('#email').val();
			 	var updateage = $('#age').val();
			 	alert($(this).data('id'));
			 	$.ajax({
			 		url:'update.php',
			 		type:'POST',
			 		data:{'id':updateid,'name':updatename,'email':updateemail,'age':updateage},
			 		success:function(response){
			 			if(response==1){
			 				alert("data updated success");
			 			}
			 			else{
			 				alert('invalid ID');
			 			}
			 		}
			 	});
			 });
		});
	</script>
</head>
<body>

<form action="1.php" method="POST" id="cform">
	NAME :<input type="text" name="name" id="name" placeholder="Enter name"><br>
	EMAIL :<input type="email" name="email" id="email" placeholder="enter email"><br>
	AGE :<input type="number" name="age" id="age" placeholder="Enter age"><br>
	<br><input type="submit" name="" value="submit" onclick="clear()">
	<input type="reset" value="reset"><br>
</form>


<?php
include_once('connection.php');


$name=$_POST['name'];
$email=$_POST['email'];
$age=$_POST['age'];
//echo $name,$email;
$qry="INSERT INTO user (name,email,age) VALUES ('$name', '$email', '$age')";

if(mysqli_query($conn, $qry))
{
	//echo "data inserted successfully";
}
else
{
	//echo "failed";
}


?>

<div id='slid'>
	<table><tr><th>USEr id</th><th>NAME</th><th>email</th><th>age</th><th>Delete</th><th>update</th></tr>


<?php
include_once('connection.php');
$qry="SELECT id, name, email, age FROM user";

$result = mysqli_query($conn,$qry);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
  	$id = $row["id"];
  	$name = $row["name"];
  	$email = $row["email"];
  	$age = $row["age"];
  	?>

  	<tr>
  	<td><?= $id; ?></td>
  	<td><?= $name; ?></td>
  	<td><?= $email; ?></td>
  	<td><?= $age; ?></td>
  	<td><button><span class="delete" data-id="<?= $id; ?>">Delete</span></button></td>
  	<td><button><span class="update" data-id="<?= $id; ?>">Update</span></button></td>
  	</tr><br>
  	<?php

  }
} 


echo "</table></div>";
?>
    
</body>
</html>