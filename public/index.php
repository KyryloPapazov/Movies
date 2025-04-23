<?php

require_once '../config/db.php';
require_once '../controllers/MovieController.php';

$controller = new MovieController();

// Обработка маршрутов
$page = isset($_GET['page']) ? $_GET['page'] : 'movies';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
$pageNumber = isset($_GET['pageNumber']) ? (int)$_GET['pageNumber'] : 1;

switch ($page) {
    case 'movies':
        if ($action === 'show' && $id) {
            $controller->show($id);
        } elseif ($action === 'add') {
            $controller->add();
        } elseif ($action === 'edit' && $id) {
            $controller->edit($id);
        } elseif ($action === 'delete' && $id) {
            $controller->delete($id);
        } else {
            $controller->index($pageNumber);
        }
        break;
    default:
        $controller->index($pageNumber);
        break;
}