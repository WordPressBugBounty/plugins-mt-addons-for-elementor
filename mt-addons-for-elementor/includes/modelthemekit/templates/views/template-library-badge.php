<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<script type="text/template" id="mtkit_TemplateLibrary_templates">
	<div id="modelthemekitTemplate_toolbar">
		<div id="modelthemekitTemplate_toolbar-search">
			<label for="modelthemekitTemplate_search" class="elementor-screen-only"><?php esc_html_e( 'Search Templates:', 'mtkit' ); ?></label>
			<input id="modelthemekitTemplate_search" placeholder="<?php esc_attr_e( 'Search', 'mtkit' ); ?>">
			<i class="eicon-search"></i>
		</div>
		<div id="modelthemekitTemplate_toolbar-counter"></div>
		
		<div id="modelthemekitTemplate_toolbar-filter" class="modelthemekitTemplate_toolbar-filter">
			<# if (mtkit.library.getTypeTags()) { var selectedTag = mtkit.library.getFilter( 'tags' ); #>
				<# if ( selectedTag ) { #>
				<span class="modelthemekitTemplate_filter-btn">{{{ mtkit.library.getTags()[selectedTag] }}} <i class="eicon-caret-right"></i></span>
				<# } else { #>
				<span class="modelthemekitTemplate_filter-btn"><?php esc_html_e( 'Filter', 'mtkit' ); ?> <i class="eicon-caret-right"></i></span>
				<# } #>
				<ul id="modelthemekitTemplate_filter-tags" class="modelthemekitTemplate_filter-tags">
					<li data-tag=""><?php esc_html_e( 'All', 'mtkit' ); ?></li>
					<# _.each(mtkit.library.getTypeTags(), function(slug) {
						var selected = selectedTag === slug ? 'active' : '';
						#>
						<li data-tag="{{ slug }}" class="{{ selected }}">{{{ mtkit.library.getTags()[slug] }}}</li>
					<# } ); #>
				</ul>
			<# } #>
		</div>
	</div>

	<div class="modelthemekitTemplate_templates-window">
		<div id="modelthemekitTemplate_templates-list"></div>
	</div>
</script>