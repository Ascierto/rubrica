<?php
    require __DIR__ . '/FormHandle.php';
    require './Rubrica.php';

if (isset($_GET['id'])) {
    DataRubrica\Rubrica::updateData($_POST, $_GET['id']);
} else {
    try {
        DataRubrica\Rubrica::insertData($_POST);
    } catch (Exception $e) {
        echo "Exception: ", $e->getMessage(), "\n";
    }
}
