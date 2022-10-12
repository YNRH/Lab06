<?php include 'template/header.php' ?>

<?php
    if(!isset($_GET['codigo'])){
        header('Location: index.php?mensaje=error');
        exit();
    }

    include_once 'model/conexion.php';
    $codigo = $_GET['codigo'];

    $sentencia = $bd->prepare("select * from alumno where id = ?;");
    $sentencia->execute([$codigo]);
    $alumno = $sentencia->fetch(PDO::FETCH_OBJ);
    //print_r($alumno);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Editar datos:
                </div>
                <form class="p-4" method="POST" action="editarProceso.php">
                    <div class="mb-3">
                        <label class="form-label">Nombres: </label>
                        <input type="text" class="form-control" name="txtNombres" required 
                        value="<?php echo $alumno->nombres; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Apellidos: </label>
                        <input type="text" class="form-control" name="txtApellidos" autofocus required
                        value="<?php echo $alumno->apellidos; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Correo: </label>
                        <input type="email" class="form-control" name="txtCorreo" autofocus required
                        value="<?php echo $alumno->correo; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Genero: </label>
                        <input type="radio" class="form-check-input" name="txtGenero" id="male" value="Masculino" autofocus required>
                        <label for="male" class="form-input-label">Masculino</label>
                        &nbsp;
                        <input type="radio" class="form-check-input" name="txtGenero" id="female" value="Femenino" autofocus required>
                        <label for="female" class="form-input-label">Femenino</label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Foto: </label>
                        <input type="file" class="form-control" name="foto" id="foto" placeholder="add file" autofocus required>
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="codigo" value="<?php echo $alumno->id; ?>">
                        <input type="submit" class="btn btn-primary" value="Editar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'template/footer.php' ?>