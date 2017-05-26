<?php
$dom = new DOMDocument();
$dom->validateOnParse = true;
$dom->load('source.xml');
$page = 0;
foreach ($dom->getElementsByTagName('menu') as $position => $nav) {
    if(isset($_POST[$position])){
        $page = $position;
    }
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <title><?= $dom->getElementsByTagName('title')->item($page)->nodeValue; ?></title>
    </head>
    <body>
        <form method="POST" action="index.php">
            <?php
            foreach ($dom->getElementsByTagName('menu') as $position => $nav) {
                ?>
                <input type="submit" name=" <?= $position; ?>" value=" <?= $nav->nodeValue; ?>">
                <?php
            }
            ?>
        </form>
        <?php
        $ciblePage = $dom->getElementsByTagName('content')->item($page);
        echo $ciblePage->nodeValue;
        ?>
    </body>
</html>