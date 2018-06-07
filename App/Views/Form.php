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
				<link href="CSS Files/form.css" rel="stylesheet" type="text/css">
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
							<div class="description">Complete our formular in order to properly describe your new added cloth. The main characteristics are mentioned below ( color, size, brand, material, season, state ). Then click the button Done and submit your options.</div>
				<a href="Logout">
					<h1 class="hcomp"> Log Out </h1> 
				</a>
					<img src="CSS Files/more.png" id="more" alt="More"></a>
				</header >
				<br>
				
				
				<form class="question" name="quiz" action="Form/save" method="POST" enctype="multipart/form-data">
					DrawerID:
					<select name="drawerID">
						<option value="19"> 19 </option>
						<option value="20"> 20 </option>
					</select><br>
					Photo:
					<input type="file" name="fileToUpload" id="fileToUpload">
					Type:
					<select name="type">
						<option value="Outdoor"> Outdoor </option>
						<option value="Dress"> Dress </option>
						<option value="Top"> Top </option>
						<option value="Pants"> Pants </option>
						<option value="Shoes"> Shoes </option>
						<option value="Skirt"> Skirt </option>
						<option value="Accessory"> Accessory </option>
					</select> <br>
					Color: <input type="text" name="color" placeholder="Color" required pattern="(?=.*[a-zA-Z]).{1,}"> <br>
					Size: <input type="text" name="size" placeholder="Size" required pattern="(?=.*[a-zA-Z]).{1,}"> <br>				
					Brand: <input type="text" name="brand" placeholder="Brand"> <br>
					State: <input type="text" name="state" placeholder="State">	<br>
					Material: <input type="text" name="material" placeholder="Material" required pattern="(?=.*[a-zA-Z]).{1,}"> <br>			
					Season: <input type="text" name="season" placeholder="Season" > <br>
					Value: <input type="text" name="value" placeholder="Value"> <br>
					Key: <input type="text" name="key" placeholder="Key"> <br>
					Extras: <input type="text" name="extras" placeholder="Other characteristics"> <br>
					<button type="submit" name="AddItem" id="subm">Done</button>						
				</form>
				</body>
			</html>';
?>