<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Choix du flux</title>
  </head>
  <body>
    <?php foreach ($tabRSS as $key => $value) {?>
<a href="../controler/affiche_nouvelles.php?flux=<?php echo $value["url"];  ?>"><?php echo $value["url"];  ?><br /></a>

      <?php
    } ?>


  </body>
</html>
