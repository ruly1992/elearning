<?php

if (!function_exists('set_message')) {
    function set_message($text, $type = 'success') {
        $CI =& get_instance();
        $CI->messages->add($text, $type);
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
        $CI =& get_instance();

        $CI->messages->keepValidationErrors();
    }
}

if (!function_exists('show_message')) {
    function show_message($type = null) {
        $CI =& get_instance();

        return $CI->messages->show($type);
    }
}
