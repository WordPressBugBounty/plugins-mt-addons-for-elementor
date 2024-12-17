<?php 
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function mt_addons_premium_animated_text_widget_register( $widgets_manager ) {
	// load
  require_once(MT_ADDONS_PREMIUM_PLUGIN_BASE.'animated-text/class-animated-text-widget-elementor.php');
	// register
	$widgets_manager->register( new \MT_Addons_Premium_Animated_Text() );
}
add_action( 'elementor/widgets/register', 'mt_addons_premium_animated_text_widget_register' );
