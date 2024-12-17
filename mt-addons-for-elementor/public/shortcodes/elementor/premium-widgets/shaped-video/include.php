<?php 
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function mt_addons_premium_shaped_video_widget_register( $widgets_manager ) {
	// load
  require_once(MT_ADDONS_PREMIUM_PLUGIN_BASE.'shaped-video/class-shaped-video-widget-elementor.php');
	// register
	$widgets_manager->register( new \MT_Addons_Premium_Shaped_Video() );
}
add_action( 'elementor/widgets/register', 'mt_addons_premium_shaped_video_widget_register' );
 