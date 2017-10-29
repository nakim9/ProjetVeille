<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php foreach ($nouvells as $nouv): ?>
      <h3><?php  echo $nouv->titre(); ?></h3>
      <p><?php echo $nouv->description(); ?></p>
      <img src="../controler/images/<?php echo $nouv->id(); ?>.jpg" alt="">
    <?php endforeach; ?>
  </body>
</html>
