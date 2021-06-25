<?php
session_start();

$mysqli = new mysqli('127.0.0.1', 'root', 'rootroot', 'rubricadb');

if ($mysqli->connect_errno) {
    echo 'Connessione al database fallita: ' . $mysqli->connect_error;
    exit();
}

$query = $mysqli->prepare("SELECT contatti.ID, Nome, Telefono, organizzazione, email, indirizzo, compleanno FROM contatti
            JOIN contatti_meta
              ON contatti.ID = contatti_meta.contatti_id
            WHERE contatti.id_utente = ?");
$query->bind_param('i', $_SESSION['userId']);
$query->execute();
$result = $query->get_result();

$contacts = array();
if ($result->num_rows > 0) {
  while ($contact = $result->fetch_assoc()) {
    $contacts[] = $contact;
  }
}

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=Contatti.csv');
$output = fopen("php://output", 'w');
fputcsv($output, array('No', 'Nome', 'Telefono', 'Organizzazione', 'Email', 'Indirizzo', 'Compleanno'));
if (count($contacts) > 0) {
  foreach ($contacts as $contact) {
    fputcsv($output, $contact);
  }
}
