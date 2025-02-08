<?php
require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../core/Controller.php';

use Core\Router;

/**
 * Добавим роутер для адресации по заданиям
 */
$router = new Router();

/**
 * Добавим адреса и имена методов контроллера
 */
$router->add('/', 'index');
$router->add('/1', 'task1');
$router->add('/2', 'task2');
$router->add('/3', 'task3');
$router->add('/4', 'task4');
$router->add('/5', 'task5');

//echo '<pre>';
//var_dump($_SERVER);
//echo '</pre>';
/**
 * Запускаем разбор адреса
 */
$router->parse($_SERVER['REQUEST_URI']);
