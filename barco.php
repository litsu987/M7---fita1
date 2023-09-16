<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<style type="text/css">
    	table, td {
        	border: 1px black solid;
        	border-collapse: collapse;
    	}
        .submarine {
            background-color: blue; /* Puedes personalizar el estilo del submarino */
        }
	</style>
</head>
<body>
    
	<h2>Barco</h2>

	<table>

	<?php
	$N = 8; // Número de columnas
	$M = 6; // Número de filas
	$letra = "A";

	$barcos = array(
		array("tipo" => "fragata", "longitud" => 1),
		array("tipo" => "submarí", "longitud" => 2),
		array("tipo" => "destructor", "longitud" => 3),
		array("tipo" => "portaavions", "longitud" => 4)
	);
	
	// Define la longitud del submarino
	$longitudSubmarino = 2;

	// Define la orientación del submarino (horizontal o vertical)
	$orientacion = "horizontal"; // Cambia a "vertical" para probar en vertical

	for ($i = 0; $i < $M; $i++) {
		echo " <tr>\n";
		for ($j = 0; $j < $N; $j++) {
			if ($j == 0 && $i == 0) {
				echo "\t\t<td> </td>\n";
			} elseif ($j == 0) {
				echo "\t\t<td>$letra</td>\n";
			} elseif ($i == 0) {
				echo "\t\t<td>$j</td>\n";
			} else {
				// Comprueba si esta celda es parte del barco
				$barcoEncontrado = false;
				foreach ($barcos as $barco) {
					if ($orientacion == "horizontal" && $j >= 1 && $j <= $barco["longitud"] && $i == 1 && $barcoEncontrado == false) {
						echo "\t\t<td class='ship'>" . substr($barco["tipo"], 0, 1) . "</td>\n";
						$barcoEncontrado = true;
					} elseif ($orientacion == "vertical" && $i >= 1 && $i <= $barco["longitud"] && $j == 1 && $barcoEncontrado == false) {
						echo "\t\t<td class='ship'>" . substr($barco["tipo"], 0, 1) . "</td>\n";
						$barcoEncontrado = true;
					}
				}
				if ($barcoEncontrado == false) {
					echo "\t\t<td></td>\n";
				}
			}
		}
		if ($i > 0) {
			$letra++;
		}
		echo " </tr>";
	}
	?>
	</table>

</body>
</html>
