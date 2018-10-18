<?php
namespace views;
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Alta Lugar Evento</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="css/normalize.css"/>
  <link rel="stylesheet" type="text/css" media="screen" href="css/style.css"/>

</head>
<body>
  <section class="content">
    <h2 class="form-title">Alta de lugar de evento:</h2>
    <form action="Location/store" method="POST" class="form-admin form-med-size">
      <div class="form-group">
        <label>Nombre lugar: </label>
        <input type="text" name="loc-name" required>
      </div>

      <div class="form-group">
        <label>Direccion: </label>
        <input type="text" name="loc-adress" required>
      </div>

      <div class="form-group">
        <label>Ciudad: </label>
        <input type="text" name="loc-city" required>
      </div>

      <button type="submit" class ="artist-button">Agregar lugar evento</button>
    </form>

  </section>
</body>
</html>
