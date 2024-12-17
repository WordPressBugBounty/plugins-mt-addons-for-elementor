<?php
class MT_Addons_Premium_Countdown extends \Elementor\Widget_Base {
    public function get_style_depends() {
        wp_enqueue_style( 'mt-addons-premium-countdown', plugin_dir_url( __FILE__ ).'css/countdown.css');
        return [
            'mt-addons-premium-countdown',
        ];
    }
    public function get_script_depends() {
      wp_enqueue_script( 'mt-addons-premium-countdown', plugin_dir_url( __FILE__ ).'js/jquery.countdown.js' );   
      return [ 'jquery', 'elementor-frontend', 'countdown', 'mt-addons-premium-countdown' ];
    }
    public function get_name()
    {
        return 'mtap-countdown';
    }

    public function get_title()
    {
        return esc_html__('MT Countdown', 'mt-addons');
    }

    public function get_icon() {
        return 'eicon-countdown';
    }

    public function get_categories() {
        return [ 'mt-addons-premium' ];
    }

    public function get_keywords() {
        return [ 'countdown', 'mt-addons-premium-premium-countdown' ];
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
            'insert_date', 
            [
                'label'             => esc_html__( 'Date', 'mt-addons' ),
                'label_block'       => true,
                'type'              => \Elementor\Controls_Manager::TEXT,
                'default'           => esc_html__( '2024-07-20', 'mt-addons' ),
            ]
        );
        $this->add_responsive_control(
            'dots',
            [
                'label'             => esc_html__( 'Dots', 'mt-addons' ),
                'type'              => \Elementor\Controls_Manager::SWITCHER,
                'label_on'          => esc_html__( 'On', 'mt-addons' ),
                'label_off'         => esc_html__( 'Off', 'mt-addons' ),
                'return_value'      => 'none',
                'default'           => 'label_off',
                'selectors'         => [
                    '{{WRAPPER}} .mt-addons-premium-countdown > span' => 'display: {{label_on}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'              => 'digit_typography',
                'label'             => esc_html__( 'Digit Typography', 'mt-addons' ),
                'selector'          => '{{WRAPPER}} .mt-addons-premium-countdown div div:first-child',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'              => 'text_typography',
                'label'             => esc_html__( 'Text Typography', 'mt-addons' ),
                'selector'          => '{{WRAPPER}} .mt-addons-premium-countdown div div:last-child',
            ]
        );
        $this->add_control(
            'digit_color',
            [
                'type'              => \Elementor\Controls_Manager::COLOR,
                'label'             => esc_html__( 'Color of the digits', 'mt-addons' ),
                'label_block'       => true,
                'default'           => '#495153',
                'selectors'         => [
                    '{{WRAPPER}} .mt-addons-premium-countdown div div:first-child' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .mt-addons-premium-countdown span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'text_color',
            [
                'type'              => \Elementor\Controls_Manager::COLOR,
                'label'             => esc_html__( 'Color of the text', 'mt-addons' ),
                'label_block'       => true,
                'default'           => '#848685',
                'selectors'         => [
                    '{{WRAPPER}} .mt-addons-premium-countdown div div:last-child' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'background_digits',
            [
                'type'              => \Elementor\Controls_Manager::COLOR,
                'label'             => esc_html__( 'Background Digits', 'mt-addons' ),
                'label_block'       => true,
                'default'           => '#ffffff',
                'selectors'         => [
                    '{{WRAPPER}} .mt-addons-premium-countdown > div' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'selector' => '{{WRAPPER}} .mt-addons-premium-countdown > div',
            ]
        );
        $this->add_control(
            'digits_border_radius',
                [
                    'label'         => esc_html__( 'Border Radius Digits', 'mt-addons' ),
                    'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units'    => [ 'px', '%', 'em' ],
                    'selectors'     => [
                        '{{WRAPPER}} .mt-addons-premium-countdown > div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default'           => [
                    'unit'              => 'px',
                    'size'              => 5,
                ],
            ]
        );
        $this->add_control(
            'digits_padding',
            [
                'label'             => esc_html__( 'Padding Digits', 'mt-addons' ),
                'type'              => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'        => ['px', '%', 'em'],
                'default'           => [
                    'top'               => 12,
                    'right'             => 23,
                    'bottom'            => 12,
                    'left'              => 23,
                    'unit'              => 'px',
                    'isLinked'          => false,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .mt-addons-premium-countdown > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 
        $this->add_control(
            'margin',
            [
                'label' => esc_html__( 'Margin', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'default' => [
                    'top' => 12,
                    'right' => 23,
                    'bottom' => 12,
                    'left' => 23,
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-premium-countdown > div' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'width',
            [
                'label' => esc_html__( 'Width', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-premium-countdown > div' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        ); 
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'              => 'box_shadow',
                'label'             => esc_html__( 'Box Shadow', 'mt-addons' ),
                'selector'          => '{{WRAPPER}} .mt-addons-premium-countdown > div',
                'fields_options'    =>
                [
                    'box_shadow_type' =>
                    [ 
                        'default' =>'yes' 
                    ],
                    'box_shadow' => [
                        'default' =>
                        [
                            'horizontal' => 0,
                            'vertical' => 0,
                            'blur' => 25,
                            'spread' => 0,
                            'color' => 'rgba(0,0,0,0.1)'
                        ]
                    ]
                ]
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings           = $this->get_settings_for_display();
        $insert_date        = $settings['insert_date'];
        
        $uniqueID = 'countdown_'.uniqid();

        ?>

        <div class="mt-addons-premium-countdown" id="<?php echo esc_attr($uniqueID); ?>">
        <script type="text/javascript">
          jQuery( document ).ready(function() {
            jQuery("#<?php echo esc_attr($uniqueID); ?>").countdown("<?php echo esc_attr($insert_date); ?>", function(event) {
              jQuery(this).html(
                event.strftime("<div class=\'days\'><div class=\'days-digit\'>%D</div><div class=\'clearfix\'></div><div class=\'days-name\'>days</div></div><span>&middot;</span><div class=\'hours\'><div class=\'hours-digit\'>%H</div><div class=\'clearfix\'></div><div class=\'hours-name\'>hur</div></div><span>&middot;</span><div class=\'minutes\'><div class=\'minutes-digit\'>%M</div><div class=\'clearfix\'></div><div class=\'minutes-name\'>min</div></div><span>&middot;</span><div class=\'seconds\'><div class=\'seconds-digit\' >%S</div><div class=\'clearfix\'></div><div class=\'seconds-name\' >sec</div></div>")
              ); 
            });
          });
        </script>
       
        <?php
    }

    protected function content_template() {}
}


