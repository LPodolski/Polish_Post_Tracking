<?php

/**
 * Autoload for Polish Post tracking
 */
spl_autoload_register(function( $_className ) {

	// check if this is autoloader for this class name
	if( ! substr( $_className, 0, 18 ) == 'PolishPostTracking\\' ) {
		return false;
	}

	// class name from camelCase to underscore + .php
	$fileName = strtolower(
					preg_replace( '/([a-z])([A-Z])/', '$1_$2', $_className )
				)
				. '.php';

	if( file_exists( $fileName ) ) {
		include $fileName;

		return class_exists( $_className, false ) || interface_exists( $_className, false );
	} else {
		return false;
	}
});