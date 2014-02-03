<?php
	$script="searchFunctions.js";
	$title="Search";
	$slimbox = TRUE;
	//$accordion = True,
	$jquery = TRUE;
	include("incl/header.php");
?>
<div id="content">
	
	<h1>Search Artist and/or Song!</h1>

	<?php
	include("src/databasefunctions.php");
	include("src/searchFunctions.php");

	try{
		$dbconnection = myDBConnect();

		// Om en kommentar skrivs
		if( isset($_POST["btnSave"]) ){
			insertComment( $dbconnection, $_POST["selArtistId"], $_POST["txtCount"], $_POST["txtTitle"], $_FILES["fileSoundFileName"]["name"] );
		}

		printSearchForm();

		if( isset($_POST["txtSearch"])){
			// Lista artister
			listArtists($dbconnection, $_POST["txtSearch"]);
		}

		if( isset($_POST["txtSearch"])){
			// Lista sånger
			listSongs($dbconnection, $_POST["txtSearch"]);
		}

		// Stäng anslutningen till databasen
		myDBClose($dbconnection);
	}
	catch( Exception $oE){
		echo ( $oE->getMessage() );
	}
	?>	
	
</div>

<?php include("incl/footer.php");