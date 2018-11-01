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
  <title>Artistas</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/normalize.css">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/style.css" />

</head>
<body>
  <section class="content">
    <h3>ARTISTAS</h3>
    <div class="container">
        <?php
            foreach ($artists as $key => $value) {

        ?>

        <div class="element">
          <a class="link-divs" href="">
            <h4><?php echo $value->getName()?></h4>
          </a>
        </div>


    <?php } ?>
    </div>

  </section>
</body>
</html>
