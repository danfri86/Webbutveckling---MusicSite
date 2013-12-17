<?php
	/* Förslag på funktioner (inklusive parametrar) som behövs för att administrera en artister */

    function printArtistForm() {
    	// Skriv ut "New/Edit Artist" formuläret
    	?>
    	<fieldset>
			<legend>New/Edit Artist</legend>
			<form action="adminArtist.php" method="post" name="frmNewUpdateArtist" id="frmNewUpdateArtist" enctype="multipart/form-data">
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

    		// Fortsätt skriva ut resen av formuläret här med data från databasen. Använd variablerna ovan.
    		// Se adminArtist.php hur det är uppbyggt.

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

    	// Frigör databasen
    	myDBFreeResult($recordSet);
    }

    function updateArtist($dbConnection, $inArtistId, $inArtist, $inNewPictureFileName, $inOldPictureFileName) {

        $strSQL = "UPDATE tblartist SET name='$inArtist', ";
        if( isset($_POST[$inNewPictureFileName]) ){
            $strSQL .= "picture='$inNewPictureFileName' ";
        }else{
            $strSQL .= "picture='$inOldPictureFileName' ";
        }
        $strSQL .= "WHERE id=$inArtistId;";

        echo $strSQL;

        myDBQuery($dbConnection, $strSQL);
    }

    function deleteArtist($dbConnection, $inArtistId, $inPictureFileName) {

    }

    function insertArtist($dbConnection, $inArtist, $inNewPictureFileName) {
        $strSQL = "INSERT INTO tblartist(name, picture) VALUES('$inArtist', '$inNewPictureFileName');";
        myDBQuery($dbConnection, $strSQL);
    }