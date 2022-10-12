<?php
    print_r($_POST);
    if(!isset($_POST['codigo'])){
        header('Location: index.php?mensaje=error');
    }

    include 'model/conexion.php';
    $codigo = $_POST['codigo'];
    $nombres = $_POST['txtNombres'];
    $apellidos = $_POST['txtApellidos'];
    $correo = $_POST['txtCorreo'];
    $genero = $_POST['txtGenero'];

    $foto = $_FILES['foto']['name'];
    $temporal = $_FILES['foto']['tmp_name'];

    $sentencia = $bd->prepare("UPDATE alumno SET nombres = ?, apellidos = ?, correo = ?,genero = ?, foto=? where id = ?;");
    $resultado = $sentencia->execute([$nombres, $apellidos, $correo, $genero,$codigo,$foto]);

    if ($resultado === TRUE) {
        move_uploaded_file($temporal,'./img/'.$foto);
        header('Location: index.php?mensaje=editado');
    } else {
        header('Location: index.php?mensaje=error');
        exit();
    }
