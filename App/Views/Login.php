<?php
	// This php only prints the Login
	// Should be linked with the Controller
	//session_start();

	echo '<!DOCTYPE html>
			<html>
			  <head>
			    <meta charset="utf-8">
				<meta name="keywords" content="web technologies,DulApp,closet,wardrobe,clothes,outfit,virtual,personal,stylist,login"/>
			    <meta name="author" content="Miruna-Elena Vasilescu, Diana Bolocan" />
				<meta name="description" content="Web Technologies project for 2nd year students, Faculty of Computer Science, Alexandru Ioan Cuza University of Iasi" />
				<title>Login | DulApp MD</title>
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<link href="CSS Files/login.css" rel="stylesheet" type="text/css">
				<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
			  </head>
			  <body>
			  <header class="header">
			  
				<h1 class="hcomp"> 
					<a href="HomePage"><img id="logo" src="CSS Files/logo.png" alt="Logo" ></a>
				</h1>
				<span><h1 class="hcomp"> Facts </h1></span>
					<div> Fiecare utilizator autentificat isi poate configura un numar de dulapuri proprii, etichetate.
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
					<div> Enter to our world of organisation! Have access to your wardrobe and manage your clothes. But first, you have to login. Enter your name and password or contact us if you lost your password. Also, we are glad that you registered.</div>
				</header >
				<br>
				
			    <section class="loginbox">
				<img src="CSS Files/loginPic.png" class="avatar">
						<h1> Login </h1>
							<form action="Login/main" method="post">
								
									<p> Username </p>
										<input type="text" name="username" placeholder="Enter Username" required pattern="(?=.*\d)(?=.*[a-zA-Z]).{8,}"
									title="Must contain at least 1 number and it must have at least 8 characters.">
									<p> Password</p>
										<input type="password" name="password" placeholder="Enter Password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}" 
									title="Must contain at least 1 number, 1 uppercase character and it must have at least 8 characters and maximum 20.">
									<input type="submit" name="Login" value="Login">	
							</form>
				</section>
			  </body>
			</html>';
?>