<?php namespace views;

include(ROOT.'views/headerAdmin.php');
include(ROOT.'views/navAdmin.php');


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

      <?php if ($val)
      {?>
          <p class="alert"> <?php echo $val; ?> </p>
      <?php }
      ?>

    <form action="<?php echo BASE ?>eventseat/store" method="POST" class="form-admin">
        <h2 class="form-title">Alta plaza evento:</h2>
        <div class="form-group">
            <label>Calendario:  <?php echo $_calendar['0']->getIdEvent(). " - " .  $_calendar['0']->getDate() . " - " . $_calendar['0']->gettime() . " - " . $_calendar['0']->getLocation() . " - Capacidad Máx. " . $locationCapacity ?>  </label>

            <input class="input" type="hidden" name="locationCapacity" value="<?php echo $locationCapacity ?>" >
            <input class="input" type="hidden" name="id_calendar" value="<?php echo $_calendar['0']->getId()?>" >

        </div>

        <div class="form-group">
            <label class="label" >Tipo de plaza: </label>
            <select class="form-control" name="id_seatType" required>
                <?php foreach ($seatsTypes as $key => $value)
                {
                    ?>
                    <option value = "<?php echo $value->getId()?>"> <?php echo $value->getName()?> </option>

                <?php } ?>
            </select>

            <span>
                  <a class ="form-secondary-button " href="<?php echo BASE ?>seatType/add/<?php echo $_calendar['0']->getId()?>">Nuevo Tipo de Plaza</a>
            </span>

        </div>


        <div class="form-group">
            <label class="label">Cantidad total: </label>
            <input class="input" id="ev-seat-cant" type="number" name="ev-seat-cant" min="1" max="<?php echo $availableCapacity ?>" oninvalid="setCustomValidity('La cantidad supera la capacidad del lugar. Máximo disponible <?php echo $availableCapacity ?>')"
    onkeydown="try{setCustomValidity('')}catch(e){}" required>
        </div>

        <div class="form-group">
            <label class="label" >Precio: </label>
            <input class="input" type="number" name="ev-seat-price" required>
        </div>


        <div class="div-form-button">
            <button type="submit" name= "button" value="continue" class ="form-button button-half">Agregar otra plaza evento</button>
            <button type="submit" name= "button" value="end" class ="form-button button-half">Finalizar</button>
        </div>
    </form>

  </section>

</body>
</html>
