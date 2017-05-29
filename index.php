<?php
//on instancie un objet de la classe DOMDocuent qui représente un fichier XML (ou HTML) entier. Il s'agit donc de la racine de l'arbre document.
$dom = new DOMDocument();
//On fait ensuite appel à la méthode load() pour charger le fichier voulu
$dom->load('source.xml');
$page = 0;
//la variable $count calcul le nombre de noeud page dans le document html
$count = $dom->getElementsByTagName('page')->length;
//la variable $_GET renvoie un tableau associatif dans lequel on recherche la valeur de 'page'. Si elle est présente...
//on vérifie aussi qu'il s'agit bien d'un chiffre et que ce chiffre n'est pas supérieur au nombre de noeuds 'page'
if(isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] <= $count && $_GET['page'] > 0) {
    //La variable $page est égale à la valeur de 'page' - 1
   $page = $_GET['page'] - 1;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <!-- On récupère les informations du fichier XML dans notre DomDocument en faisant appel à la méthode getElementsByTagName
        Puis, s'il y a plusieur balises du même nom, on utilise la méthode item qui nous permet de cibler les indices 
        de chaque balise du même nom comme dans un tableau -->
        <title><?= $dom->getElementsByTagName('title')->item($page)->nodeValue; ?></title>
        <link href="bootstrap/dist/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
            <?php
            /*On utilise la boucle foreach pour ressortir le contenu des différentes balise 'menu' dans des balises 'anchor'
            à chaque itération, la valeur de l'élément est assignée à la variable $nav. */
            foreach($dom->getElementsByTagName('menu') as $position => $nav) {
            ?>
                <!-- Dans l'attribut href, on affiche l'index assigné lors de l'ittération à nos variables $nav en ajoutant 1 pour simuler la récupération de l'id, suivi de l'extension .html-->
                <a href="<?= $position + 1 ?>.html"><?= $nav->nodeValue; ?></a>
            <?php
            }
            //Pour finir, on récupère les balises 'content' du fichier XML en fonction de la valeur de la variable $page...
            $ciblePage = $dom->getElementsByTagName('content')->item($page);
            //Puis on renvoie le contenu du noeud (content) en faisant appel à la propriété nodeValue
            echo $ciblePage->nodeValue;
            ?>
    </body>
</html>
