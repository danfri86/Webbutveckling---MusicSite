<?php

	/*
		Spara den nya kommentaren i databasen.
	*/
	include($_SERVER["DOCUMENT_ROOT"]. "/musicsite/src/databaseFunctions.php");

	$kommentarText = strip_tags( $_POST['text'] );
	$id = strip_tags( $_POST['id'] );

	$dbconnection = myDBConnect();

	$kommentarTextClean = mysqli_real_escape_string( $dbconnection, $kommentarText );
	$idClean = mysqli_real_escape_string( $dbconnection, $id );

	$strSQL = "INSERT INTO tblcomment(text, songid) VALUES('". $kommentarTextClean. "', '". $idClean ."');";

	myDBQuery($dbconnection, $strSQL);

    // Stäng anslutningen till databasen
	myDBClose($dbconnection);

	//För test returneras dagens datum och en konstant i form av JSON.
	//{"date" : "dagens datum", "comment" : "Detta är en kommentar"};

	echo("{\"date\" : \"" . date("Y-m-d G:i:s") . "\", \"comment\" : \"". $kommentarText ."\"}");
?>