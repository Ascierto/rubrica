<?php
include __DIR__ . '/includes/Rubrica.php';
include __DIR__ . '/includes/util.php';
$args = array(
    'id' => $_GET['id'],
);
$contatto = Rubrica::select_data($args);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <title><?php echo $contatto[0]['Nome']; ?></title>
</head>
  <body>
  
    
        <?php include __DIR__ . "/includes/navbar.php"  ?>

 

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

