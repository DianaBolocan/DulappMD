<?php
	// This php only prints the catalog list
	// Theoretically it should connect to the database and select all the clothes associated with the search/drawerId of the userID
	// For each row fetched from the database it will print a html line for the clothes to be displayed in the page, meaning that the whole php file will be multiple lines of echo with method calls
	// Should be linked with the Controller
	//session_start();

	echo '<!DOCTYPE html>
			<html>
			<head>
			 <meta charset="utf-8">
				<meta name="author" content="Miruna-Elena Vasilescu, Diana Bolocan" />
				<meta name="description" content="Web Technologies project for 2nd year students, Faculty of Computer Science, Alexandru Ioan Cuza University of Iasi" />
			    <title>DulApp MD</title>
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<link href="CSS Files/catalog.css" rel="stylesheet" type="text/css">
				<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
			</head>
			 <body>
			 <header class="header">
			  
				<a href="DulappList"><img id="logo" src="CSS Files/logo.png" alt="Logo" ></a>
				<span><h1 class="hcomp"> Facts </h1></span>
					<div class="description"> DULAPP MD is your personal virtual wardrobe that is ready to organize your style and life. Join
					DULAPP MD to start a new improved lifestyle.
					Our website has 7 main pages: Home Page, Login, GetStarted, Formular, DulapSelected, DulappList, Catalog, each with
					very obvious purposes.
					Fact No.1: On 18th March we still had snow.</div>
				<a href="mailto: dianabolocan.db@gmail.com; anurim_elena@yahoo.com"><h1 class="hcomp"> Contact </h1></a>
				<span><h1 class="hcomp"> Help </h1></span>
					<div class="description">
						Something. Something. Something. Something. Something. Something. Something. Something. Something. Something. 
						Something. Something. Something. Something. Something. Something. Something. Something. Something. Something. 
						Something. Something. Something. Something. Something. Something. Something. Something. Something. Something. 
					</div>
				<a href="Logout">
					<h1 class="hcomp"> Log Out </h1> 
				</a>
				<img src="CSS Files/more.png" id="more">
				<form  class="searchBar" action="#" role="search">
								<input type="text" name="" placeholder="Enter your search">
								<input type="submit" name value="">
				</form>
				</header >
				<br>
				<div id="leftSection">
					<h1 class="subtitle"> Searched after: </h1>
					<p id="searchedAfter"> "tricouri verzi si pantaloni negri " </p>
					
					<nav class="navigation">
								<ul>
									<li class="items-active-links">
										<a href="Catalog" id="allItems"> All Items </a>
										<div class="subsection-items">
											<ul>
												<li class="subitem"><a href="Catalog"> Clothes </a></li>
												<li class="subitem"><a href="Catalog"> Accessories </a></li>
												<li class="subitem"><a href="Catalog"> Shoes </a></li>
											</ul>
									</li>
									<li class="items-active-links">
										<a href="Catalog.php" id="allItems"> Brand </a>
										<div class="subsection-items">
											<ul>
												<li class="subitem"><a href="Catalog"> H&M </a></li>
												<li class="subitem"><a href="Catalog"> Zara </a></li>
												<li class="subitem"><a href="Catalog"> Stradivarius </a></li>
												<li class="subitem"><a href="Catalog"> Nike </a></li>
											</ul>
									</li>
									<li class="items-active-links">
										<a href="Catalog.php" id="allItems"> Color </a>
										<div class="subsection-items">
											<ul>
												<li class="subitem"><a href="Catalog"> Red </a></li>
												<li class="subitem"><a href="Catalog"> Yellow </a></li>
												<li class="subitem"><a href="Catalog"> Green </a></li>
											</ul>
									</li>
								</ul>
							</nav>
				</div>
				<div id="centerSection">
				<div class="item">
						<img src="CSS Files/greenTShirt.png" alt="greenTShirt" class="tShirt">
						<p class="name"> Tricou1 Verde </p>
						<a href="Form" class="linkForm">Modify</a><a href="Catalog/delete" class="linkForm">Delete/</a>	
					</div>
					<div class="item">
						<img src="CSS Files/greenTShirt.png" alt="greenTShirt" class="tShirt">
						<p class="name"> Tricou2 Verde </p>
						<a href="Form" class="linkForm">Modify</a><a href="Catalog/delete" class="linkForm">Delete/</a>	
					</div>
					<div class="item">
						<img src="CSS Files/greenTShirt.png" alt="greenTShirt" class="tShirt">
						<p class="name"> Tricou3 Verde </p>
						<a href="Form" class="linkForm">Modify</a><a href="Catalog/delete" class="linkForm">Delete/</a>	
					</div>
					<div class="item">
						<img src="CSS Files/blackPants.png" alt="blackPants" class="BlackPants">
						<p class="name"> Pantaloni1 Negri </p>
						<a href="Form" class="linkForm">Modify</a><a href="Catalog/delete" class="linkForm">Delete/</a>	
					</div>
					<div class="item">
						<img src="CSS Files/blackPants.png" alt="blackPants" class="BlackPants">
						<p class="name"> Pantaloni2 Negri </p>
						<a href="Form" class="linkForm">Modify</a><a href="Catalog/delete" class="linkForm">Delete/</a>	
					</div>
				</div>
			  </body>
			</html>';
?>