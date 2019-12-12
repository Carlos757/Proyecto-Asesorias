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
$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$PersonaID = $_SESSION["PersonaID"];
$pass = (isset($_POST['pass'])) ? $_POST['pass'] : '';


$asesorID = (isset($_POST['asesorID'])) ? $_POST['asesorID'] : '';
$materia = (isset($_POST['materia'])) ? $_POST['materia'] : '';
$salon = (isset($_POST['salon'])) ? $_POST['salon'] : '';
$fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : '';
$horai = (isset($_POST['horai'])) ? $_POST['horai'] : '';
$horaf = (isset($_POST['horaf'])) ? $_POST['horaf'] : '';
 
$cerrar = (isset($_POST['cerrar'])) ? $_POST['cerrar'] : '';  

switch($opcion){
    case 1: //alta de asesoria(profesor)
        $consulta = "
        INSERT INTO AsesoriaDatos(AsesoriaDatoID, AsesorID, MateriaID, SalonID, Fecha, HoraInicio, HoraFin) 
        VALUES (NULL, '$asesorID', '$materia', '$salon', '$fecha', '$horai', '$horaf'); ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        // $consulta = "SELECT id, nombre, pais, edad FROM personas ORDER BY id DESC LIMIT 1";
        // $resultado = $conexion->prepare($consulta);
        // $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación de contraseña
        $consulta = "
            UPDATE Usuarios u 
            inner JOIN Personas p on p.UsuarioID = u.UsuarioID
            SET Contraseña = '$pass'
            WHERE p.PersonaID = '$PersonaID' ";
                    
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
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);                    
        break;

    case 4: //alta en asesoria(alumno)
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
    case 5://cerrar materia
            $consulta1 = " DELETE FROM AsesoriaAltas WHERE AsesoriaDatoID = $cerrar ";	
            $consulta2 = " DELETE FROM AsesoriaDatos WHERE AsesoriaDatoID = $cerrar ";	
            
            $resultado1 = $conexion->prepare($consulta1);
            $resultado1->execute(); 

            $resultado2 = $conexion->prepare($consulta2);
            $resultado2->execute();      
            $data=$resultado2->fetchAll(PDO::FETCH_ASSOC);                     
            break;
         
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
