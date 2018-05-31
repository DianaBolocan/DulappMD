<?php
	// This php only prints the wardrobe
	// Theoretically it should connect to the database and select all the drawers associated with the wardrobeId
	// For each row fetched from the database it will print a html line for the drawer to be displayed in the page, meaning that the whole php file will be multiple lines of echo with method calls
	// Should be linked with the Controller
	session_start();
	//$wardrobeId = $_SESSION['wardrobeId'];
	$wardrobeId = 1;
	echo '<html>
			<head>
				<meta charset="utf-8">
				<meta name="keywords" content="web technologies,DulApp,closet,wardrobe,clothes,outfit,virtual,personal,stylist,current,drawer"/>
				<meta name="author" content="Miruna-Elena Vasilescu, Diana Bolocan" />
				<meta name="description" content="Web Technologies project for 2nd year students, Faculty of Computer Science, Alexandru Ioan Cuza University of Iasi" />
				<title>Style | Dulapp</title>
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<link href="CSS Files/dulapSelected.css" rel="stylesheet" type="text/css">
				<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
			</head>
			<body>
				<header class="header">
					<a href="DulappList"><img id="logo" src="CSS Files/logo.png" alt="Logo" ></a>
					<span><h1 class="hcomp"> Facts </h1></span>
						<div class="description"> Fiecare utilizator autentificat isi poate configura un numar de dulapuri proprii, etichetate.
						Fiecare dulap e compus din sertare si/sau compartimente (eventual, incuiate). 
						Bineinteles, utilizatorul poate plasa/scoate diferite obiecte in/din el.
						Obiectele vor avea o serie de proprietati (de exemplu, pentru o fusta, culoare: verde, material: catifea, 
						iar in cazul bijuteriilor, valoare: sentimentala, acces: cu cifru) care pot fi considerate criterii de cautare. 
						O serie de proprietati pot fi stabilite in mod dinamic pentru anumite articole specifice
						(e.g., ceas cu rubine, cu urme de rimel, donat de bunica). Solutia propusa va oferi suport pentru cautare
						multi-criteriala -- de pilda, toate obiectele obtinute prin donatie in ultima luna si de culoare verde sau
						toate cravatele de matase mutate din dulapul fratelui in dulapul etichetat "mostenire". 
						Istoricul starilor fiecarui dulap va fi oferit ca flux de stiri RSS si sub forma de date JSON. 
						Bonus: vizualizari interesante ale informatiilor administrate.</div>
					<a href="mailto: dianabolocan.db@gmail.com; anurim_elena@yahoo.com"><h1 class="hcomp"> Contact </h1></a>
					<span><h1 class="hcomp"> Help </h1></span>
						<div class="description"> Cauta articolele vestimentare din dulapul din fata ta cu ajutorul search bar-ului sau selecteaza
						sertarul pentru a avea ce contine. Adauga sertare cu si fara lacat folosindu-te de + si sterge un sortar cu - (odata ce un
						sertar este sters, sunt sterse si articolele vestimentare pe care le contine asa ca ai grija ce stergi). Adauga obiecte in
						dulap cu ajutorul umerasului.</div>
					<a href="HomePage">
					<h1 class="hcomp"> Log Out </h1> 
					<img src="CSS Files/more.png" id="more">
					</a>
					
					<form  class="searchBar" action="Catalog" role="search">
							<input type="text" name="" placeholder="Enter your search">
							<input type="submit" name value="">
				</header>
				<br>
				<div class="dulap">
					<div class="firstRow">
						<a href="Catalog"><img src="CSS Files/Drawer2_1.png" alt="Drawer" class="drawer1"></a>
						<a href="Catalog"><img src="CSS Files/Drawer2_2.png" alt="Drawer" class="drawer2"></a>
						<a href="Catalog"><img src="CSS Files/Drawer2_3.png" alt="Drawer" class="drawer3"></a>
					</div>
					<div class="secondRow">
						<a href="Catalog"><img src="CSS Files/Drawer2_4.png" alt="Drawer" class="drawer1"></a>
						<a href="Catalog"><img src="CSS Files/Drawer2_5.png" alt="Drawer" class="drawer2"></a>
						<a href="Catalog"><img src="CSS Files/Drawer2_6.png" alt="Drawer" class="drawer3"></a>
					</div>
					<img src="CSS Files/Dulap2.png" alt="Dulap" id="dulap">
				</div>
				<br>
				<div class="buttons">	
					<a href="Form"><img src="CSS Files/umeras.png" alt="addItem" id="addItem"></a>
					<a href="DulapSelected/save"><img src="CSS Files/plus(new).png" alt="addDrawer" id="addDrawer"></a>
					<a href="DulapSelected/addLockedDrawer"><img src="CSS Files/plusLock.png" alt="addLockedDrawer" id="addLockedDrawer"></a>
					<a href="DulapSelected/deleteDrawer"><img src="CSS Files/minus(new).png" alt="deleteDrawer" id="deleteDrawer"></a>
				</div>
			</body>
		</html>';

		/* MAIN IDEA

		x = getDrawers(wardrobeId); <select * from drawer natural join wd where wardrobeId = wardrobeId;>

		echo 'htmlul inainte de drawere' ;
		for each x.row do
			echo <a href="Catalog.php"><img src="CSS Files/Drawer2_' . drawerNumber .'.png" alt="Drawer" class="drawer' . drawerNumberClass . '"></a>;

		echo 'restul htmlului dupa drawere'; */
?>
