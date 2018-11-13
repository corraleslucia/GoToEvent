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
      <?php if ($val)
      {?>
          <p> <?php echo $val; ?> </p>
      <?php }
      ?>
    <h3>EVENTOS</h3>


    <div class="container">
        <form action="<?php echo BASE ?>event/listForUser" method="POST">
            <div>
                <p>Mostar:
                <input type="radio" id="showtype1" name="show" value="byArtist">
                <label for="showtype1"> Por Artista (A-Z) </label>

                <input type="radio" id="showtype2" name="show" value="byCategory">
                <label for="showtype2"> Por Categoria </label>

                <input type="radio" id="showtype3" name="show" value="byDate">
                <label for="showtype3"> Por Fecha </label>

                <input type="radio" id="showtype4" name="show" value="byLocation">
                <label for="showtype4"> Por Ciudad </label>

                <button type="submit" >Mostrar</button>
                </p>
            </div>
        </form>
        <?php if ($listType === "byArtist")
              {
                  require(ROOT.'views/listByArtistUser.php');
              }
              else if ($listType === "byCategory")
              {
                  require(ROOT.'views/listByCategoryUser.php');
              }
              else if ($listType === "byDate")
              {
                  require(ROOT.'views/listByDateUser.php');
              }
              else if ($listType === "byLocation")
              {
                  require(ROOT.'views/listByLocationUser.php');
              }
          ?>
    </div>

  </section>
</body>
</html>
