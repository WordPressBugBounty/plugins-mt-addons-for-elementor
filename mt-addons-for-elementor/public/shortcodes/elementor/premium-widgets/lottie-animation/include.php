<?php 
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function mt_addons_premium_lottie_animation_widget_register( $widgets_manager ) {
	// load
  require_once(MT_ADDONS_PREMIUM_PLUGIN_BASE.'lottie-animation/class-lottie-animation-widget-elementor.php');
	// register
	$widgets_manager->register( new \MT_Addons_Premium_Lottie_Animation() );
}
add_action( 'elementor/widgets/register', 'mt_addons_premium_lottie_animation_widget_register' );
