<?php
	$id = $_GET['id'];
	$conn = mysqli_connect("localhost","root","","todolist");
	$id = mysqli_real_escape_string($conn, $id);
	$query = "UPDATE list SET status = 0 WHERE id = $id";
	if(mysqli_query($conn, $query))
	{
	   header("Location: index.php");
	   exit;
	}else{
		echo "Something went wrong!";
	}
?>
