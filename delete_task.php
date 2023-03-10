<?php 

$conn = mysqli_connect('localhost', 'root', '', 'tasks');

if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['submit'])) {
    $delete_task_id = $_POST['delete_task_id'];

    $sql = "DELETE FROM `tasks` WHERE `id` = '$delete_task_id'";
	if (mysqli_query($conn, $sql)) {
    	echo "<h2>Task deleted successfully<h2/>";
	} else {
    	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	mysqli_close($conn);
}
?>

	<button type="button" onclick="window.location.href='index.php'">Go back to the home page</button>

