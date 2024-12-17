<?php 
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function mt_addons_premium_list_item_widget_register( $widgets_manager ) {
	// load
  require_once(MT_ADDONS_PREMIUM_PLUGIN_BASE.'list-item/class-list-item-widget-elementor.php');
	// register
	$widgets_manager->register( new \MT_Addons_Premium_List_Item() );
}
add_action( 'elementor/widgets/register', 'mt_addons_premium_list_item_widget_register' );
