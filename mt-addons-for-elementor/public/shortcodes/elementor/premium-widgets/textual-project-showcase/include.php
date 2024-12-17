<?php 
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function mt_addons_premium_textual_project_showcase_widget_register( $widgets_manager ) {
	// load
  require_once(MT_ADDONS_PREMIUM_PLUGIN_BASE.'textual-project-showcase/class-textual-project-showcase-widget-elementor.php');
	// register
	$widgets_manager->register( new \MT_Addons_Premium_Textual_Project_Showcase() );
}
add_action( 'elementor/widgets/register', 'mt_addons_premium_textual_project_showcase_widget_register' );
