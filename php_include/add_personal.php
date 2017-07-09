<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		include('db_connect.php');
		
		if(isset($_POST['button_safe'])){
			$name = $_POST['name_personal'];
			$surname = $_POST['surname_personal'];
			$patronymic = $_POST['patronymic_personal'];
			$birthday = $_POST['birthday_personal'];
			$sex = $_POST['sex_personal'];
			$name_photo = $_FILES['photo_personal']['name'];
			
			$age_personal = getdate()['year'] - array_shift(explode('-', $birthday));
			
			if($_FILES['photo_personal']['size'] < 200000){
				$where_put_file = "../photo/".$_FILES['photo_personal']['name'];
				move_uploaded_file($_FILES['photo_personal']['tmp_name'], $where_put_file);
			}	
				
			mysqli_query($link, "INSERT INTO personal VALUES(NULL, '$name_photo', '$name', '$surname', '$patronymic', 
												 $age_personal, '$sex', '$birthday')");
			header('Location: /index.php');		
		}
		
		if(isset($_POST['button_edit'])){
			$id = $_POST['id_edit_personal'];
			$name = $_POST['name_personal'];
			$surname = $_POST['surname_personal'];
			$patronymic = $_POST['patronymic_personal'];
			$birthday = $_POST['birthday_personal'];
			$sex = $_POST['sex_personal'];
			$photo = $_FILES['photo_personal'];
			
			$age_personal = getdate()['year'] - array_shift(explode('-', $birthday));
			
			mysqli_query($link, "UPDATE personal SET name = '$name', surname = '$surname', patronymic = '$patronymic', 
								 age = '$age_personal', sex = '$sex', birthday = '$birthday' WHERE id = '$id'");
			header('Location: /index.php');					 
		}
	}
?>