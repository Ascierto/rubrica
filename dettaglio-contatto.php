
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
    ?>
    <main class="container my-5"> 
      <div class="row">
        <div class="col-12 card">

        <div class="card-header text-center">
          <h1><?php echo $contatto[0]['Nome']; ?></h1>
        </div>
        <hr />
        <div class="card-body">
          <table border="1" class="table my-5">
            <thead>
            <?php echo get_table_head($contatto[0]); ?>
            </thead>
            <tbody>
            <?php echo get_table_body($contatto); ?>
            </tbody>
          </table>
        
        </div>
        
        </div>
      </div>
<?php else :?>
        <h1>Contatto non trovato!</h1>
        <p>Spiacente, il contatto con ID <?php echo $_GET['id']; ?> non esiste o è stato rimosso.
         <a class="link-light" href="/rubrica">Torna alla lista dei contatti</a></p>
<?php endif;?>
    </main>
  </body>
</html>

