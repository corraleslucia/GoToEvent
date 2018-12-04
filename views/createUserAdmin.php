<?php
namespace views;
include(ROOT.'views/headerAdmin.php');
include(ROOT.'views/navAdmin.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Alta Usuarios</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/normalize.css">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/style.css" />

</head>
<body>
  <section class="content form-content">

      <?php if ($val)
      {?>
          <p class="alert"> <?php echo $val; ?> </p>
      <?php }
      ?>

    <form action="<?php echo BASE ?>user/store" method="POST"  enctype="multipart/form-data" class="form-admin">
        <h2 class="form-title">Registrar Usuario</h2>
        <div class="form-group">
          <input class="input" type="hidden" name="typeFrm" value="1" >
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

        <div class="form-group">
            <label class="label">Tipo: </label>

            <input type="radio" id="client" name="user-type" value="2" checked>
            <label for="client">Cliente</label>

            <input type="radio" id="admin" name="user-type" value="1">
            <label for="admin">Aministrador</label>
        </div>

        <div class="form-group">
          <label class="label" >Imagen: </label>
          <input type="file" name="avatar" required>
        </div>

        <div class="div-form-button">
          <button type="submit" class ="form-button">Agregar usuario</button>
        </div>

    </form>


  </section>
</body>
</html>
