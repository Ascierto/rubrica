<?php
include_once __DIR__ . '/util.php';
include_once  __DIR__ .'/FormHandle.php';
include_once  __DIR__ .'/Rubrica.php';
include_once  __DIR__ .'/header.php';

if (!isset($_SESSION['username'])) {
    header('Location: http://localhost:8888/rubrica/login.php');
}

// var_dump($_SESSION['username']);