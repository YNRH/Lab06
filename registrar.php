<?php
//print_r($_POST);
if (empty($_POST["oculto"]) || empty($_POST["txtNombres"]) || empty($_POST["txtApellidos"]) || empty($_POST["txtCorreo"]) || empty($_POST["txtGenero"])) {
    header('Location: index.php?mensaje=falta');
    exit();
}

include_once 'model/conexion.php';
$nombres = $_POST["txtNombres"];
$apellidos = $_POST["txtApellidos"];
$correo = $_POST["txtCorreo"];
$genero = $_POST["txtGenero"];

$foto = $_FILES['foto']['name'];
$temporal = $_FILES['foto']['tmp_name'];

$sentencia = $bd->prepare("INSERT INTO alumno(nombres,apellidos,correo,genero, foto) VALUES (?,?,?,?,?);");
$resultado = $sentencia->execute([$nombres, $apellidos, $correo, $genero, $foto]);

if ($resultado === TRUE) {
    move_uploaded_file($temporal,'./img/'.$foto);
    header('Location: index.php?mensaje=registrado');
} else {
    header('Location: index.php?mensaje=error');
    exit();
}
