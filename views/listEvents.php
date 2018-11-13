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
  <title>Eventos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href= "<?php echo BASE ?>/css/normalize.css">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>/css/style.css" />

</head>
<body>
  <section class="content">
    <h3>EVENTOS</h3>


    <div class="container">
        <form action="_list" method="POST">
            <div>
                <p>Mostar:
                <input type="radio" id="showtype1" name="show" value="all">
                <label for="contactChoice1"> Todos (A-Z) </label>

                <input type="radio" id="showtype2" name="show" value="valid">
                <label for="contactChoice2"> Vigentes </label>

                <button type="submit" >Mostrar</button>
                </p>
            </div>
        </form>
        <?php
            foreach ($events as $key => $value) {

        ?>
        <div class="element">
            <a class="link-divs "href="<?= BASE ?>event/showEventDetails/<?php echo $value->getId()?>">
                <div class="p-listev-art">
                    <p style="font-size:22px"><b><?php echo $value->getDescription()?></b></p>
                </div>
                <div class="p-listev-art">
                    <p>Categoria: <?php echo $value->getCategory()?></p>
                </div>
            </a>
        </div>
    <?php } ?>
    </div>

  </section>
</body>
</html>
