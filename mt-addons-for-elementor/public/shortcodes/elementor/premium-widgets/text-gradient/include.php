<?php 
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function mt_addons_premium_text_gradient_widget_register( $widgets_manager ) {
	// load
  require_once(MT_ADDONS_PREMIUM_PLUGIN_BASE.'text-gradient/class-text-gradient-widget-elementor.php');
	// register
	$widgets_manager->register( new \MT_Addons_Premium_Text_Gradient() );
}
add_action( 'elementor/widgets/register', 'mt_addons_premium_text_gradient_widget_register' );
