<?php
	/* F�rslag p� funktioner (inklusive parametrar) som beh�vs f�r att administrera en s�ng */
    function printSongForm($inDBConnection) {}
    function listSongs($inDBConnection) {}
    function updateSong($inDBConnection, $inSongId, $inArtistId, $inCount, $inTitle, $inNewSongFileName, $inOldSongFileName) {}
    function deleteSong($inDBConnection, $inSongId, $inSongFileName) {}
    function insertSong($inDBConnection, $inArtistId, $inCount, $inTitle, $inNewSongFileName) {}
