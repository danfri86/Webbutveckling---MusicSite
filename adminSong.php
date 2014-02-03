<?php
	include("src/loginFunctions.php");

	if(!checkSession()){
		header("location: login.php");
		exit();
	}
	
	$script="songFunctions.js";
	$title="Admin song";
	$accordion = TRUE;
	$jquery = TRUE;
	//$admin = "secretpage";
	
	include("incl/header.php");
	
?>

<div id="content">
	
	<h1>Admin Song</h1>

	<?php
	include("src/databasefunctions.php");
	include("src/songfunctions.php");
	include("src/uploadFunctions.php");

	try{
		$dbconnection = myDBConnect();

		// Om vi vill spara låt med "New/Edit Song"
		if( isset($_POST["btnSave"]) ){
			// Finns inte hidId så sparas en ny sång
			if( empty($_POST["hidId"]) ){
				validateAndMoveUploadedFile(strtolower(substr($_FILES["fileSoundFileName"]["name"], -3)));
				// INSERT
				insertSong( $dbconnection, $_POST["selArtistId"], $_POST["txtCount"], $_POST["txtTitle"], $_FILES["fileSoundFileName"]["name"] );
			} else{ // Finns hidId så uppdateras en artist
				if( $_FILES["fileSoundFileName"]["name"] == '' ){

				} else {
					validateAndMoveUploadedFile(strtolower(substr($_FILES["fileSoundFileName"]["name"], -3)));
				}
				// UPDATE
				updateSong( $dbconnection, $_POST["hidId"], $_POST["selArtistId"], $_POST["txtCount"], $_POST["txtTitle"], $_FILES["fileSoundFileName"]["name"], $_POST["hidSoundFileName"] );
			}
		}

		// Om vi vill radera en sång.
		if( isset($_POST["btnDelete"]) ){
			deleteSong( $dbconnection, $_POST["hidId"], $_POST["hidSoundFileName"] );
		}

		printSongForm($dbconnection);

		echo "<div class='accordion'>";
			// Lista artister
			listSongs($dbconnection);
		echo "</div>";

		// Stäng anslutningen till databasen
		myDBClose($dbconnection);
	}
	catch( Exception $oE){
		echo ( $oE->getMessage() );
	}
	?>
	
</div>

<?php include("incl/footer.php"); ?>


