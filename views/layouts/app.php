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
	<nav class="navbar navbar-expand-md navbar-light bg-light">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
		            <a class="navbar-brand" href="/">
		            	<div>
		                    <img style="width: 100%;" src="imgs/GezinshuisRegterink_logo_breed.png"alt="logo"/>
	                </div>
	                </a>
					</div>
				
	             <div class="collapse navbar-collapse" id="navbarSupportedContent">
	                 <!-- Left Side Of Navbar -->
	                 <ul class="navbar-nav mr-auto">
	                 	
	                 </ul>
	                 <!-- Right Side Of Navbar -->
	                 <ul class="navbar-nav mr-auto float-right">
	                 		<li><a class="nav-link" href="/">Home</a></li>
	                 		<li><a class="nav-link" href="/about">About us</a></li>
	                 		<li><a class="nav-link" href="/contact">Contact</a></li>
	                 </ul>
	             </div>
	         </div>
         </div>
	</nav>
<div>
    <?php require($pagePath) ?>
</div>
<div class="rotate amazingexample">some footer perhaps</div>

</body>
</html>