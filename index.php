<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <title>Tutorias UNSAAC</title>
    <link rel="stylesheet" href="./css/index.css" ></link>
</head>
<body>
    <div class="container">
        <div class="row">
            <h3 class="pb-3 pt-5">Agregar Archivos</h3>
            <div class="col-12 pb-3">
                <div class="mb-3">
                    <form action="index.php" method="post" enctype="multipart/form-data">
                            <label for="formFile" class="form-label">Alumnos Matriculados 2022 (.csv)</label>
                            <input class="form-control mb-3" name="archivo" type="file" id="formFile">
                            <label for="formFile" class="form-label">Docentes Inscritos (.csv)</label>
                            <input class="form-control mb-3" name="archivo1" type="file" id="formFile">
                            <label for="formFile" class="form-label">Distribución Distribución Tutor-Tutorado en 2021-1 (.csv)</label>
                            <input class="form-control mb-3" name="archivo2" type="file" id="formFile">
                            <input type="submit" class="button" value="Distribuir">
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6 p-3">
                <h3 class="pb-3">Tablas</h3>
                <ul class="nav nav-tabs pb-3">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#DxD">Matriculados 2022</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#Docentes">Docentes 2022</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#DA">Distribución Anterior</a>
                    </li>
                </ul>
                <div class="tab-content p-3">
                    <div class="tab-pane container" id="DxD">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Numero</th>
                                <th>Codigo</th>
                                <th>Nombre</th>
                            </tr>
                            </thead>
                            <tbody>
<?php
include 'AllFunctions.php';

if (!isset($_FILES["archivo"])) {
    throw new Exception("Selecciona un archivo CSV válido.");
}
$file = $_FILES["archivo"];
$file1 = $_FILES["archivo1"];
$file2 = $_FILES["archivo2"];
$Mox = new Group73();
$Arreglo_Matriculados = $Mox->csv_Array($file);
$Mox->ImprimirArreglo($Arreglo_Matriculados);
?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane container fade" id="Docentes">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Numero</th>
                                <th>Nombre</th>
                                <th>Categoría</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
if (!isset($_FILES["archivo"])) {
    throw new Exception("Selecciona un archivo CSV válido.");
}
$file = $_FILES["archivo"];
$file1 = $_FILES["archivo1"];
$file2 = $_FILES["archivo2"];

$Mox = new Group73();
$ArregloDocentes = $Mox->csv_Array($file1);
$Arreglo_Dis_Docentes = $Mox->csv_Array($file2);
$Mox->ImprimirArreglo($ArregloDocentes);
?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane container fade" id="DA">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Numero</th>
                                <th>Codigo</th>
                                <th>Nombre</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
$Mox->ImprimirArreglo($Arreglo_Dis_Docentes);
?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-6 text p-3">
                <h3 class="pb-3">Resultados</h3>
                <ul class="nav nav-tabs pb-3">
                    <li class="nav-item">
                        <a class="nav-link " data-bs-toggle="tab" href="#ASM">Alumnos Sin Matricula</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#AST">Alumnos Sin Tutor</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#DF">Distribución Final</a>
                    </li>
                </ul>
                <div class="tab-content p-3">
                    <div class="tab-pane container active" id="ASM">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Numero</th>
                                <th>Codigo</th>
                                <th>Nombre</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
$AlumnosSinMatricula = $Mox->diferenciaAlumnos($Arreglo_Dis_Docentes, $Arreglo_Matriculados);
$Mox->ImprimirArreglo($AlumnosSinMatricula);

?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane container active" id="AST">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Numero</th>
                                <th>Codigo</th>
                                <th>Nombre</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

$arrayDistribucionDiccionario = $Mox->transformarDistribuciónADiccionario($Arreglo_Dis_Docentes);
$arrayDocenteOrdenado = $Mox->ordenarListaDocentes($ArregloDocentes);
$arrayTutoresQueSeMantienen = $Mox->tutoresQueSeMantienen($arrayDocenteOrdenado, $arrayDistribucionDiccionario);
$arrayTutoresNuevos = $Mox->tutoresNuevos($arrayDocenteOrdenado, $arrayTutoresQueSeMantienen);
$arrayTutoresAnteriorDistribucion = $Mox->tutoresAnteriorDistribucion($arrayDistribucionDiccionario);
$arrayTutoresQueDejanElSemestre = $Mox->tutoresQueDejanElSemestre($arrayTutoresAnteriorDistribucion, $arrayTutoresQueSeMantienen);
$arrayAlumnosSinTutor = $Mox->alumnosSinTutor($arrayTutoresQueDejanElSemestre, $arrayDistribucionDiccionario, $Arreglo_Matriculados, $Arreglo_Dis_Docentes);
$Mox->ImprimirArreglo($arrayAlumnosSinTutor);
?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane container fade" id="DF">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Numero</th>
                                <th>Codigo</th>
                                <th>Nombre</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
$arrayAlumnosCachimbosSinTutor = $Mox->alumnosCachimbos($arrayAlumnosSinTutor, "22");
$arrayAlumnosRegularesSinTutor = $Mox->diferenciaAlumnos($arrayAlumnosSinTutor, $arrayAlumnosCachimbosSinTutor);
$arrayQuitantoAlumnosSinTutor = $Mox->diferenciaAlumnos($Arreglo_Dis_Docentes, $arrayAlumnosSinTutor);
$arrayQuitandoAlumnosSinMatricula = $Mox->diferenciaAlumnos($arrayQuitantoAlumnosSinTutor, $AlumnosSinMatricula);
$arrayQuitandoDocentesDejaronSemestre = $Mox->diferenciaDocente($arrayQuitandoAlumnosSinMatricula, $arrayTutoresQueDejanElSemestre);
$arrayDistribucionAlumnosActuales = $Mox->transformarDistribuciónADiccionario($arrayQuitandoDocentesDejaronSemestre);
$arrayAgregaTutorNuevoDiccionario = $Mox->agregarTutorAlDiccionario($arrayDistribucionAlumnosActuales, $arrayTutoresNuevos);
$arrayDiccionarioOrdenado = $Mox->ordenarDiccionarioDistribucion($arrayAgregaTutorNuevoDiccionario, $arrayDocenteOrdenado);
$cantidadTutorAlumnos = $Mox->cantidadAlumnosTutor($Arreglo_Matriculados, $arrayDocenteOrdenado);
$array = $Mox->distribuirTutoresTutorados($arrayAlumnosCachimbosSinTutor, $arrayAlumnosRegularesSinTutor, $arrayDiccionarioOrdenado, $cantidadTutorAlumnos);
$Mox->ImprimirDiccionario($array);
?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>