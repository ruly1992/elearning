<?php

if (!function_exists('flash_messages')) {
    function flash_messages() {
        return new \Plasticbrain\FlashMessages\FlashMessages;
    }
}

if (!function_exists('set_message')) {
    function set_message($text, $type = 'success') {
        flash_messages()->add($text, $type);
    }
}

if (!function_exists('set_message_error')) {
    function set_message_error($text) {
        set_message($text, 'error');
    }
}

if (!function_exists('set_message_success')) {
    function set_message_success($text) {
        set_message($text, 'success');
    }
}

if (!function_exists('set_message_warning')) {
    function set_message_warning($text) {
        set_message($text, 'warning');
    }
}

if (!function_exists('keepValidationErrors')) {
    function keepValidationErrors() {        
        if (FALSE === ($OBJ =& _get_validation_object())) {
            // No action
        } else {
            $errors = $OBJ->error_array();

            foreach ($errors as $error) {
                set_message_error($error);
            }
        }
    }
}

if (!function_exists('show_message')) {
    function show_message($type = null) {
        return flash_messages()->display($type);
    }
}
