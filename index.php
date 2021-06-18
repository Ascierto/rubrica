
 <?php include __DIR__ . '/includes/header.php' ;?>

   
  

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