<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php foreach ($nouvelles as $nouv): ?>
      <h3><a href="<?php echo $nouv->url(); ?>"><?php  echo $nouv->titre(); ?></a></h3>
      <p><?php echo $nouv->description(); ?></p>
      <img src="<?php echo $nouv->urlImage(); ?>" alt="">
    <?php endforeach; ?>
  </body>
</html>
