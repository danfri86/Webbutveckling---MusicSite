<?php

	/*
		Öka tblsong.count med ett och spara i databasen.
	*/
	include($_SERVER["DOCUMENT_ROOT"]. "/musicsite/src/databaseFunctions.php");

	$count = $_POST['count'];
	$latid = $_POST['latid'];

	$count++;

	$dbconnection = myDBConnect();

	$strSQL = "UPDATE tblsong SET count= ". $count ." WHERE id= ". $latid .";";
    
    myDBQuery($dbconnection, $strSQL);

    // Stäng anslutningen till databasen
	myDBClose($dbconnection);
	
	//För test returnerars konstanten 100 i form av JSON.
	//{"gilla" : "100"}
	echo("{\"like\" : \"". $count ."\"}");
	
?>