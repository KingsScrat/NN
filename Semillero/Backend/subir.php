<?php
include('conexion.php');

if(isset($_POST['Guardar'])){
    $imagen = $_FILES['imagen']['name'];
    $nombre = $_POST['titulo'];

    if(isset($imagen) && $imagen != ""){
        $tipo = $_FILES['imagen']['type'];
        $temp  = $_FILES['imagen']['tmp_name'];

       if( !((strpos($tipo,'gif') || strpos($tipo,'jpeg') || strpos($tipo,'webp') ||strpos($tipo,'png')))){
          $_SESSION['mensaje'] = 'solo se permite archivos jpeg, png, gif, webp';
          $_SESSION['tipo'] = 'danger';
          header('location:../index.php');
       }else{
         $query = "INSERT INTO imagenes(imagen,nombre) values('$imagen','$nombre')";
         $resultado = mysqli_query($conn,$query);
         if($resultado){
              move_uploaded_file($temp,'imagenes/'.$imagen);   
             $_SESSION['mensaje'] = 'Publicacion realizada con exito!';
             $_SESSION['tipo'] = 'success';
             header('location:../index.php');
         }else{
             $_SESSION['mensaje'] = 'Oops, no se pudo realizar la publicacion';
             $_SESSION['tipo'] = 'danger';
         }
       }
    }
}


?>