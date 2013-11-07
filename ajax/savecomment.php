<?php

	/*
		Spara den nya kommentaren i databasen.
	*/
	
	//För test returneras dagens datum och en konstant i form av JSON.
	//{"date" : "dagens datum", "comment" : "Detta är en kommentar"}
	$comment = "Detta är en kommentar";
	echo("{\"date\" : \"" . date("Y-m-d") . "\", \"comment\" : \"". $comment ."\"}");
	
?>