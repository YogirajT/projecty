<?php
	$id = $_GET['id'];
	$conn = mysqli_connect("localhost","root","","todolist");
	$id = mysqli_real_escape_string($conn, $id);
	$query = "SELECT * FROM list WHERE id = $id";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);
?>
<form class="form-horizontal" action="updatetask.php" method="POST">
	<input type="hidden" name="tid" value="<?php echo $row['id'];?>"/>
	<strong>Edit:</strong>
	<div class="row">
		<div class="col-sm-12">
			<textarea class="form-control" rows="3" name="task" style="margin-bottom:10px;" placeholder="<?php echo $row['todo'];?>"></textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-12">
		  <button type="submit" name="update" class="btn btn-default" style="float:right">Update</button>
		</div>
	</div>
</form>