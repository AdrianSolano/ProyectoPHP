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

// Comprobar que el usuario es propietario de la lista

if( !userOwnsList($db, $user_id, $fichero_id) ){
    header("Location: ".BASE_URL."mis_fichas");
    die();
}

// Extraer la información de la lista
$sql_fichero = "SELECT * FROM fichero WHERE id = $fichero_id LIMIT 1";
$result_list = mysqli_query($db, $sql_fichero);
$fichero = mysqli_fetch_assoc($result_fichero);

if( isset($_POST['edit_list']) ){
    $nombreVehiculo = trim($_POST['nombreVehiculo']) ?? null;
    $description = trim($_POST['listdesc']) ?? null;

    // Array de errores
    $errors = [];

    // Validaciones
    // nombreVehiculo:
    if ( empty($nombreVehiculo) ){
        $errors['nombreVehiculo']['empty'] = "Debes introducir un nombre para la lista.";
        $username = null;
    }

    if ( strlen($nombreVehiculo) < 4 ) {
        $errors['nombreVehiculo']['length'] = "El nombre de la lista debe tener al menos 4 caracteres.";
        $username = null;
    }

    if( empty($errors) ){
        // Insertar usuario en la base de datos
        // $sql = "INSERT INTO fichero(user_id, name, description) VALUES( $user_id, '$nombreVehiculo', '$description')";
        $sql = "UPDATE fichero SET name = '$nombreVehiculo', description = '$description' WHERE id = $fichero_id";
        $actualizar = mysqli_query($db, $sql);

        if( $actualizar ){
            $id = mysqli_insert_id($db);
            // Redirigir a la página de Mis listas
            header("Location: ".BASE_URL.'list/?id='.$fichero_id);
            die();
        }

        echo "Error: ".mysqli_error($db);
        die();   
    }
}

require_once 'editar_lista.view.php';