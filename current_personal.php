<?php 
	include('php_include/db_connect.php');
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$current_personal = mysqli_query($link, "SELECT * FROM personal WHERE id = '$id'");
		if(mysqli_num_rows($current_personal) > 0){
			$row = mysqli_fetch_array($current_personal);
		}
	}
?>

<!doctype HTML>
<html>
	<head>
		<title>Тестовое задание</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="style.css" />
		<script src="js_scripts/cancel_add_personal.js"></script>
	</head>
	<body>
		<div id="main_wrap">
			<header>
				<h1>Создание сотрудника</h1>
			</header>
			<div id="create_personal">
				<form enctype="multipart/form-data" action="/php_include/add_personal.php" method="POST">
					<table>
						<tr>
							<td><p class="identific">Фамилия:</p></td>
							<td><input class="identific_input" type="text" name="surname_personal" value="<?php echo $row['name']; ?>" required/><td>
						</tr>
						<tr>
							<td><p class="identific">Имя:</p></td>
							<td><input class="identific_input" type="text" name="name_personal" value="<?php echo $row['surname']; ?>" required/><td>
						</tr>
						<tr>
							<td><p class="identific">Отчество:</p></td>
							<td><input class="identific_input" type="text" name="patronymic_personal" value="<?php echo $row['patronymic']; ?>" required/><td>
						</tr>
						<tr>
							<td><p class="identific">Дата рождения:</p></td>
							<td><input class="identific_input" type="date" name="birthday_personal" value="<?php echo $row['birthday']; ?>" required/><td>
						</tr>
						<tr>
							<td><p class="identific">Пол:</p></td>
							<td>
								<select class="identific_input" name="sex_personal" required>
									<?php 
										if($row['sex'] == 'Женский') $sex = 'selected';
										else $sex = '';
									?>
									<option>Мужской</option>
									<option <?php echo $sex; ?>>Женский</option>
								</select>
							<td>
						</tr>
						<tr>
							<td><p class="identific">Фото:</p></td>
							<td>
								<!--<input type="hidden" name="MAX_FILE_SIZE" value="30000" />-->
								<input class="identific_input" type="file" name="photo_personal" />
							<td>
						</tr>
						<tr>
							<?php if(isset($_GET['id'])): ?>
								<td><input type="submit" class="identific" id="button_edit" name="button_edit" value="Редактировать" /></td>
								<td><input type="hidden" class="identific" name="id_edit_personal" value="<?php echo $row['id']; ?>"/></td>
							<?php endif; ?>
							<?php if(!isset($_GET['id'])): ?>
								<td><input type="submit" class="identific" id="button_safe" name="button_safe" value="Сохранить" /></td>
							<?php endif; ?>
						</tr>
						<tr>
							<td><p class="identific" id="button_cancel">Отмена</p></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</body>
</html>