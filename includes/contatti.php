<?php
include './Rubrica.php';
if (isset($_GET['id'])) {
    Rubrica::update_data($_POST, $_GET['id']);
} else {
    Rubrica::insert_data($_POST);
}