<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Roboto font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    <!-- Bootstrap things -->
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="css/app.css" rel="stylesheet"/>

    <title>Gezinshuis - <?= $title ?></title>
</head>
<body>

<?php require(__DIR__ . '/../partials/nav.php') ?>

<div class="mainContainer" style="min-height: 100vh;">
    <?php require($pagePath) ?>
</div>

<?php require(__DIR__ . '/../partials/footer.php') ?>

<script src="js/global.js"></script>
</body>
</html>