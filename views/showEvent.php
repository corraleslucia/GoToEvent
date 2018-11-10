<?php
namespace views;
include(ROOT.'views/headerAdmin.php');
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

        <div class="container">
            <h2>Evento: <?php echo $event['0']->getDescription()?> </h2>
            <p>Categoria: <b><?php echo $event['0']->getCategory()?></b> </p>
            <p><b>FECHAS:</b></p>

            <?php
                foreach ($calendars as $key => $value)
                { ?>
                    <div class="element event-elem">
                        <div class="half">
                            <p style="font-size:20px"> <?php echo "Fecha: "  . $value->getDate() ?></p>
                        </div>
                        <div class="half">
                            <p style="font-size:20px"><?php echo "Hora: " . $value->getTime()?></p>
                        </div>
                        <div class="full">
                            <p><b>Lugar:</b> <?php echo $value->getLocation()?></p>
                        </div>
                        <div class="full">
                            <p><b>Artistas: </b></p>
                            <span style="font-size:18px">
                            <?php
                            foreach ($value->getArtists() as $_key => $_value)
                            { ?>
                                <?php echo $_value->getIdArtist() . " - "?>
                            <?php
                            }
                            ?></span>
                        </div>
                        <div class="full">
                            <p style="font-size:20px"><b><?php echo "Plazas: " ?></b></p>
                        </div>
                        <?php
                            foreach ($value->getEventSeats() as $_key => $_value)
                            { ?>
                                <div class="half mini-box">
                                    <p><?php echo "Tipo de Plaza: "  . $_value->getSeatType() ?> </p>
                                    <br>
                                    <p><?php echo "Cantidad Total: " . $_value->getTotalQuantity()?> </p>
                                    <br>
                                    <p><?php echo "Precio: " . $_value->getPrice()?> </p>
                                    <br>
                                    <p><?php echo "Remanente: " . $_value->getRemaningQuantity() ?> </p>
                                </div>
                    <?php } ?>

                    </div>
            <?php } ?>

        </div>

    </section>
</body>
</html>
