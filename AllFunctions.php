<?php
class Group73
{
    public function csv_Array($file)
    {
        $tmp = $file["tmp_name"];
        $size = $file["size"];
        echo 'console.log(' . json_encode($size) . ')';
        if ($size < 0) {
            throw new Exception("Selecciona un archivo válido por favor.");
        }
        $fila = 0;
        if (($gestor = fopen($tmp, "r")) !== false) {
            while (($datos = fgetcsv($gestor, 1000, ",")) !== false) {
                $val_doc = substr($datos[0], 0, 7);
                if (strlen($datos[1]) > 1 and (strtolower($datos[0]) != "codigo"
                    and strtolower($datos[1]) != "codigo" and $datos[0] != "Nuevo Tutorado")) {
                    if (strlen($datos[0]) >= 4) {
                        $Arreglo[$fila][0] = $datos[0];
                        $Arreglo[$fila][1] = $datos[1];
                    } else {
                        $Arreglo[$fila][0] = $datos[1];
                        $Arreglo[$fila][1] = $datos[2];
                    }
                    $fila++;
                }
            }
            fclose($gestor);
        }

        return $Arreglo;
    }
    public function Imprimir($Array)
    {
        if (!empty($Array)) {
            $Pos = 0;
            for ($row = 0; $row < count($Array); $row++) {
                $Pos++;
                echo '<tr><th>' . $Pos . '</th><th>' . $Array[$row][0] . '</th><th>' . $Array[$row][1] . '</th></tr>';
            }
        }
    }
    public function diferencia($ArrA, $ArrB)
    {
        $fila = 0;
        $Arreglo = array();
        for ($x = 0; $x < count($ArrA); $x++) {
            $Existe = false;
            for ($y = 0; $y < count($ArrB); $y++) {
                if ($ArrA[$x][0] == $ArrB[$y][0]) {
                    $Existe = true;
                    break;
                }
            }
            if ($Existe == false) {
                $Arreglo[$fila][0] = $ArrA[$x][0];
                $Arreglo[$fila][1] = $ArrA[$x][1];
                $fila++;
            }
        }
        return $Arreglo;
    }

    public function transformarArrayDeDistribuciónTutorTutoradoADiccionario($array, $docente)
    {
        print_r($docente);
        foreach ($array as $valor) {
            $val = substr($valor[0], 0, 7);
            if ($val == 'Docente') {
                $i = 0;
                $nombreDocente = $valor[1];
            } else {
                $Arreglo[$nombreDocente][$i] = $valor;
                $i += 1;
            }
        }
        return $Arreglo;
    }

    public function obtenerAlumnosCachimbos($array, $semestre)
    {
        $i = 0;
        foreach ($array as $key => $valor) {
            $val = substr($valor[0], 0, 2);
            if ($val == $semestre) {
                $Arreglo[$i] = $valor;
                $i += 1;
            }
        }
        return $Arreglo;
    }

    public function cantidadAlumnosTutor($arrayA, $arrayB)
    {
        $j = 0;
        $k = 0;
        for ($i = 0; $i < count($arrayB); $i++) {
            if ($arrayB[$i][1] == "PR-DE") {
                $arrayB_ConCargo[$j][0] = $arrayB[$i][0];
                $arrayB_ConCargo[$j][1] = $arrayB[$i][1];
                $j++;
            } else {
                $arrayB_SinCargo[$k][0] = $arrayB[$i][0];
                $arrayB_SinCargo[$k][1] = $arrayB[$i][1];
                $k++;
            }
        }
        $a = count($arrayA);
        $b = count($arrayB_SinCargo);
        $c = count($arrayB_ConCargo);
        $primeraDistribucion = intdiv($a, ($b + $c));
        $j = 0;
        $k = 0;
        $total = 0;
        if (($a % ($b + $c)) != 0) {
            for ($i = 0; $i < $c; $i++) {
                $arreglo1[$i] = $primeraDistribucion;
                $total += $primeraDistribucion;
            }
            for ($i = 0; $i < $b; $i++) {
                if ((($a - $total) % $primeraDistribucion) != 0) {
                    $arreglo2[$i] = $primeraDistribucion + 1;
                    $total = $total + $primeraDistribucion + 1;
                } else {
                    $arreglo2[$i] = $primeraDistribucion;
                    $total = $total + $primeraDistribucion;
                }
            }
            if ($total != $a) {
                while ($k < count($arreglo2)) {
                    if ($total != $a) {
                        if ($arreglo2[$k] != $primeraDistribucion + 1) {
                            $arreglo2[$k] += 1;
                            $total += 1;
                        }
                        $k++;
                    } else {
                        $k = count($arreglo2);
                    }
                }
            }
            if ($total != $a) {
                while ($j < count($arreglo1)) {
                    if ($total != $a and $arreglo1[$j]) {
                        $arreglo1[$j] += 1;
                        $total += 1;
                        $j++;
                    } else {
                        $j = count($arreglo1);
                    }
                }
            }
        } else {
            for ($i = 0; $i < $c; $i++) {
                $arreglo1[$i] = $primeraDistribucion;
            }
            for ($i = 0; $i < $b; $i++) {
                $arreglo2[$i] = $primeraDistribucion;
            }
        }
        shuffle($arreglo1);
        shuffle($arreglo2);
        $distribucionBalanceada = array_merge($arreglo2, $arreglo1);
        return $distribucionBalanceada;
    }

    public function diferencia1($ArrA, $ArrB)
    {
        $fila = 0;
        $Arreglo = array();
        for ($x = 0; $x < count($ArrB); $x++) {
            echo $ArrB[$x][0];            
        }
        return $Arreglo;
    }

}
