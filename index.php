<?php
//Este archivo contiene la plantilla maestra
//y direccionado básico para incluir las páginas

session_start();

//Incluir el archivo con las funciones y conexión a la base de datos usando PDO
include 'functions.php';
$pdo = pdo_connect_mysql();

//home.php será la página por defecto.
$page = isset($_GET['page']) && file_exists($_GET['page'] . '.php') ? $_GET['page'] : 'home';

//Incluir y mostrar la página requerida
include $page . '.php';
//var_dump($page);
?>