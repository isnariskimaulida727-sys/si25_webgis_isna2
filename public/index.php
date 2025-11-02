<?php

// Show all errors for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

/*
 *---------------------------------------------------------------
 * Path to the front controller (this file)
 *---------------------------------------------------------------
 */
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

use Config\Paths;
use CodeIgniter\Boot;

/*
 *---------------------------------------------------------------
 * CHECK PHP VERSION
 *---------------------------------------------------------------
 */
$minPhpVersion = '8.1'; // If you update this, don't forget to update spark.
if (version_compare(PHP_VERSION, $minPhpVersion, '<')) {
    $message = sprintf(
        'Your PHP version must be %s or higher to run CodeIgniter. Current version: %s',
        $minPhpVersion,
        PHP_VERSION
    );

    header('HTTP/1.1 503 Service Unavailable.', true, 503);
    echo $message;
    exit(1);
}

/*
 *---------------------------------------------------------------
 * LOAD OUR PATHS CONFIG FILE
 *---------------------------------------------------------------
 */
require FCPATH . '../app/Config/Paths.php';
$paths = new Paths();

/*
 *---------------------------------------------------------------
 * LOAD THE FRAMEWORK BOOTSTRAP FILE
 *---------------------------------------------------------------
 */
require $paths->systemDirectory . '/Boot.php';

exit(Boot::bootWeb($paths));