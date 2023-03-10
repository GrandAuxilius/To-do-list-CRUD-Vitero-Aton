<?php

$conn = mysqli_connect('localhost', 'root', '', 'tasks');

if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['submit'])) {
	$task_name = $_POST['task_name'];
	$task_description = $_POST['task_description'];
	$task_due_date = $_POST['task_due_date'];
	$task_status = $_POST['task_status'];

	if ($task_status != 'incomplete' && $task_status != 'in progress' && $task_status != 'complete') {
		echo 'Please enter a valid task status: incomplete, in progress, or complete';
		exit;
	}

	$sql = "INSERT INTO `tasks` (`task_name`, `task_description`, `task_due_date`, `task_status`) VALUES ('$task_name', '$task_description', '$task_due_date', '$task_status')";
	if (mysqli_query($conn, $sql)) {
    	
	} else {
    	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	mysqli_close($conn);
}
?>


<form action="" method="post">
    <label for="task_name">Task Name:</label><br>
    <input type="text" id="task_name" name="task_name"><br><br>
	
    <label for="task_description">Task Description:</label><br>
    <input type="text" id="task_description" name="task_description"><br><br>

    <label for="task_due_date">Task Due Date:</label>
    <input type="date" id="task_due_date" name="task_due_date"><br><br>

    <label for="task_status">Task Status:</label>
    <select name="task_status">
		<option value="incomplete">Incomplete</option>
		<option value="in progress">In Progress</option>
		<option value="complete">Complete</option>
	</select>
	
    <input type="submit" name="submit" value="Submit">
</form><br><br><br><br>



<form action="index.php" method="get">
	<select name="task_status">
		<option value="all">All</option>
		<option value="incomplete">Incomplete</option>
		<option value="in progress">In Progress</option>
		<option value="complete">Complete</option>
	</select>
	<input type="submit" name="submit" value="Filter">
</form> 



<?php 
$conn = mysqli_connect('localhost', 'root', '', 'tasks');
if(isset($_GET['submit'])) {
	$task_status = $_GET['task_status'];

	if($task_status == "all") {
		$result = mysqli_query($conn, "SELECT * FROM tasks");
	}
	else {
		$result = mysqli_query($conn, "SELECT * FROM tasks WHERE task_status='$task_status'");
	}
?>

<table >
	<thead>
		<tr>
			<th>Task ID</th>
			<th>Task Name</th>
			<th>Task Description</th>
			<th>Task Due Date</th>
			<th>Task Status</th>
		</tr>
	</thead>
	<tbody>
	<?php
	while($row = mysqli_fetch_assoc($result)) {
	?>
		<tr>
			<td><?php echo $row['id']; ?></td>
			<td><?php echo $row['task_name']; ?></td>
			<td><?php echo $row['task_description']; ?></td>
			<td><?php echo $row['task_due_date']; ?></td>
			<td><?php echo $row['task_status']; ?></td>
		</tr>

	<?php
	}
	?>
	</tbody>
</table>
<?php
} else{
	$result = mysqli_query($conn, "SELECT * FROM tasks");
?>

<table>
	<thead>
		<tr>
			<th>Task ID</th>
			<th>Task Name</th>
			<th>Task Description</th>
			<th>Task Due Date</th>
			<th>Task Status</th>
		</tr>
	</thead>
	<tbody>
	<?php
	while($row = mysqli_fetch_assoc($result)) {
	?>
		<tr>
			<td><?php echo $row['id']; ?></td>
			<td><?php echo $row['task_name']; ?></td>
			<td><?php echo $row['task_description']; ?></td>
			<td><?php echo $row['task_due_date']; ?></td>
			<td><?php echo $row['task_status']; ?></td>
		</tr>

	<?php
	}
	?>
	</tbody>
</table>
<?php
}
?>


<br>


<div class = "right-forms">

<h3>Action</h3>

<form action="edit_task.php" method="post">
    <label for="edit_task_id">Edit Task:</label><br>
    <select name="edit_task_id">
	<?php 
	$conn = mysqli_connect('localhost', 'root', '', 'tasks');
	$result = mysqli_query($conn, "SELECT * FROM tasks");
	while($row = mysqli_fetch_assoc($result)) {
	?>
		<option value="<?php echo $row['id']; ?>"><?php echo $row['task_name']; ?></option>
	<?php 
	} 
	?>
	</select>
    <input type="submit" name="submit" value="Edit">
</form>


<br>

    <form action="delete_task.php" method="post">
        <label for="delete_task_id">Delete Task:</label><br>
        <select name="delete_task_id">
        <?php 
        $conn = mysqli_connect('localhost', 'root', '', 'tasks');
        $result = mysqli_query($conn, "SELECT * FROM tasks");
        while($row = mysqli_fetch_assoc($result)) {
        ?>
		    <
            <option value="<?php echo $row['id']; ?>"><?php echo $row['task_name']; ?></option>
        <?php 
        } 
        ?>
        </select>
        <input type="submit" name="submit" value="Delete">
    </form>

	</div>

<style>

	table {
		border-collapse: collapse;
		width: 70%;
		overflow-x: auto;
		float: left;
		margin-bottom: 100px;
		margin-right: 40px;
		
		
	}
	th, td {
		text-align: left;
		padding: 8px;
	}
	tr:nth-child(even){background-color: #f2f2f2}
	th {
		background-color: #4CAF50;
		color: white;
	}

	.right-forms {
		
	width: 400px;
	float: right;
		
    }

</style>


