<?php namespace views;

include('header.php');
include('navAdmin.php');


?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Alta Plaza Evento</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/normalize.css">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/style.css" />

</head>
<body>
  <section class="content">
    <h2 class="form-title">Alta plaza evento:</h2>
    <form action="<?php echo BASE ?>eventseat/store" method="POST" class="form-admin">

        <div class="form-group">
            <label>Calendario:  <?php echo $event->getDescription() . " - " .  $_calendar->getDate() . " - " . $location->getName()?> </label>

            <input type="hidden" name="id_calendar" value="<?php echo $_calendar->getId()?>" >

        </div>

        <div class="form-group">
            <label>Tipo de plaza: </label>
            <select class="form-control" name="id_seatType" required>
                <?php foreach ($seatsTypes as $key => $value)
                {
                    ?>
                    <option value = "<?php echo $value->getId()?>"> <?php echo $value->getName()?> </option>

                <?php } ?>
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



      <button type="submit" name= "button" value="end" class ="category-button">Finalizar</button>
      <button type="submit" name= "button" value="continue" class ="category-button">Agregar otra plaza evento</button>
    </form>

  </section>
</body>
</html>
