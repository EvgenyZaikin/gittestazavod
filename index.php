<?php 
	include('php_include/db_connect.php');
?>

<!doctype HTML>
<html>
	<head>
		<title>Тестовое задание</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="style.css" />
		<script src="js_scripts/search_personal.js" defer></script>
	</head>
	<body>
		<div id="main_wrap">
			<header>
				<h1>Реестр сотрудников</h1>
				<p><a href="current_personal.php">+ Добавить сотрудника</a></p>
			</header>
			<section id="search">
				<form>
					<div>
						<input type="search" id="input_search" placeholder="Введите данные сотрудника" />
					</div>
					<div id="search_by_sex_and_age">	
						<ul id="sex">
							<li><h3>Пол</h3></li>
							<li><input type="checkbox" id="input_checkbox_male" /><label for="input_checkbox_male">Муж.</label></li>
							<li><input type="checkbox" id="input_checkbox_female" /><label for="input_checkbox_female">Жен.</label></li>
						</ul>
						<ul id="age">
							<li><h3>Возраст</h3></li>
							<li><input type="text" id="input_from_age" placeholder="c"/></li>
							<li><input type="text" id="input_before_age" placeholder="до"/></li>
						</ul>
					</div>
					<div>
						<p id="button_search">Поиск</p>
					</div>
				</form>
			</section>
			<section id="personal">
				<table>
					<tr id="tr_values">
						<td class="td_id"><p>№ id</p></td>
						<td class="td_photo"><p>Фото</p></td>
						<td class="td_fio"><p>ФИО</p></td>
						<td class="td_age"><p>Возраст</p></td>
						<td class="td_sex"><p>Пол</p></td>
						<td class="td_action"><p>Действие</p></td>
					</tr>
				</table>
				<div id="pagination">
				
				</div>
			</section>
		</div>
	</body>
</html>