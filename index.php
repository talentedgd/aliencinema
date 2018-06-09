<?php

/* Показ ошибок на время разработки */
ini_set('display_errors', 1);
error_reporting(E_ALL);

/* Константа с путем к корню файла */
define('ROOT', dirname(__FILE__));

/* Подклчение файлов маршрутизатора и бд*/
require_once (ROOT.'/components/Router.php');
require_once (ROOT.'/components/Db.php');

/* Вызов Router */
$router = new Router();
$router->run();
