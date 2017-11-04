<?php
if(isset($_POST['update'])){
	$task = $_POST['task'];
	$id = $_POST['tid'];
	$conn = mysqli_connect("localhost","root","","todolist");
	$id = mysqli_real_escape_string($conn, $id);
	$task = mysqli_real_escape_string($conn, $task);
	$query = "UPDATE list SET todo = '$task', created = now(), status=1 WHERE id = $id";
	if(mysqli_query($conn, $query))
	{
	   header("Location: index.php");
	   exit;
	}else{
		echo "Something went wrong!";
	}
}else{
 echo "Invalid method of update! Please fill the form and try again.";
}
?>