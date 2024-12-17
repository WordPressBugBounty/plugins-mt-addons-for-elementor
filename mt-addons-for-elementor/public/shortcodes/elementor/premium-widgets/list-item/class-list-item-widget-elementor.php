<?php
class MT_Addons_Premium_List_Item extends \Elementor\Widget_Base {
    public function get_style_depends() {
        wp_enqueue_style( 'mt-addons-premium-list-item', plugin_dir_url( __FILE__ ).'css/list-item.css');
        return [
            'mt-addons-premium-list-item',
        ];
    }

    public function get_name()
    {
        return 'mtap-list-item';
    }

    public function get_title()
    {
        return esc_html__('MT List Item', 'mt-addons');
    }

    public function get_icon() {
        return 'eicon-bullet-list';
    }

    public function get_categories() {
        return [ 'mt-addons-premium' ];
    }

    public function get_keywords() {
        return [ 'list item', 'list' ];
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
            'style', [
                'label'   => __( 'Order Type', 'mt-addons' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'unordered_list' => __( 'Unordered List', 'mt-addons' ),
                    'order_list'     => __( 'Ordered List', 'mt-addons' ),
                ],
                'default' => 'unordered_list',
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'text', [
                'label'       => __( 'Title', 'mt-addons' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => __( 'List Item', 'mt-addons' ),
                'default'     => __( 'List Item', 'mt-addons' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'ul_icon_list', [
                'label'         => 'Icon List',
                'type'          => \Elementor\Controls_Manager::REPEATER,
                'fields'        => $repeater->get_controls(),
                'title_field'   => '{{{ text }}}',
                'prevent_empty' => false,
                'default'           => [ 
                    [                      
                        'text'     => esc_html__( 'List Item', 'mt-addons' ),
                    ],
                    [                      
                        'text'     => esc_html__( 'List Item', 'mt-addons' ),
                    ],
                    [                      
                        'text'     => esc_html__( 'List Item', 'mt-addons' ),
                    ],
                ],
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'section_icon_list', [
                'label' => __( 'List', 'mt-addons' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        ); 

        $this->add_responsive_control(
            'space_between', [
                'label'     => __( 'Space Between', 'mt-addons' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mapli-steps-panel .mapli-ordered-list li:not(.mapli-steps-panel .mapli-ordered-list li:last-child)' => 'padding-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_align', [
                'label'        => __( 'Alignment', 'mt-addons' ),
                'type'         => \Elementor\Controls_Manager::CHOOSE,
                'options'      => [
                    'left'   => [
                        'title' => __( 'Left', 'mt-addons' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'right'  => [
                        'title' => __( 'Right', 'mt-addons' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'selectors'            => [
                    '{{WRAPPER}} .mapli-ordered-list' => 'float:{{VALUE}}',
                ],
               
            ]
        );

        $this->add_control(
            'text_color', [
                'label'     => __( 'Text Color', 'mt-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .mapli-steps-panel .mapli-ordered-list li' => 'color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
   
        $this->add_control(
            'text_color_hover', [
                'label'     => __( 'Hover', 'mt-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .mapli-steps-panel .mapli-ordered-list li:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'text_indent', [
                'label'     => __( 'Text Indent', 'mt-addons' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mapli-steps-panel .mapli-ordered-list li' => is_rtl() ? 'padding-right: {{SIZE}}{{UNIT}};' : 'padding-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(), [
                'name'     => 'content_typography',
                'selector' => '{{WRAPPER}} .mapli-steps-panel .mapli-ordered-list li',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_icon', [
                'label' => __( 'Icon', 'mt-addons' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_color', [
                'label'     => __( 'Color', 'mt-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .mapli-steps-panel .mapli-ordered-list li::before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_bg_color', [
                'label'     => __( 'Background', 'mt-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .mapli-steps-panel .mapli-ordered-list li::before' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size', [
                'label'     => __( 'Size', 'mt-addons' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 6,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mapli-steps-panel .mapli-ordered-list li::before' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_bg_size', [
                'label'     => __( 'Background Size', 'mt-addons' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 6,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mapli-steps-panel .mapli-ordered-list li::before' => 'width:{{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_line_height', [
                'label'     => __( 'Line Height', 'mt-addons' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 6,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mapli-steps-panel .mapli-ordered-list li::before' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'sec_bg_style', [
                'label' => __( 'Background', 'mt-addons' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'sec_margin', [
                'label'      => __( 'Padding', 'mt-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .mapli-steps-panel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default'    => [
                    'unit' => 'px',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(), [
                'name'     => 'sec_box_shadow',
                'selector' => '{{WRAPPER}} .mapli-steps-panel',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(), [
                'name'      => 'border',
                'label'     => __( 'Border', 'mt-addons' ),
                'selector'  => '{{WRAPPER}} .mapli-steps-panel',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'border_radius', [
                'label'      => __( 'Border Radius', 'mt-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .mapli-steps-panel' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings       = $this->get_settings_for_display();
        $style          = $settings['style'];
        $icon_align     = $settings['icon_align'];
        $ul_icon_list   = $settings['ul_icon_list'];

        ?>
        <?php
        if ( $settings['style'] == 'unordered_list' ) {
            ?>
            <div class="mapli-steps-panel">
                <ul class="mapli-ordered-list">
                    <?php
                    if ( ! empty( $ul_icon_list ) ) {
                        foreach ( $ul_icon_list as $item ) {
                            if ( ! empty( $item['text'] ) ) { ?>
                                <li class="elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
                                    <?php echo esc_html( $item['text'] ); ?>
                                </li>
                                <?php
                            }
                        }
                    }
                    ?>
                </ul>
            </div>
            <?php
        } elseif ( $settings['style'] == 'order_list' ) {
            ?>
            <div class="mapli-steps-panel">
                <ol class="mapli-ordered-list">
                    <?php
                    if ( ! empty( $ul_icon_list ) ) {
                        foreach ( $ul_icon_list as $item ) {
                            if ( ! empty( $item['text'] ) ) { ?>
                                <li class="elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
                                    <?php echo esc_html( $item['text'] ) ?>
                                </li>
                                <?php
                            }
                        }
                    }
                    ?>
                </ol>
            </div>
            <?php
        } ?>
        <?php
    }

    protected function content_template() {}
}


