<?php
require('../model/DAO.class.php');
$dao=new DAO();
$tabRSS = $dao->getFlux();
require_once('../view/affiche_flux.view.php');
 ?>
