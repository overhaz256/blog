<?php

//DEBEMOS INCLUIR LA CLASE EN LA QUE HACEMOS LA CONEXIÓN A LA BASE DE DATOS.
require "dbh.php";

/*METODO ISSET VERIFICA SI EL BOTON HA SIDO PRESIONADO POR ESO LE PASAMOS
EL NOMBRE CON EL QUE DECLARAMOS EL BOTON.*/

if(isset($_POST['add-category-btn'])){

    //%_POST -> SE REFERENCIA AL NOMBRE QUE LE DIMOS A CADA INPUT EN LA CLASE blog-category.php. 
    $name = $_POST['category-name'];
    $metaTitle = $_POST['category-meta-title'];
    $categoryPath = $_POST['category-path'];

    //VARIABLES QUE NOS DEVOLVERÁN LA HORA EN LA QUE SE HA CREADO EL POST.
    $date = date("Y-m-d");
    $time = date("H:i:s");

    //SENTENCIA PARA INSERTAR DATOS EN LA BD SE DEBEN ESPECIFICAR LOS MISMOS CAMPOS QUE CONTIENE NUESTRA TABLA.
    $sqlAddCategory = "INSERT INTO blog_category (v_category_title, v_category_meta_title, v_category_path, d_date_created,
    d_time_created) VALUES ('$name', '$metaTitle', '$categoryPath', '$date', '$time')";

    //SI EL QUERY SE EJECUTÓ CORRECTAMENTE NOS MOSTRARÁ addcategory=success EN EL LINK INPUT DE GOOGLE.
    if(mysqli_query($conn, $sqlAddCategory)){
        mysqli_close($conn);
        header("Location: ../blog-category.php?addcategory=success");
        exit();
    }
    //SI EL QUERY NO SE EJECUTÓ CORRECTAMENTE NOS MOSTRARÁ addcategory=error EN EL LINK INPUT DE GOOGLE.
    else{
        mysqli_close($conn);
        header("Location: ../blog-category.php?addcategory=error");
        exit();
    }

}

else{

    header("Location: ../index.php");
    exit();

}