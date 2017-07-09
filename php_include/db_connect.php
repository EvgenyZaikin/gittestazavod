<?php 
	/* Если на локальном сервере */
	//$link = mysqli_connect('localhost', 'root', '', 'test_A-Zavod') or die('Нет соединения с базой данных');
	/* Если на тестовом сервере */
	$link = mysqli_connect('mysql.zzz.com.ua', 'Shagfey', 'Shagfey', 'shagfey') or die('Нет соединения с базой данных');
?>