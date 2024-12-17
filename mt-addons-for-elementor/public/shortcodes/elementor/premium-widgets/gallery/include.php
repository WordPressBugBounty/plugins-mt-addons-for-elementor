<?php 
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function mt_addons_premium_gallery_widget_register( $widgets_manager ) {
	// load
  require_once(MT_ADDONS_PREMIUM_PLUGIN_BASE.'gallery/class-gallery-widget-elementor.php');
	// register
	$widgets_manager->register( new \MT_Addons_Premium_Gallery() );
}
add_action( 'elementor/widgets/register', 'mt_addons_premium_gallery_widget_register' );
