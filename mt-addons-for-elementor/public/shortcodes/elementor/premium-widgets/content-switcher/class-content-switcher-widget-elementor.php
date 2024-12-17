<?php

class MT_Addons_Premium_Content_Switcher extends \Elementor\Widget_Base {
    public function get_style_depends() {
        wp_enqueue_style( 'mt-addons-premium-content-switcher', plugin_dir_url( __FILE__ ).'css/content-switcher.css');
        return [
            'mt-addons-premium-content-switcher',
        ]; 
    }
    public function get_script_depends() {
      wp_enqueue_script( 'mt-content-switcher', plugin_dir_url( __FILE__ ).'js/content-switcher.js' ); 

      return [ 'jquery', 'elementor-frontend','mt-content-switcher' ];
    }
    public function get_name()
    {
        return 'mtap-content-switcher';
    }

    public function get_title()
    {
        return esc_html__('MT Content Switcher', 'mt-addons');
    }

    public function get_icon() {
        return 'eicon-ellipsis-h';
    }

    public function get_categories() {
        return [ 'mt-addons-premium' ];
    }

    public function get_keywords() {
        return [ 'content switcher', 'switcher' ];
    }
    public function select_elementor_page( $type ) {
        $args  = [
            'tax_query'      => [
                [
                    'taxonomy' => 'elementor_library_type',
                    'field'    => 'slug',
                    'terms'    => $type,
                ],
            ],
            'post_type'      => 'elementor_library',
            'posts_per_page' => -1,
        ];
        $query = new \WP_Query( $args );

        $posts = $query->posts;
        foreach ( $posts as $post ) {
            $items[ $post->ID ] = $post->post_title;
        }

        if ( empty( $items ) ) {
            $items = [];
        }

        return $items;
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
            'select_design',
            [
                'label'   => esc_html__( 'Choose Design', 'mt-addons' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'round'    => esc_html__( 'Switch Round', 'mt-addons' ),
                    'round-2'  => esc_html__( 'Switch Round V2', 'mt-addons' ),
                    'square'   => esc_html__( 'Switch Square', 'mt-addons' ),
                    'square-2' => esc_html__( 'Switch Square V2', 'mt-addons' ),
                    'button'   => esc_html__( 'Button', 'mt-addons' ),
                ],
                'default' => 'round',
            ]
        );

        $this->add_control(
            'design_warning_message',
            [
                'raw'             => '<strong>' . esc_html__( 'Please note!', 'mt-addons' ) . '</strong> ' . esc_html__( 'This design requires only two items. Only the first two items will be used.', 'mt-addons' ),
                'type'            => \Elementor\Controls_Manager::RAW_HTML,
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
                'render_type'     => 'ui',
                'condition'       => [
                    'select_design' => ['round', 'round-2', 'square', 'square-2'],
                ],
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title',
            [
                'label'   => esc_html__( 'Title', 'mt-addons' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Content', 'mt-addons' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'content_type',
            [
                'label'   => esc_html__( 'Type', 'mt-addons' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'plain_content'     => esc_html__( 'Text', 'mt-addons' ),
                    'saved_section'     => esc_html__( 'Saved Section', 'mt-addons' ),
                    'saved_container'   => esc_html__( 'Saved Container', 'mt-addons' ),
                    'saved_page'        => esc_html__( 'Saved Page', 'mt-addons' ),
                ],
                'default' => 'plain_content',
            ]
        );
        $repeater->add_control(
            'plain_content',
            [
                'label'       => esc_html__( 'Plain/ HTML Text', 'mt-addons' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'rows'        => 20,
                'condition'   => [
                    'content_type' => 'plain_content',
                ],
                'dynamic'     => [
                    'active' => true,
                ],
                'default'     => esc_html__( 'Add some content here.', 'mt-addons' ),
            ]
        );

        $saved_sections = ['0' => esc_html__( '--- Select Section ---', 'mt-addons' )];
        $saved_sections = $saved_sections + $this->select_elementor_page( 'section' );

        $repeater->add_control(
            'saved_section',
            [
                'label'     => esc_html__( 'Sections', 'mt-addons' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => $saved_sections,
                'default'   => '0',
                'condition' => [
                    'content_type' => 'saved_section',
                ],
            ]
        );

        $saved_container = ['0' => esc_html__( '--- Select Container ---', 'mt-addons' )];
        $saved_container = $saved_container + $this->select_elementor_page( 'container' );

        $repeater->add_control(
            'saved_container',
            [
                'label'     => esc_html__( 'Container', 'mt-addons' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => $saved_container,
                'default'   => '0',
                'condition' => [
                    'content_type' => 'saved_container',
                ],
            ]
        );

        $saved_page = ['0' => esc_html__( '--- Select Page ---', 'mt-addons' )];
        $saved_page = $saved_page + $this->select_elementor_page( 'page' );

        $repeater->add_control(
            'saved_pages',
            [
                'label'     => esc_html__( 'Pages', 'mt-addons' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => $saved_page,
                'default'   => '0',
                'condition' => [
                    'content_type' => 'saved_page',
                ],
            ]
        );

        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__( 'Icon', 'mt-addons' ),
                'type'  => \Elementor\Controls_Manager::ICONS,
            ]
        );
        $repeater->add_control(
            'icon_align',
            [
                'label'   => esc_html__( 'Icon Position', 'mt-addons' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left'  => esc_html__( 'Left', 'mt-addons' ),
                    'right' => esc_html__( 'Right', 'mt-addons' ),
                ],
            ]
        );

        $repeater->add_control(
            'active',
            [
                'label'        => esc_html__( 'Active', 'mt-addons' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'description'  => esc_html__( 'Active on Load', 'mt-addons' ),
                'label_on'     => esc_html__( 'Yes', 'mt-addons' ),
                'label_off'    => esc_html__( 'No', 'mt-addons' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->add_control(
            'content_list',
            [
                'label'         => esc_html__( 'Contents', 'mt-addons' ),
                'type'          => \Elementor\Controls_Manager::REPEATER,
                'fields'        => $repeater->get_controls(),
                'prevent_empty' => true,
                'default'       => [
                    [
                        'title'         => esc_html__( 'Primary', 'mt-addons' ),
                        'content_type'  => 'plain_content',
                        'plain_content' => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.' ),
                        'active'        => 'yes',
                    ],
                    [
                        'title'         => esc_html__( 'Secondary', 'mt-addons' ),
                        'content_type'  => 'plain_content',
                        'plain_content' => esc_html__( 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'mt-addons' ),
                    ],
                ],
                'title_field'   => '{{{ title }}}',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_section_display_settings',
            [
                'label' => esc_html__( 'Display Settings', 'mt-addons' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'switch_direction',
            [
                'label'   => esc_html__( 'Switch Direction', 'mt-addons' ),
                'type'    => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'horizontal' => [
                        'title' => esc_html__( 'Horizontal', 'mt-addons' ),
                        'icon'  => 'eicon-navigation-horizontal',
                    ],
                    'vertical'   => [
                        'title' => esc_html__( 'Vertical', 'mt-addons' ),
                        'icon'  => 'eicon-navigation-vertical',
                    ],
                   
                ],
                'default' => 'horizontal',
                'toggle'  => false,
            ]
        );
        $this->add_responsive_control(
            'switch_align',
            [
                'label'     => esc_html__( 'Switch Alignment', 'mt-addons' ),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', 'mt-addons' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center'     => [
                        'title' => esc_html__( 'Center', 'mt-addons' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'flex-end'   => [
                        'title' => esc_html__( 'Right', 'mt-addons' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mapcs-switch-container' => 'justify-content : {{VALUE}}',
                ],
                'default'   => 'center',
                'toggle'    => true,
            ]
        );

        $this->add_responsive_control(
            'space_between',
            [
                'label'       => esc_html__( 'Space', 'mt-addons' ),
                'description' => esc_html__( 'Set Space between switcher and content section', 'mt-addons' ),
                'type'        => \Elementor\Controls_Manager::SLIDER,
                'size_units'  => ['px', '%'],
                'range'       => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1000,
                        'step' => 5,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'     => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors'   => [
                    '{{WRAPPER}} .mapcs-switch-container' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'anim_duration',
            [
                'label'       => esc_html__( 'Animation Speed', 'mt-addons' ),
                'type'        => \Elementor\Controls_Manager::NUMBER,
                'description' => esc_html__( 'Set Animation Duration in Millisecond', 'mt-addons' ),
                'min'         => 100,
                'max'         => 3000,
                'step'        => 100,
                'default'     => 400,
                'selectors'   => [
                    '{{WRAPPER}} .mapcs-wrapper .mapcs-slider:before' => 'transition-duration: {{VALUE}}ms',
                    '{{WRAPPER}} .mapcs-wrapper .mapcs-button' => 'transition-duration: {{VALUE}}ms',
                    '{{WRAPPER}} .mapcs-content-wrapper .mapcs-content-section' => 'transition: transform calc( {{VALUE}}ms / 2 ) ease-in;',
                    '{{WRAPPER}} .mapcs-content-wrapper .mapcs-content-section' => 'transition: transform calc( {{VALUE}}ms / 2 ) ease-out;',
                ],
            ]
        );
        $this->end_controls_section();

                $this->start_controls_section(
            '_section_style_switch',
            [
                'label' => esc_html__( 'Switch', 'mt-addons' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'           => 'typography',
                'fields_options' => [
                    'typography'  => ['default' => 'yes'],
                    'font_family' => [
                        'default' => 'Nunito',
                    ],
                    'font_weight' => [
                        'default' => 'Bold',
                    ],
                ],
                'selector'       => '{{WRAPPER}} .mapcs-wrapper .mapcs-button span, {{WRAPPER}} .mapcs-wrapper .mapcs-switch, {{WRAPPER}} .mapcs-wrapper .mapcs-button',

            ]
        );

        $this->add_responsive_control(
            'icon_spacing',
            [
                'label'      => esc_html__( 'Icon Spacing', 'mt-addons' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 5,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .mapcs-wrapper .mapcs-button.mapcs-icon-left .mapcs-icon-wrapper' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .mapcs-wrapper .mapcs-button.mapcs-icon-right .mapcs-icon-wrapper' => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .mapcs-wrapper .mapcs-switch.mapcs-icon-left .mapcs-icon-wrapper' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .mapcs-wrapper .mapcs-switch.mapcs-icon-right .mapcs-icon-wrapper' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'label_spacing',
            [
                'label'      => esc_html__( 'Title Spacing', 'mt-addons' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .mapcs-wrapper.horizontal .mapcs-switch.primary' => 'margin-right: {{SIZE}}{{UNIT}}; margin-bottom: unset;',
                    'body[data-elementor-device-mode="widescreen"] {{WRAPPER}} .mapcs-wrapper.widescreen-horizontal .mapcs-switch.primary' => 'margin-right: {{SIZE}}{{UNIT}}; margin-bottom: unset;',
                    'body[data-elementor-device-mode="desktop"] {{WRAPPER}} .mapcs-wrapper.desktop-horizontal .mapcs-switch.primary' => 'margin-right: {{SIZE}}{{UNIT}}; margin-bottom: unset;',
                    'body[data-elementor-device-mode="laptop"] {{WRAPPER}} .mapcs-wrapper.laptop-horizontal .mapcs-switch.primary' => 'margin-right: {{SIZE}}{{UNIT}}; margin-bottom: unset;',
                    'body[data-elementor-device-mode="tablet_extra"] {{WRAPPER}} .mapcs-wrapper.tablet-extra-horizontal .mapcs-switch.primary' => 'margin-right: {{SIZE}}{{UNIT}}; margin-bottom: unset;',
                    'body[data-elementor-device-mode="tablet"] {{WRAPPER}} .mapcs-wrapper.tablet-horizontal .mapcs-switch.primary' => 'margin-right: {{SIZE}}{{UNIT}}; margin-bottom: unset;',
                    'body[data-elementor-device-mode="mobile_extra"] {{WRAPPER}} .mapcs-wrapper.mobile-extra-horizontal .mapcs-switch.primary' => 'margin-right: {{SIZE}}{{UNIT}}; margin-bottom: unset;',
                    'body[data-elementor-device-mode="mobile"] {{WRAPPER}} .mapcs-wrapper.mobile-horizontal .mapcs-switch.primary' => 'margin-right: {{SIZE}}{{UNIT}}; margin-bottom: unset;',

                    '{{WRAPPER}} .mapcs-wrapper.horizontal .mapcs-switch.secondary' => 'margin-left: {{SIZE}}{{UNIT}}; margin-top: unset;',
                    'body[data-elementor-device-mode="widescreen"] {{WRAPPER}} .mapcs-wrapper.widescreen-horizontal .mapcs-switch.secondary' => 'margin-left: {{SIZE}}{{UNIT}}; margin-top: unset;',
                    'body[data-elementor-device-mode="desktop"] {{WRAPPER}} .mapcs-wrapper.desktop-horizontal .mapcs-switch.secondary' => 'margin-left: {{SIZE}}{{UNIT}}; margin-top: unset;',
                    'body[data-elementor-device-mode="laptop"] {{WRAPPER}} .mapcs-wrapper.laptop-horizontal .mapcs-switch.secondary' => 'margin-left: {{SIZE}}{{UNIT}}; margin-top: unset;',
                    'body[data-elementor-device-mode="tablet_extra"] {{WRAPPER}} .mapcs-wrapper.tablet-extra-horizontal .mapcs-switch.secondary' => 'margin-left: {{SIZE}}{{UNIT}}; margin-top: unset;',
                    'body[data-elementor-device-mode="tablet"] {{WRAPPER}} .mapcs-wrapper.tablet-horizontal .mapcs-switch.secondary' => 'margin-left: {{SIZE}}{{UNIT}}; margin-top: unset;',
                    'body[data-elementor-device-mode="mobile_extra"] {{WRAPPER}} .mapcs-wrapper.mobile-extra-horizontal .mapcs-switch.secondary' => 'margin-left: {{SIZE}}{{UNIT}}; margin-top: unset;',
                    'body[data-elementor-device-mode="mobile"] {{WRAPPER}} .mapcs-wrapper.mobile-horizontal .mapcs-switch.secondary' => 'margin-left: {{SIZE}}{{UNIT}}; margin-top: unset;',

                    '{{WRAPPER}} .mapcs-wrapper.horizontal .mapcs-switch.primary' => 'margin-bottom: {{SIZE}}{{UNIT}}; margin-right: unset;',
                    'body[data-elementor-device-mode="widescreen"] {{WRAPPER}} .mapcs-wrapper.widescreen-vertical .mapcs-switch.primary' => 'margin-bottom: {{SIZE}}{{UNIT}}; margin-right: unset;',
                    'body[data-elementor-device-mode="desktop"] {{WRAPPER}} .mapcs-wrapper.desktop-vertical .mapcs-switch.primary' => 'margin-bottom: {{SIZE}}{{UNIT}}; margin-right: unset;',
                    'body[data-elementor-device-mode="laptop"] {{WRAPPER}} .mapcs-wrapper.laptop-vertical .mapcs-switch.primary' => 'margin-bottom: {{SIZE}}{{UNIT}}; margin-right: unset;',
                    'body[data-elementor-device-mode="tablet_extra"] {{WRAPPER}} .mapcs-wrapper.tablet-extra-vertical .mapcs-switch.primary' => 'margin-bottom: {{SIZE}}{{UNIT}}; margin-right: unset;',
                    'body[data-elementor-device-mode="tablet"] {{WRAPPER}} .mapcs-wrapper.tablet-vertical .mapcs-switch.primary' => 'margin-bottom: {{SIZE}}{{UNIT}}; margin-right: unset;',
                    'body[data-elementor-device-mode="mobile_extra"] {{WRAPPER}} .mapcs-wrapper.mobile-extra-vertical .mapcs-switch.primary' => 'margin-bottom: {{SIZE}}{{UNIT}}; margin-right: unset;',
                    'body[data-elementor-device-mode="mobile"] {{WRAPPER}} .mapcs-wrapper.mobile-vertical .mapcs-switch.primary' => 'margin-bottom: {{SIZE}}{{UNIT}}; margin-right: unset;',

                    '{{WRAPPER}} .mapcs-wrapper.vertical .mapcs-switch.secondary' => 'margin-top: {{SIZE}}{{UNIT}}; margin-left: unset;',
                    'body[data-elementor-device-mode="widescreen"] {{WRAPPER}} .mapcs-wrapper.widescreen-vertical .mapcs-switch.secondary' => 'margin-top: {{SIZE}}{{UNIT}}; margin-left: unset;',
                    'body[data-elementor-device-mode="desktop"] {{WRAPPER}} .mapcs-wrapper.desktop-vertical .mapcs-switch.secondary' => 'margin-top: {{SIZE}}{{UNIT}}; margin-left: unset;',
                    'body[data-elementor-device-mode="laptop"] {{WRAPPER}} .mapcs-wrapper.laptop-vertical .mapcs-switch.secondary' => 'margin-top: {{SIZE}}{{UNIT}}; margin-left: unset;',
                    'body[data-elementor-device-mode="tablet_extra"] {{WRAPPER}} .mapcs-wrapper.tablet-extra-vertical .mapcs-switch.secondary' => 'margin-top: {{SIZE}}{{UNIT}}; margin-left: unset;',
                    'body[data-elementor-device-mode="tablet"] {{WRAPPER}} .mapcs-wrapper.tablet-vertical .mapcs-switch.secondary' => 'margin-top: {{SIZE}}{{UNIT}}; margin-left: unset;',
                    'body[data-elementor-device-mode="mobile_extra"] {{WRAPPER}} .mapcs-wrapper.mobile-extra-vertical .mapcs-switch.secondary' => 'margin-top: {{SIZE}}{{UNIT}}; margin-left: unset;',
                    'body[data-elementor-device-mode="mobile"] {{WRAPPER}} .mapcs-wrapper.mobile-vertical .mapcs-switch.secondary' => 'margin-top: {{SIZE}}{{UNIT}}; margin-left: unset;',
                ],
                'condition'  => [
                    'select_design' => ['round', 'round-2', 'square', 'square-2'],
                ],
            ]
        );

        $this->start_controls_tabs(
            'label_tabs'
        );

        $this->start_controls_tab(
            'label_style_normal',
            [
                'label' => esc_html__( 'Normal', 'mt-addons' ),
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Title Color', 'mt-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mapcs-wrapper .mapcs-button span' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .mapcs-wrapper .mapcs-switch span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => esc_html__( 'Icon Color', 'mt-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mapcs-wrapper .mapcs-button div > i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .mapcs-wrapper .mapcs-switch div > i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .mapcs-wrapper .mapcs-button div > svg' => 'fill: {{VALUE}}',
                    '{{WRAPPER}} .mapcs-wrapper .mapcs-switch div > svg' => 'fill: {{VALUE}}',

                ],
            ]
        );

        $this->add_control(
            'title_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'mt-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mapcs-wrapper .mapcs-button' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'select_design' => ['button'],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'      => 'title_border_normal',
                'label'     => esc_html__( 'Border', 'mt-addons' ),
                'selector'  => '{{WRAPPER}} .mapcs-wrapper .mapcs-button',
                'condition' => [
                    'select_design' => ['button'],
                ],
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'mt-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default'    => [
                    'top'      => '30',
                    'right'    => '30',
                    'bottom'   => '30',
                    'left'     => '30',
                    'unit'     => 'px',
                    'isLinked' => 'true',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .mapcs-wrapper .mapcs-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'select_design' => ['button'],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'      => 'title_box_shadow',
                'label'     => esc_html__( 'Box Shadow', 'mt-addons' ),
                'selector'  => '{{WRAPPER}} .mapcs-wrapper .mapcs-button',
                'condition' => [
                    'select_design' => ['button'],
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'label_style_active',
            [
                'label' => esc_html__( 'Active', 'mt-addons' ),
            ]
        );

        $this->add_control(
            'title_color_active',
            [
                'label'     => esc_html__( 'Title Color', 'mt-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mapcs-wrapper .mapcs-button.active span' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .mapcs-wrapper .mapcs-switch.active span' => 'color: {{VALUE}}',

                ],
            ]
        );

        $this->add_control(
            'icon_color_active',
            [
                'label'     => esc_html__( 'Icon Color', 'mt-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mapcs-wrapper .mapcs-button.active i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .mapcs-wrapper .mapcs-switch.active i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .mapcs-wrapper .mapcs-button.active svg' => 'fill: {{VALUE}}',
                    '{{WRAPPER}} .mapcs-wrapper .mapcs-switch.active svg' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_bg_color_active',
            [
                'label'     => esc_html__( 'Background Color', 'mt-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mapcs-wrapper .mapcs-button.active' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'select_design' => ['button'],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'      => 'title_border_active',
                'label'     => esc_html__( 'Border', 'mt-addons' ),
                'selector'  => '{{WRAPPER}} .mapcs-wrapper .mapcs-button.active',
                'condition' => [
                    'select_design' => ['button'],
                ],
            ]
        );

        $this->add_control(
            'button_border_radius_active',
            [
                'label'      => esc_html__( 'Border Radius', 'mt-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default'    => [
                    'top'      => '30',
                    'right'    => '30',
                    'bottom'   => '30',
                    'left'     => '30',
                    'unit'     => 'px',
                    'isLinked' => 'true',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .mapcs-wrapper .mapcs-button.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'select_design' => ['button'],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'      => 'title_box_shadow_active',
                'label'     => esc_html__( 'Box Shadow', 'mt-addons' ),
                'selector'  => '{{WRAPPER}} .mapcs-wrapper .mapcs-button.active',
                'condition' => [
                    'select_design' => ['button'],
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'button_padding',
            [
                'label'      => esc_html__( 'Padding', 'mt-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default'    => [
                    'top'      => '10',
                    'right'    => '20',
                    'bottom'   => '10',
                    'left'     => '20',
                    'unit'     => 'px',
                    'isLinked' => '',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .mapcs-wrapper .mapcs-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'select_design' => ['button'],
                ],
                'separator'  => 'before',
            ]
        );

        $this->add_responsive_control(
            'button_margin',
            [
                'label'      => esc_html__( 'Margin', 'mt-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default'    => [
                    'top'      => '5',
                    'right'    => '5',
                    'bottom'   => '5',
                    'left'     => '5',
                    'unit'     => 'px',
                    'isLinked' => 'true',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .mapcs-wrapper .mapcs-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'select_design' => ['button'],
                ],
            ]
        );

        $this->add_control(
            'box_style',
            [
                'label'     => esc_html__( 'Box Style', 'mt-addons' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'select_design' => ['button'],
                ],
            ]
        );

        $this->add_control(
            'title_box_bg_color',
            [
                'label'     => esc_html__( 'Box Color', 'mt-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#FFF',
                'selectors' => [
                    '{{WRAPPER}} .mapcs-wrapper' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'select_design' => ['button'],
                ],
            ]
        );

        $this->add_responsive_control(
            'box_padding',
            [
                'label'      => esc_html__( 'Box Padding', 'mt-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default'    => [
                    'top'      => '5',
                    'right'    => '5',
                    'bottom'   => '5',
                    'left'     => '5',
                    'unit'     => 'px',
                    'isLinked' => 'true',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .mapcs-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'select_design' => ['button'],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'      => 'box_border',
                'label'     => esc_html__( 'Border', 'mt-addons' ),
                'selector'  => '{{WRAPPER}} .mapcs-wrapper',
                'condition' => [
                    'select_design' => ['button'],
                ],
            ]
        );

        $this->add_control(
            'box_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'mt-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default'    => [
                    'top'      => '50',
                    'right'    => '50',
                    'bottom'   => '50',
                    'left'     => '50',
                    'unit'     => 'px',
                    'isLinked' => 'true',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .mapcs-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'select_design' => ['button'],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_box_shadow',
                'label'    => esc_html__( 'Box Shadow', 'mt-addons' ),
                'selector' => '{{WRAPPER}} .mapcs-wrapper',
            ]
        );

        $this->end_controls_section();
                $this->start_controls_section(
            '_section_style_switcher_control',
            [
                'label'     => esc_html__( 'Switcher Control', 'mt-addons' ),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'select_design' => ['round', 'round-2', 'square', 'square-2'],
                ],
            ]
        );

        $this->add_control(
            'switch_style_size',
            [
                'label'      => esc_html__( 'Switch Size (px)', 'mt-addons' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 1,
                        'max'  => 200,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 12,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .mapcs-switch-container .mapcs-switch.mapcs-input-label' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs(
            'switch_style_tabs'
        );

        $this->start_controls_tab(
            'switch_style_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'mt-addons' ),
            ]
        );

        $this->add_control(
            'switch_color',
            [
                'label'     => esc_html__( 'Color', 'mt-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mapcs-input-label .mapcs-slider:before' => 'background-color : {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'switch_background_color',
            [
                'label'     => esc_html__( 'Background Color', 'mt-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mapcs-input-label .mapcs-slider' => 'background-color : {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'switch_style_active_tab',
            [
                'label' => esc_html__( 'Active', 'mt-addons' ),
            ]
        );

        $this->add_control(
            'switch_color_active',
            [
                'label'     => esc_html__( 'Color', 'mt-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mapcs-input-label input:checked+.mapcs-slider:before' => 'background-color : {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'switch_background_color_active',
            [
                'label'     => esc_html__( 'Background Color', 'mt-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mapcs-input-label input:checked+.mapcs-slider' => 'background-color : {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

                $this->start_controls_section(
            '_section_style_switch_bar',
            [
                'label' => esc_html__( 'Switch Bar', 'mt-addons' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'title_section_padding',
            [
                'label'      => esc_html__( 'Section Padding', 'mt-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .mapcs-switcher-wrapper .mapcs-switch-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'title_section_bg_color',
                'label'    => esc_html__( 'Background', 'mt-addons' ),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .mapcs-switcher-wrapper .mapcs-switch-container',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'title_section_border',
                'label'    => esc_html__( 'Border', 'mt-addons' ),
                'selector' => '{{WRAPPER}} .mapcs-switcher-wrapper .mapcs-switch-container',
            ]
        );

        $this->add_control(
            'title_section_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'mt-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .mapcs-switcher-wrapper .mapcs-switch-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'title_section_shadow',
                'label'    => esc_html__( 'Box Shadow', 'mt-addons' ),
                'selector' => '{{WRAPPER}} .mapcs-switcher-wrapper .mapcs-switch-container',
            ]
        );

        $this->end_controls_section();
            $this->start_controls_section(
            '_section_style_content',
            [
                'label' => esc_html__( 'Content', 'mt-addons' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label'      => esc_html__( 'Padding', 'mt-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .mapcs-switcher-wrapper .mapcs-content-container .mapcs-content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'           => 'content_typography',
                'fields_options' => [
                    'typography'  => [
                        'default' => 'yes',
                    ],
                    'font_family' => [
                        'default' => 'Nunito',
                    ],
                    'font_weight' => [
                        'default' => '600',
                    ],
                ],
                'selector'       => '{{WRAPPER}} .mapcs-switcher-wrapper .mapcs-content-section',
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label'     => esc_html__( 'Color', 'mt-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mapcs-content-container .mapcs-content-wrapper .mapcs-content-section' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'content_box_bg_color',
                'label'    => esc_html__( 'Background', 'mt-addons' ),
                'types'    => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .mapcs-switcher-wrapper .mapcs-content-container .mapcs-content-wrapper',
            ]
        );

        $this->add_control(
            'contetn_box_alignment',
            [
                'label'     => esc_html__( 'Alignment', 'mt-addons' ),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'mt-addons' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'mt-addons' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'mt-addons' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default'   => 'center',
                'selectors' => [
                    '{{WRAPPER}} .mapcs-switcher-wrapper' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'content_box',
                'label'    => esc_html__( 'Border', 'mt-addons' ),
                'selector' => '{{WRAPPER}} .mapcs-switcher-wrapper .mapcs-content-container .mapcs-content-wrapper',

            ]
        );
        $this->add_control(
            'content_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'mt-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .mapcs-switcher-wrapper .mapcs-content-container .mapcs-content-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'content_box_shadow',
                'label'    => esc_html__( 'Box Shadow', 'mt-addons' ),
                'selector' => '{{WRAPPER}} .mapcs-switcher-wrapper .mapcs-content-container .mapcs-content-wrapper',

            ]
        );
        $this->end_controls_section();


    }

    protected function render() {
        $settings  = $this->get_settings_for_display();
        $primary   = ( isset( $settings['content_list'][0] ) ? $settings['content_list'][0] : '' );
        $secondary = ( isset( $settings['content_list'][1] ) ? $settings['content_list'][1] : '' );

        $class_for_direction  = (!empty($settings['switch_direction_widescreen']))? 'widescreen-' . $settings['switch_direction_widescreen']: '';
        $class_for_direction .= (!empty($settings['switch_direction']))? ' desktop-' . $settings['switch_direction']: '';
        $class_for_direction .= (!empty($settings['switch_direction']))? ' ' . $settings['switch_direction']: '';
        $class_for_direction .= (!empty($settings['switch_direction_laptop']))? ' laptop-' . $settings['switch_direction_laptop']: '';
        $class_for_direction .= (!empty($settings['switch_direction_tablet_extra']))? ' tablet-extra-' . $settings['switch_direction_tablet_extra']: '';
        $class_for_direction .= (!empty($settings['switch_direction_tablet']))? ' tablet-' . $settings['switch_direction_tablet']: '';
        $class_for_direction .= (!empty($settings['switch_direction_mobile_extra']))? ' mobile-extra-' . $settings['switch_direction_mobile_extra']: '';
        $class_for_direction .= (!empty($settings['switch_direction_mobile']))? ' mobile-' . $settings['switch_direction_mobile']: '';

        ?> 
        <div class="mapcs-switcher-wrapper mapcs-design-<?php echo esc_attr( $settings['select_design'] ); ?>" data-design-type="<?php echo esc_attr( $settings['select_design'] ); ?>">
            <div class="mapcs-switch-container">
                <div class="mapcs-wrapper <?php echo esc_attr($class_for_direction); ?>">
                    <?php if ( $settings['select_design'] == 'button' ) : ?>
                        <?php foreach ( $settings['content_list'] as $i => $item ) : ?>
                            <button class="mapcs-button <?php echo esc_attr( ( $item['active'] == 'yes' ) ? 'active' : '' ); ?> mapcs-icon-<?php echo esc_attr( $item['icon_align'] ); ?>" data-content-id="<?php echo esc_attr( $item['_id'] ); ?>">
                                <?php if ( ! empty( $item['icon']['value'] ) ) : ?>
                                    <div class="mapcs-icon-wrapper"><?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true']); ?></div>
                                <?php endif; ?>
                                <span><?php echo esc_html( $item['title'] ); ?></span>
                            </button>
                        <?php endforeach; ?>
                        <?php
                    else :
                        ?>
                         <div class="mapcs-switch primary <?php echo esc_attr( ( $primary['active'] == 'yes' ) ? 'active' : '' ); ?> mapcs-icon-<?php echo esc_attr( $primary['icon_align'] ); ?>" data-content-id="<?php echo esc_attr( $primary['_id'] ); ?>">
                            <?php if ( ! empty( $primary['icon']['value'] ) ) : ?>
                                <div class="mapcs-icon-wrapper"><?php \Elementor\Icons_Manager::render_icon($primary['icon'], ['aria-hidden' => 'true']); ?></div>
                            <?php endif; ?>
                            <span><?php echo esc_html( $primary['title'] ); ?></span>
                        </div>

                        <label class="mapcs-switch mapcs-input-label">
                            <input class="mapcs-toggle-switch" type="checkbox" <?php echo esc_attr( ( $secondary['active'] == 'yes' ) ? 'checked' : '' ); ?>>
                            <span class="mapcs-slider mapcs-<?php echo esc_attr( $settings['select_design'] ); ?>"></span>
                        </label>

                        <div class="mapcs-switch secondary <?php echo esc_attr( ( $secondary['active'] == 'yes' ) ? 'active' : '' ); ?> mapcs-icon-<?php echo esc_attr( $secondary['icon_align'] ); ?>" data-content-id="<?php echo esc_attr( $secondary['_id'] ); ?>">
                            <?php if ( ! empty( $secondary['icon']['value'] ) ) : ?>
                                <div class="mapcs-icon-wrapper"><?php \Elementor\Icons_Manager::render_icon($secondary['icon'], ['aria-hidden' => 'true']); ?></div>
                            <?php endif; ?>
                            <span><?php echo esc_html( $secondary['title'] ); ?></span>
                        </div>

                    <?php endif; ?>
                </div>
            </div>
            <div class="mapcs-content-container">
                <div class="mapcs-content-wrapper <?php echo esc_attr( $class_for_direction ); ?>">
                    <?php if ( $settings['select_design'] == 'button' ) : ?>
                        <?php foreach ( $settings['content_list'] as $i => $item ) : ?>
                            <div id="<?php echo esc_attr( $item['_id'] ); ?>" class="mapcs-content-section <?php echo esc_attr( ( $item['active'] == 'yes' ) ? 'active' : '' ); ?>">
                                <?php
                                if ( $item['content_type'] == 'plain_content' ) {
                                    echo wp_kses_post($item['plain_content']);

                                } elseif ( $item['content_type'] == 'saved_section' ) {
                                    $item['saved_section'] = apply_filters('wpml_object_id', $item['saved_section'], 'elementor_library');
                                    echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $item['saved_section'] );
                                } elseif ( $item['content_type'] == 'saved_container' ) {
                                    $item['saved_container'] = apply_filters('wpml_object_id', $item['saved_container'], 'elementor_library');
                                    echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $item['saved_container'] );
                                } elseif ( $item['content_type'] == 'saved_page' ) {
                                    $item['saved_pages'] = apply_filters('wpml_object_id', $item['saved_pages'], 'elementor_library');
                                    echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $item['saved_pages'] );
                                }
                                ?>
                            </div>
                        <?php endforeach; ?>
                        <?php
                    else :
                        ?>
                        <div id="<?php echo esc_attr( $primary['_id'] ); ?>" class="mapcs-content-section primary <?php echo esc_attr( ( $primary['active'] == 'yes' ) ? 'active' : '' ); ?>">
                            <?php
                            if ( $primary['content_type'] == 'plain_content' ) {
                               echo wp_kses_post($primary['plain_content']);
                            } elseif ( $primary['content_type'] == 'saved_section' ) {
                                $primary['saved_section'] = apply_filters('wpml_object_id', $primary['saved_section'], 'elementor_library');
                                echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $primary['saved_section'] );
                            } elseif ( $primary['content_type'] == 'saved_page' ) {
                                $primary['saved_pages'] = apply_filters('wpml_object_id', $primary['saved_pages'], 'elementor_library');
                                echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $primary['saved_pages'] );
                            }

                            ?>
                        </div>
                        <div id="<?php echo esc_attr( $secondary['_id'] ); ?>" class="mapcs-content-section secondary <?php echo esc_attr( ( $secondary['active'] == 'yes' ) ? 'active' : '' ); ?>">
                            <?php
                            if ( $secondary['content_type'] == 'plain_content' ) {
                               echo wp_kses_post($secondary['plain_content']);
                            } elseif ( $secondary['content_type'] == 'saved_section' ) {
                                $secondary['saved_section'] = apply_filters('wpml_object_id', $secondary['saved_section'], 'elementor_library');
                                echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $secondary['saved_section'] );
                            } elseif ( $secondary['content_type'] == 'saved_page' ) {
                                $secondary['saved_pages'] = apply_filters('wpml_object_id', $secondary['saved_pages'], 'elementor_library');
                                echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $secondary['saved_pages'] );
                            }
                            ?>
                        </div>

                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php
    }

    protected function content_template() {}
}


