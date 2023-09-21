<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Barco</title>
    <style type="text/css">
        table, td {
            border: 1px black solid;
            border-collapse: collapse;
        }
        .ship {
            background-color: blue;
        }
    </style>
</head>
<body>

    <h2>Barco</h2>

    <table>

        <?php
        
            $N = 8; // Número de columnas
            $M = 6; // Número de filas
            $letra = "A"; //Variable para columna de letras

            $hori = $M - 1;
            $verti = $N - 1;

            $barcos = array( //Array de los barcos con su longitud
                array("tipo" => "fragata", "longitud" => 1),
                array("tipo" => "submarí", "longitud" => 2),
                array("tipo" => "destructor", "longitud" => 3),
                array("tipo" => "portaavions", "longitud" => 4)
            );

            for ($i = 0; $i < count($barcos); $i++) { 
                $longitudBarco = $barcos[$i]["longitud"];
                $orientacionesPosibles = ["horizontal", "vertical"];
                $orientacion = $orientacionesPosibles[array_rand($orientacionesPosibles)]; //Define aleatoriamente si los barcos se colocaran de forma vertical o horizontal

                $posicionValida = false; //Variable que servirá para comprobar si la posición del barco es valida o no

                while (!$posicionValida) { //Bucle para añadir el barco dentro del mapa
                    if ($orientacion == "horizontal") {
                        $x = rand(1, $hori);
                        $y = rand(1, $verti - $longitudBarco + 1);
                    } else {
                        $x = rand(1, $hori - $longitudBarco + 1);
                        $y = rand(1, $verti);
                    }

                    
                    $casillasOcupadas = false;
                    for ($j = 0; $j < $longitudBarco; $j++) { //Comprueba si las casillas que se han asigando a los barcos estan ocupadas o no
                        if ($orientacion == "horizontal" && isset($mapa[$x][$y + $j])) {
                            $casillasOcupadas = true;
                            break;
                        } elseif ($orientacion == "vertical" && isset($mapa[$x + $j][$y])) {
                            $casillasOcupadas = true;
                            break;
                        }
                    }

                    if (!$casillasOcupadas) { //Si casillasOcupadas es false le asigna la posición
                        $barcos[$i]["x"] = $x;
                        $barcos[$i]["y"] = $y;
                        $barcos[$i]["orientacion"] = $orientacion;

                        for ($j = 0; $j < $longitudBarco; $j++) {
                            if ($orientacion == "horizontal") {
                                $mapa[$x][$y + $j] = true;
                            } else {
                                $mapa[$x + $j][$y] = true;
                            }
                        }
                        $posicionValida = true;
                    }
                }
            }
            
            for ($i = 0; $i < $M; $i++) { //Bucle para dibujar el mapa y los barcos que hemos posicionado anteriormente
                echo " <tr>\n";
                for ($j = 0; $j < $N; $j++) {
                    
                    if ($j == 0 && $i == 0) {
                        echo "\t\t<td> </td>\n";
                    } elseif ($j == 0) {
                        echo "\t\t<td>$letra</td>\n";
                    } elseif ($i == 0) {
                        echo "\t\t<td>$j</td>\n";
                    } else {
                        
                        $barcoEncontrado = false;
                        foreach ($barcos as $barco) {
                            if ($barco["orientacion"] == "horizontal" && $j >= $barco["y"] && $j < $barco["y"] + $barco["longitud"] && $i == $barco["x"]) {
                                echo "\t\t<td class='ship'>" . substr($barco["tipo"], 0, 1) . "</td>\n";
                                $barcoEncontrado = true;
                                break;
                            } elseif ($barco["orientacion"] == "vertical" && $i >= $barco["x"] && $i < $barco["x"] + $barco["longitud"] && $j == $barco["y"]) {
                                echo "\t\t<td class='ship'>" . substr($barco["tipo"], 0, 1) . "</td>\n";
                                $barcoEncontrado = true;
                                break;
                            }
                        }
                        if (!$barcoEncontrado) {
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