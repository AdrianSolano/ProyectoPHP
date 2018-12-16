<?php

function validationDiv($data, $type) {
    global $errors;

    $div = "";
    if( !empty($errors[$data]) ){
        
        $div .= ($type=="invalid-feedback"?
                    '<div class="invalid-feedback">':
                    '<div class="alert alert-danger" role="alert">');

        foreach ($errors[$data] as $error) {
            $div .= $error;
        }
        $div .= '</div>';
    }

    return $div;
}