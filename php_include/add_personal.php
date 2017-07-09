<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		include('db_connect.php');
		
		$name = $_POST['name_personal'];
		$surname = $_POST['surname_personal'];
		$patronymic = $_POST['patronymic_personal'];
		$birthday = $_POST['birthday_personal'];
		$sex = $_POST['sex_personal'];
		$photo = $_FILES['photo_personal'];
		
		$age_personal = getdate()['year'] - array_shift(explode('-', $birthday));
		
		$picture_extension = array_pop(explode('.', $photo['name']));
		if($picture_extension == 'jpg' or $picture_extension == 'png' or $picture_extension == 'gif'){
			$path = 'photo/';
			$new_name_photo = time().'.'.$picture_extension;
			$full_path = $path.$new_name_photo;
			echo $photo['tmp_name']."<br/>".$full_path;
			$result = move_uploaded_file($photo['tmp_name'], $path);
			if($result == true) echo '1';
			else echo '0';
		}
		
		$add_personal = mysqli_query($link, "INSERT INTO personal VALUES(NULL, '$new_name_photo', '$name', '$surname', '$patronymic', 
											 $age_personal, '$sex', '$birthday')");
		if($add_personal == true) echo '1';
		else echo '0';
	}
?>