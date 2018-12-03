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
  <title>Buscar Eventos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/normalize.css">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/style.css" />

</head>
<body>
  <section class="content">
      <?php
      if ($events)
      { ?>
          <h3>EVENTOS</h3>
          <div class="container">
              <?php
              foreach ($events as $key => $value)
              {
              ?>
              <div class="element">
                  <a class="link-divs "href="<?= BASE ?>event/showEventDetailsForUser/<?php echo $value->getId()?>">
                  <div class="div-img">
                        <?php
                        if ($value->getPoster() != '0')
                        { ?>
                            <img src="<?= IMG_UPLOADS . '/event/' . $value->getPoster() ?>" class="img-list-event" />
                        <?php
                        }?>
                    </div>    
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
<?php
      }
      else if ($val)
      { ?>
          <p class="alert"> <?php echo $val ?> </p>
<?php
      }
       ?>

    <form action="<?php echo BASE ?>event/searchByEvent" method="POST" class="form-admin">
      <h2 class="form-title">BUSCAR EVENTOS:</h2>
      <div class="form-group">
        <label class="label-l" >Evento: </label>
        <input class="input-s" type="text" name="art-name" required>
      </div>

      <div class="div-form-button">
        <button type="submit" class ="form-button">Buscar Eventos</button>
      </div>
    </form>

    <div style="text-align: center">
        <a class="secondary-button" href="<?= BASE ?>event/index">Volver</a>
        <br>
    </div>
    <br>

  </section>
</body>
</html>
