<?php 
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function mt_addons_premium_mailchimp_form_widget_register( $widgets_manager ) {
	// load
  require_once(MT_ADDONS_PREMIUM_PLUGIN_BASE.'mailchimp-form/class-mailchimp-form-widget-elementor.php');
	// register
	$widgets_manager->register( new \MT_Addons_Premium_Mailchimp_Form() );
}
add_action( 'elementor/widgets/register', 'mt_addons_premium_mailchimp_form_widget_register' );
