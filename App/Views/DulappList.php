<?php
	// This php only prints the wardrobe list
	// Theoretically it should connect to the database and select all the wardrobes associated with the userId from the login method
	// For each row fetched from the database it will print a html line for the wardrobe to be displayed in the page, meaning that the whole php file will be multiple lines of echo with method calls
	// Should be linked with the Controller
	//session_start();
	//$userId = $_SESSION['userId'];
	//$userId = 1;

	echo '<html>
			<head>
				<meta charset="utf-8">
				<meta name="keywords" content="web technologies,DulApp,closet,wardrobe,clothes,outfit,virtual,personal,stylist,current,drawer"/>
				<meta name="author" content="Miruna-Elena Vasilescu, Diana Bolocan" />
				<meta name="description" content="Web Technologies project for 2nd year students, Faculty of Computer Science, Alexandru Ioan Cuza University of Iasi" />
				<title>Wardrobes | Dulapp</title>
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<link href="CSS Files/DulappList.css" rel="stylesheet" type="text/css">
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
						<div class="description">Apasa + ca sa adaugi un dulap. Apasa - ca sa stergi dulapul pe care il vizualizezi.
						Foloseste-te de sageti ca sa navighezi prin lista ta de dulapuri. Uita-te sa vezi ce ai in dulap apasand
						pe el. Cauta in search bar obiectul pe care il doresti in toate dulapurile tale.</div>
					<a href="Logout"><h1 class="hcomp"> Log Out </h1></a>
					<img id="more" src="CSS Files/more.png">
					<form  class="loginbox" action="Catalog" role="search">
							<input type="text" name="" placeholder="Enter your search">
							<input type="submit" name value="">
					</form>
				</header>
				<br>
				<p> Dulap Name</p>
				<img src="CSS Files/leftArrow.png" alt="switchWardrobeLeft" id="leftArrow" class="arrow">
				<img src="CSS Files/rightArrow.png" alt="switchWardrobeRight" id="rightArrow" class="arrow">
				<a href="DulapSelected"><img src="CSS Files/Dulap2.png" alt="Dulap" id="dulap"></a>
				<div class="buttons">
					<a href="addWardrobe"><img src="CSS Files/plus(new).png" alt="addDrawer" id="addDrawer"></a>
					<a href="deleteDrawer"><img src="CSS Files/minus(new).png" alt="deleteDrawer" id="deleteDrawer"></a>
				</div>
			</body>
		</html>';
?>