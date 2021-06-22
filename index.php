
<?php
  require __DIR__ . '/includes/FormHandle.php';
  require __DIR__ . '/includes/header.php';
  require __DIR__ . '/includes/Rubrica.php';
  require __DIR__ . '/includes/util.php';
  $contatti = \DataRubrica\Rubrica::selectData();

if (isset($_GET['statocanc'])) {
    show_alert("cancellazione", $_GET['statocanc']);
}
if (count($contatti) > 0) :
    ?>

  <main class=" container">
    <div class="row justify-content-center">
      <div class="col-12">


                  <table border="1" class="table my-5">
                    <thead>
                  <?php echo get_table_head($contatti[0]); ?>
                    </thead>
                    <tbody>
                  <?php echo get_table_body($contatti); ?>
                    </tbody>
                  </table>

<?php else : ?>
                <p>Nessun contatto da mostrare, <a href="/rubrica/inserisci-contatto.php">vuoi aggiungerne uno?</a></p>
<?php endif;?>
      </div>
    </div>

  </main>
</body>
</html>