<?php namespace views;

include('header.php');
include('navAdmin.php');


use \daos\daodb\ArtistDb as DaoArtist;
use \daos\daodb\LocationDb as DaoLocation;
use \daos\daodb\EventDb as DaoEvent;

$daoArtist = DaoArtist::getInstance();
$artists = $daoArtist->readAll();

$daoLocation = DaoLocation::getInstance();
$locations = $daoLocation->readAll();

$daoEvent = DaoEvent::getInstance();
$events = $daoEvent->readAll();

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
        <label>Hora: </label>
        <input type="time" name="cal-time" required>
        </div>

        <div class="form-group">
            <label>Evento: </label>
            <select class="form-control" name="id_event" required>
                <?php foreach ($events as $key => $value)
                {
                    ?>
                    <option value = "<?php echo $value->getId()?>"> <?php echo $value->getDescription()?> </option>

                <?php } ?>
            </select>

        </div>

        <div class="form-group">
            <label>Lugar: </label>
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


      <button type="submit" class ="category-button">Agregar calendario</button>

    </form>

  </section>
</body>
</html>
