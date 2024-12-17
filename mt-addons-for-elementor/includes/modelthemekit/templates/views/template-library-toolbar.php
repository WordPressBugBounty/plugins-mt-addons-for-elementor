<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<script type="text/template" id="mtkit-TemplateLibrary_template">
	<div class="modelthemekitTemplate_template-body" id="liteTemplate-{{ template_id }}">
		<div class="modelthemekitTemplate_template-preview">
			<i class="eicon-zoom-in-bold" aria-hidden="true"></i>
		</div>
		<img class="modelthemekitTemplate_template-thumbnail" src="{{ thumbnail }}">
		<# if ( obj.isPro ) { #>
		<span class="modelthemekitTemplate_template-badge"><?php esc_html_e( 'Pro', 'mtkit' ); ?></span>
		<# } #>
		<div class="modelthemekitTemplate_template-name">{{{ title }}}</div>
	</div>
	<div class="modelthemekitTemplate_template-footer">
		{{{ mtkit.library.getModal().getTemplateActionButton( obj ) }}}

	</div>
</script>