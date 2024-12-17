<?php 
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function mt_addons_premium_hexagon_photo_widget_register( $widgets_manager ) {
	// load
  require_once(MT_ADDONS_PREMIUM_PLUGIN_BASE.'hexagon-photo/class-hexagon-photo-widget-elementor.php');
	// register
	$widgets_manager->register( new \MT_Addons_Premium_Hexagon_Photo() );
}
add_action( 'elementor/widgets/register', 'mt_addons_premium_hexagon_photo_widget_register' );
