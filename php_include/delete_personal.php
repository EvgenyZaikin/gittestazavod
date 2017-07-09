<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		include('db_connect.php');
		$id = $_POST['delete_id'];
		mysqli_query($link, "DELETE FROM personal WHERE id = '$id'");
	}
	//header('Location: /index.php');
?>