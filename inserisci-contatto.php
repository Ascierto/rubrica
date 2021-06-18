<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <title>Aggiungi Contatto</title>
</head>
<body>
 
        <?php include __DIR__ . "/includes/navbar.php"  ?>
    
  <main class="container my-5">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 card">

         <?php
          if (isset($_GET['stato']) && $_GET['stato'] === 'ok'):
          ?>
                <div class="stato stato--ok">Contatto aggiunto con successo.</div>
              <?php
          elseif (isset($_GET['stato']) && $_GET['stato'] === 'ko'):
          ?>
                <div class="stato stato--ko">Ops! C'è stato un problema, riprova più tardi.</div>
              <?php
          endif;
          ?>

            <form action="includes/contatti.php" method="POST">

              <label class="form-label my-3" for="nome">Nome</label>
              <input class="form-control" type="text" name="nome" id="nome" required>

              <label class="form-label my-3" for="telefono">Numero di Telefono</label>
              <input class="form-control" type="tel" name="telefono" id="telefono" required>

              <hr />
              <h2>Informazioni Aggiuntive</h2>
              <label class="form-label my-3" for="organizzazione">Organizzazione</label>
              <input class="form-control" type="text" name="organizzazione" id="organizzazione">
              
              <label class="form-label my-3" for="email">Email</label>
              <input class="form-control" type="email" name="email" id="email">
              
              <label class="form-label my-3" for="indirizzo">Indirizzo</label>
              <input class="form-control" type="text" name="indirizzo" id="indirizzo">

              <label class="form-label my-3" for="compleanno">Compleanno</label>
              <input class="form-control" type="date" name="compleanno" id="compleanno">


              <input type="submit" value="Aggiungi Contatto" class="btn btn-outline-success my-4">

            </form>


      </div>
    </div>
   </main>
 </body>
</html>