<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Roboto font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="css/app.css" rel="stylesheet"/>
    <title>Gezinshuis - <?= $title ?></title>
</head>
<body>
<!-- <div class="rotate amazingexample">some navbar perhaps</div> -->
<nav class="navbar navbar-expand-md navbar-light" style="height: 70px;border:1px solid grey;">
		Navbar hier
</nav>
<div>
    <?php require($pagePath) ?>
</div>
<!--<div class="rotate amazingexample">-->
<!--    some footer perhaps-->
<!--</div>-->

</body>
</html>