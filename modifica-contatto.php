<?php
include __DIR__ . '/includes/Rubrica.php';
$args = array(
    'id' => $_GET['id'],
);
$contatto = Rubrica::select_data($args);
?>



      <?php include __DIR__ . "/includes/header.php"  ?>
   

  <main class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 card p-4">
        
            <?php
                if (isset($_GET['stato']) && $_GET['stato'] === 'ok'):
                ?>
                      <div class="alert alert-success" role="alert">Contatto aggiornato con successo.</div>
                    <?php
                elseif (isset($_GET['stato']) && $_GET['stato'] === 'ko'):
                ?>
                      <div class="alert alert-danger" role="alert">Ops! C'è stato un problema, riprova più tardi.</div>
                    <?php
                endif;
              ?>
                  <form action="includes/contatti.php?id=<?php echo $contatto[0]['ID']; ?>" method="POST">

                    <label class="form-label my-3" for="nome">Nome</label>
                    <input class="form-control" type="text" name="nome" id="nome" value="<?php echo $contatto[0]['Nome']; ?>" required>
                    <label class="form-label my-3" for="telefono">Numero di Telefono</label>
                    <input class="form-control" type="tel" name="telefono" id="telefono" value="<?php echo $contatto[0]['Telefono']; ?>" required>
                    <hr />
                    <h2>Informazioni Aggiuntive</h2>
                    <label class="form-label my-3" for="organizzazione">Organizzazione</label>
                    <input class="form-control" type="text" name="organizzazione" id="organizzazione" value="<?php echo $contatto[0]['organizzazione']; ?>">
                    <label class="form-label my-3" for="email">Email</label>
                    <input class="form-control" type="email" name="email" id="email" value="<?php echo $contatto[0]['email']; ?>">
                    <label class="form-label my-3" for="indirizzo">Indirizzo</label>
                    <input class="form-control" type="text" name="indirizzo" id="indirizzo" value="<?php echo $contatto[0]['indirizzo']; ?>">
                    <label class="form-label my-3" for="compleanno">Compleanno</label>
                    <input class="form-control" type="date" name="compleanno" id="compleanno" value="<?php echo $contatto[0]['compleanno']; ?>">
                  
                    <input type="submit" value="Aggiorna Contatto" class="btn btn-outline-warning my-4">

                  </form>
        </div>
    </div>

   </main>

</body>
</html>