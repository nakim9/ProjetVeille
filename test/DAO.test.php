<?php
     // Test de la classe DAO
     require_once('..\data\DAO.class.php');

     // Test si l'URL existe dans la BD
     $url = 'https://confrerie-des-traducteurs.fr/skyrim/rss';
     $dao = new DAO();
     $rss = $dao->readRSSfromURL($url);

     if ($rss == NULL) {
          echo $url." n'est pas connu\n";
          echo "On l'ajoute ... \n";
          $rss = $dao->createRSS($url);

     }

     // Mise à jour du flux
     $rss->update();
     $nouvelles = $rss->nouvelles();
     require_once('..\view\vue.php');
?>
