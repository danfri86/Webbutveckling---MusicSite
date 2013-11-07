<?php
	/* Förslag på funktioner (inklusive parametrar) som behövs för att administrera en sång */
    function printSongForm($inDBConnection) {}
    function listSongs($inDBConnection) {}
    function updateSong($inDBConnection, $inSongId, $inArtistId, $inCount, $inTitle, $inNewSongFileName, $inOldSongFileName) {}
    function deleteSong($inDBConnection, $inSongId, $inSongFileName) {}
    function insertSong($inDBConnection, $inArtistId, $inCount, $inTitle, $inNewSongFileName) {}
