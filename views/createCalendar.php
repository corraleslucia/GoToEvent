<?php
namespace views;
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Alta Calendario</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="css/normalize.css"/>
  <link rel="stylesheet" type="text/css" media="screen" href="css/style.css"/>

</head>
<body>
  <section class="content">
    <h2 class="form-title">Alta de calendario:</h2>
    <form action="Calendar/store" method="POST" class="form-admin form-med-size">
        <div class="form-group">
        <label>Fecha: </label>
        <input type="date" name="cal-date" required>
        </div>

        <div class="form-group">
            <label>Evento: </label>
            <select>
                <option value="#">###########</option>
                <option value="#">###########</option>
                <option value="#">###########</option>
                <option value="#">###########</option>
            </select>

        </div>

        <div class="form-group">
            <label>Lugar: </label>
            <select>
                <option value="#">###########</option>
                <option value="#">###########</option>
                <option value="#">###########</option>
                <option value="#">###########</option>
            </select>

        </div>

        <div class="form-group">
            <label>Artista/s: </label><br>
            <input type="checkbox" name="#####" value="###">***************<br>
            <input type="checkbox" name="#####" value="###">***************<br>
            <input type="checkbox" name="#####" value="###">***************<br>

        </div>


      <button type="submit" class ="category-button">Agregar calendario</button>

    </form>

  </section>
</body>
</html>
