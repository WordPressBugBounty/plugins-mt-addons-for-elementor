<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

//Include Import
require_once('templates/import.php');
//Initialize
include( __DIR__ . '/templates/init.php');
//Load
include( __DIR__ . '/templates/load.php');
//Get Template Kits
include( __DIR__ . '/templates/api.php');

\ModelthemeKit\Templates\Import::instance()->load();
\ModelthemeKit\Templates\ModelthemeKit_Load::instance()->load();
\ModelthemeKit\Templates\ModelthemeKit_Templates::instance()->init();

if (!defined('TEMPLATE_LOGO_SRC')){
	define('TEMPLATE_LOGO_SRC', plugin_dir_url( __FILE__ ) . 'templates/assets/img/template_logo.png');
}

if (!defined('MTKIT_TEMPLATE_LOGO_SRC')){
    define('MTKIT_TEMPLATE_LOGO_SRC', plugin_dir_url( __FILE__ ) . 'templates/assets/img/logo-template.png');
}