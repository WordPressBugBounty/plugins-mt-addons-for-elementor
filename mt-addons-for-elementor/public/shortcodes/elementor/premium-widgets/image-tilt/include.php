<?php 
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function mt_addons_premium_image_tilt_widget_register( $widgets_manager ) {
	// load
  require_once(MT_ADDONS_PREMIUM_PLUGIN_BASE.'image-tilt/class-image-tilt-widget-elementor.php');
	// register
	$widgets_manager->register( new \MT_Addons_Premium_Image_Tilt() );
}
add_action( 'elementor/widgets/register', 'mt_addons_premium_image_tilt_widget_register' );
