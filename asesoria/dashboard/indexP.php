
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
    <h1>Asesorias disponibles</h1>
   
        
    
 <?php
include_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$PersonaID = $_SESSION["PersonaID"];

// asesorias disponibles
$consulta = "
SELECT ad.AsesoriaDatoID, concat_ws(' ', p.Nombre, p.Apellido) as Asesor,m.Nombre as Materia,d.Nombre as Departamento,s.Nombre as Aula,Fecha ,concat_ws(' - ', HoraInicio, HoraFin) as Horario
FROM AsesoriaDatos ad
inner JOIN Personas p on ad.AsesorID = p.PersonaID
inner JOIN Materias m on ad.MateriaID = m.MateriaID
inner JOIN Salones s on ad.SalonID = s.SalonID
inner JOIN Departamentos d on d.DepartamentoID = s.DepartamentoID";
 
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
                        <table id="tablaPersonas3" class="table table-striped table-bordered table-condensed" style="width:100%;text-align: center;">
                        <thead class="text-center">
                            <tr>
                                <th>ID</th>
                                <th>Asesor</th>
                                <th>Materia</th>
                                <th>Departamento</th>
                                <th>Aula</th>                                
                                <th>Fecha</th>  
                                <th>Horario</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['AsesoriaDatoID'] ?></td>
                                <td><?php echo $dat['Asesor'] ?></td>
                                <td><?php echo $dat['Materia'] ?></td>
                                <td><?php echo $dat['Departamento'] ?></td>
                                <td><?php echo $dat['Aula'] ?></td>
                                <td><?php echo $dat['Fecha'] ?></td>    
                                <td><?php echo $dat['Horario'] ?></td>    
                               
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