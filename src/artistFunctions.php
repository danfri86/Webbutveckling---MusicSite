<?php
    function printArtistForm() {
    	// Skriv ut "New/Edit Artist" formuläret
    	?>
    	<fieldset>
			<legend>New/Edit Artist</legend>
			<form action="<?php echo($_SERVER["PHP_SELF"]); ?>" method="post" name="frmNewUpdateArtist" id="frmNewUpdateArtist" enctype="multipart/form-data">
				<input type="hidden" id="hidId" name="hidId" />
				<input type="hidden" id="hidPictureFileName" name="hidPictureFileName" />
				<label>
					Artist
					<br />
					<input type="text" id="txtArtist" name="txtArtist" title="Artist"/>
				</label>
				<br />
				<label>
					Picture
					<br />
					<input type="file" id="filePictureFileName" name="filePictureFileName" title="Picture" />
				</label>
				<br />
				<input type="submit" class="btnSave" name="btnSave" value="Save" />
				<input type="button" class="btnReset" name="btnReset" value="Reset" />
			</form>
		</fieldset>
		<?php
    }

    function listArtists($dbConnection) {
    	// Hämta all info om artister
    	$strSQL = "SELECT * FROM tblartist;";
    	$recordSet = myDBQuery($dbConnection, $strSQL);

    	// Gå igenom tabellen rad för rad och lägg innehållet en vektor $record
    	while( $record = mysqli_fetch_assoc($recordSet) ){
    		// Skapa variabler av allt från databasen
    		$id = $record["id"];
    		$name = $record["name"];
    		$picture = $record["picture"];
    		$changeDate = $record["changedate"];

            ?>
            <h3><?php echo $name ?></h3>
    
            <form action="adminArtist.php" method="post" name="frmArtist">
                id: <?php echo $id ?><br />
                name: <?php echo $name ?> <br />
                picture: <?php echo $picture ?> <br />
                changedate: <?php echo $changeDate ?> <br />
                <img src="upload_jpg/<?php echo $picture ?>" alt="<?php echo $picture ?>" class="imgAnimation" /><br />
                <input type="button" name="btnEdit" value="Edit" >
                <input type="submit" class="btnDelete" name="btnDelete" value="Delete" />
                <input type="hidden" name="hidId" value="<?php echo $id ?>" />
                <input type="hidden" name="hidPictureFileName" value="<?php echo $picture ?>" />
                <input type="hidden" name="hidArtist" value="<?php echo $name ?>" />
            </form>

            <?php
    	}

    	// Frigör minnet från databasen
    	myDBFreeResult($recordSet);
    }

    function updateArtist($dbConnection, $inArtistId, $inArtist, $inNewPictureFileName, $inOldPictureFileName) {

        $strSQL = "UPDATE tblartist SET name='$inArtist'";

        if( !empty($inNewPictureFileName))
            $strSQL .= ", picture='$inNewPictureFileName' ";

        $strSQL .= "WHERE id=$inArtistId;";

        if( !empty($inOldPictureFileName) )
            unlink($_SERVER["DOCUMENT_ROOT"]."/musicsite/upload_jpg/".$inOldPictureFileName);

        myDBQuery($dbConnection, $strSQL);
    }

    function deleteArtist($dbConnection, $inArtistId, $inPictureFileName) {
        $artistlat = "SELECT sound FROM tblsong WHERE artistid=$inArtistId;";

        $artistlatResults = myDBQuery($dbConnection, $artistlat);

        while( $record = mysqli_fetch_assoc($artistlatResults) )
            $artistlatValue = $record["sound"];

        myDBQuery($dbConnection, $artistlat);

        $strSQL = "DELETE tblartist, tblsong FROM tblartist, tblsong WHERE tblartist.id=$inArtistId AND tblsong.artistid=$inArtistId;";

        if( !empty($inPictureFileName) )
            unlink($_SERVER["DOCUMENT_ROOT"]."/musicsite/upload_jpg/".$inPictureFileName);

        if( !empty($artistlat) )
            unlink($_SERVER["DOCUMENT_ROOT"]."/musicsite/upload_ogg/".$artistlatValue);

        myDBQuery($dbConnection, $strSQL);
    }

    function insertArtist($dbConnection, $inArtist, $inNewPictureFileName) {
        $strSQL = "INSERT INTO tblartist(name, picture) VALUES('$inArtist', '$inNewPictureFileName');";
        myDBQuery($dbConnection, $strSQL);
    }
?>