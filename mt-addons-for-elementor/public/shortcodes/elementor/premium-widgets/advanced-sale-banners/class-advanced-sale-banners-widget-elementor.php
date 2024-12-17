<?php
class MT_Addons_Premium_Advanced_Sale_Banners extends \Elementor\Widget_Base {
    public function get_style_depends() {
        wp_enqueue_style( 'mt-addons-premium-advanced-sale-banners', plugin_dir_url( __FILE__ ).'css/advanced-sale-banners.css');
        return [
            'mt-addons-advanced-sale-banners',
        ];
    }

    public function get_name()
    {
        return 'mtap-advanced-sale-banners';
    }

    public function get_title()
    {
        return esc_html__('MT Advanced Sale Banners', 'mt-addons');
    }

    public function get_icon() {
        return 'eicon-banner';
    }

    public function get_categories() {
        return [ 'mt-addons-premium' ];
    }

    public function get_keywords() {
        return [ 'advanced sale banners', 'banners' ];
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
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'          => 'container_background',
                'label'         => esc_html__( 'Container Background', 'mt-addons' ),
                'types'         => [ 'classic' ],
                'selector'      => '{{WRAPPER}} .mt-addons-premium-advanced-sale-banners-image',
            ]
        );
        $this->add_control(
            'background_image_position',
            [
                'label'                => esc_html__( 'Background Image Position', 'mt-addons' ),
                'type'                 => \Elementor\Controls_Manager::CHOOSE,
                'options'              => [
                    'left'  => [
                        'title' => esc_html__( 'Left', 'mt-addons' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'mt-addons' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'default'              => 'right',
                'selectors_dictionary' => [
                    'left'  => 'flex-flow: inherit',
                    'right' => 'flex-direction:row-reverse',
                ],
                'toggle'               => false,
                'selectors'            => [
                    '{{WRAPPER}} .mt-addons-premium-advanced-sale-banners-container' => '{{VALUE}}',
                ],
               
            ]
        );
        $this->add_control(
            'container_bg',
            [
                'type'              => \Elementor\Controls_Manager::COLOR,
                'label'             => esc_html__( 'Container Background', 'mt-addons' ),
                'selectors'         => [
                    '{{WRAPPER}} .mt-addons-premium-advanced-sale-banners-content' => 'background: {{VALUE}}',
                ],
                'default'           => '#E2E8E5',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_title',
            [
                'label'         => esc_html__('Title Section', 'mt-addons'),
                'tab'           => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'show_title',
            [
                'label'         => esc_html__( 'Show Title', 'mt-addons' ),
                'type'          => \Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'mt-addons' ),
                'label_off'     => esc_html__( 'Hide', 'mt-addons' ),
                'return_value'  => 'yes',
                'default'       => 'yes',
            ]
        );
        $this->add_control(
            'title',
            [
                'label'         => esc_html__( 'Title', 'mt-addons' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'default'       => esc_html__( 'Free Shipping', 'mt-addons' ),
                'placeholder'   => esc_html__( 'Type your title here', 'mt-addons' ),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .mt-addons-premium-advanced-sale-banners-text',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'type'              => \Elementor\Controls_Manager::COLOR,
                'label'             => esc_html__( 'Color', 'mt-addons' ),
                'selectors'         => [
                    '{{WRAPPER}} .mt-addons-premium-advanced-sale-banners-text' => 'color: {{VALUE}}',
                ],
                'default'           => '#111',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_btn',
            [
                'label'         => esc_html__('Button Section', 'mt-addons'),
                'tab'           => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'show_button',
            [
                'label'         => esc_html__( 'Show Button', 'mt-addons' ),
                'type'          => \Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'mt-addons' ),
                'label_off'     => esc_html__( 'Hide', 'mt-addons' ),
                'return_value'  => 'yes',
                'default'       => 'yes',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'selector' => '{{WRAPPER}} .mt-addons-premium-advanced-sale-banners-discount-btn',
            ]
        );
        $this->add_control(
            'text_color',
            [
                'type'              => \Elementor\Controls_Manager::COLOR,
                'label'             => esc_html__( 'Color', 'mt-addons' ),
                'selectors'         => [
                    '{{WRAPPER}} .mt-addons-premium-advanced-sale-banners-discount-btn' => 'color: {{VALUE}}',
                ],
                'default'           => '#ffffff',
            ]
        );
        $this->add_control(
            'text_color_hover',
            [
                'type'              => \Elementor\Controls_Manager::COLOR,
                'label'             => esc_html__( 'Color Hover', 'mt-addons' ),
                'selectors'         => [
                    '{{WRAPPER}} .mt-addons-premium-advanced-sale-banners-discount-btn:hover' => 'color: {{VALUE}}',
                ],
                'default'           => '#ffffff',
            ]
        );
        $this->add_control(
            'background_color',
            [
                'type'              => \Elementor\Controls_Manager::COLOR,
                'label'             => esc_html__( 'Background', 'mt-addons' ),
                'selectors'         => [
                    '{{WRAPPER}} .mt-addons-premium-advanced-sale-banners-discount-btn' => 'background-color: {{VALUE}}',
                ],
                'default'           => '#8F80AF',
            ]
        );
        $this->add_control(
            'background_color_hover',
            [
                'label'             => esc_html__( 'Background Hover', 'mt-addons' ),
                'type'              => \Elementor\Controls_Manager::COLOR,
                'selectors'         => [
                    '{{WRAPPER}} .mt-addons-premium-advanced-sale-banners-discount-btn:hover' => 'background-color: {{VALUE}}',
                ],
                'default'           => '#000000',
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'btn_title', [
                'label'         => esc_html__( 'Button Title', 'mt-addons' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'default'       => esc_html__( 'SHOP NOW' , 'mt-addons' ),
                'label_block'   => true,
            ]
        ); 
        $repeater->add_control(
            'button_link',
            [
                'label'         => esc_html__( 'Button Link', 'mt-addons' ),
                'type'          => \Elementor\Controls_Manager::URL,
                'placeholder'   => esc_html__( 'https://your-link.com', 'mt-addons' ),
                'options'       => [ 'url', 'is_external', 'nofollow' ],
                'default'       => [
                    'url'           => '',
                    'is_external'   => true,
                    'nofollow'      => true,
                ],
                'label_block'   => true,
            ]
        );
        $this->add_control(
            'btn_groups',
            [    
                'label'             => esc_html__('Button Items', 'mt-addons'),
                'type'              => \Elementor\Controls_Manager::REPEATER,
                'fields'            => $repeater->get_controls(),
                'default'           => [ 
                    [                      
                        'btn_title'               => esc_html__( 'SHOP NOW', 'mt-addons' ),
                        'button_link'             => esc_url( '#', 'mt-addons' ),
                    ],
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings       = $this->get_settings_for_display();
        $title          = $settings['title'];
        $btn_groups     = $settings['btn_groups'];

        ?>

        <div class="mt-addons-premium-advanced-sale-banners-container">
            <div class="mt-addons-premium-advanced-sale-banners-content">
                <?php if ( 'yes' === $settings['show_title'] ) { ?>
                    <div class="mt-addons-premium-advanced-sale-banners-text"><?php echo esc_html($title); ?></div>
                <?php } ?>
                <div class="mt-addons-premium-advanced-sale-banners-discount-btn-zone">
                    <?php
                    if ( 'yes' === $settings['show_button'] ) { ?>
                        <?php if ($btn_groups) { ?>
                            <?php foreach ($btn_groups as $btns) { 
                                $btn_title     = $btns['btn_title'];
                                $button_link   = $btns['button_link']['url'];

                                ?>
                                <a class="mt-addons-premium-advanced-sale-banners-discount-btn" href="<?php echo esc_url($button_link);?>"><?php echo esc_html($btns['btn_title']);?></a>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
            <div class="mt-addons-premium-advanced-sale-banners-image"></div>
        </div>
        <?php
    }

    protected function content_template() {}
}


