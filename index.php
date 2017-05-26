<?php
// Instancie la variable $dom en DOMDocument
$dom = new DOMDocument();
// Charge le fichier XML
$dom->load('source.xml');
// Initialisation de la variable $page qui représente le numéro de la page.
$page = 0;
// Si on est sur une page on affiche le contenu attitré à cette page.
if (isset($_GET['page'])) { // && $_GET['page'] < getElementsByTagName('menu')
    $page = $_GET['page'] -1;
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <!-- On affiche le titre selon la page où l'on ce trouve. --> 
        <title><?= $dom->getElementsByTagName('title')->item($page)->nodeValue; ?></title>
        <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php
        // Dans le fichier XML on récupère le noeud <menu> avec sa position et on le met dans le menu
        foreach ($dom->getElementsByTagName('menu') as $position => $nav) {
            ?>
            <!-- L'input type submit récupère la position où l'on ce trouve et sa valeur. -->
            <a href=" /<?= $position +1; ?>.html"><?= $nav -> nodeValue; ?></a>
            <?php
        }
        ?>
        <?php
        // On affiche le contenu des pages.
        $ciblePage = $dom->getElementsByTagName('content')->item($page);
        echo $ciblePage->nodeValue;
        ?>
    </body>
</html>