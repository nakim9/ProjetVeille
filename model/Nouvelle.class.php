<?php
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



      // Charge les attributs de la nouvelle avec les informations du noeud XML
      function update(DOMElement $item) {
<<<<<<< HEAD
        $this->titre=$item->nodeValue;
        $this->url=$item->baseURI;
      }
    }
=======
        $this->titre=$item["nodeValue"];
        $this->$url=$item["baseURI"]
        $doc=load($this->url);
      }

      downloadImage(DOMElement $item, $imageId){
           $url = $item->url;
           file_put_contents($imageId,file_get_contents($url));
      }
}
>>>>>>> 0ef1edc6e3d9c3525fba3089bb8c1e0ad8094633
 ?>
