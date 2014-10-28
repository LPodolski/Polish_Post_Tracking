<?php

/**
 * Autoload for Polish Post tracking
 */
spl_autoload_register(
    function ($_className) {

        // check if this is autoloader for this class name
        if (!substr($_className, 0, 18) == 'PolishPostTracking\\') {
            return false;
        }

        // class name to path,  replace \ to / and add .php
        $fileName = str_replace('\\', '/', $_className) . '.php';

        if (file_exists($fileName)) {
            include $fileName;

            return class_exists($_className, false) || interface_exists($_className, false);
        } else {
            return false;
        }
    }
);