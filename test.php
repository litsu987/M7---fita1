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
            $letra = "A";

            $hori = $M - 1;
            $verti = $N - 1;

            $barcos = array(
                array("tipo" => "fragata", "longitud" => 1),
                array("tipo" => "submarí", "longitud" => 2),
                array("tipo" => "destructor", "longitud" => 3),
                array("tipo" => "portaavions", "longitud" => 4)
            );

            for ($i = 0; $i < count($barcos); $i++) {
                $longitudBarco = $barcos[$i]["longitud"];
                $orientacionesPosibles = ["horizontal", "vertical"];
                $orientacion = $orientacionesPosibles[array_rand($orientacionesPosibles)]; // Selecciona una orientación aleatoria

                $posicionValida = false;

                while (!$posicionValida) {
                    if ($orientacion == "horizontal") {
                        $x = rand(1, $hori);
                        $y = rand(1, $verti - $longitudBarco + 1);
                    } else {
                        $x = rand(1, $hori - $longitudBarco + 1);
                        $y = rand(1, $verti);
                    }

                    // Verifica si las casillas ya están ocupadas por otro barco
                    $casillasOcupadas = false;
                    for ($j = 0; $j < $longitudBarco; $j++) {
                        if ($orientacion == "horizontal" && isset($mapa[$x][$y + $j])) {
                            $casillasOcupadas = true;
                            break;
                        } elseif ($orientacion == "vertical" && isset($mapa[$x + $j][$y])) {
                            $casillasOcupadas = true;
                            break;
                        }
                    }

                    // Si no hay colisiones, asigna las coordenadas al barco y marca las casillas como ocupadas
                    if (!$casillasOcupadas) {
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
