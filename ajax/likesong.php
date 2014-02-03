<?php

	/*
		Öka tblsong.count med ett och spara i databasen.
	*/
	include($_SERVER["DOCUMENT_ROOT"]. "/musicsite/src/databaseFunctions.php");

	if( !empty($_POST["count"]) )
		$count = $_POST['count'];

	if( !empty($_POST["latid"]) )
		$latid = $_POST['latid'];

	$count++;

	$dbconnection = myDBConnect();

	$strSQL = "UPDATE tblsong SET count= ". $count ." WHERE id= ". $latid .";";
    
    myDBQuery($dbconnection, $strSQL);

    // Stäng anslutningen till databasen
	myDBClose($dbconnection);
	
	echo("{\"like\" : \"". $count ."\"}");
	
?>