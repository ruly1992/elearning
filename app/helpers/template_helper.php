<?php

if (!function_exists('get_view')) {
    function get_view($name = 'index', $data = [])
    {
        global $active, $slider, $custom_stylesheet, $custom_script;

        foreach ($data as $key => $value) {
            ${$key} = $value;
        }

        $filename = __DIR__.'/../template/'.$name.'.php';

        if (is_file($filename)) {
            return include($filename);
        }
        else
            throw new Exception("Template $name tidak ada.");

        return null;            
    }
}

if (!function_exists('get_header_slider')) {
    function get_header_slider($name = 'default', $data = [])
    {
        $data = array_merge($data, ['slider' => true]);

        return get_header($name, $data);
    }
}

if (!function_exists('get_header')) {
    function get_header($name = 'default', $data = [])
    {
        return get_view('header_'.$name, $data);
    }
}

if (!function_exists('get_footer')) {
    function get_footer($name = 'default', $data = [])
    {
        return get_view('footer_'.$name, $data);
    }
}

if (!function_exists('custom_stylesheet')) {
    function custom_stylesheet()
    {
        ob_start();
    }
}

if (!function_exists('endcustom_stylesheet')) {
    function endcustom_stylesheet()
    {
        global $custom_stylesheet;
        
        $custom_stylesheet .= ob_get_contents();

        ob_end_clean();
    }
}

if (!function_exists('custom_script')) {
    function custom_script()
    {
        ob_start();
    }
}

if (!function_exists('endcustom_script')) {
    function endcustom_script()
    {
        global $custom_script;
        
        $custom_script .= ob_get_contents();

        ob_end_clean();
    }
}