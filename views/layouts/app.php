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
    <link href="css/app.css" rel="stylesheet"/>

    <title>Gezinshuis - <?= $title ?></title>
</head>
<body>
<!-- <div class="rotate amazingexample">some navbar perhaps</div> -->
	<nav>
		<div class="mainContainer">
				<div class="row">
					<div class="col col-sm-4">
		           <a href="/"> <img style="width: 100%; height:100%;" src="imgs/GezinshuisRegterink_logo_breed.png"alt="logo"/></a>
	                </div>
	                <div class="col-sm-8">

	             <div class="flexContainer">
	                 <a class="navLink nav-link" href="/">Home</a>
	                 		<a class="navLink nav-link" href="/about">About us</a>
	                 		<a class="navLink nav-link" href="/contact">Contact</a>
	             </div>
	         </div>
         </div>
      </div>
	</nav>
<div class="mainContainer">
    <?php require($pagePath) ?>
</div>
<div class="rotate amazingexample">some footer perhaps</div>

</body>
</html>