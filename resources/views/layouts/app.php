<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="https://adsd.clow.nl/~2018_p1_11/P1_OOAPP_Opdracht"/>

    <!-- Roboto font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    <!-- Bootstrap things -->
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="css/app.css" rel="stylesheet"/>

    <title>Gezinshuis - <?= $title ?></title>
</head>
<body>

<?php require(__DIR__ . '/../JSDATA.php') ?>

<script src="public/js/global.js"></script>

<?php require(__DIR__ . "/../{$nav_path}") ?>

<?php require($pagePath) ?>

<?php require(__DIR__ . "/../{$footer_path}") ?>

</body>
</html>