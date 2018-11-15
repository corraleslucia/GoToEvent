<?php
namespace views;
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
    if ($artists)
    {
        foreach ($artists as $key => $value)
        { ?>
            <div class="element event-elem">

                <h4><?php echo $value->getName() ?></h4>
                <img src="<?= IMG_UPLOADS . '/artist/' . $value->getAvatar() ?>" height="200" />

            </div>
    <?php
        }
    }
    else
    { ?>
        <div class="element event-elem">
            <h4> SIN ARTISTAS</h4>
        </div>
<?php
    }
    ?>

    </div>

  </section>
</body>
</html>
