<?php
include_once __DIR__ . '/includes/globals.php';
$args     = array(
    'id' => $_GET['id'],
    'userId' => $_SESSION['userId']
);
$contatto = \DataHandling\Rubrica::selectData($args);
if (count($contatto) > 0) :
    ?>
  <div class="d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center" >
    <?php $hash = md5($contatto[0]['email']); ?>
    <div class="d-inline-block me-3 rounded bg-light overflow-hidden">
      <img src="https://gravatar.com/avatar/<?php echo $hash; ?>?s=400&d=robohash&r=x"
      alt="avatar di <?php echo $contatto[0]['Nome']; ?>" width="64" />
    </div>
    <h1 class="d-inline-block"><?php echo $contatto[0]['Nome']; ?></h1>
    </div>
    <div>
      <a class="btn btn-primary" href="/rubrica/modifica-contatto.php?id=<?php echo $_GET['id']; ?>">
        Modifica Contatto
      </a>
      <a
        class="btn btn-outline-danger"
        href="/rubrica/includes/cancella-contatto.php?id=<?php echo $_GET['id']; ?>">
        Cancella Contatto
      </a>
    </div>
  </div>
  <hr />
  <table class="table table-striped table-dark table-hover table-bordered table-responsive">
    <thead>
    <?php echo \DataHandling\Utils\get_table_head($contatto[0]); ?>
    </thead>
    <tbody>
    <?php echo \DataHandling\Utils\get_table_body($contatto); ?>
    </tbody>
  </table>
<?php else : ?>
  <h1>Contatto non trovato!</h1>
  <p>Spiacente, il contatto con ID <?php echo $_GET['id']; ?> non esiste o è stato rimosso.
  <a class="link-light" href="/rubrica">Torna alla lista dei contatti</a></p>
<?php endif; ?>
  </main>
</body>
</html>

