<?php 
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function mt_addons_premium_blog_card_slider_widget_register( $widgets_manager ) {
	// load
  require_once(MT_ADDONS_PREMIUM_PLUGIN_BASE.'blog-card-slider/class-blog-card-slider-widget-elementor.php');
	// register
	$widgets_manager->register( new \MT_Addons_Premium_Blog_Card_Slider() );
}
add_action( 'elementor/widgets/register', 'mt_addons_premium_blog_card_slider_widget_register' );
