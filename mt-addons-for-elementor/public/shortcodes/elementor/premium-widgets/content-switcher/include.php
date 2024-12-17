<?php 
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function mt_addons_premium_content_switcher_widget_register( $widgets_manager ) {
	// load
  require_once(MT_ADDONS_PREMIUM_PLUGIN_BASE.'content-switcher/class-content-switcher-widget-elementor.php');
	// register
	$widgets_manager->register( new \MT_Addons_Premium_Content_Switcher() );
}
add_action( 'elementor/widgets/register', 'mt_addons_premium_content_switcher_widget_register' );
