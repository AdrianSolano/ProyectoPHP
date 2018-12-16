<?php
require_once '../setup.php';
require_once '../database/conexion.php';
require_once '../database/helpers.php';

// Comprobar que hay sesión
if ( empty($_SESSION) ){
    header("Location: ".BASE_URL.'login');
    die();
}
$user_id = $_SESSION['usuario']['id'];

if( isset($_GET['fichero_id']) && isset($_GET['item_id']) ){
    $item_id = $_GET['item_id'];
    $fichero_id = $_GET['fichero_id'];

    // Comprobar que el usuario es propietario de la ficha del mbt y el item existe y pertenece a la ficha
    if( !userOwnsList($db, $user_id, $fichero_id) ){
        header("Location: ".BASE_URL."mis_fichas");
        die();
    }

    if( !itemBelongsToList($db, $item_id, $fichero_id) ){
        header("Location: ".BASE_URL."mis_fichas");
        die();
    }

    // Borrar el item id
    $sql = "DELETE FROM zapatillas WHERE id_zapatilla = $item_id";

    $result =  mysqli_query($db, $sql);

    if($result){
        header("Location: ".BASE_URL."list/?id=".$fichero_id);
    }else{
        die("Error");
    }
}else{
    header("Location: ".BASE_URL);
}