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
  <link rel="stylesheet" type="text/css" media="screen" href="../css/normalize.css"/>
  <link rel="stylesheet" type="text/css" media="screen" href="../css/style.css"/>

</head>
<body>
  <section class="content">
    <h2 class="form-title">Login</h2>
    <form action="User/login" method="POST" class="form-login">
        <div class="form-group">
            <label>E-mail: </label>
            <input type="email" name="mail">
        </div>
        
        <div class="form-group">
            <label>Contraseña: </label>
            <input type="password" name="pass">
        </div>
       

      <button type="submit" class ="category-button">Iniciar Sesion</button>
    </form>

  </section>
</body>
</html>
