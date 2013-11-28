<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>POST & GET</title>
</head>
<body>
	<p>DOCUMENT_ROOT: <?php echo($_SERVER["DOCUMENT_ROOT"]); ?></p>
	<p>PHP_SELF: <?php echo($_SERVER["PHP_SELF"]); ?></p>
	<p>QUERY_STRING: <?php echo($_SERVER["QUERY_STRING"]); ?></p>

	<form action="<?php echo($_SERVER["PHP_SELF"]); ?>" method="get">

		<p>
			<label>Fabrikat:
				<input type= "text" name="txtBil" placeholder="Ange fabrikat!"
				/>
			</label>
		</p>

		<p>
			<label>Regnr:
				<input type= "text" name="txtRegnr" placeholder="Ange regnr!" />
			</label>
		</p>

		<input type="submit" name="btnSkicka" value="Skicka" />
		<input type="reset" name="btnRensa" value="Rensa" />

	</form>

</body>
</html>