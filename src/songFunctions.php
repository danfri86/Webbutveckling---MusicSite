<?php
    function printSongForm($inDBConnection) {
    	// Skriv ut "New/Edit Song" formuläret
    	?>
    	<form action="<?php echo($_SERVER["PHP_SELF"]); ?>" method="post" id="frmNewUpdateSong" name="frmNewUpdateSong" enctype="multipart/form-data">
		
			<fieldset>
				<legend>New/Edit Song</legend>
				<input type="hidden" id="hidId" name="hidId" />
				<input type="hidden" id="hidSoundFileName" name="hidSoundFileName" />
				<label>
					Artist
					<br />
					<select id="selArtistId" name="selArtistId" title="Artist" autofocus="autofocus">
					<option value="0">Choose Artist</option>
					<?php

					$strSQL = "SELECT * FROM tblartist;";

					$recordSet = myDBQuery($inDBConnection, $strSQL);

					while($record=mysqli_fetch_assoc($recordSet)){
						echo '<option value="'.$record["id"].'">';
						echo $record["name"];
						echo '</option>';
					}

					?>
					</select>
				</label>
				<br />
				
				<label>
					Song
					<br />
					<input type="text" id="txtTitle" name="txtTitle" title="Title"/>
				</label>
				<br />
				
				<label>
					Sound
					<br />
					<input type="file" id="fileSoundFileName" name="fileSoundFileName" title="File" />
				</label>
				<br />
				
				<label>
					Count
					<br />
					<input type="text" id="txtCount" name="txtCount" title="Count" />
				</label>
				<br />
				
				<input type="submit" id="btnSave" name="btnSave" value="Save" />
				<input type="button" class="btnReset" name="btnReset" value="Reset" />
			</fieldset>
		</form>
		<?php
    }

    function listSongs($inDBConnection) {
    	// Hämta all info om låtar
    	$strSQL = "SELECT * FROM tblsong;";
    	$recordSet = myDBQuery($inDBConnection, $strSQL);

    	// Gå igenom tabellen rad för rad och lägg innehållet en vektor $record
    	while( $record = mysqli_fetch_assoc($recordSet) ){
    		// Skapa variabler av allt från databasen
    		$id = $record["id"];
    		$artistid = $record["artistid"];
    		$title = $record["title"];
    		$sound = $record["sound"];
    		$count = $record["count"];
    		$changeDate = $record["changedate"];

            ?>
            <h3><?php echo $title ?></h3>
    
            <form action="adminSong.php" method="post" class="frmSong" name="frmSong">
                id: <?php echo $id ?><br />
                name: <?php echo $title ?> <br />
                sound: <?php echo $sound ?> <br />
                count: <?php echo $count ?> <br />
                changeDate: <?php echo $changeDate ?> <br />

                <input type="hidden" name="hidId" value="<?php echo $id ?>" />
                <input type="hidden" name="hidArtistId" value="<?php echo $artistid ?>" />
                <input type="hidden" name="hidTitle" value="<?php echo $title ?>" />
                <input type="hidden" name="hidSoundFileName" value="<?php echo $sound ?>" />
				<input type="hidden" name="hidCount" value="<?php echo $count ?>" />

				<audio controls="controls">
					<source src="upload_ogg/<?php echo $sound ?>" />
					Your browser does not support the audio tag!
				</audio>
				<br />

               <input type="button" name="btnEdit" value="Edit" />
				<input type="submit" class="btnDelete" name="btnDelete" value="Delete" />
            </form>
            <?php
    	}

    	// Frigör databasen
    	myDBFreeResult($recordSet);
    }

    function updateSong($inDBConnection, $inSongId, $inArtistId, $inCount, $inTitle, $inNewSongFileName, $inOldSongFileName) {
    	
    	$strSQL = "UPDATE tblsong SET title='$inTitle', count='$inCount', artistid='$inArtistId', ";
        if( isset($_POST[$inNewSongFileName]) ){
            $strSQL .= "sound='$inNewSongFileName' ";
        }else{
            $strSQL .= "sound='$inOldSongFileName' ";
        }
        $strSQL .= "WHERE id=$inSongId;";

        myDBQuery($inDBConnection, $strSQL);
    }

    function deleteSong($inDBConnection, $inSongId, $inSongFileName) {
    	$strSQL = "DELETE FROM tblsong WHERE id='$inSongId' AND sound='$inSongFileName';";

        myDBQuery($inDBConnection, $strSQL);
    }

    function insertSong($inDBConnection, $inArtistId, $inCount, $inTitle, $inNewSongFileName) {
    	$strSQL = "INSERT INTO tblsong(artistid, count, title, sound) VALUES('$inArtistId', '$inCount', '$inTitle', '$inNewSongFileName');";
        myDBQuery($inDBConnection, $strSQL);
    }
?>