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
  <title>Categorias</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/normalize.css">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE ?>css/style.css" />

</head>
<body>
  <section class="content">
      <?php if ($val)
      {?>
          <p class="alert"> <?php echo $val; ?> </p>
      <?php }
      ?>
    <h3>CATEGORIAS</h3>
    <div class="container">
        <?php
        if ($categories)
        {
            foreach ($categories as $key => $value)
            { ?>
                <div class="element">
                    <div>
                        <h4><?php echo $value->getDescription()?></h4>
                        <a class="secondary-button margin-0" href="<?= BASE ?>category/inputUpdateData/<?php echo $value->getId()?>">Modificar</a>
                        <h4></h4>
                        <a class="secondary-button margin-0" href="<?= BASE ?>category/deleteCategory/<?php echo $value->getId()?>">Eliminar</a>
                    </div>
                    <br>
                </div>
        <?php
            }
        }
        else
        { ?>
            <p>SIN CATEGORIAS</p>
    <?php
        }?>

    </div>


  </section>
</body>
</html>
