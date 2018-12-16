<?php
    require_once '../setup.php';
    require_once '../database/conexion.php';

    if ( empty($_SESSION) ){
        header("Location: ".BASE_URL.'login');
        die();
    }

    if( isset($_POST['nuevaFicha']) ){
        $nombreVehiculo = trim($_POST['nombreVehiculo']) ?? null;
        $description = trim($_POST['descVehiculo']) ?? null;

        // Array de errores
        $errors = [];

        // Validaciones
        // username:
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
            $user_id = $_SESSION['usuario']['id'];
            $sql = "INSERT INTO fichero(user_id, name, description) VALUES( $user_id, '$nombreVehiculo', '$description')";

            $guardar = mysqli_query($db, $sql);

            if( $guardar ){
                $id = mysqli_insert_id($db);
                // Redirigir a la página de Mis listas
                header("Location: ".BASE_URL.'fichas/?id='.$id);
                die();
            }

            echo "Error";
            die();   
        }
    }
    require_once 'crear_ficha.view.php';