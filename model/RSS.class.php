<?php
include ('../model/Nouvelle.class.php');
class RSS {
            private $titre; // Titre du flux
            private $url;   // Chemin URL pour télécharger un nouvel état du flux
            private $date;  // Date du dernier téléchargement du flux
            private $nouvelles; // Liste des nouvelles du flux dans un tableau d'objets Nouvelle

            // Contructeur
            function __construct($url) {
              $this->url = $url;
              $this->nouvelles=[];
              $this->update();

            }
            function url(){
              return $this->url;
            }

            function date(){
              return $this->date;
            }

            function nouvelles(){
              return $this->nouvelles;
            }

            function titre() {
              return $this->titre;
            }
            // Récupère un flux à partir de son URL
      function update() {
        // Cree un objet pour accueillir le contenu du RSS : un document XML
        $doc = new DOMDocument;

        //Telecharge le fichier XML dans $rss
        $doc->load($this->url);

        // Recupère la liste (DOMNodeList) de tous les elements de l'arbre 'title'
        $nodeList = $doc->getElementsByTagName('item');

        // Met à jour le titre dans l'objet
        $this->titre = $nodeList->item(0)->textContent;

        // Met à jour la date dans l'objet
        //$this->date= now();//marche pas

        // Met à jour les nouvelles dans l'objet

        foreach ($nodeList as $i => $nouv) {
          $nouvelle= new Nouvelle;
          $nouvelle->update($nouv);
          array_push($this->nouvelles,$nouvelle);
          var_dump($nouv);
          $nouvelle->downloadImage($nouv, $i);
        }
      }
          }
 ?>
