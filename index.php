<?php include 'includes/header.php' ?>

<?php
    include_once("database/connection.php");
    $query = new Connection; //SE INTANCIA LA CLASE CONECTION
    //$query-> conectar(); //SE ACCEDE AL METODO DE LA CLASE- CONECTION
    //$query = $mysqli->query("SELECT * FROM empleado");
    //$query = "SELECT * FROM empleado";
    $sentencia = $mysqli->query("select * from empleado");
    $persona = $sentencia->fetchAll(PDO::FETCH_OBJ);//
    //print_r($persona);
?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <!-- inicio alerta -->
            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'falta'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Rellena todos los campos.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?>

            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'registrado'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Registrado!</strong> Se agregaron los datos.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?>   
            
            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'error'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Vuelve a intentar.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?>   

            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'editado'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Cambiado!</strong> Los datos fueron actualizados.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?> 

            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'eliminado'){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Eliminado!</strong> Los datos fueron borrados.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?> 
             <!-- fin alerta -->

            <div class="card">
                <div class="card-header">
                    Lista de empleados
                </div>
                <div class="p-4">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Email</th>
                                <th scope="col">Sexo</th>
                                <th scope="col">Area</th>
                                <th scope="col">Boletin</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php 
                            if ($result = $mysqli->query($query)) {
                            
                            /* fetch associative array */
                            while ($row = $result->fetch_assoc()) {
                            $Nombre = $row["nombre"];
                            $Email = $row["email"];
                            $Sexo = $row["sexo"];
                            $Area = $row["area_id"];
                            $Boletin = $row["boletin"];
                            }
                            /* free result set */
                            $result->free();
                            }
                            ?> 
                            
                            <?php 
                                foreach($persona as $dato){ 
                            ?>

                            <tr>
                                <td scope="row"><?php echo $dato->id; ?></td>
                                <td><?php echo $dato->Nombre; ?></td>
                                <td><?php echo $dato->Email; ?></td>
                                <td><?php echo $dato->Sexo; ?></td>
                                <td><?php echo $dato->Area; ?></td>
                                <td><?php echo $dato->Boletin; ?></td>
                                <td><a class="text-success" href="edit.php?id=<?php echo $dato->id; ?>"><i class="bi bi-pencil-square"></i></a></td>
                                <td><a onclick="return confirm('Estas seguro de eliminar?');" class="text-danger" href="delete.php?id=<?php echo $dato->id; ?>"><i class="bi bi-trash"></i></a></td>
                            </tr>

                            <?php 
                                }
                            ?>

                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Ingresar datos:
                </div>
                <form class="p-4" method="POST" action="registrar.php">
                    <div class="mb-3">
                        <label class="form-label">Nombre *</label>
                        <input type="text" class="form-control" name="txtName" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Correo electronico *</label>
                        <input type="email" class="form-control" name="txtEmail" autofocus required>
                        <div id="emailHelp" class="form-text"></div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="radioFem">
                        <label class="form-check-label" for="flexRadioDefault1">Femenino</label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="radioMas">
                        <label class="form-check-label" for="flexRadioDefault2">Masculino</label>
                    </div>
                    <select class="form-select" aria-label="Default select example">
                        <label class="form-label">Area *</label>
                        <option selected>- Seleccione un area -</option>
                        <option value="1">Administrativa y Financiera</option>
                        <option value="2">Ingeniería</option>
                        <option value="3">Desarrollo de Negocio</option>
                        <option value="1">Proyectos</option>
                        <option value="2">Servicios</option>
                        <option value="3">Calidad</option>
                    </select>
                    <div class="mb-3">
                        <label class="form-label">Descripción *</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="" value="">
                        <label class="form-check-label">Default checkbox </label>
                    </div>

                    <div class="d-grid">
                        <input type="hidden" name="oculto" value="1">
                        <input type="submit" class="btn btn-primary" value="Registrar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php' ?>
