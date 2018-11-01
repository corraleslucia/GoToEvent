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
  <title>Eventos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href= "<?php echo BASE ?>/css/normalize.css">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>/css/style.css" />

</head>
<body>
  <section class="content">
    <h3>PROXIMOS EVENTOS</h3>
    <div class="events-content">
        <?php
            foreach ($events as $key => $value) {
                foreach ($categories as $_key => $_value) {
                    if ($value->getCategory() === $_value->getId())
                    {
                        $_categoryName = $_value->getDescription();
                    }
                }
        ?>

            <div class="event">
            <a href="<?= BASE ?>event/showEventDetails/<?php echo $value->getId()?>"> <h4><?php echo $value->getDescription()?></h4> </a>
            <div class="p-listev-art"><p>Categoria:<?php echo $_categoryName?></p></div>
        </div>
    <?php } ?>
    </div>

  </section>
</body>
</html>
