<?php

	/*
		Spara den nya kommentaren i databasen.
	*/
	include("../src/databasefunctions.php");

	$kommentarText = $_POST[$text];
	$id = $_POST[$id];

	$dbconnection = myDBConnect();

	$strSQL = "INSERT INTO tblcomment(text, songid) VALUES(". $kommentarText. ", ". $id .");";
    $recordSet = myDBQuery($dbConnection, $strSQL);
	
	//För test returneras dagens datum och en konstant i form av JSON.
	//{"date" : "dagens datum", "comment" : "Detta är en kommentar"}
	echo("{\"date\" : \"" . date("Y-m-d") . "\", \"comment\" : \"". $kommentarText ."\"}");
?>