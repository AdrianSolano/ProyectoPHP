<?php

require_once '../setup.php';
require_once '../database/conexion.php';
require_once '../database/helpers.php';

// Comprobar que la sesión está creada
if ( empty($_SESSION) ){
    header("Location: ".BASE_URL.'login');
    die();
}
$user_id = $_SESSION['usuario']['id'];

$sql_fich = "SELECT * FROM fichero WHERE user_id = $user_id";
$result_fichas = mysqli_query($db, $sql_fich);

require_once 'mis_fichas.view.php';