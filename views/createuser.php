<?php
namespace views;
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
  <section class="content form-content">

      <?php if ($val)
      {?>
          <p> <?php echo $val; ?> </p>
      <?php }
      ?>



    <form action="<?php echo BASE ?>user/store" method="POST" class="form-admin">
        <h2 class="form-title">Registrate</h2>
        <div class="form-group">
          <label class="label">Mail:</label>
          <input class="input" type="email" name="us_mail" required>
        </div>

        <div class="form-group">
          <label class="label">Pass:</label>
          <input class="input" type="password" name="us-pass" required>
        </div>

        <div class="form-group">
          <label class="label">Nombre: </label>
          <input class="input" type="text" name="us-name" required>
        </div>

        <div class="form-group">
          <label class="label">Apellido: </label>
          <input class="input" type="text" name="us-lastname" required>
        </div>

        <input class="input" type="hidden" name="type" value="2" >

        <div class="div-form-button">
          <button type="submit" class ="form-button">Agregar usuario</button>
        </div>

        <div style="text-align:center">
         <p>Ya estas registrado? <a href="<?php echo BASE ?>home/index">Logueate aquí</a></p>
        </div>

    </form>

  </section>
</body>
</html>
