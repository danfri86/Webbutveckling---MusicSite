<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>POST & GET</title>
</head>
<body>

	<form action="<?php echo($_SERVER["PHP_SELF"]); ?>" method="post">

		<p>
			<label>
				Ange filmtitel:
				<input type="text" name="txtTitel" />
			</label>
		</p>

		<p>
			<label>Ange filmårtal:
				<input type="text" name="txtArtal" />
			</label>
		</p>

		<p>
			<label>Ange kategori:
				<select name="cboKategori">
					<option value="0">--- Ange en kategori ---</option>
					<option value="1">Action</option>
					<option value="2">Skräck</option>
					<option value="3">Komedi</option>
				</select>
			</label>
		</p>


		<p>
			<input type="submit" name="btnSkicka" value="Skicka" />
			<input type="reset" name="btnRensa" value="Rensa" />
		</p>

	</form>

	<?php
		echo("<pre>\n");
		print_r($_POST);
		echo("</pre>\n");

		echo(var_dump(isset($_POST["btnSkicka"])));
		echo(var_dump(isset($_POST["txtTitel"])));
		echo(var_dump(empty($_POST["txtTitel"])));

		echo(var_dump(is_numeric($_POST["txtArtal"]))); //Kommer att ge felmeddelande om vi inte har tryckt på submit
		$year = $_POST["txtArtal"]; //Kommer att ge felmeddelande om vi inte har tryckt på submit
		echo("<pre>".gettype($year)."</pre>");
		settype($year, "integer"); echo("<pre>".gettype($year)."</pre>");
	?>


</body>
</html>
