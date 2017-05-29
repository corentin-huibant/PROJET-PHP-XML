<?php
//on instancie un objet de la classe DOMDocuent qui représente un fichier XML (ou HTML) entier. Il s'agit donc de la racine de l'arbre document.
$dom = new DOMDocument();
//On fait ensuite appel à la méthode load() pour charger le fichier voulu
$dom->load('source.xml');
// Initialisation de la variable $page qui représente le numéro de la page.
$page = 0;
//la variable $count calcul le nombre de noeud page dans le document html
$count = $dom->getElementsByTagName('page')->length;
//la variable $_GET renvoie un tableau associatif dans lequel on recherche la valeur de 'page'. Si elle est présente...
//on vérifie aussi qu'il s'agit bien d'un chiffre et que ce chiffre n'est pas supérieur au nombre de noeuds 'page'
if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] <= $count && $_GET['page'] > 0) {
    //La variable $page est égale à la valeur de 'page' - 1
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
        <link rel="icon" type="image/png" href="assets/img/logo.png" />
    </head>
    <body>
        <div class="content">
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <a class="logo" href="index.php"><img src="assets/img/logo.png" alt=""/></a>
                            <!-- On récupère les informations du fichier XML dans notre DomDocument en faisant appel à la méthode getElementsByTagName
                            Puis, s'il y a plusieur balises du même nom, on utilise la méthode item qui nous permet de cibler les indices 
                            de chaque balise du même nom comme dans un tableau -->
                            <?php
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
                        //Pour finir, on récupère les balises 'content' du fichier XML en fonction de la valeur de la variable $page...
                        $ciblePage = $dom->getElementsByTagName('content')->item($page);
                        //Puis on renvoie le contenu du noeud (content) en faisant appel à la propriété nodeValue
                        echo $ciblePage->nodeValue;
                        ?>
                    </div>
                </div>
            </div>
            <nav class="navbar navbar-default navbar-fixed-bottom">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">Projet PHP-XML</a>
                    </div>
                    <ul class="nav navbar-nav">
                        <li><a href="https://github.com/corentin-huibant">Corentin H.</a></li>
                        <li><a href="https://github.com/quentinpimont">Quentin P.</a></li>
                        <li><a href="https://github.com/AudreyLesterlin">Audrey L.</a></li>
                        <li><a href="https://github.com/PriscilliaL">Priscillia L.</a></li>
                    </ul>
                </div>
            </nav> 
        </div>
    </body>
</html>