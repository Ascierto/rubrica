<?php
// phpcs:ignoreFile
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <title>Rubrica Contatti</title>
</head>
<body class="bg-dark text-light">
  <header class="container">
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg mb-3">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Rubrica</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav" >
          <ul class="navbar-nav">
            <?php if ( isset( $_SESSION['username'] ) ) : ?>
              <li class="nav-item">
                <span class="nav-link">Benvenuto <?php echo $_SESSION['username']; ?></span>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/rubrica">Tutti i Contatti</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/rubrica/inserisci-contatto.php">Inserisci Contatto</a>
              </li>
              <li>
                <a class="nav-link" href="/rubrica/includes/login.php?logout=1">Logout</a>
              </li>
            <?php else: ?>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/rubrica/login.php">Accedi</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/rubrica/registrazione.php">Registrati</a>
              </li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <main class="container">