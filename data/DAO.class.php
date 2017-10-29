<?php

include('..\model\RSS.class.php');
include_once('..\model\Nouvelle.class.php');

class DAO {
        private $db; // L'objet de la base de donnée

        // Ouverture de la base de donnée
        function __construct() {
          $dsn = 'sqlite:..\data\rss.db'; // Data source name
          try {
            $this->db = new PDO($dsn);
          } catch (PDOException $e) {
            exit("Erreur ouverture BD : ".$e->getMessage());
          }
        }

        //////////////////////////////////////////////////////////
        // Methodes CRUD sur RSS
        //////////////////////////////////////////////////////////

        // Crée un nouveau flux à partir d'une URL
        // Si le flux existe déjà on ne le crée pas
        function createRSS($url) {
          $rss = $this->readRSSfromURL($url);
          if ($rss == NULL) {
            try {
              $q = "INSERT INTO RSS (url) VALUES ('$url')";
              $r = $this->db->exec($q);
              if ($r == 0) {
                die("createRSS error: no rss inserted\n");
              }
              return $this->readRSSfromURL($url);
            } catch (PDOException $e) {
              die("PDO Error :".$e->getMessage());
            }
          } else {
            // Retourne l'objet existant
            return $rss;
          }
        }

        // Acces à un objet RSS à partir de son URL
        function readRSSfromURL($url) {
          $rss = NULL;
          $q = "SELECT * FROM RSS WHERE url='$url'";

          $r = $this->db->query($q);
          $tabRSS = $r->fetchall();

          if($tabRSS != NULL){
               $tabRSS = $tabRSS[0];
               $rss = new RSS($url);
               $rss->setTitre($tabRSS['titre']);
               $rss->setDate($tabRSS['date']);
               $rss->setID($tabRSS['id']);
          }
          return $rss;
        }

        // Met à jour un flux
        function updateRSS(RSS $rss) {
          // Met à jour uniquement le titre et la date
          $titre = $this->db->quote($rss->titre());
          $q = "UPDATE RSS SET titre=$titre, date='".$rss->date()."' WHERE url='".$rss->url()."'";
          try {
            $r = $this->db->exec($q);
            if ($r == 0) {
              die("updateRSS error: no rss updated\n");
            }
          } catch (PDOException $e) {
            die("PDO Error :".$e->getMessage());
          }
        }

        //////////////////////////////////////////////////////////
        // Methodes CRUD sur Nouvelle
        //////////////////////////////////////////////////////////

        // Acces à une nouvelle à partir de son titre et l'ID du flux
        function readNouvellefromTitre($titre,$RSS_id) {
             $q = "SELECT * FROM nouvelle WHERE titre='$titre' and RSS_id=$RSS_id";
             try{
                  $r = $this->db->query($q);
                  if ($r == NULL) {
                    die("readNouvellefromTitre error: no Nouvelle find\n");
                  }
                  $tab = $r->fetchall();
                  if ($tab != 0) {
                       $tab=$tab[0];
                       $nouv = new Nouvelle();
                       $nouv->setTitre($tab['titre']);
                       $nouv->setDate($tab['date']);
                       $nouv->setUrl($tab['url']);
                       $nouv->setdescription($tab['description']);
                       $nouv->setUrlImage($tab['image']);

                  }
             }catch (PDOException $e) {
                  die("PDO Error :".$e->getMessage());
             }
             return TRUE;
        }

        // Crée une nouvelle dans la base à partir d'un objet nouvelle
        // et de l'id du flux auquelle elle appartient
        function createNouvelle(Nouvelle $n, $RSS_id) {
          try {
               $date = $n->date();                $titre = $n->titre();
               $description = $n->description();  $url = $n->url();
               $image = $n->urlImage();
               $q = "INSERT INTO nouvelle (date,titre,description,url,image,RSS_id) VALUES ('$date','$titre','$description','$url','$image',$RSS_id)";
               $r = $this->db->exec($q);
               if ($r == 0) {
                 die("createNouvelle error: no rss inserted\n");
               }
               return TRUE;
          } catch (PDOException $e) {
               die("PDO Error :".$e->getMessage());
          }
     }
   }
?>
