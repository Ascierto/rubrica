<?php
include __DIR__ . '/includes/Rubrica.php';
include __DIR__ . '/includes/util.php';
$args = array(
    'id' => $_GET['id'],
);
$contatto = Rubrica::select_data($args);
?>

  
    
        <?php include __DIR__ . "/includes/header.php"  ?>

 

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

    </main>
  </body>
</html>

