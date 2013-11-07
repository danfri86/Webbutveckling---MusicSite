<?php
	/* Förslag på funktioner (inklusive parametrar) som behövs för att administrera en artister */
    function printArtistForm() {}
    function listArtists($dbConnection) {}
    function updateArtist($dbConnection, $inArtistId, $inArtist, $inNewPictureFileName, $inOldPictureFileName) {}
    function deleteArtist($dbConnection, $inArtistId, $inPictureFileName) {}
    function insertArtist($dbConnection, $inArtist, $inNewPictureFileName) {}