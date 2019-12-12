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
    <h1>Alumnos inscritos</h1>
   
        
    
 <?php
include_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// $id = (isset($_POST['id'])) ? $_POST['id'] : '';
$PersonaID = $_SESSION["PersonaID"];
$id = $_COOKIE["id"];

// asesorias que esta llevando el estudiante
$consulta = "
SELECT concat_ws(' ', p.Nombre, p.Apellido) as Nombre,p.Edad,p.Sexo,p.Correo,p.Telefono,a.NoControl,c.Nombre as Carrera FROM AsesoriaAltas aa
inner JOIN Personas p on aa.Asesorado = p.PersonaID
inner JOIN Alumnos a on p.PersonaID = a.PersonaID
inner join AsesoriaDatos ad on aa.AsesoriaDatoID = ad.AsesoriaDatoID
inner JOIN Carreras c on c.CarreraID = a.CarreraID
WHERE ad.AsesoriaDatoID = '$id'";



$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

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
                                <th>Nombre</th>
                                <th>Edad</th>
                                <th>Sexo</th>
                                <th>Correo</th>                                
                                <th>Telefono</th>  
                                <th>No.Control</th>
                                <th>Carrera</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['Nombre'] ?></td>
                                <td><?php echo $dat['Edad'] ?></td>
                                <td><?php echo $dat['Sexo'] ?></td>
                                <td><?php echo $dat['Correo'] ?></td>
                                <td><?php echo $dat['Telefono'] ?></td>
                                <td><?php echo $dat['NoControl'] ?></td>    
                                <td><?php echo $dat['Carrera'] ?></td>    
                
                                
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