<?php 
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function mt_addons_premium_services_carousel_widget_register( $widgets_manager ) {
	// load
  require_once(MT_ADDONS_PREMIUM_PLUGIN_BASE.'services-carousel/class-services-carousel-widget-elementor.php');
	// register
	$widgets_manager->register( new \MT_Addons_Premium_Services_Carousel() );
}
add_action( 'elementor/widgets/register', 'mt_addons_premium_services_carousel_widget_register' );
