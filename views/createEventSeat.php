<?php
namespace views;
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Alta Plaza Evento</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="css/normalize.css"/>
  <link rel="stylesheet" type="text/css" media="screen" href="css/style.css"/>

</head>
<body>
  <section class="content">
    <h2 class="form-title">Alta plaza evento:</h2>
    <form action="EventSeat/store" method="POST" class="form-admin">
        <div class="form-group">
            <label>Tipo plaza: </label>
            <select>
                <option value="#">###########</option>
                <option value="#">###########</option>
                <option value="#">###########</option>
                <option value="#">###########</option>
            </select>

        </div>

        <div class="form-group">
            <label>Calendario: </label>
            <select>
                <option value="#">Date - event description</option>
                <option value="#">###########</option>
                <option value="#">###########</option>
                <option value="#">###########</option>
            </select>
        </div>

        <div class="form-group">
            <label>Cantidad total: </label>
            <input type="number" name="ev-seat-cant" required>
        </div>

        <div class="form-group">
            <label>Precio: </label>
            <input type="number" name="ev-seat-price" required>
        </div>



      <button type="submit" class ="category-button">Agregar plaza evento</button>
    </form>

  </section>
</body>
</html>
