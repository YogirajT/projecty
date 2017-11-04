<?php
	$id = $_GET['id'];
	$conn = mysqli_connect("localhost","root","","todolist");
	$query = "DELETE FROM list WHERE id = $id";
	if(mysqli_query($conn, $query))
	{
	   header("Location: index.php");
	   exit;
	}else{
		echo "something went wrong";
	}
?>