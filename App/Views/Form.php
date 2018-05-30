<?php
	// This php only prints the form
	// It can remain like this, with no other additions, or we could keep the information of the item if the client wants to update it
	// Should be linked with the Controller
	session_start();
	/*if(isset($_SESSION['itemId']))
	{
		$itemId = $_SESSION['itemId'];
	}*/

	echo '<!DOCTYPE html>
			<html>
			<head>
			 <meta charset="utf-8">
				<meta name="author" content="Miruna-Elena Vasilescu, Diana Bolocan" />
				<meta name="description" content="Web Technologies project for 2nd year students, Faculty of Computer Science, Alexandru Ioan Cuza University of Iasi" />
			    <title>DulApp MD</title>
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<link href="CSS/form.css" rel="stylesheet" type="text/css">
				<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
			</head>
			 <body>
			 <header class="header">
			  
				
					<a href="DulappList"><img id="logo" src="CSS/logo.png" alt="Logo" ></a>
				
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
							<div class="description">Complete our formular in order to properly describe your new added cloth. The main characteristics are mentioned below ( color, size, brand, material, season, state ). Then click the button Done and submit your options.</div>
				<a href="HomePage">
					<h1 class="hcomp"> Log Out </h1> 
				</a>
					<img src="CSS/more.png"id="more" alt="More"></a>
				</header >
				<br>
				
				
			<form name="quiz" action="addItem" method="POST">
					<div class="question">
						<h2>Color:</h2>
							<input type="checkbox" name="r-c" value="Red">Red<br>
							<input type="checkbox" name="r-c" value="Green">Green <br>
							<input type="checkbox" name="r-c" value="Pink">Pink<br>
							<input type="checkbox" name="r-c" value="Black">Black <br>
					</div>	
					<div class="question">
						<h2>Size:</h2>
							<input type="checkbox" name="r-s" value="XS">XS<br>
							<input type="checkbox" name="r-s" value="S">S<br>
							<input type="checkbox" name="r-s" value="M">M<br>
							<input type="checkbox" name="r-s" value="L">L <br>
						
					</div>	
					<div class="question">
						<h2>Brand:</h2>
							<input type="radio" name="r-b" value="H&M">H&M<br>
							<input type="radio" name="r-b" value="Zara">Zara<br>
							<input type="radio" name="r-b" value="Pull&Bear">Pull&Bear<br>
							<input type="radio" name="r-b" value="Bershka">Bershka <br>
							
					</div>	
					<div class="question">
						<h2>State:</h2>
							<input type="checkbox" name="r-ls" value="New">New<br>
							<input type="checkbox" name="r-ls" value="Second hand">Second hand<br>
							<input type="checkbox" name="r-ls" value="Third hand">Third hand<br>
							<input type="checkbox" name="r-ls" value="Borrowed">Borrowed <br>
							
					</div>	
					<div class="question">
						<h2>Material:</h2>
							<input type="checkbox" name="r-f" value="Cotton">Cotton<br>
							<input type="checkbox" name="r-f" value="Silk">Silk<br>
							<input type="checkbox" name="r-f" value="Polyester">Polyester<br>
							<input type="checkbox" name="r-f" value="Wool">Wool <br>
							
					</div>	
					<div class="question">
						<h2>Season:</h2>
							<input type="checkbox" name="r-ss" value="Spring">Spring<br>
							<input type="checkbox" name="r-ss" value="Summer">Summer<br>
							<input type="checkbox" name="r-ss" value="Autumn">Autumn<br>
							<input type="checkbox" name="r-ss" value="Winter">Winter <br>		
					</div>
					<div class="others">	
					<input type="text" name="extras" placeholder="Other characteristics">
					</div>
					<button type="submit" id="subm">Done</button>						
				</form>
				</body>
			</html>';
?>