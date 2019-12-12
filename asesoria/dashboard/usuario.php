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
    <h1>Perfil</h1>
   
     
    
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
$conexion=null;



?>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

<div class="container">
  	<hr>
	<div class="row">
      <!-- left column -->
      <div class="col-md-3">
        <div class="text-center">
          <img src="img/user.png" class="avatar img-circle" alt="avatar">
          <h6>Cambiar foto...</h6>
          
          <input type="file" class="form-control">
        </div>
      </div>
      
      <!-- edit form column -->
      <div class="col-md-9 personal-info">
        <!-- <div class="alert alert-info alert-dismissable">
          <a class="panel-close close" data-dismiss="alert">×</a> 
          <i class="fa fa-coffee"></i>
          This is an <strong>.alert</strong>. Use this to show important messages to the user.
        </div> -->
        <h3 class="">Informacion personal</h3>
        <p></p>
        <div class="text-center text-sm-left">
            <span class="col-lg-3">Tipo: </span>
            <span class="badge badge-primary"><?php echo $tipo;?></span>
        </div>
        
        <form class="login-form validate-form"  id="formPass" action="" method="post"">
          <div class="form-group">
            <label class="col-lg-3 control-label">Nombre:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" readonly value="<?php echo $nombre;?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Apellido:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" readonly value="<?php echo $apellido;?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Telefono:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" readonly value="<?php echo $telefono;?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Correo:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" readonly value="<?php echo $correo;?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $depaCarrNombre;?></label>
            <div class="col-lg-8">
              <input class="form-control" type="text" readonly value="<?php echo $depaCarr;?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $noContRfcNombre;?></label>
            <div class="col-lg-8">
              <input class="form-control" type="text" readonly value="<?php echo $noContRfc;?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Usuario:</label>
            <div class="col-md-8">
              <input class="form-control" type="text" readonly value="<?php echo $usuario;?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label" >Contraseña:</label>
            <div class="col-md-8">
              <input class="form-control" type="password" id="pass" value="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Confirmar contraseña:</label>
            <div class="col-md-8">
              <input class="form-control" type="password" id="passConfirm" value="">
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <!-- <input type="submit" class="btn btn-primary btnGuardar"  value="Guardar Cambios"> -->
              <button type="submit" name="submit" class="btn btn-primary btnGuardar">Guardar Cambios</button>
              <span></span>
              <input type="reset" class="btn btn-default" value="Cancelar">
            </div>
          </div>
        </form>
      </div>
  </div>
</div>
<hr> 
    
    
</div>
<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"?>