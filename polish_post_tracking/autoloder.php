<?php

/**
 * Autoload for Polish post tracking
 */
spl_autoload_register(function( $_className ) {

	// class name from camelCase to underscore
	$fileName = strtolower( preg_replace('/([a-z])([A-Z])/', '$1_$2', $_className ) );

	require_once $fileName . '.php';
});