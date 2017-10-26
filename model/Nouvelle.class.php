<?php

define("LIEN_VERS_IMG",'images/');

class Nouvelle {
      private $titre;   // Le titre
      private $date;    // Date de publication
      private $description; // Contenu de la nouvelle
      private $url;         // Le lien vers la ressource associée à la nouvelle
      private $urlImage;    // URL vers l'image

      // Fonctions getter

      function titre() {
          return $this->titre;
      }
      function date() {
          return $this->date;
      }
      function url() {
          return $this->url;
      }
      function description() {
          return $this->description;
      }
      function urlImage() {
          return $this->urlImage;
      }
      // Charge les attributs de la nouvelle avec les informations du noeud XML
      function update(DOMElement $item) {
        $this->titre=$item->getElementsByTagName('title')->item(0)->textContent;
        $this->description=$item->getElementsByTagName('description')->item(0)->textContent;
      }

      function downloadImage(DOMElement $item, $imageId){
          if(!(file_exists('images/'.$this->titre.'.jpg'))){ //verification que le fichier n'est pas déjà créé
               //var_dump($item);
               $nodeList = $item->getElementsByTagName('enclosure');
               //var_dump($nodeList);
               $node = $nodeList->item(0)->attributes->getNamedItem('url');
               //var_dump($node);
               if ($node != NULL) {
                    // L'attribut url a été trouvé : on récupère sa valeur, c'est l'URL de l'image
                    $url = $node->nodeValue;
                    // On construit un nom local pour cette image : on suppose que $nomLocalImage contient un identifiant unique
                    // On suppose que le dossier images existe déjà
                    $this->urlImage = LIEN_VERS_IMG.$imageId.'.jpg';
                    $file = file_get_contents($url);

                    // Écrit le résultat dans le fichier
                    file_put_contents($this->urlImage, $file);
               }
          }
          else{
               if($this->urlImage == NULL){
                    $this->urlImage = LIEN_VERS_IMG.$imageId.'.jpg'; //lien à l'image quand l'image est déjà créé
               }
          }
      }
    }
 ?>
