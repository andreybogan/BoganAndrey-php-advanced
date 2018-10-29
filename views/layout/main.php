<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!--  <script src="http://--><? //= $_SERVER['HTTP_HOST'] ?><!--/global/js/main.js"></script>-->
    <title><?= $title ?></title>
</head>
<body>

<?php
// Вставляем шапку сайта.
include \app\base\App::call()->config['templateDir'] . "header.php";
?>

<div class="center"><?= $content ?></div>

<footer>&copy; AndreyShop :)</footer>
</body>
</html>