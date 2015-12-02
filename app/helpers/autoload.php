<?php

$pattern_helper = __DIR__ . '/*_helper.php';

foreach (glob($pattern_helper) as $helper) {
	include $helper;
}