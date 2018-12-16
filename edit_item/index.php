<?php
require_once '../setup.php';
require_once '../database/conexion.php';
require_once '../database/helpers.php';

$item_id = $_GET['item_id'];
$list_id = $_GET['list_id'];

if( isset($_GET['list_id']) && isset($_GET['item_id']) ){

    // Comprobar que el usuario es propietario de la lista, el item existe y pertenece a la lista

    if( isset($_POST['edit_item']) ) {
        // Editar item
        $item = trim($_POST['item']) ?? null;
        
        // Validaciones
        if ( empty($item) ){
            $errors['item']['empty'] = "Debes introducir un texto para la tarea.";
            $username = null;
        }
        if( empty($errors) ){
            // Guardar item en la base de datos

            // Insertar usuario en la base de datos
            $sql = "UPDATE zapatillas SET description = '$item' WHERE id_zapatilla = $item_id";

            $result = mysqli_query($db, $sql);

            if( $result ){
                header("Location: ".BASE_URL.'list/?id='.$list_id);
                die();
            }

            echo "Error";
            die();   
        }
    }
        // Mostrar form con la información actual del item

        $sql = "SELECT lists.id as 'list_id', lists.name as 'list_name', zapatillas.description as 'item_text' FROM zapatillas INNER JOIN lists ON zapatillas.list_id = lists.id WHERE zapatillas.id_zapatilla = $item_id LIMIT 1";
        $result = mysqli_query($db, $sql);
        $item = mysqli_fetch_assoc($result);
    
}else{
    header("Location: ".BASE_URL);
}

require_once 'edit_item.view.php';