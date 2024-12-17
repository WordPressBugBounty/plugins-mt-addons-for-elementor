<?php
class MT_Addons_Premium_Image_Tilt extends \Elementor\Widget_Base {
    public function get_style_depends() {
        wp_enqueue_style( 'mt-addons-premium-image-tilt', plugin_dir_url( __FILE__ ).'css/image-tilt.css');
        
        return [
            'mt-addons-premium-image-tilt',
        ];
    }

    public function get_script_depends() {
        wp_enqueue_script( 'tilt', plugin_dir_url( __FILE__ ).'js/tilt.jquery.min.js', array('jquery', 'elementor-frontend'), '1.0.0', true );   
        return [ 'jquery', 'elementor-frontend', 'tilt' ];
    }


    public function get_name()
    {
        return 'mtap-image-tilt';
    }

    public function get_title()
    {
        return esc_html__('MT Image Tilt', 'mt-addons');
    }

    public function get_icon() {
        return 'eicon-product-categories';
    }

    public function get_categories() {
        return [ 'mt-addons-premium' ];
    }

    public function get_keywords() {
        return [ 'image tilt', 'tilt' ];
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
            'image',
            [
                'label' => esc_html__( 'Image', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'radius',
            [
                'label' => esc_html__( 'Image Radius', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ]
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-premium-image-tilt' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'selector' => '{{WRAPPER}} .mt-addons-premium-image-tilt',
            ]
        );
        $this->add_control(
            'tilt_options',
            [
                'label' => esc_html__( 'Tilt Options', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'axis',
            [
                'label' => esc_html__( 'Axis', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'xy',
                'options' => [
                    'xy' => esc_html__( 'Default (X/Y)', 'mt-addons' ),
                    'x' => 'X',
                    'y'  => 'Y',
                ],
            ]
        );
        $this->add_control(
            'perspective',
            [
                'label' => esc_html__( 'Perspective', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 500,
                        'max' => 5000,
                        'step' => 500,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 1000,
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
                        'min' => 100,
                        'max' => 1000,
                        'step' => 100,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 300,
                ],
            ]
        );
       
        $this->add_control(
            'glare',
            [
                'label' => esc_html__( 'Glare', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'mt-addons' ),
                'label_off' => esc_html__( 'No', 'mt-addons' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'maxglare',
            [
                'label' => esc_html__( 'Max Glare', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => 0.1,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0.3,
                ],
                'condition' => [
                    'glare' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'scale',
            [
                'label' => esc_html__( 'Scale', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 2,
                        'step' => 0.1,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 1.0,
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $image_src = wp_get_attachment_image_url( $settings['image']['id'], 'full' );
        $atts = '';

        // glare
        $glare = $settings['glare'];
        if ($glare == 'yes') {
            $atts .= ' data-tilt-glare="true" ';
        }
        // max glare
        $maxglare = $settings['maxglare'];
        if ($maxglare) {
            $atts .= ' data-tilt-maxglare="'.esc_attr($maxglare['size']).'" ';
        }
        // speed
        $speed = $settings['speed'];
        if ($speed) {
            $atts .= ' data-tilt-speed="'.esc_attr($speed['size']).'" ';
        }
        // scale
        $scale = $settings['scale'];
        if ($scale) {
            $atts .= ' data-tilt-scale="'.esc_attr($scale['size']).'" ';
        }
        // perspective
        $perspective = $settings['perspective'];
        if ($perspective) {
            $atts .= ' data-tilt-perspective="'.esc_attr($perspective['size']).'" ';
        }
        // axis
        $axis = $settings['axis'];
        if ($axis != 'xy') {
            $atts .= ' data-tilt-axis="'.esc_attr($axis).'" ';
        }
        ?>
            <div class="mt-addons-premium-image-tilt tilt" data-tilt <?php echo $atts; ?>>
                <img src="<?php echo esc_url($image_src); ?>" alt="image" />
            </div>
        <?php
    }

    protected function content_template() {}
}


