<?php 
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function mt_addons_premium_onepage_navigation_widget_register( $widgets_manager ) {
	// load
  require_once(MT_ADDONS_PREMIUM_PLUGIN_BASE.'onepage-navigation/class-onepage-navigation-widget-elementor.php');
	// register
	$widgets_manager->register( new \MT_Addons_Premium_OnePage_Navigation() );
}
add_action( 'elementor/widgets/register', 'mt_addons_premium_onepage_navigation_widget_register' );
