<?php

$conn = mysqli_connect('localhost', 'root', '', 'tasks');

if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['submit'])) {
	$edit_task_id = $_POST['edit_task_id'];
	$sql = "SELECT * FROM tasks WHERE id = '$edit_task_id'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		$task_name = $row['task_name'];
		$task_description = $row['task_description'];
		$task_due_date = $row['task_due_date'];
		$task_status = $row['task_status'];
	}
}

if(isset($_POST['update'])) {
	$edit_task_id = $_POST['edit_task_id'];
	$task_name = $_POST['task_name'];
	$task_description = $_POST['task_description'];
	$task_due_date = $_POST['task_due_date'];
	$task_status = $_POST['task_status'];

	if ($task_status != 'incomplete' && $task_status != 'in progress' && $task_status != 'complete') {
		echo 'Please enter a valid task status: incomplete, in progress, or complete';
		exit;
	}

	$sql = "UPDATE tasks SET task_name = '$task_name', task_description = '$task_description', task_due_date = '$task_due_date', task_status = '$task_status' WHERE id = '$edit_task_id'";
	if (mysqli_query($conn, $sql)) {
    	echo "Task updated successfully";
	} else {
    	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	mysqli_close($conn);
}
?>

<form action="" method="post">
    
    <input type="hidden" name="edit_task_id" value="<?php echo $edit_task_id; ?>">
    <label for="task_name">Task Name:</label><br>
    <input type="text" id="task_name" name="task_name" value="<?php echo $task_name; ?>"><br><br>

    <label for="task_description">Task Description:</label><br>
    <input type="text" id="task_description" name="task_description" value="<?php echo $task_description; ?>"><br><br>

    <label for="task_due_date">Task Due Date:</label>
    <input type="date" id="task_due_date" name="task_due_date" value="<?php echo $task_due_date; ?>"><br><br>

    <label for="task_status">Task Status:</label>
    <select name="task_status" value="<?php echo $task_status; ?>">
		<option value="incomplete">Incomplete</option>
		<option value="in progress">In Progress</option>
		<option value="complete">Complete</option>
	</select>
	
    <input type="submit" name="update" value="Update">
</form>

<button onclick="window.location.href='index.php'">Back</button>

