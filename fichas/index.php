<?php
require_once '../setup.php';
require_once '../database/conexion.php';
require_once '../database/helpers.php';

if( !isset($_GET['id']) ){
    header("Location: ".BASE_URL);
}

$fichero_id = $_GET['id'];

if( isset($_POST['saveitem']) ){
    $item = trim($_POST['item']) ?? null;

    // Validaciones
    // username:
    if ( empty($item) ){
        $errors['item']['empty'] = "Debes introducir un nombre.";
        $username = null;
    }

    if( empty($errors) ){
        // Guardar item en la base de datos
        
        // Insertar usuario en la base de datos
        $sql = "INSERT INTO items(fichero_id, description) VALUES($fichero_id, '$item')";

        $guardar = mysqli_query($db, $sql);

        if( $guardar ){
            header("Location: ".BASE_URL.'fichas/?id='.$fichero_id);
            die();
        }

        echo "Error";
        die();   
    }
}
    // Extraer los items de la fichasa
    $sql_items = "SELECT * FROM items WHERE fichero_id = $fichero_id;";
    $result_items = mysqli_query($db, $sql_items);

    $sql_fichas = "SELECT * FROM fichero WHERE id = $fichero_id LIMIT 1";
    $result_fichas = mysqli_query($db, $sql_fichas);
    $fichas = mysqli_fetch_assoc($result_fichas);


require_once 'fichas.view.php';