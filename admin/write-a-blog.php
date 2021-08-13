<?php
require "includes/dbh.php";
session_start();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sección del Administrador</title>
    <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <!-- Summernote-->
    <link href='summernote/summernote.min.css' rel='stylesheet' type='text/css' />
</head>

<body>
    <div id="wrapper">
        <?php include "header.php"; include "sidebar.php";?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Crear una entrada
                        </h1>
                    </div>
                </div>
                <?php

                    if(isset($_REQUEST['addblog'])){
                        if($_REQUEST['addblog'] == "emptytitle"){
                            echo "<div class = 'alert alert-danger'>
                                    <strong>Error!</strong> Porfavor agregale un titulo a la entrada.
                            </div>";
                        }
                        else if($_REQUEST['addblog'] == "emptycategory"){
                            echo "<div class = 'alert alert-danger'>
                                    <strong>Error!</strong> Porfavor selecciona una categoría.
                            </div>";
                        }
                        else if($_REQUEST['addblog'] == "emptysummary"){
                            echo "<div class = 'alert alert-danger'>
                                    <strong>Error!</strong> Porfavor ingresa un resumen para la entrada.
                            </div>";
                        }
                        else if($_REQUEST['addblog'] == "emptycontent"){
                            echo "<div class = 'alert alert-danger'>
                                    <strong>Error!</strong> Porfavor agregale un contenido a la entrada.
                            </div>";
                        }
                        else if($_REQUEST['addblog'] == "emptytags"){
                            echo "<div class = 'alert alert-danger'>
                                    <strong>Error!</strong> Porfavor agrega algunos tags para el blog.
                            </div>";
                        }
                        else if($_REQUEST['addblog'] == "emptypath"){
                            echo "<div class = 'alert alert-danger'>
                                    <strong>Error!</strong> Porfavor agrega una ruta para la entrada.
                            </div>";
                        }
                        else if($_REQUEST['addblog'] == "sqlerror"){
                            echo "<div class = 'alert alert-danger'>
                                    <strong>Error!</strong> Porfavor intenta denuevo.
                            </div>";
                        }
                        else if($_REQUEST['addblog'] == "pathcontainspaces"){
                            echo "<div class = 'alert alert-danger'>
                                    <strong>Error!</strong> Porfavor no uses espacios al ingresar los paths.
                            </div>";
                        }
                        else if($_REQUEST['addblog'] == "emptymainimage"){
                            echo "<div class = 'alert alert-danger'>
                                    <strong>Error!</strong> Porfavor ingresa una imagen principal.
                            </div>";
                        }
                        else if($_REQUEST['addblog'] == "emptyaltimage"){
                            echo "<div class = 'alert alert-danger'>
                                    <strong>Error!</strong> Porfavor ingresa una imagen alterna.
                            </div>";
                        }
                        else if($_REQUEST['addblog'] == "mainimageerrror"){
                            echo "<div class = 'alert alert-danger'>
                                    <strong>Error!</strong> Porfavor selecciona otra imagen principal.
                            </div>";
                        }
                        else if($_REQUEST['addblog'] == "altimageerrror"){
                            echo "<div class = 'alert alert-danger'>
                                    <strong>Error!</strong> Porfavor selecciona otra imagen alterna.
                            </div>";
                        }
                        else if($_REQUEST['addblog'] == "invalidtypemainimage"){
                            echo "<div class = 'alert alert-danger'>
                                    <strong>Error!</strong> Main Image -> Solo se aceptan las extensiones jpg, jpeg, gif, png, bmp.
                            </div>";
                        }
                        else if($_REQUEST['addblog'] == "erroruploadingmainimage"){
                            echo "<div class = 'alert alert-danger'>
                                    <strong>Error!</strong> Main Image -> Hubo un error al cargar la imagen. Por favor intenta denuevo mas tarde.
                            </div>";
                        }
                        else if($_REQUEST['addblog'] == "erroruploadingaltimage"){
                            echo "<div class = 'alert alert-danger'>
                                    <strong>Error!</strong> Alt Image -> Hubo un error al cargar la imagen. Por favor intenta denuevo mas tarde.
                            </div>";
                        }
                        else if($_REQUEST['addblog'] == "titlebeingused"){
                            echo "<div class = 'alert alert-danger'>
                                    <strong>Error!</strong> El título está siendo usado en otra entrada. Intenta escogiendo otro título.
                            </div>";
                        }
                        else if($_REQUEST['addblog'] == "pathbeingused"){
                            echo "<div class = 'alert alert-danger'>
                                    <strong>Error!</strong> El path está siendo usado en otra entrada. Intenta escogiendo un path diferente.
                            </div>";
                        }
                        else if($_REQUEST['addblog'] == "homepageplacementerror"){
                            echo "<div class = 'alert alert-danger'>
                                    <strong>Error!</strong> Ocurrió un error inesperado cuando se intentó colocar la entrada en la página principal, 
                                    Por favor intenta denuevo.
                            </div>";
                        }
                    }
            
                ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i>
                                    Escribe tu entrada para el Blog.  Es necesario llenar todos los campos que se solicitan.   
                                </i>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form role="form" method = "POST" action="includes/add-blog.php" enctype = "multipart/form-data"
                                        onsubmit = "return validateImage();">
                                            <div class="form-group">
                                                <label>Título</label>
                                                <input class="form-control" name = "blog-title" value = "<?php if (isset($_SESSION['blogTitle'])) {echo $_SESSION['blogTitle'];} ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Meta Title</label>
                                                <input class="form-control" name = "blog-meta-title" value = "<?php if (isset($_SESSION
                                                ['blogMetaTitle'])) {echo $_SESSION['blogMetaTitle'];} ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Categoría del Blog</label>
                                                <select class="form-control" name = "blog-category">
                                                <option value = "">Elige una categoría</option>
                                                    <?php
                                                    
                                                    $sqlCategories = "SELECT * FROM blog_category";
                                                    $queryCategories = mysqli_query($conn, $sqlCategories);

                                                    while($rowCategories = mysqli_fetch_assoc($queryCategories)){

                                                        $cId = $rowCategories['n_category_id'];
                                                        $cName = $rowCategories['v_category_title'];

                                                        if(isset($_SESSION['blogCategoryId'])){

                                                            if($_SESSION['blogCategoryId'] == $cId){
                                                                echo "<option value = '".$cId."' selected = ''>".$cName."</option>";
                                                            }
                                                            else{
                                                                echo "<option value = '".$cId."'>".$cName."</option>";
                                                            }
                                                        }
                                                        else {

                                                            echo "<option value = '".$cId."'>".$cName."</option>";  
                                                        }   
                                                    }                                                
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Imagen de Portada</label>
                                                <input type="file" name = "main-blog-image" id = "main-blog-image">
                                            </div>
                                            <div class="form-group">
                                                <label>Imagen Alterna</label>
                                                <input type="file" name = "alt-blog-image" id = "alt-blog-image">
                                            </div>
                                            <div class="form-group">
                                                <label>Resumen</label>
                                                <textarea class="form-control" rows="3" name = "blog-summary"><?php if (isset($_SESSION
                                                ['blogSummary'])) {echo $_SESSION['blogSummary'];} ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Contenido del Blog</label>
                                                <textarea class="form-control" rows="3" name = "blog-content" id = "summernote"><?php if (isset($_SESSION
                                                ['blogContent'])) {echo $_SESSION['blogContent'];} ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Blog Tags (separado por coma)</label>
                                                <input class="form-control" name = "blog-tags" value = "<?php if (isset($_SESSION
                                                ['blogTags'])) {echo $_SESSION['blogTags'];} ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Ruta</label>
                                                <div class = "input-group">
                                                    <span class="input-group-addon">www.fcodehat.com/</span>
                                                    <!-- DANGER -->
                                                    <input type="text" class="form-control" name = "blog-path" value = "<?php if (isset($_SESSION
                                                ['blogPath'])) {echo $_SESSION['blogPath'];} ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Posicionamiento en la página principal</label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="blog-home-page-placement"
                                                        id="optionsRadiosInline1" value="1" 
                                                        <?php 
                                                        if(isset($_SESSION['blogHomePagePlacement'])){ 
                                                            if($_SESSION['blogHomePagePlacement'] == 1){
                                                            echo "checked = ''";
                                                            }
                                                        } 
                                                    ?>>1
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="blog-home-page-placement"
                                                        id="optionsRadiosInline2" value="2"
                                                        <?php 
                                                        if(isset($_SESSION['blogHomePagePlacement'])){ 
                                                            if($_SESSION['blogHomePagePlacement'] == 2){
                                                            echo "checked = ''";
                                                            }
                                                        } 
                                                    ?>>2
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="blog-home-page-placement"
                                                        id="optionsRadiosInline3" value="3"
                                                        <?php 
                                                        if(isset($_SESSION['blogHomePagePlacement'])){ 
                                                            if($_SESSION['blogHomePagePlacement'] == 3){
                                                            echo "checked = ''";
                                                            }
                                                        } 
                                                    ?>>3
                                                </label>
                                            </div>
                                            <button type="submit" class="btn btn-default" name = "submit-blog">Crear Blog</button>
                                        </form>
                                    </div>
                                </div>
                                <!-- /.row (nested) -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>
    <!-- Summernote API -->
    <script src="summernote/summernote.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 300,
                minHeight: null,
                maxHeight: null,
                focus: false
            });
        });
    </script>   

    <script>

        function validateImage(){

            var main_img = $("#main-blog-image").val();
            var alt_img = $("#alt-blog-image").val();

            var exts = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];

            var get_ext_main_img = main_img.split('.');
            var get_ext_alt_img = alt_img.split('.');

            get_ext_main_img = get_ext_main_img.reverse();
            get_ext_alt_img = get_ext_alt_img.reverse();

            main_image_check = false;
            alt_image_check = false;

            if(main_img.length > 0){
                if($.inArray(get_ext_main_img[0].toLoweCase(), exts) >= -1){
                    main_image_check = true;
                }
                else{
                    alert("Error -> Imagen Principal. Solo se aceptan las extensiones: jpg, jpeg, png, gif, bmp.");
                    main_img_check = false;
                }
            }
            else{
                alert("Porfavor selecciona una nueva imagen principal.");
                main_img_check = false;
            }

            if(alt_img.length > 0){
                if($.inArray(get_ext_alt_img[0].toLoweCase(), exts) >= -1){
                    alt_image_check = true;
                }
                else{
                    alert("Error -> Imagen Alterna. Solo se aceptan las extensiones: jpg, jpeg, png, gif, bmp.");
                    alt_image_check = false;
                }
            }
            else{
                alert("Porfavor selecciona una nueva imagen alterna.");
                alt_image_check = false;
            }

            if(main_image_check == true && alt_image_check == true){
                return true;
            }
            else{
                return false;
            }
            
        }
    
    </script>

</body>
</html>