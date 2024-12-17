<?php 
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function mt_addons_premium_search_forms_widget_register( $widgets_manager ) {
	// load
  require_once(MT_ADDONS_PREMIUM_PLUGIN_BASE.'search-forms/class-search-forms-widget-elementor.php');
	// register
	$widgets_manager->register( new \MT_Addons_Premium_Search_Forms() ); 
}
add_action( 'elementor/widgets/register', 'mt_addons_premium_search_forms_widget_register' );
