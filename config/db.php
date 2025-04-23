<?php
require_once 'config.php';

define('DB_HOST', 'MySQL-8.2');
define('DB_NAME', 'test_Kyrylo_Papazov');
define('DB_USER', 'root');
define('DB_PASS', '');

try{
    $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die('Error connecting to DB: ' . $e->getMessage());
}