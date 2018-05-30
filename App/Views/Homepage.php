 <?php
 	session_start();
 	$_SESSION['id'] = 1;

 echo '<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<meta name="keywords" content="web technologies,DulApp,closet,wardrobe,clothes,outfit,virtual,personal,stylist"/>
			<meta name="author" content="Miruna-Elena Vasilescu, Diana Bolocan" />
			<meta name="description" content="Web Technologies project for 2nd year students, Faculty of Computer Science, Alexandru Ioan Cuza University of Iasi" />
			<title>DulApp MD</title>
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link href="CSS Files/HomePage.css" rel="stylesheet" type="text/css">
			<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
		</head>
		<body>
			  
		<header class="header">
			  
		<h1 class="hcomp"> 
			<a href="#"><img id="logo" src="CSS Files/logo.png" alt="Logo" ></a>
		</h1>
		<span><h1 class="hcomp"> Facts </h1></span>
			<div class="desc"> DULAPP MD is your personal virtual wardrobe that is ready to organize your style and life. Join
				DULAPP MD to start a new improved lifestyle.
				Our website has 7 main pages: Home Page, Login, GetStarted, Formular, DulapSelected, DulappList, Catalog, each with
				very obvious purposes.
				Fact No.1: On 18th March we still had snow.</div>
			<a href="mailto: dianabolocan.db@gmail.com; anurim_elena@yahoo.com"><h1 class="hcomp"> Contact </h1></a>
		<span><h1 class="hcomp"> Help </h1></span>
		<div class="desc">
			Hi! Welcome to our website DULAPP MD! If you want to design your wardrobe and indirectly your entire life, join our comunity.
			First of all you have to Register and than you have to Login. Enjoy!
		</div>
		</header >
				
		<br>
		<section class="main">
			<p id="numeApp">DULAPP MD</p>
			<p id="description"> Your personal virtual closet</p>
			<a href="Login"><div class="login">Login</div></a>
			<a href="GetStarted"><div class="login">Get started</div></a>
			
		</section>
	</body>
</html>';
?>