<?php
	
	$script="artistFunctions.js";
	$title="Admin Artist";
	$accordion = TRUE;
	$jquery = TRUE;
	//$admin = "secretpage";
	
	include("incl/header.php");	
?>

<div id="content">
	
	<h1>Admin Artist</h1>

	<?php
	include("src/databasefunctions.php");
	include("src/artistfunctions.php");

	try{
		$dbconnection = myDBConnect();

		// Insert, update, delete ska ske innan Select. Vi kontrollerar först insert, update och delete

		// Om vi vill spara info om artist med "New/Edit Artist"
		if( isset($_POST["btnSave"]) ){
			// Finns inte hidId så sparas en ny artist
			if( empty($_POST["hidId"]) ){
				// INSERT
				insertArtist( $dbconnection, $_POST["txtArtist"], $_FILES["filePictureFileName"]["name"] );
			} else{ // Finns hidId så uppdateras en artist
				// UPDATE
				updateArtist( $dbconnection, $_POST["hidId"], $_POST["txtArtist"], $_FILES["filePictureFileName"]["name"], $_POST["hidPictureFileName"] );
			}
		}

		// Om vi vill radera en artist. Använder endast det formulär så knappen finns i automatiskt
		if( isset($_POST["btnDelete"]) ){
			// DELETE
		}

		printArtistForm();

		echo "<div class='accordion'>";
			// Lista artister
			listArtists($dbconnection);
		echo "</div>";

		// Stäng anslutningen till databasen
		myDBClose($dbconnection);
	}
	catch( Exception $oE){
		echo ( $oE->getMessage() );
	}
?>
	
</div>
					
<?php include("incl/footer.php");


