<?php
include __DIR__ . '/includes/globals.php';

$contatti = \DataHandling\Rubrica::selectData(array( 'userId' => $_SESSION['userId'] ));



if (isset($_GET['statocanc'])) {
    \DataHandling\Utils\show_alert('cancellazione', $_GET['statocanc']);
}
if (count($contatti) > 0) :
    ?>

<table class="table table-striped table-dark table-hover table-bordered table-responsive">
  <thead>
    <?php echo \DataHandling\Utils\get_table_head($contatti[0]); ?>
  </thead>
  <tbody>
    <?php echo \DataHandling\Utils\get_table_body($contatti); ?>
  </tbody>
</table>
<?php else : ?>
  <p class="alert alert-dark" role="alert">Nessun contatto da mostrare,
  <a href="/rubrica/inserisci-contatto.php">vuoi aggiungerne uno?</a></p>
<?php endif; ?>
  </main>
</body>
</html>