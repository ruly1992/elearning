<?php

if (!function_exists('button_create')) {
    function button_create($link, $text = 'Add')
    {
        $html = '<a href="'.site_url($link).'" class="btn btn-primary"><i class="fa fa-plus"></i> '.$text.'</a>';

        return $html;
    }
}

if (!function_exists('button_save')) {
    function button_save($text = 'Save')
    {
        $html = '<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> '.$text.'</button>';

        return $html;
    }
}

if (!function_exists('button_edit')) {
    function button_edit($link, $size = 'md')
    {
        if ($size == 'sm')
            $html = '<a href="'.site_url($link).'" class="label label-info"><i class="fa fa-pencil"></i> Edit</a>';
        else
            $html = '<a href="'.site_url($link).'" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>';

        return $html;
    }
}

if (!function_exists('button_delete')) {
    function button_delete($link)
    {
        $html = '<a href="'.site_url($link).'" class="label label-danger btn-delete"><i class="fa fa-trash-o"></i> Hapus</a>';

        return $html;
    }
}