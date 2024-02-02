<?php 

// Report all errors except E_NOTICE
error_reporting(E_ALL & ~E_NOTICE);

// Minimum PHP requirement check 
$minPHPVersion = '7.4';
if (phpversion() < $minPHPVersion){
	die("Your PHP version must be {$minPHPVersion} or higher to run CodeIgniter. Current version: " . phpversion());
}

// Define framework basepath path
defined('FRAMEWORK_BASEPATH') OR define('FRAMEWORK_BASEPATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);

// Define absolute path
defined('ABSPATH') OR define('ABSPATH', dirname(__DIR__, 4) . DIRECTORY_SEPARATOR);

// Path to public folder, the main app entry point 
defined('PUBLIC_PATH') OR define('PUBLIC_PATH', ABSPATH . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR);

// Require procedual style helpers
require_once FRAMEWORK_BASEPATH . 'Common.php';

// Require autloader
require_once FRAMEWORK_BASEPATH . 'Autoloader.php';
