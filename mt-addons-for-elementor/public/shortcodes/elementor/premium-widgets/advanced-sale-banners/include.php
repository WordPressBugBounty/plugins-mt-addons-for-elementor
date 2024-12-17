<?php 
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function mt_addons_premium_advanced_sale_banners_widget_register( $widgets_manager ) {
	// load
  require_once(MT_ADDONS_PREMIUM_PLUGIN_BASE.'advanced-sale-banners/class-advanced-sale-banners-widget-elementor.php');
	// register
	$widgets_manager->register( new \MT_Addons_Premium_Advanced_Sale_Banners() );
}
add_action( 'elementor/widgets/register', 'mt_addons_premium_advanced_sale_banners_widget_register' );
