<?php
//Ici je crée un nouveau document qui permet de travailler avec le xml
$dom = new DOMDocument();
// a priori le validateOnParse est utilise pour utiliser getElementById
$dom->validateOnParse = true;
//Ici je lui indique quel fichier utiliser
$dom->load('source.xml');
//Je déclare une variable page que j'initilise à 0
$page = 0;
if (isset($_GET['page'])) {
    $page = $_GET['page']-1;
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <title><?= $dom->getElementsByTagName('title')->item($page)->nodeValue ?></title>
    </head>
    <body>
        <?php
        /* Ca c'est égal au foreach du dessous mais simplifié
          $menuList = $dom->getElementsByName('menu');
          foreach ($menuList as $key => $menu){
          echo $menu->nodeValue;
          }
         */
        foreach ($dom->getElementsByTagName('menu') as $position => $btn) {
            ?>
            <a href="<?= $position + 1;?>.html"><?php echo $btn->nodeValue ?></a>
            <?php
        }
        ?>
        <?php
        //Création d'une variable cible page dans laquelle je vais indiquer ce que je souhaite récupérer
        $ciblePage1 = $dom->getElementsByTagName('content')->item($page);
        //afficaige de la valeur récupérer de ma variable
        echo $ciblePage1->nodeValue;
        ?>
    </body>
</html>

