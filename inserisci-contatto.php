
 
        <?php include __DIR__ . "/includes/header.php"  ?>
    
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