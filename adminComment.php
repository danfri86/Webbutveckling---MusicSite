<?php
	include("src/loginFunctions.php");

	if(!checkSession()){
		header("location: login.php");
		exit();
	}
	
	$script="commentFunctions.js";
	$title="Admin comment";
	//$accordion = TRUE;
	$jquery = TRUE;
	//$admin = "secretpage";
	
	include("incl/header.php");
	
?>

<script type="text/javascript" src="clientwidth.js"></script>
<div id="content">
		
	<h1>Admin Comment</h1>

	<?php
	include("src/databasefunctions.php");
	include("src/commentFunctions.php");

	try{
		$dbconnection = myDBConnect();

		// Insert, update, delete ska ske innan Select. Vi kontrollerar först insert, update och delete

		// Om vi vill radera en kommentar. Använder endast det formulär så knappen finns i automatiskt
		if( isset($_POST["btnDelete"]) ){
			deleteComment( $dbconnection, $_POST["hidId"] );
		}

		// Lista kommentarer
		listComments($dbconnection);

		// Stäng anslutningen till databasen
		myDBClose($dbconnection);
	}
	catch( Exception $oE){
		echo ( $oE->getMessage() );
	}
	?>
</div>

<?php include("incl/footer.php");