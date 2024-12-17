<?php
class MT_Addons_Premium_Lottie_Animation extends \Elementor\Widget_Base {
    public function get_style_depends() {
        wp_enqueue_style( 'mt-addons-premium-lottie-animation', plugin_dir_url( __FILE__ ).'css/lottie-animation.css');
        return [
            'mt-addons-premium-lottie-animation',
        ];
    }

    public function get_script_depends() {
        wp_enqueue_script( 'lottie-player', plugin_dir_url( __FILE__ ).'js/lottie-player.js', array('jquery', 'elementor-frontend'), '1.0.0', true );   
        return [ 'jquery', 'elementor-frontend', 'lottie-player' ];
    }

    public function get_name()
    {
        return 'mtap-lottie-animation';
    }

    public function get_title()
    {
        return esc_html__('MT Lottie Animation', 'mt-addons');
    }

    public function get_icon() {
        return 'eicon-product-categories';
    }

    public function get_categories() {
        return [ 'mt-addons-premium' ];
    }

    public function get_keywords() {
        return [ 'lottie', 'lottie animation', 'animation' ];
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
            'json',
            [
                'label'       => __( 'Animation JSON URL', 'mt-addons' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default'     => 'https://assets.codepen.io/265602/dessin.json',
                'description' => 'Get JSON code URL from <a href="https://lottiefiles.com/" target="_blank">here</a>',
                'label_block' => true,
            ]
        );
        $this->add_control(
            'width_height',
            [
                'label' => esc_html__( 'Width/Height', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 30,
                        'max' => 800,
                        'step' => 5,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 200,
                ],
            ]
        );
        $this->add_control(
            'speed',
            [
                'label' => esc_html__( 'Speed', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0.1,
                        'max' => 3,
                        'step' => 0.1,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0.5,
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings           = $this->get_settings_for_display();
        $json           = $settings['json'];
        $id = uniqid('mtap-lottie-animation-');
        $width = $settings['width_height']['size'];
        ?>

        <lottie-player class="mtap-lottie-animation" style="height:<?php echo esc_attr($width); ?>px;width:<?php echo esc_attr($width); ?>px;" src="<?php echo esc_url($json); ?>" background="transparent" speed="<?php echo esc_attr($settings['speed']['size']); ?>" loop autoplay data-el-id="<?php echo esc_attr($id); ?>"></lottie-player>

        <?php
    }

    protected function content_template() {}
}


