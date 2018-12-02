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
  <title>Carrito</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/normalize.css">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/style.css" />

</head>
<body>
    <section class="content">
        <h3>CARRITO</h3>

        <?php if ($val)
        {?>
            <p> <?php echo $val; ?> </p>
        <?php }
        ?>

        <div class="container">
        <?php if (count($_SESSION['cart'])===0)
        { ?>
            <h2> Carrito vacio </h2>
            <div class= "full">
            <a class="secondary-button" href="<?= BASE ?>event/listForUser/byArtist">Ver Eventos</a>
            </div>
    <?php
        }
        else
        { ?>
                <?php foreach ($_SESSION['cart'] as $key => $ticket)
                  { ?>
                    <div class="element event-elem">
                        <div style="text-align: center">
                        <h2>Evento: <?php echo $ticket->getCalendar()->getIdEvent()?> </h2>
                        <p>Fecha: <b><?php echo $ticket->getCalendar()->getDate() ?></b></p>
                        <p>Hora: <b><?php echo $ticket->getCalendar()->getTime()?></b></p>
                        <p>Lugar: <b><?php echo $ticket->getCalendar()->getLocation()?></b></p>
                        <p><b>Artistas: </b></p>
                        <span style="font-size:18px">
                        <?php
                        foreach  ($ticket->getCalendar()->getArtists() as $_key => $_value)
                        {
                            echo $_value->getName() ?> <br>

                        <?php
                        }
                        ?></span>
                        </div>
                        <div class="element event-elem">
                            <div style="text-align: center">
                                <div class= "full">
                                <p><?php echo $ticket->getSeatType() . " - Cantidad: " . $ticket->getQuantity() . " - $ " . $ticket->getPrice() . " - Total: $" . $ticket->getTotal() ?>
                                </p>
                                    <a class="secondary-button" href="<?= BASE ?>ticket/deleteFromCart/<?php echo $key?>">Borrar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                 <?php
                  } ?>

                  <div class= "full">
                  <a class="secondary-button" href="<?= BASE ?>ticket/buyTickets">COMPRAR</a>
                  </div>
    <?php
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
