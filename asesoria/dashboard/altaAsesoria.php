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
    <h1>Nueva Asesoria</h1>
   
     
    
 <?php
include_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$PersonaID = $_SESSION["PersonaID"];

$consultaA = "
SELECT Usuario,Contraseña,p.Nombre,Apellido,Edad,Sexo,Correo,Telefono,NoControl,c.Nombre as Carrera FROM Usuarios u 
inner JOIN Personas p on u.UsuarioID = p.UsuarioID
inner JOIN Alumnos a on p.PersonaID = a.PersonaID
inner JOIN Carreras c on c.CarreraID = a.CarreraID
WHERE p.PersonaID = '$PersonaID'";

$consultaP = "
SELECT Usuario,Contraseña,p.Nombre,Apellido,Edad,Sexo,Correo,Telefono,Rfc,d.Nombre as Departamento FROM Usuarios u 
inner JOIN Personas p on u.UsuarioID = p.UsuarioID
inner JOIN Profesores a on p.PersonaID = a.PersonaID
inner JOIN Departamentos d on d.DepartamentoID = a.DepartamentoID
WHERE p.PersonaID = '$PersonaID' ";


$resultado = $conexion->prepare($consultaA);
$resultado->execute();

$resultado1 = $conexion->prepare($consultaP);
$resultado1->execute();
// 1-profesor, 2-alumno
$tipo = "";
$nombre="1";
$apellido="";
$telefono="";
$correo="";
$usuario="";
$contraseña="";
$depaCarrNombre="";
$depaCarr="";
$noContRfcNombre="";
$noContRfc="";


if($resultado->rowCount() >= 1){
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    foreach ($data as $row) {
        $nombre=$row["Nombre"];
        $apellido=$row["Apellido"];
        $telefono=$row["Telefono"];
        $correo=$row["Correo"];
        $usuario=$row["Usuario"];
        $contraseña=$row["Contraseña"];
        $depaCarr=$row["Carrera"];
        $noContRfc=$row["NoControl"];
     }
    // $_SESSION["tipo"] = "Alumno";
    $_SESSION["nombre"] = $nombre;
    $_SESSION["apellido"] = $apellido;
    $_SESSION["telefono"] = $telefono;
    $_SESSION["correo"] = $correo;
    $_SESSION["usuario"] = $usuario;
    $_SESSION["pass"] = $contraseña;
    $depaCarrNombre="Carrera:";
    $noContRfcNombre="No. Control:";
   $tipo = "Alumno";

}else if($resultado1->rowCount() >= 1){
    $data = $resultado1->fetchAll(PDO::FETCH_ASSOC);
    foreach ($data as $row) {
        $nombre=$row["Nombre"];
        $apellido=$row["Apellido"];
        $telefono=$row["Telefono"];
        $correo=$row["Correo"];
        $usuario=$row["Usuario"];
        $contraseña=$row["Contraseña"];
        $depaCarr=$row["Departamento"];
        $noContRfc=$row["Rfc"];
     }
    $_SESSION["nombre"] = $nombre;
    $_SESSION["apellido"] = $apellido;
    $_SESSION["telefono"] = $telefono;
    $_SESSION["correo"] = $correo;
    $_SESSION["usuario"] = $usuario;
    $_SESSION["pass"] = $contraseña;
    // $_SESSION["tipo"] = "Profesor";
    $depaCarrNombre="Departamento:";
    $noContRfcNombre="RFC:";
    $tipo = "Profesor";
    
}
// print json_encode($data);

$consultaD = "
SELECT m.MateriaID,m.Nombre FROM Materias m 
inner JOIN Carreras c on m.CarreraID = c.CarreraID
inner JOIN Departamentos d on c.DepartamentoID = d.DepartamentoID
WHERE d.Nombre = '$depaCarr' ";

$consultaS = "
SELECT s.SalonID,s.Nombre from Salones s
inner JOIN Departamentos d on s.DepartamentoID = d.DepartamentoID
WHERE d.Nombre = '$depaCarr' ";

$resultado2 = $conexion->prepare($consultaD);
$resultado2->execute();
$data2 = $resultado2->fetchAll(PDO::FETCH_ASSOC);

$resultado3 = $conexion->prepare($consultaS);
$resultado3->execute();
$data3 = $resultado3->fetchAll(PDO::FETCH_ASSOC);


$conexion=null;


?>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

<form class="validate-form"  id="formAlta" action="" method="post"">
<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <!-- <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nueva</button>     -->
            </div>    
        </div>    
    </div>    
    <br>  
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="asesor">Asesor</label>
      <input type="text" class="form-control" id="asesor" readonly value="<?php echo $nombre;?> <?php echo $apellido;?>">
      <input type="text" class="form-control" id="asesorID"  hidden readonly value="<?php echo $PersonaID;?>">
    </div>
    <div class="form-group col-md-6">
      <label for="departamento">Departamento</label>
      <input type="text" class="form-control" id="departamento" readonly value="<?php echo $depaCarr;?>">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-4">
        <label for="materia">Materia</label>
        <select id="materia" class="form-control">
            <option selected>Seleccione la materia...</option>
                <?php foreach ($data2 as $row): ?>
                    <option><?=$row["MateriaID"]," - ",$row["Nombre"]?></option>
                <?php endforeach ?>
        </select>
    </div>
    <div class="form-group col-md-4">
        <label for="salon">Salon</label>
        <select id="salon" class="form-control">
            <option selected>Seleccione el aula...</option>
                <?php foreach ($data3 as $row): ?>
                    <option><?=$row["SalonID"]," - ",$row["Nombre"]?></option>
                <?php endforeach ?>
        </select>
    </div>
    <div class="form-group col-md-4">
      <label for="fecha">Fecha</label>
      <input id="fecha"/>
    <script>
        $('#fecha').datepicker({
          format: 'yyyy-mm-dd' ,
            uiLibrary: 'bootstrap4'
        });
    </script>

    </div>
  </div>
  <!-- <div class="form-group">
    <label for="inputAddress">Materia</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
  </div>
  <div class="form-group">
    <label for="inputAddress2">Salon</label>
    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
  </div> -->
  <div class="form-row">
  
    <div class="form-group col-md-2">
      <label for="horai">Hora-inicio</label>
      <input id="horai" width="150" />
    <script>
        $('#horai').timepicker();
    </script>
    </div>

    <div class="form-group col-md-2">
      <label for="horaf">Hora-fin</label>
      <input id="horaf" width="150" />
    <script>
        $('#horaf').timepicker();
    </script>
    </div>
    
  </div>
  <div class="col text-center">
  <button type="submit" name="submit" class=" mt-5 btn btn-primary btnAlta">Dar de alta</button>
  </div>
  
</form>
</div>
<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"?>