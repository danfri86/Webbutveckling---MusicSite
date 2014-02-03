<?php

	/*
		Spara den nya kommentaren i databasen.
	*/
	include($_SERVER["DOCUMENT_ROOT"]. "/musicsite/src/databaseFunctions.php");

	if( empty($_POST["text"]) )
		echo 'Du måste skriva någonting!';
	else
		$kommentarText = strip_tags( $_POST['text'] );

	if( empty($_POST["text"]) )
		echo 'Det finns inget id';
	else
		$id = strip_tags( $_POST['id'] );

	$dbconnection = myDBConnect();

	$kommentarTextClean = mysqli_real_escape_string( $dbconnection, $kommentarText );
	$idClean = mysqli_real_escape_string( $dbconnection, $id );

	$strSQL = "INSERT INTO tblcomment(text, songid) VALUES('". $kommentarTextClean. "', '". $idClean ."');";

	myDBQuery($dbconnection, $strSQL);

    // Stäng anslutningen till databasen
	myDBClose($dbconnection);

	echo("{\"date\" : \"" . date("Y-m-d G:i:s") . "\", \"comment\" : \"". $kommentarText ."\"}");
?>