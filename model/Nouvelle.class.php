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


      // Charge les attributs de la nouvelle avec les informations du noeud XML
      function update(DOMElement $item) {
        $this->titre=$item["nodeValue"];
        $this->$url=$item["baseURI"]

      }

      downloadImage(DOMElement $item, $imageId){
           $url = $item->url;
           file_put_contents($imageId,file_get_contents($url));
      }
}
 ?>
