<?php
class MT_Addons_Premium_Blog_Card_Slider extends \Elementor\Widget_Base {
    public function get_style_depends() {
        wp_enqueue_style( 'mt-addons-premium-blog-card-slider', plugin_dir_url( __FILE__ ).'css/blog-card-slider.css');
        return [
            'mt-addons-premium-blog-card-slider' 
        ];
    }
    public function get_script_depends() {
        wp_register_script( 'mt-addons-premium-swiper-bundle', plugin_dir_url( __FILE__ ).'js/swiper-bundle.min.js');
        wp_register_script( 'mt-addons-premium-blog-card-slider', plugin_dir_url( __FILE__ ).'js/blog-card-slider.js');

        
        return [ 'jquery', 'elementor-frontend','mt-addons-premium-swiper-bundle', 'mt-addons-premium-blog-card-slider'];
    }
    public function get_name()
    {
        return 'mtap-blog-card-slider';
    }

    public function get_title()
    {
        return esc_html__('MT Blog Card Slider', 'mt-addons');
    }

    public function get_icon() {
        return 'eicon-slider-vertical';
    }

    public function get_categories() {
        return [ 'mt-addons-premium' ];
    }

    public function get_keywords() {
        return [ 'blog card slider', 'card' ];
    }

    protected function register_controls() {
        $this->all_controls();
    }

    private function all_controls() {
        $this->start_controls_section(
            'image_info',
            [
                'label'             => esc_html__('Image Settings', 'mt-addons'),
                'tab'               => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'bg_image',
                'label'    => esc_html__( 'Backgorund Image', 'mt-addons' ),
                'description' => 'My Description',  
                'show_label' => true, 
                'label_block' => true, 
                'types'    => [ 'gradient' ],
                'selector' => '{{WRAPPER}} .mapbcs-img:after',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'image_box_shadow',
                'selector' => '{{WRAPPER}} .mapbcs-img',
                'fields_options' =>
                [
                    'box_shadow_type' =>
                    [ 
                        'default' =>'yes' 
                    ],
                    'box_shadow' => [
                        'default' =>
                            [
                                'horizontal' => 4,
                                'vertical' => 13,
                                'blur' => 30,
                                'spread' => 1,
                                'color' => 'rgba(252,56,56,0.2)'
                            ]
                    ]
                ]
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'button_settings',
            [
                'label'             => esc_html__('Button Settings', 'mt-addons'),
                'tab'               => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'btn_color',
            [
                'label'             => esc_html__( 'Btn Text Color', 'mt-addons' ),
                'type'              => \Elementor\Controls_Manager::COLOR,
                'selectors'         => [
                    '{{WRAPPER}} .mapbcs-button' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'button_background',
                'label'    => esc_html__( 'Background Button', 'mt-addons' ),
                'description' => 'Background Button',  
                'show_label' => true, 
                'label_block' => true, 
                'types'    => [ 'gradient' ],
                'selector' => '{{WRAPPER}} .mapbcs-button',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'category_info',
            [
                'label'             => esc_html__('Content', 'mt-addons'),
                'tab'               => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'above_title', 
            [
                'label'         => esc_html__( 'Above title Text', 'mt-addons' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );
        $repeater->add_control(
            'title', 
            [
                'label'         => esc_html__( 'Title', 'mt-addons' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        ); 
        $repeater->add_control(
            'description',
            [
                'label' => esc_html__( 'Description', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Enter your content', 'mt-addons' ),
            ]
        );
        $repeater->add_control(
            'button_text', 
            [
                'label'         => esc_html__( 'Button text', 'mt-addons' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        ); 
        $repeater->add_control(
            'link', 
            [
                'label' => esc_html__( 'Link', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'mt-addons' ),
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'image',
            [
                'label' => esc_html__( 'Choose Image', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'bullet_color',
            [
                'label'             => esc_html__( 'Bullet Color', 'mt-addons' ),
                'type'              => \Elementor\Controls_Manager::COLOR,
                'selectors'         => [
                    '{{WRAPPER}} .mapbcs-pagination .swiper-pagination-bullet-active' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'items_groups',
            [    
                'label'             => esc_html__('Items', 'mt-addons'),
                'type'              => \Elementor\Controls_Manager::REPEATER,
                'fields'            => $repeater->get_controls(),
                'default'           => [ 
                    [
                        'above_title'     => esc_html__( '26 December 2023', 'mt-addons' ),
                        'title'           => esc_html__( 'How To Make Your Website', 'mt-addons' ),
                        'description'     => esc_html__( 'Quickly maximize timely deliverables for real-time schemas. Dramatically maintain clicks-and-mortar solutions.', 'mt-addons' ),
                        'button_text'     => esc_html__( 'Read More', 'mt-addons' ),
                        'link'            => esc_html__( '#', 'mt-addons' ),
                    ],
                    [
                        'above_title'     => esc_html__( '08 March 2024', 'mt-addons' ),
                        'title'           => esc_html__( 'Content And User Interface', 'mt-addons' ),
                        'description'     => esc_html__( 'Objectively innovate empowered manufactured products whereas parallel platforms. Holisticly predominate extensible. ', 'mt-addons' ),
                        'button_text'     => esc_html__( 'Read More', 'mt-addons' ),
                        'link'            => esc_html__( '#', 'mt-addons' ),
                    ],
                    [
                        'above_title'     => esc_html__( '08 March 2024', 'mt-addons' ),
                        'title'           => esc_html__( 'The Easy Landing Page Guide', 'mt-addons' ),
                        'description'     => esc_html__( ' Professionally cultivate one-to-one customer service with robust ideas. Dynamically innovate resource-leveling. ', 'mt-addons' ),
                        'button_text'     => esc_html__( 'Read More', 'mt-addons' ),
                        'link'            => esc_html__( '#', 'mt-addons' ),
                    ],
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings           = $this->get_settings_for_display();
        $items_groups       = $settings['items_groups'];
        ?>

        <div class="mapbcs">
            <div class="mapbcs-wrp swiper-wrapper">
                <?php if ($items_groups) { ?>
                    <?php foreach ($items_groups as $item) { 
                        $above_title         = $item['above_title'];
                        $title               = $item['title'];
                        $description         = $item['description'];
                        $button_text         = $item['button_text'];
                        $link                = $item['link']['url'];
                        $image               = $item['image']['url'];
                        ?>

                        <div class="mapbcs-item swiper-slide">
                            <div class="mapbcs-img">
                                <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_html($title); ?>">
                            </div>
                            <div class="mapbcs-content">
                                <span class="mapbcs-above-title"><?php echo esc_html($above_title); ?></span>
                                <div class="mapbcs-title"><?php echo esc_html($title); ?></div>
                                <div class="mapbcs-description"><?php echo esc_html($description); ?></div>
                                <a href="<?php echo esc_url($link); ?>" class="mapbcs-button"><?php echo esc_html($button_text);  ?></a>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="mapbcs-pagination"></div>
        </div>
        <?php
        if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
            ?>
            <script type="text/javascript">
                var swiper = new Swiper('.mapbcs', {
                    spaceBetween: 30,
                    effect: 'fade',
                    loop: true,
                    mousewheel: {
                        invert: false,
                    },
                    // autoHeight: true,
                    pagination: {
                        el: '.mapbcs-pagination',
                        clickable: true,
                    }
                });
            </script>
            <?php
        }
    }

    protected function content_template() {}
}