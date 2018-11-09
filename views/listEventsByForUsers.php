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
  <title>Eventos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href= "<?php echo BASE ?>/css/normalize.css">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>/css/style.css" />

</head>
<body>
  <section class="content">
    <h3>EVENTOS</h3>


    <div class="container">
        <form action="listForUser" method="POST">
            <div>
                <p>Mostar:
                <input type="radio" id="showtype1" name="show" value="byArtist">
                <label for="contactChoice1"> Por Artista (A-Z) </label>

                <input type="radio" id="showtype2" name="show" value="bycategory">
                <label for="contactChoice2"> Por Categoria </label>

                <input type="radio" id="showtype3" name="show" value="byDate">
                <label for="contactChoice2"> Por Fecha </label>

                <input type="radio" id="showtype4" name="show" value="byLocation">
                <label for="contactChoice2"> Por Ciudad </label>

                <button type="submit" >Mostrar</button>
                </p>
            </div>
        </form>
        <?php
            foreach ($eventsByArtists as $artist => $events)
            { ?>
                <div class="p-listev-art">
                <p style="font-size:22px"><b><?php echo $artist ?></b></p>
                </div>
            <?php
                foreach ($events as $key => $value)
                { ?>
                        <div class="element">
                        <a class="link-divs "href="<?= BASE ?>event/showEventDetails/<?php echo $value->getId()?>">
                            <div class="p-listev-art">
                                <p style="font-size:22px"><b><?php  echo $value->getDescription()?></b></p>
                            </div>
                        </a>
                        </div>

          <?php } ?>
    <?php } ?>
    </div>

  </section>
</body>
</html>
