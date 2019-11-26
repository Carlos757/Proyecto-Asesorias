<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();
// Recepción de los datos enviados mediante POST desde el JS   

$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$pais = (isset($_POST['pais'])) ? $_POST['pais'] : '';
$edad = (isset($_POST['edad'])) ? $_POST['edad'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$AsesoriaDatoID = (isset($_POST['AsesoriaDatoID'])) ? $_POST['AsesoriaDatoID'] : '';
$AsesoriaAltaID = (isset($_POST['AsesoriaAltaID'])) ? $_POST['AsesoriaAltaID'] : '';
$PersonaID = $_SESSION["PersonaID"];

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO personas (nombre, pais, edad) VALUES('$nombre', '$pais', '$edad') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT id, nombre, pais, edad FROM personas ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE personas SET nombre='$nombre', pais='$pais', edad='$edad' WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT id, nombre, pais, edad FROM personas WHERE id='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM AsesoriaAltas WHERE AsesoriaAltaID = $AsesoriaAltaID ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;
    case 4: //alta en asesoria
            // $consulta = "INSERT INTO personas (nombre, pais, edad) VALUES('$nombre', '$pais', '$edad') ";			
            $consulta = "INSERT INTO AsesoriaAltas(AsesoriaAltaID, AsesoriaDatoID, Asesorado) VALUES (NULL, '$AsesoriaDatoID', '$PersonaID');";			
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $consulta = "   SELECT ad.AsesoriaDatoID,concat_ws(' ', p.Nombre, p.Apellido) as Asesor, m.Nombre as Materia, s.Nombre as Aula, Fecha ,concat_ws(' - ', HoraInicio, HoraFin) as Horario
                FROM AsesoriaDatos ad
                inner JOIN Personas p on ad.AsesorID = p.PersonaID
                inner JOIN Materias m on ad.MateriaID = m.MateriaID
                inner JOIN Salones s on ad.SalonID = s.SalonID";
            
           
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
