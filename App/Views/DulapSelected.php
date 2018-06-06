<?php
	// This php only prints the wardrobe
	// Theoretically it should connect to the database and select all the drawers associated with the wardrobeId
	// For each row fetched from the database it will print a html line for the drawer to be displayed in the page, meaning that the whole php file will be multiple lines of echo with method calls
	// Should be linked with the Controller
	if(!isset($_SESSION)) 
    { 
		session_start();
	}
	//$wardrobeId = $_SESSION['wardrobeId'];
	//$wardrobeId = 1;
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
				<script src="jquery-3.3.1.js"></script>
				<script>
					$(function() {
						$("#deleteDrawer").click(function() {
				    		$("#mc-embedded-drawerForm").show();
						});

						$("#addLockedDrawer").click(function() {
				    		$("#mc-embedded-drawerLockForm").show();
						});
					});
				</script>
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
					<a href="Logout">
						<h1 class="hcomp"> Log Out </h1>
					</a>
					<img src="CSS Files/more.png" id="more">
					</a>
					
					<form  class="searchBar" action="DulapSelected/main" method="post" role="search">
							<input type="text" name="searchParams" placeholder="Enter your search">
							<input type="submit" name="searchAfterW" value="">
					</form>
				</header>
				<br>';
				$count=0;
				if(sizeof($_SESSION["drawerIDs"])==0)
					echo 'The current wardrobe has no drawers';
				else{
					$nrOfIDs=sizeof($_SESSION["drawerIDs"]);
					for($i=0;$i<$nrOfIDs;$i++)
					{
						$count++;
						if($count<4)
						{
							if($count==1)
							{	
								echo '<div class="dulap">';
								echo '<div class="firstRow">';
							}
							$img="'CSS Files/Drawer2_" . $count . ".png' ";
							//echo $img;
							$class="drawer" . $count;
							if($nrOfIDs==1)
							{
								//format the first image in a special way
								$class=$class . "special";
							}	
							//echo $class;
						}
						else 
						{
							if($count==4)
							{
								echo '</div>';
								echo '<div class="secondRow">';
							}
							$img="'CSS Files/Drawer2_" . $count . ".png' ";
							$classCount=$count-3;
							$class="drawer" . $classCount;
							if($nrOfIDs==4)
							{
								//format the first image from the second row in a special way
								$class=$class . "special";
							}
						}
						$imgSrc="<img src=". $img .  " alt='Drawer' class='". $class . "'></a>";
						echo "<a href='" . "http://localhost/DulappMD/Public/Catalog?drawerID=" .
						 	$_SESSION["drawerIDs"][$i] . "'>" . $imgSrc ;
						//<div class="dulap">
							//<div class="firstRow">';
								//<a href="Catalog"><img src="CSS Files/Drawer2_1.png" alt="Drawer" class="drawer1"></a>
								//<a href="Catalog"><img src="CSS Files/Drawer2_2.png" alt="Drawer" class="drawer2"></a>
								//<a href="Catalog"><img src="CSS Files/Drawer2_3.png" alt="Drawer" class="drawer3"></a>
							//</div> //div first row
							//<div class="secondRow">
							//	<a href="Catalog"><img src="CSS Files/Drawer2_4.png" alt="Drawer" class="drawer1"></a>
							//	<a href="Catalog"><img src="CSS Files/Drawer2_5.png" alt="Drawer" class="drawer2"></a>
							//	<a href="Catalog"><img src="CSS Files/Drawer2_6.png" alt="Drawer" class="drawer3"></a>
							//</div> //div second row
							//poza dulap
						//</div> //div dulap
					}
						echo'
						</div> 
						<img src="CSS Files/Dulap2.png" alt="Dulap" id="dulap">
					 	</div>';
					
				}
			echo '
				<form class="update" action="DulapSelected/main" method="post">
					<input type="text"  name="newName" placeholder="New name" required pattern=".{3,20}" title="Must contain beetwen 3 and 20 characters."><br />
					<input type="submit" id="updateButton" name="Update" value="Update wardrobe name">
				</form> 
				<br>
				<div class="buttons">	
					<a href="Form"><img src="CSS Files/umeras.png" alt="addItem" id="addItem"></a>
					<a href="DulapSelected/save"><img src="CSS Files/plus(new).png" alt="addDrawer" id="addDrawer"></a>
					<img src="CSS Files/plusLock.png" alt="addLockedDrawer" id="addLockedDrawer">
					<form class="drawerLockForm" action="DulapSelected/save" method="post" id="mc-embedded-drawerLockForm" name="mc-embedded-drawerLockForm">
					    <fieldset>
					        <input type="text" name="drawerLock" placeholder="Set password for drawer" required pattern="(?=.*\d)(?=.*[a-zA-Z]).{1,}" title="Must be filled up."/> 
					        <input type="lockSubmit" value="Submit" id="submit"/>
					    </fieldset>
					</form>
					<img src="CSS Files/minus(new).png" alt="deleteDrawer" id="deleteDrawer">
					<form class="drawerForm" action="DulapSelected/delete" method="post" id="mc-embedded-drawerForm" name="mc-embedded-drawerForm">
					    <fieldset>
					        <input type="text" name="drawerID" placeholder="DrawerID to delete" required pattern="(?=.*\d).{1,}" title="Must be only digits."/> 
					        <input type="deleteSubmit" value="Submit" id="submit"/>
					    </fieldset>
					</form>
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
