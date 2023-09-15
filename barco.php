
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
	</style>
</head>
<body>
    
	<h2>Barco</h2>

	<table>

	<?php
	$N = 8;
	$M = 6;
	$letra = "A";
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
            	echo "\t\t<td>$letra$j</td>\n";
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
