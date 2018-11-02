<?php namespace views;

include(ROOT.'views/headerAdmin.php');
include(ROOT.'views/navAdmin.php');

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Alta Calendario</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/normalize.css">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/style.css" />

</head>
<body>
  <section class="content">
    
    <form action="<?php echo BASE ?>calendar/store" method="POST" class="form-admin form-med-size">
        <h2 class="form-title">Alta de calendario:</h2>
        <div class="form-group">
            <label class="label">Fecha: </label>
            <input type="date" name="cal-date" required>
        </div>

        <div class="form-group">
            <label class="label">Hora: </label>
            <input type="time" name="cal-time" required>
        </div>

        <div class="form-group">
            <label>Evento: <?php echo $event->getDescription()?> </label>
            <input type="hidden" name="id_event" value="<?php echo $event->getId()?>" >

        </div>

        <div class="form-group">
            <label class="label">Lugar: </label>
            <select class="form-control" name="id_location" required>
                <?php foreach ($locations as $key => $value)
                {
                    ?>
                    <option value = "<?php echo $value->getId()?>"> <?php echo $value->getName()?> </option>

                <?php } ?>
            </select>

        </div>

        <div class="form-group" >
            <label>Artista/s: </label><br>
            <?php foreach ($artists as $key => $value)
            {
                ?>
                <input type="checkbox" name="artists[]" value="<?php echo $value->getId()?>"><?php echo $value->getName()?><br>

            <?php } ?>

        </div>

        <div class="div-form-button">             
            <button type="submit" class ="form-button">Agregar calendario</button>
        </div> 
    </form>

  </section>
</body>
</html>
