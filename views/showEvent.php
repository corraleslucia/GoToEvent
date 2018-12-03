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
        <h3>EVENTO:</h3>

        <div class="container">
      <?php if ($event)
            { ?>
                <div class="div-img" style="padding-top: 5%">
                    <img class="img-list-event" src="<?= IMG_UPLOADS . '/event/' . $event['0']->getPoster() ?>" class="img-list-event" />
                </div>
                <h2 style="padding-top: 5%">Evento: <?php echo $event['0']->getDescription()?> </h2>
                <p>Categoria: <b><?php echo $event['0']->getCategory()?></b> </p>

                <div style="text-align: center">
                    <a class="secondary-button" href="<?= BASE ?>event/inputUpdateData/<?php echo $event['0']->getId()?>">Modificar</a>
                    <a class="secondary-button" href="<?= BASE ?>event/deleteEvent/<?php echo $event['0']->getId()?>">Eliminar</a>
                </div>
                <br>


                <div class="subtitle">
                    <p class="margin-0"><b>FECHAS:</b></p>
                </div>


          <?php if ($calendars)
                {
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
                                    <?php echo $_value->getName() . " - "?>
                                <?php
                                }
                                ?></span>
                            </div>
                            <div class="full">
                                <p style="font-size:20px"><b><?php echo "Plazas: " ?></b></p>
                            </div>
                            <?php
                            if ($value->getEventSeats())
                            {
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
                          <?php }
                          ?>
                        </div>
                        <?php
                            }
                            else
                            { ?>
                                <div class="half mini-box"><p>SIN PLAZAS</p></div>
                      <?php }
                    }
                }
                else
                { ?>
                    <div class="half mini-box"><p>SIN FECHAS</p></div>
          <?php }
         } ?>


        </div>

        <div style="text-align: center">
            <a class="secondary-button" href="<?= BASE ?>event/index">Volver</a>
            <br>
        </div>
        <br>
    </section>
</body>
</html>
