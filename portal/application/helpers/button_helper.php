<?php

function button_create($link, $text = 'Add')
{
	$html = '<a href="'.site_url($link).'" class="btn btn-primary"><i class="fa fa-plus"></i> '.$text.'</a>';

	return $html;
}

function button_save($text = 'Save')
{
	$html = '<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> '.$text.'</button>';

	return $html;
}

function button_edit($link)
{
	$html = '<a href="'.site_url($link).'" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit</a>';

	return $html;
}

function button_delete($link, $size = 'xs')
{
	$html = '<a href="'.site_url($link).'" class="btn btn-danger btn-'.$size.' btn-delete"><i class="fa fa-trash-o"></i> Delete</a>';

	return $html;
}