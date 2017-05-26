<?php
$dom = new DOMDocument();
$dom->validateOnParse = true;
$dom->load('source.xml');
$page = 0;
foreach ($dom->getElementsByTagName('menu') as $position => $btn) {
    if (isset($_POST[$position])) {
        $page = $position;
    }
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <title><?= $dom->getElementsByTagName('title')->item($page)->nodeValue ?></title>
    </head>
    <body>
        <form method="POST" action="index.php">
            <?php
            foreach ($dom->getElementsByTagName('menu') as $position => $btn) {
                ?>
                <input type="submit" name="<?= $position; ?>" value="<?= $btn->nodeValue; ?>"/>
                <?php
            }
            ?>
        </form>
        <?php
        $ciblePage1 = $dom->getElementsByTagName('content')->item($page);
        echo $ciblePage1->nodeValue;
        ?>
    </body>
</html>