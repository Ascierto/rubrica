<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <title>Rubrica Contatti</title>
</head>
<body>

 
      
       <?php include __DIR__ . "/includes/navbar.php"  ?>

   
  

  <main class=" container">
    <div class="row justify-content-center">
      <div class="col-12">

      
            <?php
                include __DIR__ . '/includes/Rubrica.php';
                include __DIR__ . '/includes/util.php';
                $contatti = Rubrica::select_data();

                if (isset($_GET['statocanc']) && $_GET['statocanc'] === 'ok'):
                ?>

                  <div class="alert alert-success" role="alert">Contatto eliminato con successo.</div>

                <?php
                elseif (isset($_GET['statocanc']) && $_GET['statocanc'] === 'ko'):
                ?>

                  <div class="alert alert-danger" role="alert">Ops! C'è stato un problema, riprova più tardi.</div>

                <?php
                endif;
                if (count($contatti) > 0):
              ?>

                  <table border="1" class="table my-5">
                    <thead>
                    <?php echo get_table_head($contatti[0]); ?>
                    </thead>
                    <tbody>
                    <?php echo get_table_body($contatti); ?>
                    </tbody>
                  </table>

              <?php else: ?>

                <p>Nessun contatto da mostrare, <a href="/rubrica/inserisci-contatto.php">vuoi aggiungerne uno?</a></p>

            <?php endif;?>
      </div>
    </div>

  </main>
</body>
</html>