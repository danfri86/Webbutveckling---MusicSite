<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<title>
		Lotto
	</title>

</head>

<body>

	<?php

	$arrMinVektor = array(35);

	for($intRaknare = 1; $intRaknare <= 35; $intRaknare++){
		$arrMinVektor[$intRaknare] = 0;
	}

	$intAntalSlumpningar = 0;

	for($intRaknare = 1; $intRaknare <= 7; $intRaknare++){
		$intSlumptal = mt_rand(1, 35);
		$intAntalSlumpningar++;

		while($arrMinVektor[$intSlumptal] == 1){
			$intSlumptal = mt_rand(1, 35);
			$intAntalSlumpningar++;
		}

		$arrMinVektor[$intSlumptal] = 1;
	}

	echo("<p>\nAntal slumpningar är: <b>".$intAntalSlumpningar.
		"</b></p><br />\n");

	echo("<table border=\"1\">\n");

	$intLottoNummer=0;

	for($intRader=1; $intRader<=7; $intRader++){
		echo("<tr>\n");

		for($intKolumner=1; $intKolumner<=5; $intKolumner++){
			$intLottoNummer++;

			if($arrMinVektor[$intLottoNummer] == 1){
				echo("<td>".$intLottoNummer."</td>\n");
			}
			else{
				echo("<td>".$intLottoNummer."</td>\n");
			}
		}

		echo("</tr>\n");
	}
	echo("</table>\n");

	?>

	<form action="php-lotto.php" method="post" name="frmLotto">
		<input type="submit" name="btnNyLottorad" value="Slumpa ny lottorad" />
	</form>

</body>
</html>