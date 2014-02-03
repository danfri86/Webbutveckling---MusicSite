<?php
    function listComments($inDBConnection){
    	// Hämta all info om kommentarer
    	$strSQL = "SELECT * FROM tblcomment;";
    	$recordSet = myDBQuery($inDBConnection, $strSQL);

    	// Gå igenom tabellen rad för rad och lägg innehållet en vektor $record
    	while( $record = mysqli_fetch_assoc($recordSet) ){
    		// Skapa variabler av allt från databasen
    		$id = $record["id"];
    		$songid = $record["songid"];
    		$text = $record["text"];
    		$insertdate = $record["insertdate"];

            ?>

            <h3><?php echo 'ID: '. $id ?></h3>

            <form action="adminComment.php" method="post" name="frmComment">
				id: <?php echo $id ?><br />
				songid: <?php echo $songid ?><br />
				text: <?php echo $text ?><br />
				insertdate: <?php echo $insertdate ?><br />
				<input type="hidden" name="hidId" value="<?php echo $id ?>" />
				<input type="hidden" name="hidText" value="<?php echo $text ?>" />
				<input type="submit" class="btnDelete" name="btnDelete" value="Delete" />
			</form>
            <?php
    	}

    	// Frigör databasen
    	myDBFreeResult($recordSet);
    }

    function deleteComment($inDBConnection, $inCommentId) {
    	$strSQL = "DELETE FROM tblcomment WHERE id='$inCommentId';";

        myDBQuery($inDBConnection, $strSQL);
    }