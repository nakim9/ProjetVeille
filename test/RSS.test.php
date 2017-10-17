<?php
      require_once('../model/RSS.class.php');

      // Une instance de RSS
      $rss = new RSS('http://www.lemonde.fr/m-actu/rss_full.xml');

      // Charge le flux depuis le réseau
      $rss->update();

      // Affiche le titre
      echo $rss->titre()."\n";

      // Affiche les nouvelles
      var_dump($rss->nouvelle());
 ?>
