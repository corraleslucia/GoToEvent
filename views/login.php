<?php
namespace views;
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login - GoToEvent</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/normalize.css">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/style.css" />

</head>
<body>
  <section class="content">

    <form action="<?php echo BASE ?>User/login" method="POST" class="form-login">
    <h2 class="form-title">Login</h2>
      <div class="form-group">
          <label class="label">E-mail: </label>
          <input class="input" type="email" name="mail">
      </div>

      <div class="form-group">
          <label class="label">Contraseña: </label>
          <input class="input" type="password" name="pass">
      </div>

      <div class="div-form-button">
        <button type="submit" class ="form-button">Iniciar Sesion</button>
      </div>

      <div style="text-align:center">
        <p>No estas registrado? <a href="<?php echo BASE ?>user/register">Registrate aquí</a></p>
      </div>
    </form>

  </section>
</body>
</html>
