<?php
namespace views;
include(ROOT.'views/header.php');
include(ROOT.'views/navAdmin.php');


 ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Plazas Evento</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/normalize.css">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/style.css" />

</head>
<body>
    <section class="content">
        <h3>EVENTO</h3>

        <div class="events-content">
            <h4>Evento: <?php echo $event->getDescription()?> </h4>
            <p>Categoria: <?php echo $category->getDescription()?> </p>
            <p>FECHAS:</p>

            <?php
                foreach ($calendars as $cal_key => $cal_value)
                { ?>
                    <div class="event">
                        <h4> <?php echo "Fecha: "  . $cal_value->getDate() ?></h4>
                        <br>
                        <h4><?php echo "Hora: " . $cal_value->getTime()?></h4>
                        <br>
                        <h4><?php echo "Lugar: " . $location->getname()?></h4>
                        <br>
                        <h4><?php echo "Artistas: "?> </h4>
                        <br>
                        <?php
                        foreach ($cal_value->getArtists() as $key => $value)
                        { ?>
                            <h4><?php echo $value['0']->getName() ?> </h4>
                        <?php
                        }
                         ?>
                         <h4><?php echo "Plazas: " ?> </h4>
                        <br>
                        <?php
                            foreach ($cal_value->getEventSeats() as $evS_key => $evS_value)
                            {
                                foreach ($_seatsType as $seT_key => $seT_value)
                                {
                                    if ($evS_value->getSeatType() === $seT_value->getId())
                                    {
                                        $_seatTypeName = $seT_value->getName();
                                    }
                                } ?>
                                <h4><?php echo "Tipo de Plaza: "  . $_seatTypeName ?> </h4>
                                <br>
                                <p><?php echo "Cantidad Total: " . $evS_value->getTotalQuantity()?> </p>
                                <br>
                                <p><?php echo "Precio: " . $evS_value->getPrice()?> </p>
                                <br>
                                <p><?php echo "Remanente: " . $evS_value->getRemaningQuantity() ?> </p>
                                <br>
                    <?php } ?>

                    </div>
            <?php } ?>

        </div>

    </section>
</body>
</html>
