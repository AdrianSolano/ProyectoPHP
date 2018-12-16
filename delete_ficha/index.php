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

// Comprobamos que recibimos el id por GET
if ( !isset($_GET['id']) ){
    header("Location: ".BASE_URL.'login');
    die();
}
$fichero_id = $_GET['id'];

// Comprobar que el usuario es propietario de la ficha
// La url será de la forma:

if( !userOwnsList($db, $user_id, $fichero_id) ){
    header("Location: ".BASE_URL."mis_fichas");
    die();
}

// En caso afirmativo borrar la ficha
$sql = "DELETE FROM fichero WHERE id = $fichero_id AND user_id = $user_id LIMIT 1";
$result = mysqli_query($db, $sql);

if( $result ) {
    header("Location: ".BASE_URL."mis_fichas");
    die();
}else{
    echo "Error borrando la ficha del vehiculo";
    die();
}