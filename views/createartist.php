<?php
namespace views;

include('header.php');
include('navAdmin.php');
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Alta Artista</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/normalize.css">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/style.css" />

</head>
<body>
  <section class="content">
      <?php if ($val)
      {?>
          <p> <?php echo $val; ?> </p>
      <?php }
      ?>
    

    <form action="store" method="POST" class="form-admin">
      <h2 class="form-title">Alta de artista:</h2>
      <div class="form-group">
        <label>Nombre: </label>
        <input type="text" name="art-name" required>
      </div>
      <div class="div-form-button">
        <button type="submit" class ="form-button">Agregar artista</button>
      </div>
    </form>

  </section>
</body>
</html>
