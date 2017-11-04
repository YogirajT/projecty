<?php
if(isset($_POST['addtask'])){
	$task = $_POST['task'];

	$conn = mysqli_connect("localhost","root","","todolist");
	
	$task = mysqli_real_escape_string($conn, $task);
	
	$query = "INSERT INTO list VALUES(NULL,'$task',now(),1)";
	
	if(mysqli_query($conn, $query))
	{
	   header("Location: index.php");
	   exit;
	}else{
		echo "Something went wrong!";
	}
}
?>