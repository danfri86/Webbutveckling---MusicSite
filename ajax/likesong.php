<?php

	/*
		Öka tblsong.count med ett och spara i databasen.
	*/
	include("../src/databasefunctions.php");

	$dbconnection = myDBConnect();

	$strSQL = "SELECT count FROM tblsong
	WHERE id = ;";
    $recordSet = myDBQuery($dbConnection, $strSQL);
	
	//För test returnerars konstanten 100 i form av JSON.
	//{"gilla" : "100"}
	echo("{\"like\" : \"100\"}");
	
?>