<?php
session_start();
$tipo = $_SESSION["tipo"];
if ($tipo == "Alumno"){
    require_once "vistas/parte_superior.php"; 
}

if ($tipo == "Profesor") {
    require_once "vistas/parte_superiorP.php";
}
?>

<!--INICIO del cont principal-->
<div class="container">
    <h1>Mis asesorias</h1>
   
        
    
 <?php
include_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$PersonaID = $_SESSION["PersonaID"];

// asesorias que esta llevando el estudiante
$consulta = "
SELECT a.AsesoriaAltaID, Asesor,Materia,Aula,Fecha,Horario
FROM vasesorias v 
inner JOIN AsesoriaAltas a on v.AsesoriaDatoID = a.AsesoriaDatoID
WHERE a.Asesorado = '$PersonaID'";




$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" type="image/x-icon" href="../faviconTec.ico">

<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <!-- <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nueva</button>     -->
            </div>    
        </div>    
    </div>    
    <br>  
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaPersonas1" class="table table-striped table-bordered table-condensed" style="width:100%;text-align: center;">
                        <thead class="text-center">
                            <tr>
                                <th>ID</th>
                                <th>Asesor</th>
                                <th>Materia</th>
                                <th>Aula</th>                                
                                <th>Fecha</th>  
                                <th>Horario</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['AsesoriaAltaID'] ?></td>
                                <td><?php echo $dat['Asesor'] ?></td>
                                <td><?php echo $dat['Materia'] ?></td>
                                <td><?php echo $dat['Aula'] ?></td>
                                <td><?php echo $dat['Fecha'] ?></td>    
                                <td><?php echo $dat['Horario'] ?></td>    
                                <td></td>
                                
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>                    
                    </div>
                </div>
        </div>  
    </div>    
          
    
</div>
<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"?>