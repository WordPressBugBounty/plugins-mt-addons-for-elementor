<?php 
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function mt_addons_premium_stacked_photos_widget_register( $widgets_manager ) {
	// load
  require_once(MT_ADDONS_PREMIUM_PLUGIN_BASE.'stacked-photos/class-stacked-photos-widget-elementor.php');
	// register
	$widgets_manager->register( new \MT_Addons_Premium_Stacked_Photos() );
}
add_action( 'elementor/widgets/register', 'mt_addons_premium_stacked_photos_widget_register' );
