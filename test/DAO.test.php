<?php
 // Test de la classe DAO
     require_once('..\model\DAO.class.php');

     // Test si l'URL existe dans la BD
     $url = 'http://www.01net.com/rss/tests/les-derniers-tests/rss-derniers-tests/';
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
     foreach ($nouvelles as $value) {
          $dao->createNouvelle($value,$rss->id());
          $dao->readNouvellefromTitre($value->titre(),$rss->id());
     }
     require_once('..\view\vue.php');
?>
