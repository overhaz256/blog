<?php 
require "includes/dbh.php";
include "includes/unset-sessions.php";
$sqlCategories = "SELECT * FROM blog_category";
$queryCategories = mysqli_query($conn, $sqlCategories);
$numCategories = mysqli_num_rows($queryCategories);
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Interfaz De Administrador</title>
    <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>

<body>
    <div id="wrapper">
        <?php include "header.php"; include "sidebar.php" ?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Categorías del Blog
                        </h1>
                    </div>
                </div>


                <?php
                if(isset($_REQUEST['addcategory'])){
                    if($_REQUEST['addcategory'] == "success"){
                        echo "<div class = 'alert alert-success'>
                            <strong>La categoría se agregó correctamente.</strong>
                        </div>";
                    }
                    else if($_REQUEST['addcategory'] == "error"){
                        echo "<div class = 'alert alert-danger'>
                            <strong>La categoría no se agregó correctamente, ocurrió un error inesperado.</strong>
                        </div>";
                    }
                }
                else if(isset($_REQUEST['editcategory'])){
                    if($_REQUEST['editcategory'] == "success"){
                        echo "<div class = 'alert alert-success'>
                            <strong>La categoría se modificó correctamente.</strong>
                        </div>";
                    }
                    else if($_REQUEST['editcategory'] == "error"){
                        echo "<div class = 'alert alert-danger'>
                            <strong>La categoría no modificó correctamente, ocurrió un error inesperado.</strong>
                        </div>";
                    }
                }
                else if(isset($_REQUEST['deletecategory'])){
                    if($_REQUEST['deletecategory'] == "success"){
                        echo "<div class = 'alert alert-success'>
                            <strong>La categoría se eliminó.</strong>
                        </div>";
                    }
                    else if($_REQUEST['deletecategory'] == "error"){
                        echo "<div class = 'alert alert-danger'>
                            <strong>La categoría no se pudo eliminar, ocurrió un error inesperado.</strong>
                        </div>";
                    }
                }

                ?>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Agregar Una Categoría al Blog
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form role="form" method="POST" action="includes/add-category.php">
                                            <div class="form-group">
                                                <label>Nombre</label>
                                                <input class="form-control" name="category-name">
                                            </div>
                                            <div class="form-group">
                                                <label>Meta Title</label>
                                                <input class="form-control" name="category-meta-title">
                                            </div>
                                            <div class="form-group">
                                                <label>Category Path (sin espacios, en minúscula)</label>
                                                <input class="form-control" name="category-path">
                                            </div>
                                            <button type="submit" class="btn btn-default" name="add-category-btn">Crear
                                                Categoría</button>
                                        </form>
                                    </div>
                                </div>
                                <!-- /.row (nested) -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->

                        <!--Tabla de Entradas-->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Todas las Categorías
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Meta Title</th>
                                                <th>Category Path</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php 
                                                //INICIALIZAMOS UN CONTADOR EN 0. EN CASO LO QUERRAMOS USAR COMO ID, EN ESTE CASO ESTOY USANDO EL PROPIO ID DE LAS CATEGORÍAS GUARDADAS
                                                $counter = 0;

                                                //LO QUE HACE fetch_assoc ES QUE DEVUELVE UN ARRAY ASOCIANDO TODOS LOS DATOS DE LA FILA RECUPERADA.
                                                while($rowCategories = mysqli_fetch_assoc($queryCategories)){
                                                    
                                                    //SE DECLARAN LAS VARIABLES PARA EL LISTADO DE DATOS. LAS VARIABLES INTERNAS DEBEN CORRESPONDER A LO DECLARADO EN LA SENTENCIA.
                                                    $counter++;
                                                    $id = $rowCategories['n_category_id'];
                                                    $name = $rowCategories['v_category_title'];
                                                    $metaTitle = $rowCategories['v_category_meta_title'];
                                                    $categoryPath = $rowCategories['v_category_path'];

                                                ?>

                                            <tr>
                                                <!--SE IMPRIMEN LOS DATOS RECUPERADOS EN UNA TABLA, EL WHILE CORRE HASTA QUE TODOS LOS DATOS GUARDADOS EN LA BD SE LISTEN -->
                                                <td><?php echo $id; ?></td>
                                                <td><?php echo $name; ?></td>
                                                <td><?php echo $metaTitle; ?></td>
                                                <td><?php echo $categoryPath; ?></td>
                                                <td>
                                                    <!--BOTON VER CATEGORI PATH HACE REFERENCIA AL INPUT QUE ESPECIFICAMOS EN EL FORMULARIO-->
                                                    <button class="popup-button"
                                                        onclick="window.open('../categories.php?group=<?php echo $categoryPath; ?>' , '_blank');">Ver</button>
                                                    <button data-toggle="modal" data-target="#edit<?php echo $id; ?>"
                                                        class="popup-button">Editar</button>
                                                    <button data-toggle="modal" data-target="#delete<?php echo $id; ?>"
                                                        class="popup-button">Borrar</button>
                                                </td>
                                                <!-- EN PHP ES MUY IMPORTANTE LOS ESPACIOS, NO OLVIDAR QUE DENTRO DE UN TAG HTML AL INTRODUCIR
                                                UNA LINEA DE CODIGO PHP ESTA DEBE ESTAR SIEMPRE JUNTA -->
                                                <div class="modal fade" id="edit<?php echo $id;?>" tabindex="-1" role="dialog"
                                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form method = "POST" action = "includes/edit-category.php">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-hidden="true">&times;</button>
                                                                    <h4 class="modal-title" id="myModalLabel">Editar Categoría</h4>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <input type = "hidden" name = "category-id" value = "<?php echo $id; ?>">
                                                                    <div class = "form-group">
                                                                        <label>Nombre</label>
                                                                        <input class = "form-control" name = "edit-category-name" value = "<?php echo $name; ?>">
                                                                    </div>
                                                                    <div class = "form-group">
                                                                        <label>Meta Title</label>
                                                                        <input class = "form-control" name = "edit-category-meta-title" value = "<?php echo $metaTitle; ?>">
                                                                    </div>
                                                                    <div class = "form-group">
                                                                        <label>Category Path</label>
                                                                        <input class = "form-control" name = "edit-category-path" value = "<?php echo $categoryPath; ?>">
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                                    <button type="submit" class="btn btn-primary" name = "edit-category-btn">Guardar Cambios</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade" id="delete<?php echo $id;?>" tabindex="-1" role="dialog"
                                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form method = "POST" action = "includes/delete-category.php">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-hidden="true">&times;</button>
                                                                    <h4 class="modal-title" id="myModalLabel">Eliminar Categoría</h4>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <input type = "hidden" name = "category-id" value = "<?php echo $id; ?>">
                                                                    <p>¿Estas seguro que deseas eliminar esta categoría?</p>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                                    <button type="submit" class="btn btn-primary" name = "delete-category-btn">Eliminar</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
                                            <?php
                                                }
                                                ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Fin de la tabla de entradas-->

                    </div>
                    <!-- /.col-lg-12 -->
                </div>

                <?php include "footer.php";?>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>


</body>

</html>