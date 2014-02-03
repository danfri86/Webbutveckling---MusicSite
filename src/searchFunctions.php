<?php
	/* Förslag på funktioner (inklusive parametrar) som behövs för att hantera söksidan */
    function printSearchForm() {
    	?>
    	<form action="<?php echo($_SERVER["PHP_SELF"]); ?>" id="frmSearch" method="post" name="frmsearch">
			<fieldset>
				<legend>
					Song and/or Artist
				</legend>
				<input type="text" id="txtsearch" name="txtSearch" title="Song and/or Artist!" required="required" placeholder="Type Artist or Song and press Search!" size="35" autofocus="autofocus"/><br />
				<input type="submit" id="btnsearch" name="btnSearch" value="Search" />
				<input type="reset" class="btnReset" name="btnReset" value="Reset" />
			</fieldset>
		</form>
	<?php
    }

    function listArtists($inDBConnection, $inSearchString) {
    	// Hämta all info om artister
    	$strSQL = "SELECT * FROM tblartist WHERE name LIKE '". $inSearchString ."%';";
    	$recordSet = myDBQuery($inDBConnection, $strSQL);

    	echo "<fieldset><legend>Searchresult Artist</legend>";

    	// Gå igenom tabellen rad för rad och lägg innehållet en vektor $record
    	while( $record = mysqli_fetch_assoc($recordSet) ){
    		// Skapa variabler av allt från databasen
    		$name = $record["name"];
    		$picture = $record["picture"];

            ?>

            Name: <?php echo $name; ?>	<br />
            <a href="upload_jpg/<?php echo $picture; ?>" rel="lightbox">
			<img src="upload_jpg/<?php echo $picture; ?>" alt="<?php echo $picture; ?>" />
			</a>
            <br />
            <?php
    	}

    	echo "</fieldset>";

    	// Frigör databasen
    	myDBFreeResult($recordSet);
    	?>
		<?php
    }

    function listSongs($inDBConnection, $inSearchString) {
    	// Hämta all info om låtar
    	$strSQL = "SELECT * FROM tblsong WHERE title LIKE '". $inSearchString ."%';";
    	$recordSet = myDBQuery($inDBConnection, $strSQL);

    	echo "<fieldset><legend>Searchresult Song</legend>";

    	// Gå igenom tabellen rad för rad och lägg innehållet en vektor $record
    	while( $record = mysqli_fetch_assoc($recordSet) ){
    		// Skapa variabler av allt från databasen
    		$songId = $record["id"];
    		$title = $record["title"];
    		$sound = $record["sound"];
    		$count = $record["count"];

    		listComments($inDBConnection, $songId);

    		printCommentForm($songId, $sound, $_POST["txtSearch"]);

            ?>

			<p>
				Title: <?php echo $title; ?><br />
				Song: <?php echo $sound; ?><br />
				Count: <span data-id="<?php echo $songId; ?>"><?php echo $count; ?></span>
				<br />
				<audio controls="controls">
					<source src="upload_ogg/<?php echo $sound; ?>" />
					Din webbläsare stödjer inte audio-taggen!
				</audio>
				<br />
			</p>
            <?php
    	}

    	echo "</fieldset>";

    	// Frigör databasen
    	myDBFreeResult($recordSet);
    	?>
		<?php
    }

    /*
		Om användaren inte har JavaScript aktiverat borde följande funktion anropas vid klick på gilla länken.
		function likeSong($inDBConnection, $inSongId) {
	
		}
	*/
    function printCommentForm($songId, $inSongFileName, $inSearchString) {
    	?>
    	<form action="#" method="post" name="frmcomment" data-id="<?php echo $songId; ?>">
			<fieldset>
				<legend>
					Comment on <?php echo $inSongFileName; ?>
				</legend>
				<textarea name="txtComment" cols="40" rows="10" title='Comment' required="required" placeholder="Write your comment!"></textarea><br />
				<input type="hidden" name="hidId" value="<?php echo $songId; ?>" />
				<input type="submit" name="btnSave" value="Save" />
				<input type="reset" class="btnReset" name="btnReset" value="Reset" />
			</fieldset>
		</form>

		<a href="javascript:;" data-id="<?php echo $songId; ?>">Like <?php echo $inSongFileName; ?></a>
		<?php
    }

    function listComments($inDBConnection, $inSongId){
    	// Hämta all info om kommentarer
    	$strSQL = "SELECT * FROM tblcomment WHERE songid=". $inSongId .";";
    	$recordSet = myDBQuery($inDBConnection, $strSQL);

        echo '<div data-comments="comments" data-id="'. $inSongId .'">';
    	// Gå igenom tabellen rad för rad och lägg innehållet en vektor $record
    	while( $record = mysqli_fetch_assoc($recordSet) ){
    		// Skapa variabler av allt från databasen
    		$text = $record["text"];
    		$insertdate = $record["insertdate"];

            ?>
				<p>
					<b><?php echo $insertdate; ?>: </b>
					<i><?php echo $text; ?></i>
				</p>
            <?php
    	}
        echo '</div>';

    	// Frigör databasen
    	myDBFreeResult($recordSet);
    }