<?php 
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function mt_addons_premium_scroll_reveal_image_widget_register( $widgets_manager ) {
	// load
  require_once(MT_ADDONS_PREMIUM_PLUGIN_BASE.'scroll-reveal-image/class-scroll-reveal-image-widget-elementor.php');
  
	// register
	$widgets_manager->register( new \MT_Addons_Premium_Scroll_Reveal_Image() );
}
add_action( 'elementor/widgets/register', 'mt_addons_premium_scroll_reveal_image_widget_register' );
