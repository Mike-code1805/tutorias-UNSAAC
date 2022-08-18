<?php
class Group73
{
    public function csv_Array($file)
    {
        $tmp = $file["tmp_name"];
        $size = $file["size"];
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
    public function ImprimirArreglo($Array)
    {
        if (!empty($Array)) {
            $Pos = 0;
            for ($row = 0; $row < count($Array); $row++) {
                $Pos++;
                echo '<tr><th>' . $Pos . '</th><th>' . $Array[$row][0] . '</th><th>' . $Array[$row][1] . '</th></tr>';
            }
        }
    }

    public function ImprimirDiccionario($Array)
    {
        if (!empty($Array)) {
            $PosDocente = 0;

            foreach ($Array as $docente => $alumnos) {
                $PosDocente++;
                $PosAlumno = 0;
                echo '<tr><th>' . $PosDocente . '</th><th>' . 'Docente' . '</th><th>' . $docente . '</th></tr>';
                for ($i = 0; $i < count($alumnos); $i++) {
                    $PosAlumno++;
                    echo '<tr><th>' . $PosAlumno . '</th><th>' . $alumnos[$i][0] . '</th><th>' . $alumnos[$i][1] . '</th></tr>';
                }
            }
        }
    }

    public function diferenciaAlumnos($ArrA, $ArrB)
    {
        $fila = 0;
        $Arreglo = array();
        for ($x = 0; $x < count($ArrA); $x++) {
            $Existe = false;
            $val = substr($ArrA[$x][0], 0, 7);
            for ($y = 0; $y < count($ArrB); $y++) {
                if ($ArrA[$x][0] == $ArrB[$y][0] and $val != "Docente") {
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
    public function diferenciaDocente($ArrA, $ArrB)
    {
        $fila = 0;
        $Arreglo = array();
        for ($x = 0; $x < count($ArrA); $x++) {
            $Existe = false;
            for ($y = 0; $y < count($ArrB); $y++) {
                $val = substr($ArrA[$x][0], 0, 7);
                if ($val == "Docente" and $ArrA[$x][1] == $ArrB[$y][1]) {
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

    public function ordenarListaDocentes($ListaDocente)
    {
        $array_docente = array();
        $docente_array = array();
        $j = 0;
        for ($i = 0; $i < count($ListaDocente); $i++) {
            if ($ListaDocente[$i][1] == "PR-DE") {
                $array_docente[$j][0] = $ListaDocente[$i][0];
                $array_docente[$j][1] = $ListaDocente[$i][1];
                $j++;
            }
        }
        for ($i = 0; $i < count($ListaDocente); $i++) {
            if ($ListaDocente[$i][1] != "PR-DE") {
                $array_docente[$j][0] = $ListaDocente[$i][0];
                $array_docente[$j][1] = $ListaDocente[$i][1];
                $j++;
            }
        }
        $docente_array = array_reverse($array_docente);
        return $docente_array;
    }

    public function transformarDistribuciónADiccionario($Distribucion)
    {
        $Arreglo = array();
        foreach ($Distribucion as $valor) {
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

    public function tutoresQueSeMantienen($docente_array, $DistribucionDiccionario)
    {
        $tutoresQueSeMantienen = array();
        $i = 0;
        $k = 0;
        foreach ($docente_array as $valor) {
            $val_doc_distri = substr($valor[0], 0, 12);
            foreach ($DistribucionDiccionario as $doc => $alumno) {
                $val_doc_array = substr($doc, 0, 12);
                if ($val_doc_distri == $val_doc_array) {
                    $tutoresQueSeMantienen[$i][0] = $valor[0];
                    $tutoresQueSeMantienen[$i][1] = $valor[1];
                    $i++;
                }
            }
        }
        return $tutoresQueSeMantienen;
    }
    public function tutoresNuevos($docente_array, $tutoresQueSeMantienen)
    {
        $tutoresNuevos = array();
        $fila = 0;
        for ($x = 0; $x < count($docente_array); $x++) {
            $Existe = false;
            $val_doc_ante_distri = substr($docente_array[$x][0], 0, 12);
            for ($y = 0; $y < count($tutoresQueSeMantienen); $y++) {
                $val_doc_mantiene = substr($tutoresQueSeMantienen[$y][0], 0, 12);
                if ($val_doc_ante_distri == $val_doc_mantiene) {
                    $Existe = true;
                    break;
                }
            }
            if ($Existe == false) {
                $tutoresNuevos[$fila][0] = $docente_array[$x][0];
                $tutoresNuevos[$fila][1] = $docente_array[$x][1];
                $fila++;
            }
        }
        return $tutoresNuevos;
    }

    public function tutoresAnteriorDistribucion($DistribucionDiccionario)
    {
        $tutoresAnteriorDistribucion = array();
        $j = 0;
        foreach ($DistribucionDiccionario as $doc => $alumno) {
            $tutoresAnteriorDistribucion[$j][0] = $doc;
            $j++;
        }
        return $tutoresAnteriorDistribucion;
    }

    public function tutoresQueDejanElSemestre($tutoresAnteriorDistribucion, $tutoresQueSeMantienen)
    {
        $tutoresQueDejanElSemestre = array();
        $fila = 0;
        for ($x = 0; $x < count($tutoresAnteriorDistribucion); $x++) {
            $Existe = false;
            $val_doc_ante_distri = substr($tutoresAnteriorDistribucion[$x][0], 0, 12);
            for ($y = 0; $y < count($tutoresQueSeMantienen); $y++) {
                $val_doc_mantiene = substr($tutoresQueSeMantienen[$y][0], 0, 12);
                if ($val_doc_ante_distri == $val_doc_mantiene) {
                    $Existe = true;
                    break;
                }
            }
            if ($Existe == false) {
                $tutoresQueDejanElSemestre[$fila][0] = $tutoresAnteriorDistribucion[$x][0];
                $tutoresQueDejanElSemestre[$fila][1] = $tutoresAnteriorDistribucion[$x][0];
                $fila++;
            }
        }
        return $tutoresQueDejanElSemestre;
    }

    public function alumnosSinTutor($tutoresQueDejanElSemestre, $DistribucionDiccionario, $alumnos, $Distribucion)
    {
        $alumnosSinTutor = array();
        $fila = 0;
        for ($x = 0; $x < count($alumnos); $x++) {
            $Existe = false;
            for ($y = 0; $y < count($Distribucion); $y++) {
                if ($alumnos[$x][0] == $Distribucion[$y][0]) {
                    $Existe = true;
                    break;
                }
            }
            if ($Existe == false) {
                $alumnosSinTutor[$fila][0] = $alumnos[$x][0];
                $alumnosSinTutor[$fila][1] = $alumnos[$x][1];
                $fila++;
            }
        }
        if (count($tutoresQueDejanElSemestre) > 0) {
            foreach ($tutoresQueDejanElSemestre as $doc) {
                foreach ($DistribucionDiccionario as $docen => $alum) {
                    if ($doc[0] == $docen) {
                        for ($y = 0; $y < count($DistribucionDiccionario[$docen]); $y++) {
                            foreach ($alumnos as $alumno) {
                                if ($alumno == $alum[$y]) {
                                    $alumnosSinTutor[$fila] = $alum[$y];
                                    $fila++;
                                }
                            }
                        }
                    }
                }
            }
        }
        return $alumnosSinTutor;
    }

    public function alumnosCachimbos($alumnosSinTutor, $semestre)
    {
        $AlumnosCachimbos = array();
        $i = 0;
        foreach ($alumnosSinTutor as $key => $valor) {
            $val = substr($valor[0], 0, 2);
            if ($val == $semestre) {
                $AlumnosCachimbos[$i] = $valor;
                $i += 1;
            }
        }
        return $AlumnosCachimbos;
    }

    public function alumnosRegulares($alumnosSinTutor, $AlumnosCachimbos)
    {
        $alumnosRegulares = array();
        $i = 0;
        foreach ($alumnosSinTutor as $key => $valor) {
            $val = substr($valor[0], 0, 2);
            if ($val == $semestre) {
                $AlumnosCachimbos[$i] = $valor;
                $i += 1;
            }
        }
        return $alumnosRegulares;
    }

    public function agregarTutorAlDiccionario($DistribucionDiccionario, $tutoresNuevos)
    {
        $diccionario = $DistribucionDiccionario;
        foreach ($tutoresNuevos as $valor) {
            $diccionario[$valor[0]] = [];
        }
        return $diccionario;
    }

    public function ordenarDiccionarioDistribucion($DistribucionDiccionario, $docenteOrdenadoArray)
    {
        $nuevoDiccionario = array();
        foreach ($docenteOrdenadoArray as $num => $docente) {
            $val_docente = substr($docente[0], 0, 9);
            foreach ($DistribucionDiccionario as $key => $alumno) {
                $val_docente_dicci = substr($key, 0, 9);
                if ($val_docente == $val_docente_dicci) {
                    $nuevoDiccionario[$key] = $alumno;
                }
            }
        }
        return $nuevoDiccionario;
    }

    public function cantidadAlumnosTutor($arrayA, $arrayB)
    {
        $j = 0;
        $k = 0;
        $arrayB_ConCargo = array();
        $arreglo1 = array();
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
        if (count($arreglo1) != 0) {
            shuffle($arreglo1);
        }
        if (count($arreglo2) != 0) {
            shuffle($arreglo2);
        }
        $distribucionBalanceada = array_merge($arreglo2, $arreglo1);
        return $distribucionBalanceada;
    }

    public function distribuirTutoresTutorados($a, $b, $c, $d)
    {
        $diccionario = $c;
        $i = 0;
        $count = 0;
        foreach ($c as $doc => $valor) {
            if ($d[$i] < count($valor)) {
                echo "Enviar reporte del tutor " . $doc . "-> tiene " . count($valor) - $d[$i] . " alumno(s) de más" . "</br>";
                $d[$i] = count($valor);
                $count++;
            }
            $i++;
        }
        $x = 0;
        $y = 0;
        $k = 0;
        for ($i = 0; $i < count($b); $i++) {
            foreach ($diccionario as $doc => $listAlum) {
                if ($y >= count($diccionario)) {
                    $y = 0;
                }
                if ($k >= count($diccionario)) {
                    $k = 0;
                }
                if ($x < count($b)) {
                    if ($d[$y] != count($listAlum) and $k < count($diccionario)) {
                        $diccionario[$doc][count($listAlum)] = $b[$x];
                        $x++;
                    }
                    $y++;
                    $k++;
                }
            }
        }
        $x = 0;
        $y = 0;
        $k = 0;
        foreach ($diccionario as $doc => $listAlum) {
            $count = count($listAlum);
            for ($i = 0; $i < count($a); $i++) {
                if ($y >= count($diccionario)) {
                    $y = 0;
                }
                if ($k >= count($diccionario)) {
                    $k = 0;
                }
                if ($x < count($a)) {
                    if ($d[$y] != $count) {
                        $diccionario[$doc][$count] = $a[$x];
                        $count++;
                        $x++;
                    }
                    $k++;
                }
            }
            $y++;
        }
        return $diccionario;
    }
}
