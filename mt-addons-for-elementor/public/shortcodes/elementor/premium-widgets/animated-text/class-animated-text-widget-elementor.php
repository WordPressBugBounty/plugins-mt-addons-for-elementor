<?php
class MT_Addons_Premium_Animated_Text extends \Elementor\Widget_Base {
    public function get_style_depends() {
        wp_enqueue_style( 'mt-addons-premium-animated-text', plugin_dir_url( __FILE__ ).'css/animated-text.css');
        return [
            'mt-addons-premium-animated-text',
        ];
    }

    public function get_script_depends() {
        wp_enqueue_script( 'mt-addons-premium-animated-text', plugin_dir_url( __FILE__ ).'js/animated-text.js' );   
        return [ 'jquery', 'elementor-frontend', 'mt-addons-premium-animated-text' ];
    }

    public function get_name()
    {
        return 'mtap-animated-text';
    }

    public function get_title()
    {
        return esc_html__('MT Animated Text', 'mt-addons');
    }

    public function get_icon() {
        return 'eicon-product-categories';
    }

    public function get_categories() {
        return [ 'mt-addons-premium' ];
    }

    public function get_keywords() {
        return [ 'text gradient', 'gradient' ];
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
            'text',
            [
                'label'             => esc_html__( 'Text', 'mt-addons' ),
                'type'              => \Elementor\Controls_Manager::TEXTAREA,
                'default'           => esc_html__( 'POWER ELITE', 'mt-addons' ),
            ]
        );
        $this->add_control(
            'alignment',
            [
                'label'             => esc_html__( 'Text Alignment', 'mt-addons' ),
                'type'              => \Elementor\Controls_Manager::CHOOSE,
                'options'           => [
                    'left'              => [
                        'title'         => esc_html__( 'Left', 'mt-addons' ),
                        'icon'          => 'eicon-text-align-left',
                    ],
                    'center'            => [
                        'title'         => esc_html__( 'Center', 'mt-addons' ),
                        'icon'          => 'eicon-text-align-center',
                    ],
                    'right'             => [
                        'title'         => esc_html__( 'Right', 'mt-addons' ),
                        'icon'          => 'eicon-text-align-right',
                    ],
                ],
                'default'           => 'left',
                'toggle'            => true,
                 'selectors'        => [
                    '{{WRAPPER}} .mt-addons-premium-animated-text' => 'text-align: {{VALUE}};',
                ],  
            ]
        );
        $this->add_control(
            'image',
            [
                'label' => esc_html__( 'Image', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-premium-animated-text .mt-addons-premium-animated-text-inner' => 'background-image: url("{{URL}}");',
                ],
            ]
        ); 
        $this->add_control(
            'tag',
            [ 
                'label'             => esc_html__( 'HTML Tag', 'mt-addons' ),
                'label_block'       => true,
                'type'              => \Elementor\Controls_Manager::SELECT,
                'options'           => [
                    'div'               => 'div',
                    'h1'                => 'h1',
                    'h2'                => 'h2',
                    'h3'                => 'h3',
                    'h4'                => 'h4',
                    'h5'                => 'h5',
                    'h6'                => 'h6',
                    'p'                 => 'p',
                    'span'               => 'span',

                ],
                'default'           => 'h2',
            ]
        );

        $this->add_control(
            'image_title',
            [
                'label' => esc_html__( 'Styling', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'animation_type',
            [
                'label' => esc_html__( 'Animation Type', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'mtap-loop',
                'options' => [
                    'mtap-loop' => esc_html__( 'Loop', 'textdomain' ),
                    'mtap-hover' => esc_html__( 'On Hover', 'textdomain' ),
                ],
            ]
        );
        $this->add_control(
            'speed',
            [
                'label' => esc_html__( 'Speed', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 's' ],
                'range' => [
                    's' => [
                        'min' => 1,
                        'max' => 20,
                        'step' => 1,
                    ]
                ],
                'default' => [
                    'unit' => 's',
                    'size' => 8,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-premium-animated-text.mtap-loop .mt-addons-premium-animated-text-inner' => 'animation: mtap-shine-animation {{SIZE}}s linear infinite;;',
                ],
                'condition' => [
                    'animation_type' => 'mtap-loop',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'selector' => '{{WRAPPER}} .mt-addons-premium-animated-text .mt-addons-premium-animated-text-inner',
            ]
        );
        $this->add_control(
            'text_shadow_title',
            [
                'label' => esc_html__( 'Text Shadow', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'text_shadow',
            [
                'label' => esc_html__( 'Text Shadow', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT_SHADOW,
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-premium-animated-text .mt-addons-premium-animated-text-inner' => 'text-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{COLOR}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings           = $this->get_settings_for_display();
        $text          = $settings['text'];
        $tag          = $settings['tag'];
        $animation_type          = $settings['animation_type'];
        ?>

        <div class="mt-addons-premium-animated-text <?php echo esc_attr($animation_type); ?>">
            <<?php echo \Elementor\Utils::validate_html_tag($tag); ?> class="mt-addons-premium-animated-text-inner"><?php echo esc_html($text); ?>
            </<?php echo \Elementor\Utils::validate_html_tag($tag); ?>>
        </div>
        <?php
    }

    protected function content_template() {}
}


