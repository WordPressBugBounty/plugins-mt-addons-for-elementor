<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

use MT_Addons\includes\ContentControlSlider;
use MT_Addons\includes\ContentControlHelp;

class mt_addons_products_category extends Widget_Base {
	public function get_style_depends() {
   	 	wp_enqueue_style( 'mt-addons-products-category', MT_ADDONS_PUBLIC_ASSETS.'css/products-category.css');
      	wp_enqueue_style( 'swiper-bundle', MT_ADDONS_PUBLIC_ASSETS.'css/plugins/swiperjs/swiper-bundle.min.css');

        return [
            'mt-addons-products-category',
            'swiper-bundle',
        ];
    }
	use ContentControlSlider;
	use ContentControlHelp;
	
	public function get_name() {
		return 'mtfe-products-category';
	}
	
	public function get_title() {
		return esc_html__('MT - Products Category','mt-addons');
	}
	
	public function get_icon() {
		return 'eicon-product-categories';
	}
	
	public function get_categories() {
		return [ 'mt-addons-widgets' ];
	}
	public function get_script_depends() {
        wp_register_script( 'swiper', MT_ADDONS_PUBLIC_ASSETS.'js/plugins/swiperjs/swiper-bundle.min.js');
        wp_register_script( 'mt-addons-swiper', MT_ADDONS_PUBLIC_ASSETS.'js/swiper.js');
        
        return [ 'jquery', 'elementor-frontend', 'swiper', 'mt-addons-swiper' ];
    }
	protected function register_controls() {

        $this->section_title();
        $this->section_slider_hero_settings();
        $this->section_help_settings();
    }
    private function section_title() {

        $this->start_controls_section(
            'section_title',
            [
                'label' => esc_html__( 'Content', 'mt-addons' ),
            ]
        );
		$this->add_control(
			'featured_image_size',
				[
					'label' => __( 'Featured Image size', 'mt-addons' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => mt_addons_image_sizes_array(),
				]
		);
		$this->add_control(
			'image_status',
			[
				'label' => __( 'Enable/Disable Category Image', 'mt-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'mt-addons' ),
				'label_off' => __( 'Hide', 'mt-addons' ),
			]
		);
		$this->add_control(
			'btn_style',
			[
				'label' => __( 'Shape', 'mt-addons' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'btn-square' 	=> __( 'Square (Default)', 'mt-addons' ),
					'btn-rounded' 		=> __( 'Rounded (5px Radius)', 'mt-addons' ),
					'btn-round' 		=> __( 'Round (30px Radius)', 'mt-addons' ),
				],
				'condition' => [
					'image_status' => '',
				],
			]
		);
		$product_category = array();
	    if ( class_exists( 'WooCommerce' ) ) {
	      $product_category_tax = get_terms( 'product_cat', array(
	        'parent'      => 0,
	        'hide_empty'      => 1,
	      ));
	      if ($product_category_tax) {
	        foreach ( $product_category_tax as $term ) {
	          if ($term) {
	             $product_category[$term->slug] = $term->name.' ('.$term->count.')';
	          }
	        }
	      }
	    }

	    $repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'category',
				[
					'label' => __( 'Category', 'mt-addons' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => $product_category,
				]
		);
		$repeater->add_control(
			'bg_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Background color', 'mt-addons' ),
				'label_block' => true,

			]
		);
		$this->add_control(
	        'collectors_groups',
	        [
	            'label' => esc_html__('Items', 'mt-addons'),
	            'type' => \Elementor\Controls_Manager::REPEATER,
	            'fields' => $repeater->get_controls()
	        ]
	    );
	
		$this->end_controls_section();
	}
	protected function render() {
        $settings 					= $this->get_settings_for_display();
        // $number 					= $settings['number'];
        $featured_image_size 		= $settings['featured_image_size'];
        $collectors_groups 			= $settings['collectors_groups'];
        // $category 					= $settings['category'];
		//carousel
        $autoplay 					= $settings['autoplay'];
        $delay 					    = $settings['delay'];
        $items_desktop 				= $settings['items_desktop'];
        $items_mobile 				= $settings['items_mobile'];
        $items_tablet 				= $settings['items_tablet'];
        $space_items 				= $settings['space_items'];
        $touch_move 				= $settings['touch_move'];
        $effect 					= $settings['effect'];
        $grab_cursor 				= $settings['grab_cursor'];
        $infinite_loop 				= $settings['infinite_loop'];
        // $carousel 					= $settings['carousel'];
        $columns 					= $settings['columns'];
        $layout 					= $settings['layout'];
        $centered_slides 			= $settings['centered_slides'];
        // $select_navigation 			= $settings['select_navigation'];
        $navigation_position 		= $settings['navigation_position'];
        $nav_style 					= $settings['nav_style'];
        $navigation_color 			= $settings['navigation_color'];
        $navigation_bg_color 		= $settings['navigation_bg_color'];
        // $navigation_bg_color_hover 	= $settings['navigation_bg_color_hover'];
        // $navigation_color_hover 	= $settings['navigation_color_hover'];
        // $pagination_color 			= $settings['pagination_color'];
        $navigation 				= $settings['navigation'];
        $pagination 				= $settings['pagination'];
        $image_status 				= $settings['image_status'];
        $btn_style 					= $settings['btn_style'];




	    $id = 'mt-addons-carousel-'.uniqid();
	    $carousel_item_class = $columns;
	    $carousel_holder_class = '';
	    $swiper_wrapped_start = '';
	    $swiper_wrapped_end = '';
	    $swiper_container_start = '';
	    $swiper_container_end = '';
	    $html_post_swiper_wrapper = '';

	    if ($layout == "carousel" or $layout == " ") {
	    	$carousel_holder_class = 'mt-addons-swipper swiper';
	    	$carousel_item_class = 'swiper-slide';
	    	$swiper_wrapped_start = '<div class="swiper-wrapper">';
	    	$swiper_wrapped_end = '</div>';
	    	$swiper_container_start = '<div class="mt-addons-swiper-container">';
	    	$swiper_container_end = '</div>';
	      
	    	if($navigation == "yes") { 
	        	// next/prev
	        	$html_post_swiper_wrapper .= '
	        	<i class="fas fa-arrow-left swiper-button-prev '.esc_attr($nav_style).' '.esc_attr($navigation_position).'"></i>
	        	<i class="fas fa-arrow-right swiper-button-next '.esc_attr($nav_style).' '.esc_attr($navigation_position).'"></i>';
	      	}
	      	if($pagination == "yes") { 
	        	// pagination
	        	$html_post_swiper_wrapper .= '<div class="swiper-pagination"></div>';
	      	}
	    }
	   ?>
		<?php echo wp_kses_post($swiper_container_start); ?>
    <div class="mt-swipper-carusel-position" style="position:relative;">

      <div id="<?php echo esc_attr($id); ?>" 
        <?php mt_addons_swiper_attributes($id, $autoplay, $delay, $items_desktop, $items_mobile, $items_tablet, $space_items, $touch_move, $effect, $grab_cursor, $infinite_loop, $centered_slides); ?>
        class="mt-addons-collectors-carusel <?php echo esc_attr($carousel_holder_class); ?> <?php echo esc_attr($style_var_value); ?>">

          <?php //swiper wrapped start ?>
          <?php echo wp_kses_post($swiper_wrapped_start); ?>
 
            <?php if ($collectors_groups) { ?>
              <?php foreach ($collectors_groups as $collector) {
                if (!array_key_exists('category', $collector)) {
                  $category = 'Uncategorized';
                }else{
                  $category = $collector['category'];
                }
                if (!array_key_exists('bg_color', $collector)) {
                    $bg_color = '';
                  }else{
                    $bg_color = $collector['bg_color'];
                  }
                $cat   = get_term_by('slug', $category, 'product_cat');
                if($cat) {
                $cat_link  = get_term_link( $category, 'product_cat' );
                $cat_img_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );  
                $args_prods = array(
                    'posts_per_page'   => 1,
                    'order'            => 'ASC',
                    'post_type'        => 'product',
                    'tax_query' => array(
                      array(
                          'taxonomy' => 'product_cat',
                          'field' => 'slug',
                          'terms' => $category
                      )),
                    'post_status'      => 'publish' 
                ); 

                $prods = get_posts($args_prods); 
                $image_size = 'enefti_collections149x100';
                if ($featured_image_size) {
                  $image_size = $featured_image_size;
                }
                ?>

                <div class="<?php echo esc_attr($carousel_item_class); ?>">
                  <?php if ($image_status) { ?>

                  <div class="mt-addons-product-category-wrapper">
                    <?php 
                      $category_src = wp_get_attachment_image_src( $cat_img_id, $image_size );

                      if ($category_src) {
                          $post_img = '<img class="mt_addons_post_image" src="'. esc_url($category_src[0]) . '" alt="mt_addons_post_image" />';
                      }else{
                          $post_img = '<img class="mt_addons_post_image" src="http://via.placeholder.com/144x100" alt="'.$cat->post_title.'" />';
                      } ?>  
                      <a class="mt-addons-product-category" title="<?php echo esc_attr($cat->post_title);?>" href="<?php echo esc_url($cat_link);?>"><?php echo $post_img; ?></a>
                    <?php ?>
                  </div>
                  <?php } ?>
                  <div class="mt-addons-product-category-info-wrapper <?php echo esc_attr($btn_style);?>" <?php if($bg_color){?>style="background:<?php echo esc_attr($bg_color); ?>;" <?php } ?>>
                    <a class="#categoryid_<?php echo esc_attr($cat->term_id);?>" href="<?php echo esc_url($cat_link);?>"><span class="mt-addons-product-category-title"><?php echo esc_attr($cat->name);?></span></a>
                  </div> 
                </div>
              <?php } ?>
              <?php } ?>
            <?php } ?>
          <?php //swiper wrapped end ?>
          <?php echo wp_kses_post($swiper_wrapped_end); ?>
        <?php //pagination/navigation ?>
        <?php echo wp_kses_post($html_post_swiper_wrapper); ?>
      </div>
			   		<?php echo wp_kses_post($swiper_container_end); ?>
				</div>
	    <?php
		}



	protected function content_template() {
    }
}