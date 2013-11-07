<?php
	/* Förslag på funktioner (inklusive parametrar) som behövs för att hantera söksidan */
    function printSearchForm() {}
    function listArtists($inDBConnection, $inSearchString) {}
    function listSongs($inDBConnection, $inSearchString) {}
    /*
		Om användaren inte har JavaScript aktiverat borde följande funktion anropas vid klick på gilla länken.
		function likeSong($inDBConnection, $inSongId) {}
	*/
    function printCommentForm($songId, $inSongFileName, $inSearchString) {}
    function listComments($inDBConnection, $inSongId){}
	/*
		Om användaren inte har JavaScript aktiverat borde följande funktion anropas vid klick på spara knappen.
		function insertComment($inDBConnection, $inSongId, $inCommentString) {}
	*/
