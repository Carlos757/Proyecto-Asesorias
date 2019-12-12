<?php
session_start();


include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

//recepción de datos enviados mediante POST desde ajax
$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$password = (isset($_POST['password'])) ? $_POST['password'] : '';

// $pass = md5($password); //encripto la clave enviada por el usuario para compararla con la clava encriptada y almacenada en la BD
$pass = $password;

$consulta = "
SELECT u.UsuarioID,u.Usuario,u.Contraseña,p.PersonaID,concat_ws(' ', Nombre, Apellido) as Nombre from Usuarios u
inner join Personas p on p.UsuarioID = u.UsuarioID
inner JOIN Alumnos a on p.PersonaID = a.PersonaID
WHERE Usuario = '$usuario' AND Contraseña = '$pass' ";
$resultado = $conexion->prepare($consulta);
$resultado->execute();

$consulta1 = "
SELECT u.UsuarioID,u.Usuario,u.Contraseña,p.PersonaID,concat_ws(' ', Nombre, Apellido) as Nombre from Usuarios u
inner join Personas p on p.UsuarioID = u.UsuarioID
inner JOIN Profesores a on p.PersonaID = a.PersonaID
WHERE Usuario = '$usuario' AND Contraseña = '$pass' ";
$resultado1 = $conexion->prepare($consulta1);
$resultado1->execute();

$nombre = "";
// $tipo = "";

if($resultado->rowCount() >= 1){
    $_SESSION["tipo"] = "Alumno";
    echo '<script>var tipoDato = '.json_encode($_SESSION["tipo"]).';</script>'; 
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    // $nombre = $row["Nombre"];
    foreach ($data as $row) {
        $nombre=$row["Nombre"];
        $id=$row["PersonaID"];
     }
    $_SESSION["s_usuario"] = $nombre;
    $_SESSION["PersonaID"] = $id;


}else if($resultado1->rowCount() >= 1){
    $_SESSION["tipo"] = "Profesor";
    echo '<script>var tipoDato = '.json_encode($_SESSION["tipo"]).';</script>'; 
    $data = $resultado1->fetchAll(PDO::FETCH_ASSOC);
    // $nombre = $row["Nombre"];
    foreach ($data as $row) {
        $nombre=$row["Nombre"];
        $id=$row["PersonaID"];
     }
    $_SESSION["s_usuario"] = $nombre;
    $_SESSION["PersonaID"] = $id;

}else{
    $_SESSION["s_usuario"] = null;
    $data=null;
}

print json_encode($data);
$conexion=null;



