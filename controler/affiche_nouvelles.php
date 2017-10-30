<?php

require_once('../model/DAO.class.php');
$dao=new DAO();
// Une instance de RSS
$flux=$_GET['flux'];
$rss = $dao->readRSSfromURL($flux);


// Charge le flux depuis le réseau
$rss->update();
$dao->updateRSS($rss);



$ids = $dao-> getNouvelles($rss->id());
$nouvelles=[];
foreach($ids as $nouv){
  $nouvelle=new Nouvelle;
  var_dump($nouv['url']);
  $nouvelle->setUrl($nouv['url']);
  $nouvelle->setID($nouv['id']);
  $nouvelle->setUrlImage($nouv['image']);
  $nouvelle->setTitre($nouv['titre']);
  $nouvelle->setDescription($nouv['description']);
  array_push($nouvelles,$nouvelle);
}
require_once('../view/affiche_nouvelles.view.php');
 ?>
