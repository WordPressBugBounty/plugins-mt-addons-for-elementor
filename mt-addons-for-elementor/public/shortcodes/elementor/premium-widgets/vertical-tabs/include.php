<?php 
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function mt_addons_premium_vertical_tabs_widget_register( $widgets_manager ) {
	// load
  require_once(MT_ADDONS_PREMIUM_PLUGIN_BASE.'vertical-tabs/class-vertical-tabs-widget-elementor.php');
	// register
	$widgets_manager->register( new \MT_Addons_Premium_Vertical_Tab() );
}
add_action( 'elementor/widgets/register', 'mt_addons_premium_vertical_tabs_widget_register' );
