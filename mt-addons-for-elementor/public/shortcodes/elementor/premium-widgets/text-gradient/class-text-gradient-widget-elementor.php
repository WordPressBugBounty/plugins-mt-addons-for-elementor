<?php
class MT_Addons_Premium_Text_Gradient extends \Elementor\Widget_Base {
    public function get_style_depends() {
        wp_enqueue_style( 'mt-addons-premium-text-gradient', plugin_dir_url( __FILE__ ).'css/text-gradient.css');
        return [
            'mt-addons-premium-text-gradient',
        ];
    }

    public function get_name()
    {
        return 'mtap-text-gradient';
    }

    public function get_title()
    {
        return esc_html__('MT Text Gradient', 'mt-addons');
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
                'default'           => esc_html__( 'Upgrade your experience with our VIP membership benefits package.', 'mt-addons' ),
            ]
        );
        $this->add_control(
            'alignment',
            [
                'label'             => esc_html__( 'Alignment', 'mt-addons' ),
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
                    '{{WRAPPER}} .mt-addons-premium-text-gradient' => 'text-align: {{VALUE}};',
                ],  
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'              => 'background',
                'label'             => esc_html__( 'Background', 'mt-addons' ),
                'types'             => [ 'gradient' ],
                'selector'          => '{{WRAPPER}} .mt-addons-premium-text-gradient .mt-addons-premium-text-gradient-element',
                'default'           => 'gradient',
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
                'default'           => 'div',
            ]
        ); 
        $this->add_control(
            'font_size',
            [
                'label' => esc_html__( 'Custom Font Size', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 250,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-premium-text-gradient .mt-addons-premium-text-gradient-element' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings           = $this->get_settings_for_display();
        $text          = $settings['text'];
        $tag          = $settings['tag'];
        ?>

        <div class="mt-addons-premium-text-gradient">
            <<?php echo \Elementor\Utils::validate_html_tag($tag); ?> class="mt-addons-premium-text-gradient-element"><?php echo esc_html($text); ?></<?php echo \Elementor\Utils::validate_html_tag($tag); ?>>
        </div>
        <?php
    }

    protected function content_template() {}
}


