<?php 
session_start();
include("conexion.php");

$id_cat= $_POST['id_categoria'];
$nom_cat= $_POST['nombre_categoria'];


$query2 = "INSERT INTO categorias (id_categoria, nombre_categoria) VALUES ($id_cat,'$nom_cat')";
mysqli_query($link,$query2);

if($id_cat='' || $id_cat==null){
    $query = "INSERT INTO categorias (nombre_categoria) VALUES ('$nom_cat')";
    mysqli_query($link,$query);
    }

    $_SESSION['message'] = "Categoria creada correctamente";
    $_SESSION['message_type'] = "success";
    header("Location: categorias.php");

?>