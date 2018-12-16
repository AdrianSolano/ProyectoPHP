<?php
    require_once '../setup.php';
    require_once '../database/conexion.php';

    if ( !empty($_SESSION) ){
        header("Location: ".BASE_URL);
        die();
    }
    
    if( isset($_POST['registro']) ){
        $username = $_POST['username'] ?? null;
        $email = $_POST['email'] ?? null;
        $password = trim($_POST['password']) ?? null;
        $passwordconf = trim($_POST['password-conf']) ?? null;

        // Array de errores
        $errors = [];

        // Validaciones
        // username:
        if ( empty($username) ){
            $errors['username']['empty'] = "Debes introducir un nombre.<br>";
            $username = null;
        }

        if ( strlen($username) < 8 ) {
            $errors['username']['length'] = "El nombre de usuario debe tener al menos 8 caracteres.<br>";
            $username = null;
        }

        if ( !preg_match("/[0-9a-z]+$/",$username) ){
            $errors['username']['format'] = "La contraseña solo admite números y letras minúsculas.<br>";
            $username = null;
        }
    
        // email:
        if ( empty($email) ){
            $errors['email']['empty'] = "Debes introducir un email.<br>";
            $email = null;
        }

        if( !filter_var($email, FILTER_VALIDATE_EMAIL) ){
            $errors['email']['format'] = "Debes introducir un email válido.<br>";
            $email = null;
        }
    
        // password:
        if ( empty($password) ){
            $errors['password']['empty'] = "Debes facilitar una contraseña.<br>";
        }
    
        if ( strlen($password) < 6 ) {
            $errors['password']['length'] = "La contraseña debe tener al menos 6 caracteres.<br>";
        }

        if ( empty($passwordconf) ){
            $errors['passwordconf']['empty'] = "Debes confirmar la contraseña.<br>";
        }

        if ( $password != $passwordconf ){
            $errors['passwordconf']['match'] = "Las contraseñas no coinciden.<br>";
        }
    
        if( empty($errors) ){
            // Guardar en la base de datos
            // Cifrar la contraseña
            $password_segura = password_hash($password, PASSWORD_BCRYPT);

            // Insertar usuario en la base de datos
            $sql = "INSERT INTO users VALUES(NULL, '$username', '$email', '$password_segura', NOW(), NOW())";

            $guardar = mysqli_query($db, $sql);

            if( $guardar ){
                header("Location: ".BASE_URL);
                die();
            }

            echo "Error";
            die();   
        }
    }

    require 'register.view.php';