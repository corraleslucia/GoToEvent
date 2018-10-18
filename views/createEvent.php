<?php
namespace views;
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Alta Evento</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="css/normalize.css"/>
  <link rel="stylesheet" type="text/css" media="screen" href="css/style.css"/>

</head>
<body>
  <section class="content">
    <h2 class="form-title">Alta de evento:</h2>
    <form action="Event/store" method="POST" class="form-admin">
        <div class="form-group">
        <label>Nombre: </label>
        <input type="text" name="ev-name">
        </div>

        <div class="form-group">
            <label>Categoria: </label>
            <select>
                <option value="#">###########</option>
                <option value="#">###########</option>
                <option value="#">###########</option>
                <option value="#">###########</option>
            </select>

        </div>

      <button type="submit" class ="category-button">Agregar evento</button>
    </form>

  </section>
</body>
</html>
