<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		include('db_connect.php');
		
		$query_text = 'WHERE (name LIKE "%'.$_POST['text'].'%" OR surname LIKE "%'.$_POST['text'].'%" OR patronymic LIKE "%'.$_POST['text'].'%")';
		if($_POST['male'] == 'true' and $_POST['female'] == 'true'){
			$query_sex = '';
		} else if($_POST['male'] == 'true' and $_POST['female'] == 'false'){
			$query_sex = 'AND sex = "Мужской"';
		} else if($_POST['male'] == 'false' and $_POST['female'] == 'true'){
			$query_sex = 'AND sex = "Женский"';
		} else {
			$query_sex = '';
		}	
		if($_POST['from_age'] != '') $query_from_age = 'AND age >= "'.$_POST['from_age'].'"';
		else $query_from_age = '';
		if($_POST['before_age'] != '') $query_before_age = 'AND age <= "'.$_POST['before_age'].'"';
		else $query_before_age = '';
		
		$personal = mysqli_query($link, "SELECT * FROM personal $query_text $query_sex $query_from_age $query_before_age");
		if(mysqli_num_rows($personal) > 0){
			$massive_personal = array();
			while($row = mysqli_fetch_array($personal)){
				array_push($massive_personal, $row);
			}
			echo json_encode($massive_personal);
		} else {
			echo json_encode('Сотрудников нет');
		}
	}
?>