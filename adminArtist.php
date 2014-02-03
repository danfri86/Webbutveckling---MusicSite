<?php
	include("src/loginFunctions.php");

	if(!checkSession()){
		header("location: login.php");
		exit();
	}
	
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
	include("src/uploadFunctions.php");

	try{
		$dbconnection = myDBConnect();

		// Om vi vill spara artist med "New/Edit Artist"
		if( isset($_POST["btnSave"]) ){
			// Finns inte hidId så sparas en ny artist
			if( empty($_POST["hidId"]) ){
				validateAndMoveUploadedFile(strtolower(substr($_FILES["filePictureFileName"]["name"], -3)));
				// INSERT
				insertArtist( $dbconnection, $_POST["txtArtist"], $_FILES["filePictureFileName"]["name"] );
			} else{ // Finns hidId så uppdateras en artist
				if( $_FILES["filePictureFileName"]["name"] == '' ){

				} else {
					validateAndMoveUploadedFile(strtolower(substr($_FILES["filePictureFileName"]["name"], -3)));
				}
				// UPDATE
				updateArtist( $dbconnection, $_POST["hidId"], $_POST["txtArtist"], $_FILES["filePictureFileName"]["name"], $_POST["hidPictureFileName"] );
			}
		}

		// Om vi vill radera en artist.
		if( isset($_POST["btnDelete"]) ){
			deleteArtist( $dbconnection, $_POST["hidId"], $_POST["hidPictureFileName"] );
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


