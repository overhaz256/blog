<?php

require "includes/dbh.php";
include "includes/unset-sessions.php";

$sqlBlogs = "SELECT * FROM blog_post WHERE f_post_status != '2'";
$queryBlogs = mysqli_query($conn, $sqlBlogs);
$numBlogs = mysqli_num_rows($queryBlogs);

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
                            Blogs Posts
                        </h1>
                    </div>
                </div>

                <?php

                    if(isset($_REQUEST['addblog'])){
                        if($_REQUEST['addblog'] == "success"){
                            echo "<div class = 'alert alert-success'>
                                <strong> Exito!</strong> El blog se agregó correctamente
                                </div>";
                        }
                    }

                    if(isset($_REQUEST['updateblog'])){
                        if($_REQUEST['updateblog'] == "success"){
                            echo "<div class = 'alert alert-success'>
                                <strong> Exito!</strong> Cambios guardados.
                                </div>";
                        }
                    }

                    if(isset($_REQUEST['deleteblogpost'])){
                        if($_REQUEST['deleteblogpost'] == "success"){
                            echo "<div class = 'alert alert-success'>
                                <strong> Exito!</strong> Blog eliminado!
                                </div>";
                        }
                        else if($_REQUEST['deleteblogpost'] == 'error'){
                            echo "<div class = 'alert alert-danger'>
                                <strong>Error!</strong> El post no fue eliminado debido a un error inesperado!
                                </div>";
                        }
                    }

                ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Administración de entradas
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Categoría</th>
                                        <th>Vistas</th>
                                        <th>Blog Path</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    $counter = 0;

                                    while($rowBlogs = mysqli_fetch_assoc($queryBlogs)){

                                        $counter++;
                                        $id = $rowBlogs['n_blog_post_id'];
                                        $name = $rowBlogs['v_post_title'];
                                        $cId = $rowBlogs['n_category_id'];
                                        $views = $rowBlogs['n_blog_post_views'];
                                        $blogPath = $rowBlogs['v_post_path'];

                                        $sqlGetCategoryName = "SELECT v_category_title FROM blog_category WHERE n_category_id ='$cId'";
                                        $queryGetCategoryName = mysqli_query($conn, $sqlGetCategoryName);
                                        if($rowGetCategoryName = mysqli_fetch_assoc($queryGetCategoryName)){
                                            $categoryName = $rowGetCategoryName['v_category_title'];
                                        }
                                    
                                    ?>
                                    <tr>
                                        <td><?php echo $counter;?></td>
                                        <td><?php echo $name;?></td>
                                        <td><?php echo $categoryName;?></td>
                                        <td><?php echo $views;?></td>
                                        <td><?php echo $blogPath;?></td>
                                        <td>
                                            <button class="popup-button"
                                                onclick="window.open('../single-blog.php?blog=<?php echo $blogPath; ?>', '_blank');">Ver</button>
                                            <button class="popup-button"
                                                onclick="location.href = 'edit-blog.php?blogid=<?php echo $id; ?>'">Editar</button>
                                            <button class="popup-button" data-toggle="modal"
                                                data-target="#delete<?php echo $id; ?>">Borrar</button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="delete<?php echo $id;?>" tabindex="-1" role="dialog"
                                        aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form method="POST" action="includes/delete-blog-post.php">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title" id="myModalLabel">Eliminar Blog Post</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="blog-post-id"
                                                            value="<?php echo $id; ?>">
                                                        <p>¿Estas seguro que deseas eliminar este post del blog?</p>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-primary"
                                                            name="delete-blog-post-btn">Eliminar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Fin de la tabla de entradas-->
                <?php include "footer.php";?>
            </div>
        </div>
    </div>
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