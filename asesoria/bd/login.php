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

$consulta = "SELECT u.UsuarioID,u.Usuario,u.Contraseña,p.PersonaID,concat_ws(' ', Nombre, Apellido) as Nombre from Usuarios u
inner join Personas p on p.UsuarioID = u.UsuarioID
WHERE Usuario = '$usuario' AND Contraseña = '$pass' ";
$resultado = $conexion->prepare($consulta);
$resultado->execute();

$nombre = "";

if($resultado->rowCount() >= 1){
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    // $nombre = $row["Nombre"];
    foreach ($data as $row) {
        $nombre=$row["Nombre"];
        $id=$row["PersonaID"];
     }
    $_SESSION["s_usuario"] = $nombre;
    $_SESSION["PersonaID"] = $id;

    // $.ajax({
    //     url:"dashboard/bd/crud.php",
    //     type:"POST",
    //     datatype: "json",
    //     data: {id:$usuario}
    //     }    
    //  });

}else{
    $_SESSION["s_usuario"] = null;
    $data=null;
}

print json_encode($data);
$conexion=null;

//usuarios de pruebaen la base de datos
//usuario:admin pass:12345
//usuario:demo pass:demo