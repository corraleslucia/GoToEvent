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
      <?php if ($val)
      {?>
          <p> <?php echo $val; ?> </p>
      <?php }
      ?>
    <h3>ARTISTAS</h3>
    <div class="container">
    <?php
    if ($artists)
    {
        foreach ($artists as $key => $value)
        { ?>
            <div class="artist-container">
                <div class="artist-name">
                    <h4><?php echo $value->getName() ?></h4>
                </div>
                <div class="artist-image">
                    <img src="<?= IMG_UPLOADS . '/artist/' . $value->getAvatar() ?>" height="200" />
                </div>

                <div style="text-align: center">
                    <a class="secondary-button" href="<?= BASE ?>artist/inputUpdateData/<?php echo $value->getId()?>">Modificar</a>
                    <a class="secondary-button" href="<?= BASE ?>artist/deleteArtist/<?php echo $value->getId()?>">Eliminar</a>
                </div>
                <br>
            </div>
    <?php
        }
    }
    else
    { ?>
        <p>SIN ARTISTAS</p>

<?php
    }
    ?>


    </div>

  </section>
</body>
</html>
