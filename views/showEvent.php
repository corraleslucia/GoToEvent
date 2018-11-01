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

        <div class="container">
            <h2>Evento: <?php echo $event->getDescription()?> </h2>
            <p>Categoria: <b><?php echo $category->getDescription()?></b> </p>
            <p><b>FECHAS:</b></p>

            <?php
                foreach ($calendars as $cal_key => $cal_value)
                { ?>
                    <div class="element event-elem">
                        <div class="half">    
                            <p style="font-size:20px"> <?php echo "Fecha: "  . $cal_value->getDate() ?></p>
                        </div>  
                        <div class="half">    
                            <p style="font-size:20px"><?php echo "Hora: " . $cal_value->getTime()?></p>
                        </div> 
                        <div class="full">
                            <p><b>Lugar:</b> <?php echo $location->getname()?></p>
                        </div>
                        <div class="full">
                            <p><b>Artistas: </b></p>
                            <span style="font-size:18px">
                            <?php
                            foreach ($cal_value->getArtists() as $key => $value)
                            { ?>
                                <?php echo $value['0']->getName() . " - "?> 
                            <?php
                            }
                            ?></span>
                        </div>
                        <div class="full">
                            <p style="font-size:20px"><b><?php echo "Plazas: " ?></b></p>
                        </div>
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
                                <div class="half mini-box">
                                    <p><?php echo "Tipo de Plaza: "  . $_seatTypeName ?> </p>
                                    <br>
                                    <p><?php echo "Cantidad Total: " . $evS_value->getTotalQuantity()?> </p>
                                    <br>
                                    <p><?php echo "Precio: " . $evS_value->getPrice()?> </p>
                                    <br>
                                    <p><?php echo "Remanente: " . $evS_value->getRemaningQuantity() ?> </p>
                                </div>
                    <?php } ?>

                    </div>
            <?php } ?>

        </div>

    </section>
</body>
</html>
