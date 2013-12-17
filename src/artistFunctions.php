<?php
	/* F�rslag p� funktioner (inklusive parametrar) som beh�vs f�r att administrera en artister */

    function printArtistForm() {
    	// Skriv ut "New/Edit Artist" formul�ret
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
    	// H�mta all info om artister
    	$strSQL = "SELECT * FROM tblartist;";
    	$recordSet = myDBQuery($dbConnection, $strSQL);

    	// G� igenom tabellen rad f�r rad och l�gg inneh�llet en vektor $record
    	while( $record = mysqli_fetch_assoc($recordSet) ){
    		// Skapa variabler av allt fr�n databasen
    		$id = $record["id"];
    		$name = $record["name"];
    		$picture = $record["picture"];
    		$changeDate = $record["changedate"];

    		// Forts�tt skriva ut resen av formul�ret h�r med data fr�n databasen. Anv�nd variablerna ovan.
    		// Se adminArtist.php hur det �r uppbyggt.

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

    	// Frig�r databasen
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