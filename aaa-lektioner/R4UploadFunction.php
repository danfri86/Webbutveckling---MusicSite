<?php
	//Hit kommer vi om formulärets storlek (skickad mängd) är tillåten
	function validateAndMoveUploadedFile(){
		//Skapa en vektor för att skriva ut lämpligt felmeddelande
		$uploadErrorMsg = array(
			0 => "Inget fel",
			1 => "upload_max_filesize",
			2 => "upload_error_form_size i HTML",
			3 => "Filen har bara delvis blivit uppladdad",
			4 => "Ingen fil hittades",
			6 => "Ingen tmp mapp hittades",
			7 => "Kan inte skriva",
			8 => "upload_error_extension",
		);

		define( "PATH", $_SERVER["DOCUMENT_ROOT"] . "musicsite/aaa-lektioner/R4/" );

		//Om felet är annat än 0 (0 är inget fel) så gör en throw
		if( $_FILES["fileToUpload"]["error"] != 0 ){
			//Det fel som blir motsvarar siffran i vektorn vi skapat
			throw new Exception( $uploadErrorMsg[$_FILES["fileToUpload"]["error"]] );
		}

		//Hämta dom 3 sista tecknen i filen (filformat)
		$inFileExtension = substr($_FILES["fileToUpload"]["name"], -3);

		//Gör om filformatet till små tecken ifall att..
		$inFileExtension = strtolower($inFileExtension);
		
		//Om filen inte har filformatet .ogg så ge ett fel.
		if( $inFileExtension != "ogg" ){
			throw new Exception( "Filen måste vara av formatet .ogg" );
		}

		//Om vi inte kan flytta filen(FALSE) från där xampp lägger den default, till en vald sökväg
		if( move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], PATH.$_FILES["fileToUpload"]["name"]) == FALSE ){
			throw new Exception( "Kunde inte flytta filen." );
		}
	}
?>