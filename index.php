<?php
// Instancie la variable $dom en DOMDocument
$dom = new DOMDocument();
// Charge le fichier XML
$dom->load('source.xml');
// Initialisation de la variable $page qui représente le numéro de la page.
$page = 0;
// Si on est sur une page on affiche le contenu attitré à cette page.
if (isset($_GET['page'])) { // && $_GET['page'] < getElementsByTagName('menu')
    $page = $_GET['page'] - 1;
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <!-- On affiche le titre selon la page où l'on ce trouve. --> 
        <title><?= $dom->getElementsByTagName('title')->item($page)->nodeValue; ?></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Baloo|Clicker+Script|Lobster|News+Cycle" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <nav class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <?php
                        /* On utilise la boucle foreach pour ressortir le contenu des différentes balise 'menu' dans des balises 'anchor'
                          à chaque itération, la valeur de l'élément est assignée à la variable $nav. */
                        foreach ($dom->getElementsByTagName('menu') as $position => $nav) {
                            ?>
                            <!-- Dans l'attribut href, on affiche l'index assigné lors de l'ittération à nos variables $nav en ajoutant 1 pour simuler la récupération de l'id, suivi de l'extension .html-->
                            <li><a href="<?= $position + 1 ?>.html"><?= $nav->nodeValue; ?></a></li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid ">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?php
                    // On affiche le contenu des pages.
                    $ciblePage = $dom->getElementsByTagName('content')->item($page);
                    echo $ciblePage->nodeValue;
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>