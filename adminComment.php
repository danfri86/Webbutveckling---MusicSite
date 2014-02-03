<?php
	include("src/loginFunctions.php");

	if(!checkSession()){
		header("location: login.php");
		exit();
	}
	
	$script="commentFunctions.js";
	$title="Admin comment";
	$accordion = TRUE;
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

		// Om vi vill radera en kommentar.
		if( isset($_POST["btnDelete"]) ){
			deleteComment( $dbconnection, $_POST["hidId"] );
		}

		echo "<div class='accordion'>";
			// Lista kommentarer
			listComments($dbconnection);
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