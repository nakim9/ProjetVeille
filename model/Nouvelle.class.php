<?php

define("LIEN_VERS_IMG",'images/');

class Nouvelle {
      private $titre;   // Le titre
      private $date;    // Date de publication
      private $description; // Contenu de la nouvelle
      private $url;         // Le lien vers la ressource associée à la nouvelle
      private $urlImage;    // URL vers l'image
      private $id;

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
      function id(){
           return $this->id;
      }
      // Charge les attributs de la nouvelle avec les informations du noeud XML
      function update(DOMElement $item) {
        $this->titre=$item->getElementsByTagName('title')->item(0)->textContent;
        $this->description=$item->getElementsByTagName('description')->item(0)->textContent;
      }

<<<<<<< HEAD
    function downloadImage(DOMElement $item, $imageId){
          $nodeList = $item->getElementsByTagName('enclosure');
          //var_dump($nodeList);
          $node = $nodeList->item(0)->attributes->getNamedItem('url');
          //var_dump($node);
          if ($node != NULL) {
               // L'attribut url a été trouvé : on récupère sa valeur, c'est l'URL de l'image
               $url = $node->nodeValue;
               // On construit un nom local pour cette image : on suppose que $nomLocalImage contient un identifiant unique
               // On suppose que le dossier images existe déjà
               $imagePath = '../data/images/'.$imageId.'.jpg'; // Pas besoin de "this"
               $file = file_get_contents($url);
               // Écrit le résultat dans le fichier
               file_put_contents($imagePath, $file);
=======
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
                    $this->mkIdIntFromName();//création d'un ID
                    // On construit un nom local pour cette image : on suppose que $nomLocalImage contient un identifiant unique
                    // On suppose que le dossier images existe déjà
                    $this->urlImage = LIEN_VERS_IMG.$this->id.'.jpg';
                    $file = file_get_contents($url);

                    //Création d'un dossier images
                    if(!(file_exists('images/'))) {mkdir('images/');}
                    // Écrit le résultat dans le fichier
                    file_put_contents($this->urlImage, $file);
               }
          }
          else{
               if($this->urlImage == NULL){
                    $this->urlImage = LIEN_VERS_IMG.$imageId.'.jpg'; //lien à l'image quand l'image est déjà créé
               }
>>>>>>> 5c08c403b82122f97b17732b43aab14c70b3c3a6
          }
      }

      function mkIdStrFromName(){
           $titre = $this->titre;
           $idLength = 0;
           for($i = 0; $i<strlen($titre) && $idLength<25; $i++){
                //on parcourt la chaîne du titre jusqu'à avoir séléctionné 25 bons caractères
                $ascii = ord($titre[$i]); //ord — Retourne le code ASCII d'un caractère
                if( ($ascii >= 48 && $ascii<=57) || //caractère est un chiffre (0à9)
                    ($ascii >= 65 && $ascii<=90) || //caractère est une lettre majuscule (AàZ)
                    ($ascii >= 97 && $ascii<=122))  //caractère est une lettre minuscule (aàz)
                    {
                         $id[$i]= $titre[$i];
                         $idLength ++;
                    }
           }
           if(isset($id)){    $this->id = implode($id);     }
           else{    echo'<p>Nouvelle.class.php : mkIdFromName :'.$this->titre.' id non créé</p>';   }

      }

      function mkIdIntFromName(){
           $titre = $this->titre;
           $id = 0;
           for($i = 0; $i<strlen($titre); $i++){
                $ascii = ord($titre[$i]);
                $id += $ascii;
           }
           if(isset($id)){    $this->id = $id;    }
           else{    echo'<p>Nouvelle.class.php : mkIdFromName :'.$this->titre.' id non créé</p>';   }
      }
    }
 ?>
