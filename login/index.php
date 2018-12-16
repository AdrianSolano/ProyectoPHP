<?php
    require_once '../setup.php';
    require_once '../database/conexion.php';
    require_once '../database/helpers.php';

    if ( !empty($_SESSION) ){
        header("Location: ".BASE_URL);
        die();
    }
    
    if( isset($_POST['login']) ){
        $username = trim($_POST['username']) ?? null;
        $password = trim($_POST['password']) ?? null;

        // Validaciones
        // username:
        if ( empty($username) ){
            $errors['username']['empty'] = "Debes introducir un nombre de usuario.<br>";
            $username = null;
        }

        // password:
        if ( empty($password) ){
            $errors['password']['empty'] = "Debes facilitar una contraseña.<br>";
        }
    
        if ( strlen($password) < 6 ) {
            $errors['password']['length'] = "La contraseña debe tener al menos 6 caracteres.<br>";
        }

        if( empty($errors) ){
            // Consulta para comprobar las credenciales del usuario
            $sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
            
            $login = mysqli_query($db, $sql);

            $guardar = mysqli_query($db, $sql);

            if( $login && mysqli_num_rows($login)==1 ){
                $usuario = mysqli_fetch_assoc($login);
        
                // Comprobar la contraseña
                if( password_verify($password, $usuario['password']) ) {
                    // Guardar login
                    guardarLogin($db, $username, 'OK');

                    // Utilizar una sesión para guardar los datos del usuario logueado
                    $_SESSION['usuario'] = $usuario;
                    header("Location: ".BASE_URL.'my_lists');
                }else{
                    // Guardar login si la contraseña no es correcta
                    guardarLogin($db, $username, 'WRONG_PASS');

                    // Si algo falla enviar una sesión con el fallo
                    $errors['login']['password'] = "La contraseña no es correcta.";
                }
            }else{
                // Guardar login sin el usuario no es correcto
                guardarLogin($db, $username, 'WRONG_USER');
                $errors['login']['data'] = "Los datos no son correctos.";
            }  
        }
    }

    require_once 'login.view.php';