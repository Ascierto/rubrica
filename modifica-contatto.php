<?php
include_once __DIR__ . '/includes/globals.php';
$args = array(
    'id' => $_GET['id'],
    'userId' => $_SESSION['userId']
);
$contatto = \DataHandling\Rubrica::selectData($args);
if (count($contatto) > 0) :
    if (isset($_GET['stato'])) {
        \DataHandling\Utils\show_alert('modifica', $_GET['stato']);
    }
    ?>
            <form action="includes/contatti.php?id=<?php echo $contatto[0]['ID']; ?>" method="POST" class="container">
            <div class="row mb-3">
              <div class="col">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" name="nome" id="nome"
                value="<?php echo $contatto[0]['Nome']; ?>" required>
              </div>
              <div class="col">
                <label for="telefono" class="form-label">Numero di Telefono</label>
                <input type="tel" class="form-control" name="telefono" id="telefono"
                value="<?php echo $contatto[0]['Telefono']; ?>" required>
              </div>
            </div>
            <h2 class="my-3">Informazioni Aggiuntive</h2>
              <div class="row mb-3">
              <div class="col">
                <label for="organizzazione" class="form-label">Organizzazione</label>
                <input type="text" name="organizzazione" id="organizzazione" class="form-control"
                value="<?php echo $contatto[0]['organizzazione']; ?>">
              </div>
              <div class="col">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control"
                value="<?php echo $contatto[0]['email']; ?>">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col">
                <label for="indirizzo" class="form-label">Indirizzo</label>
                <input type="text" name="indirizzo" id="indirizzo" class="form-control"
                value="<?php echo $contatto[0]['indirizzo']; ?>">
              </div>
              <div class="col">
                <label for="compleanno" class="form-label">Compleanno</label>
                <input type="date" name="compleanno" id="compleanno" class="form-control"
                value="<?php echo $contatto[0]['compleanno']; ?>">
              </div>
            </div>
              <input type="submit" class="btn btn-primary" value="Aggiorna Contatto">
            </form>
<?php else : ?>
  <h1>Contatto non trovato!</h1>
  <p>Spiacente, il contatto con ID <?php echo $_GET['id']; ?> non esiste o è stato rimosso.
  <a class="link-light" href="/rubrica">Torna alla lista dei contatti</a></p>
<?php endif;?>
  </main>
</body>
</html>