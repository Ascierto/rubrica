
<?php
  require __DIR__ . '/includes/FormHandle.php';
  require __DIR__ . '/includes/header.php';
  require __DIR__ . '/includes/Rubrica.php';
  require __DIR__ . '/includes/util.php';
  $args = array(
      'id' => $_GET['id'],
  );
  $contatto = DataRubrica\Rubrica::selectData($args);
  if (count($contatto) > 0) :
      if (isset($_GET['stato'])) {
          show_alert("modifica", $_GET['stato']);
      }
        ?>
   

        <main class="container my-5">
          <div class="row justify-content-center">
              <div class="col-12 col-md-8 card p-4">
              
                        <form action="includes/contatti.php?id=<?php echo $contatto[0]['ID']; ?>" method="POST">

                          <label class="form-label my-3" for="nome">Nome</label>
                          <input class="form-control" type="text" name="nome" id="nome" 
                          value="<?php echo $contatto[0]['Nome']; ?>" required>

                          <label class="form-label my-3" for="telefono">Numero di Telefono</label>
                          <input class="form-control" type="tel" name="telefono" id="telefono" 
                          value="<?php echo $contatto[0]['Telefono']; ?>" required>

                          <hr />
                          <h2>Informazioni Aggiuntive</h2>
                          <label class="form-label my-3" for="organizzazione">Organizzazione</label>
                          <input class="form-control" type="text" name="organizzazione" id="organizzazione"
                          value="<?php echo $contatto[0]['organizzazione']; ?>">

                          <label class="form-label my-3" for="email">Email</label>
                          <input class="form-control" type="email" name="email" id="email"
                          value="<?php echo $contatto[0]['email']; ?>">

                          <label class="form-label my-3" for="indirizzo">Indirizzo</label>
                          <input class="form-control" type="text" name="indirizzo" id="indirizzo"
                          value="<?php echo $contatto[0]['indirizzo']; ?>">

                          <label class="form-label my-3" for="compleanno">Compleanno</label>
                          <input class="form-control" type="date" name="compleanno" id="compleanno"
                          value="<?php echo $contatto[0]['compleanno']; ?>">
                        
                          <input type="submit" value="Aggiorna Contatto" class="btn btn-outline-warning my-4">

                        </form>
              </div>
          </div>

  <?php else : ?>
        <h1>Contatto non trovato!</h1>
        <p>Spiacente, il contatto con ID <?php echo $_GET['id']; ?> non esiste o è stato rimosso.
        <a class="link-light" href="/rubrica">Torna alla lista dei contatti</a></p>
  <?php endif;?>

   </main>

</body>
</html>