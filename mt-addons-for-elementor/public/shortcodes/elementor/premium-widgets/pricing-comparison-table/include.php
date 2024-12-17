<?php 
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function mt_addons_premium_pricing_comparison_table_widget_register( $widgets_manager ) {
	// load
    require_once(MT_ADDONS_PREMIUM_PLUGIN_BASE.'pricing-comparison-table/class-pricing-comparison-table-widget-elementor.php');
	// register
	$widgets_manager->register( new \MT_Addons_Premium_Pricing_Comparison_Table() );
}
add_action( 'elementor/widgets/register', 'mt_addons_premium_pricing_comparison_table_widget_register' );
