<?php
namespace views;
include(ROOT.'views/headerUser.php');
include(ROOT.'views/navUser.php');


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
            if($calendars)
            {
                foreach ($calendars as $key => $value)
                {  ?>
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
                                        <?php if ($_value->getRemaningQuantity() === "0")
                                        { ?>
                                            <p><?php echo "Tipo de Plaza: "  . $_value->getSeatType() ?> </p>
                                            <br>
                                            <p><?php echo "SIN DISPONIBILIDAD"?> </p>
                                        <?php }
                                        else
                                        { ?>
                                            <a class="link-divs" href="<?= BASE ?>purchaseline/selectTicketOptions/<?php echo $value->getId()?>/<?php echo $_value->getId()?>/<?php echo $event['0']->getId()?>">
                                                <p><?php echo "Tipo de Plaza: "  . $_value->getSeatType() ?> </p>
                                                <br>
                                                <p><?php echo "Precio: " . $_value->getPrice()?> </p>
                                            </a>
                                  <?php } ?>
                                    </div>
                          <?php } ?>
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
      <?php }?>

            <div style="text-align: center">
                <a class="secondary-button" href="<?= BASE ?>event/listForUser/byArtist">Volver</a>
                <br>
            </div>
            <br>
        </div>

    </section>
</body>
</html>
