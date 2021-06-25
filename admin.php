<?php
include __DIR__ . '/includes/globals.php';
?>

    <a href="includes/cancella-contatto.php" class="btn btn-primary">Cancella Tutti i Contatti</a>
    <a href="includes/cancella-utente.php" class="btn btn-primary">Cancella Account</a>
    <a href="#" id="export" class="btn btn-primary">Esporta Contatti</a>


  <script>
  function exportCSV(e) {
    e.preventDefault();
    const conferma = confirm("Vuoi esportare tutti i contatti?");
    if (conferma) {
      window.open("includes/export.php", '_blank');
    }
  }
  document.getElementById("export").addEventListener("click", exportCSV);
  </script>
  </main>
</body>
</html>