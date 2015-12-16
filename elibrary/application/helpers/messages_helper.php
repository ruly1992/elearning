<?php

function set_message($text, $type = 'success') {
	$CI =& get_instance();
	$CI->messages->add($text, $type);
}

function set_message_error($text) {
	set_message($text, 'error');
}

function set_message_success($text) {
	set_message($text, 'success');
}

function set_message_warning($text) {
	set_message($text, 'warning');
}

function keepValidationErrors() {
	$CI =& get_instance();

	$CI->messages->keepValidationErrors();
}

function show_message($type = null) {
	$CI =& get_instance();

	return $CI->messages->show($type);
}