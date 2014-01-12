<?php
	include ("R4UploadFunction.php");

	try{
		//Kontrollera om den totala datamängden är mer än tillåten
		//Om någon skickat med POST och innehållet är för stort så blir FILES och POST empty för innehållet skickas inte.
		if( empty($_FILES) && empty($_POST) && isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST" ){

			throw new exception("Du har överskridit tillåten datamängd");
		}

		//Om en fil har valts och har tillåten storlek, kör funktionen...
		if( isset($_POST["btnUpload"]) ){
			validateAndMoveUploadedFile();
		}
	}
	catch( Exception $oE){
		echo ( $oE->getMessage() );
	}
?>