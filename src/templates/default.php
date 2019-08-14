<?php

use Quiz\Session;
use Quiz\View;

/**
 * @var string $content
 * @var array $params
 */

$content = $this->renderContent($params);

$this->registerCssFile('https://bootswatch.com/4/simplex/bootstrap.min.css');
$this->registerCssFile('css/style.css');
$this->registerCssFile('assets/style.css');
//$this->registerJsFile('assets/scripts.js');
$this->registerJsFile('https://code.jquery.com/jquery-3.3.1.slim.min.js');
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js');
$this->registerJsFile('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js');
$this->registerJsFile('https://kit.fontawesome.com/7ea6cb8239.js');
$this->registerJsFile('js/main.js');

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quiz</title>

    <?php if ($this->cssFiles): ?>
        <?php foreach ($this->cssFiles as $cssFile): ?>
            <link rel="stylesheet" href="<?= $cssFile; ?>">
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if ($this->jsFiles): ?>
        <?php foreach ($this->jsFiles as $jsFile): ?>
            <script src="<?= $jsFile; ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>

</head>
<body>

<div id="app">
    <?= $this->renderView('header'); ?>

    <?= $this->renderView('messages'); ?>

    <?= $content; ?>

    <?= $this->renderView('footer'); ?>
</div>

<?php if ($this->js): ?>
    <script>
        <?= $this->js; ?>
    </script>
<?php endif; ?>

<script src="assets/scripts.js"></script>

</body>
</html>
