<?php

defined( 'ABSPATH' ) || die();

class MT_Addons_Premium_Services_Carousel extends \Elementor\Widget_Base {

    public function get_style_depends() {
        wp_enqueue_style( 'mt-addons-premium-services_carousel', plugin_dir_url( __FILE__ ).'css/services-carousel.css');
        return [ 
            'mt-addons-premium-services-carousel',
        ];
    }

    public function get_script_depends() {
        
        wp_register_script( 'mt-owl-carousel', plugin_dir_url( __FILE__ ).'js/mt.owl.carousel.js');
        wp_register_script( 'mt-addons-premium-services-carousel', plugin_dir_url( __FILE__ ).'js/services-carousel.js');
        
        return [ 'jquery', 'elementor-frontend', 'mt-owl-carousel', 'mt-addons-premium-services-carousel' ];
    }

    public function get_name()
    {
        return 'mtap-services-slider';
    }

    public function get_title()
    {
        return esc_html__('MT Services Carousel', 'mt-addons');
    }

    public function get_icon() {
        return 'eicon-slider-push';
    }

    public function get_categories() {
        return [ 'mt-addons-premium' ];
    }

    public function get_keywords() {
        return [ 'services carousel', 'carousel', 'services'];
    }

    protected function register_controls() {
        $this->all_controls();
    }

    private function all_controls() {
        $this->start_controls_section(
            'category_info',
            [
                'label'             => esc_html__('Content', 'mt-addons'),
                'tab'               => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'visible_items',
            [
                'label' => __( 'Visible items', 'mt-addons' ),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                  '3' => __( '3 items', 'mt-addons' ),
                  '4' => __( '4 items', 'mt-addons' ),
                  '5' => __( '5 items', 'mt-addons' ),
                ]
            ]
        );
        $this->add_control(
          'color_title',
          [
            'type'        => \Elementor\Controls_Manager::COLOR,
            'label'       => esc_html__( 'Color', 'mt-addons' ),
            'default'       => '#111111',
            'selectors' => [
                  '{{WRAPPER}} .mt-addons-premium-services-carousel .owl-item .mt-addons-premium-services-name a' => 'color: {{VALUE}};',
              ],
          ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background_gradient',
                'types' => [ 'gradient'],
                'selector' => '{{WRAPPER}} .mt-addons-premium-services-carousel.owl-theme .services-shadow-overlay',
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'title', 
            [
                'label'             => esc_html__( 'Title', 'mt-addons' ),
                'label_block'       => true,
                'type'              => \Elementor\Controls_Manager::TEXT,
                'default'           => esc_html__( 'Title', 'mt-addons' ),
            ]
        );
        $repeater->add_control(
            'link',
            [
                'label' => esc_html__( 'Link', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::URL,
                'options' => [ 'url', 'is_external', 'nofollow' ],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'services_groups',
            [    
                'label'             => esc_html__('Carousel Items', 'mt-addons'),
                'type'              => \Elementor\Controls_Manager::REPEATER,
                'fields'            => $repeater->get_controls(),
                'default'           => [ 
                    [                      
                        'title'     => esc_html__( 'Optimization Search', 'mt-addons' ),
                        'link'      => esc_url( '#', 'mt-addons' ),
                       
                    ],
                    [
                        'title'     => esc_html__( 'Development Ideas', 'mt-addons' ),
                        'link'      => esc_url( '#', 'mt-addons' ),
                    ],
                    [
                        'title'     => esc_html__( 'Design Inspiration', 'mt-addons' ),
                        'link'      => esc_url( '#', 'mt-addons' ),
                    ],
                    [
                        'title'     => esc_html__( 'Optimization Search', 'mt-addons' ),
                        'link'      => esc_url( '#', 'mt-addons' ),
                    ],
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings               = $this->get_settings_for_display();
        $visible_items          = $settings['visible_items'];
        $services_groups        = $settings['services_groups'];
        ?>
        <div class="mt-addons-premium-services-carousel-<?php echo esc_attr($visible_items); ?>  mt-addons-premium-services-carousel">
            <?php //services ?>
            <?php if ($services_groups) { ?>
                <?php foreach ($services_groups as $service) {
                    $title   = $service['title'];
                    $link    = $service['link']['url'];
                    ?> 
                    <div class="item mt-addons-premium-service">
                        <h3 class="mt-addons-premium-services-name">
                            <a href="<?php echo esc_url($link);?>"><?php echo esc_html($service['title']);?></a>
                        </h3>
                        <div class="mt-addons-premium-services-icon">
                            <a href="<?php echo esc_url($link);?>">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M326.6 185.4c59.7 59.8 58.9 155.7 .4 214.6-.1 .1-.2 .3-.4 .4l-67.2 67.2c-59.3 59.3-155.7 59.3-215 0-59.3-59.3-59.3-155.7 0-215l37.1-37.1c9.8-9.8 26.8-3.3 27.3 10.6 .6 17.7 3.8 35.5 9.7 52.7 2 5.8 .6 12.3-3.8 16.6l-13.1 13.1c-28 28-28.9 73.7-1.2 102 28 28.6 74.1 28.7 102.3 .5l67.2-67.2c28.2-28.2 28.1-73.8 0-101.8-3.7-3.7-7.4-6.6-10.3-8.6a16 16 0 0 1 -6.9-12.6c-.4-10.6 3.3-21.5 11.7-29.8l21.1-21.1c5.5-5.5 14.2-6.2 20.6-1.7a152.5 152.5 0 0 1 20.5 17.2zM467.5 44.4c-59.3-59.3-155.7-59.3-215 0l-67.2 67.2c-.1 .1-.3 .3-.4 .4-58.6 58.9-59.4 154.8 .4 214.6a152.5 152.5 0 0 0 20.5 17.2c6.4 4.5 15.1 3.8 20.6-1.7l21.1-21.1c8.4-8.4 12.1-19.2 11.7-29.8a16 16 0 0 0 -6.9-12.6c-2.9-2-6.6-4.9-10.3-8.6-28.1-28.1-28.2-73.6 0-101.8l67.2-67.2c28.2-28.2 74.3-28.1 102.3 .5 27.8 28.3 26.9 73.9-1.2 102l-13.1 13.1c-4.4 4.4-5.8 10.8-3.8 16.6 5.9 17.2 9 35 9.7 52.7 .5 13.9 17.5 20.4 27.3 10.6l37.1-37.1c59.3-59.3 59.3-155.7 0-215z"/></svg>
                            </a>
                        </div>
                        <div class="services-shadow-overlay">
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
        <?php
    }
    protected function content_template() {}

}