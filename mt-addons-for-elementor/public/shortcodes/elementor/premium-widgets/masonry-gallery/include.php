<?php 
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function mt_addons_premium_masonry_gallery_widget_register( $widgets_manager ) {
	// load
  require_once(MT_ADDONS_PREMIUM_PLUGIN_BASE.'masonry-gallery/class-masonry-gallery-widget-elementor.php');
	// register
	$widgets_manager->register( new \MT_Addons_Premium_Masonry_Gallery() );
}
add_action( 'elementor/widgets/register', 'mt_addons_premium_masonry_gallery_widget_register' );
