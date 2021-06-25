<?php
include_once __DIR__ . '/globals.php';
if (isset($_GET['id'])) {
    \DataHandling\Rubrica::updateData($_POST, $_GET['id']);
} else {
    try {
        \DataHandling\Rubrica::insertData($_POST, $_SESSION["userId"]);
    } catch (Exception $e) {
        echo 'Exception: ', $e->getMessage(), "\n";
    }
}