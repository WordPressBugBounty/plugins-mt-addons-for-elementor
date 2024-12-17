<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$logo =  MTKIT_TEMPLATE_LOGO_SRC; 
?>
<script type="text/template" id="mtkit-modelthemekitTemplate_header-logo">
	<span class="modelthemekitTemplate_logo-wrap">
		<img src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_html__('Template Logo','mtkit'); ?>" width="25">
	</span>
    <span class="modelthemekitTemplate_logo-title">{{{ title }}}</span>
</script>

<script type="text/template" id="mtkit-modelthemekitTemplate_header-back">
	<i class="eicon-" aria-hidden="true"></i>
	<span><?php echo esc_html__( 'Back to Library', 'mtkit' ); ?></span>
</script>

<script type="text/template" id="mtkit-TemplateLibrary_header-menu">
	<# _.each( tabs, function( args, tab ) { var activeClass = args.active ? 'elementor-active' : ''; #>
		<div class="elementor-component-tab elementor-template-library-menu-item {{activeClass}}" data-tab="{{{ tab }}}">{{{ args.title }}}</div>
	<# } ); #>
</script>

<script type="text/template" id="mtkit-TemplateLibrary_header-menu-responsive">
	
</script>

<script type="text/template" id="mtkit-TemplateLibrary_header-actions">
	<div id="modelthemekitTemplate_header-sync" class="elementor-templates-modal__header__item">
		<i class="eicon-sync" aria-hidden="true" title="<?php esc_attr_e( 'Sync Library', 'mtkit' ); ?>"></i>
		<span class="elementor-screen-only"><?php esc_html_e( 'Sync Library', 'mtkit' ); ?></span>
	</div>
</script>