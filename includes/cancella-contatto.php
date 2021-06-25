<?php
include_once __DIR__ . '/globals.php';
if ( isset( $_GET['id'] ) ) {
  \DataHandling\Rubrica::deleteData($_GET['id']);
} else {
  \DataHandling\Rubrica::deleteData(null, $_SESSION['userId']);
}