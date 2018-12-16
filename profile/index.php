<?php
require_once '../setup.php';
require_once '../database/conexion.php';
require_once '../database/helpers.php';


$user_id = $_GET['id'];
if( isset( $_GET['id'])){

    // Comprobar que el usuario es propietario de la lista, el item existe y pertenece a la lista

    if( isset($_POST['edit_profile']) ) {
        


        $userName = trim($_POST['username']) ?? null;
        $password = trim($_POST['password']) ?? null;
        $passwordConf = trim($_POST['password-conf']) ?? null;
        
        // Validaciones
        if ( empty($userName) ){
            $errors['username']['empty'] = "Debes introducir un nombre.";
            $username = null;
        }

        if ( !empty($password)){
            if (empty($passwordConf)){
                $errors['passwordConf']['empty'] = "Debes confirmar la nueva contraseña.";
            }
        }else{
            $errors['password']['empty'] = "Debes introducir una nueva contraseña.";
        }
        
        if( empty($errors) ){
            // Guardar item en la base de datos

            // Insertar usuario en la base de datos
            
            $sql = "UPDATE users SET username = '$userName' WHERE id = $id_user";
            $sqlPassword = "UPDATE users SET password = '$password' WHERE id = $id_user";

            

            $result = mysqli_query($db, $sql);
            $resultPassword = mysqli_query($db, $sqlPassword);

            if( $result && $resultPassword){
                header("Location: ".BASE_URL.'profile/?id='.$user_id);
                die();
            }

            echo "Error";
            die();   
        }
    }
    
        // Mostrar form con la información actual del item

        // $sql = "SELECT lists.id as 'list_id', lists.name as 'list_name', zapatillas.description as 'item_text' FROM zapatillas INNER JOIN lists ON zapatillas.list_id = lists.id WHERE zapatillas.id_zapatilla = $item_id LIMIT 1";
        // $result = mysqli_query($db, $sql);
        // $item = mysqli_fetch_assoc($result);
    
}else{
    header("Location: ".BASE_URL.'profile/?id='.$user_id);
}

require_once 'edit_profile.view.php';

