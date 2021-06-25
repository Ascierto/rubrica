<?php
include_once __DIR__ . '/includes/globals.php';
//phpcs:ignore Generic.Files.LineEndings
if (isset($_GET['stato'])) {
    \DataHandling\Utils\show_alert('inserimento', $_GET['stato']);
}
?>
    <form action="includes/contatti.php" method="POST" class="container">
    <div class="row mb-3">
      <div class="col">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" class="form-control" name="nome" id="nome" required>
      </div>
      <div class="col">
        <label for="telefono" class="form-label">Numero di Telefono</label>
        <input type="tel" class="form-control" name="telefono" id="telefono" required>
      </div>
    </div>
    <h2 class="my-3">Informazioni Aggiuntive</h2>
      <div class="row mb-3">
      <div class="col">
        <label for="organizzazione" class="form-label">Organizzazione</label>
        <input type="text" name="organizzazione" id="organizzazione" class="form-control">
      </div>
      <div class="col">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control">
      </div>
    </div>
    <div class="row mb-3">
      <div class="col">
        <label for="indirizzo" class="form-label">Indirizzo</label>
        <input type="text" name="indirizzo" id="indirizzo" class="form-control">
      </div>
      <div class="col">
        <label for="compleanno" class="form-label">Compleanno</label>
        <input type="date" name="compleanno" id="compleanno" class="form-control">
      </div>
    </div>

      <input type="submit" class="btn btn-primary" value="Aggiungi Contatto">
    </form>
  </main>
</body>
</html>