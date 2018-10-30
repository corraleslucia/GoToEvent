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
  <title>Alta Usuario</title>
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

    <h2 class="form-title">Alta de usuario:</h2>

    <form action="store" method="POST" class="form-admin">
        <div class="form-group">
        <label>Mail: </label>
        <input type="email" name="us_mail" required>
        </div>

        <div class="form-group">
        <label>Pass: </label>
        <input type="password" name="us-pass" required>
        </div>

        <div class="form-group">
        <label>Nombre: </label>
        <input type="text" name="us-name" required>
        </div>

        <div class="form-group">
        <label>Apellido: </label>
        <input type="text" name="us-lastname" required>
        </div>


      <button type="submit" class ="user-button">Agregar usuario</button>
    </form>

  </section>
</body>
</html>
