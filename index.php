<?php
// instancie un objet DOMDocument
$dom = new DOMDocument();
// charge le fichier xml voulu
$dom->load('source.xml');
// variable representant le numero de la page courante
$page = 0;
// permet changer la valeur de la variable $page selon le bouton appuyer
    if (isset($_GET['page'])) {
        $page = $_GET['page'] - 1;
    }

?>
<html>
    <head>
        <meta charset="utf-8"/>
        <title><?= $dom->getElementsByTagName('title')->item($page)->nodeValue ?></title>
    </head>
    <body>
        <form method="POST" action="index.php">
            <?php
            // créer les boutons de naviguation 
            foreach ($dom->getElementsByTagName('menu') as $position => $btn) {
                ?>
            <a href="/<?= $position + 1;?>.html"><?= $btn -> nodeValue; ?></a>
                <?php
            }
            ?>
        </form>
        <?php
        // affiche la page desirez 
        $ciblePage1 = $dom->getElementsByTagName('content')->item($page);
        echo $ciblePage1->nodeValue;
        ?>
    </body>
</html>