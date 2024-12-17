<?php

class MT_Addons_Premium_Textual_Project_Showcase extends \Elementor\Widget_Base {
    public function get_style_depends() {
        wp_enqueue_style( 'mt-addons-premium-textual-project-showcase', plugin_dir_url( __FILE__ ).'css/textual-project-showcase.css');
        return [
            'mt-addons-premium-textual-project-showcase',
        ];
    }

    public function get_name()
    {
        return 'mtap-textual-project-showcase';
    }

    public function get_title()
    {
        return esc_html__('MT Textual Project Showcase', 'mt-addons');
    }

    public function get_icon() {
        return 'eicon-text-area';
    }

    public function get_categories() {
        return [ 'mt-addons-premium' ];
    }

    public function get_keywords() {
        return [ 'textual project showcase', 'showcase' ];
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
        $this->add_responsive_control(
            'align',
            [
                'label'     => esc_html__( 'Text Alignment', 'mt-addons' ),
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
                'toggle'    => false,
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-premium-textual-project-showcase'    => 'justify-content: {{VALUE}}',
                ],
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'item_type',
            [
                'label'       => esc_html__( 'Type', 'mt-addons' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'options'     =>[
                    'icon'   => esc_html__( 'Icon', 'mt-addons' ),
                    'text'   => esc_html__( 'Text', 'mt-addons' ),
                    'image'  => esc_html__( 'Image', 'mt-addons' ),
                ],
                'default'     => 'text',
            ]
        );

        $repeater->add_control(
            'item_txt',
            [
                'label'       => esc_html__( 'Text', 'mt-addons' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'condition'   => [
                    'item_type' => 'text',
                ],
            ]
        );

        $repeater->add_control(
            'item_txt_tag',
            [
                'label'       => esc_html__( 'HTML Tag', 'mt-addons' ),
                'description' => esc_html__( 'Select an HTML tag for the text.', 'mt-addons' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'default'     => 'span',
                'options'     => [
                    'h1'   => 'H1',
                    'h2'   => 'H2',
                    'h3'   => 'H3',
                    'h4'   => 'H4',
                    'h5'   => 'H5',
                    'h6'   => 'H6',
                    'div'  => 'div',
                    'span' => 'span',
                    'p'    => 'p',
                ],
                'label_block' => true,
                'condition'   => [
                    'item_type' => 'text',
                ],
            ]
        );

        $repeater->add_control(
            'content_image',
            [
                'label'     => esc_html__( 'Choose Image', 'mt-addons' ),
                'type'      => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition'   => [
                    'item_type' => 'image',
                ],
            ]
        );
        $repeater->add_control(
            'icon',
            [
                'label'       => esc_html__( 'Choose Icon', 'mt-addons' ),
                'type'        => \Elementor\Controls_Manager::ICONS,
                'skin'        => 'inline',
                'default'     => [ 
                    'value'   => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
                'label_block' => false,
                'condition'   => [
                    'item_type' => 'icon',
                ],
            ]
        );
        $repeater->add_control(
            'style',
            [
                'label'     => esc_html__( 'Element Style', 'mt-addons' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $repeater->add_responsive_control(
            'content_size',
            [ 
                'label'       => esc_html__( 'Size', 'mt-addons' ),
                'type'        => \Elementor\Controls_Manager::SLIDER,
                'size_units'  => [ 'px', 'em', '%' ],
                'label_block' => true,
                'range'       => [ 
                    'px' =>[ 
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'default'     => [ 
                    'size' => 50,
                    'unit' => 'px',
                ],
                'selectors'   => [ 
                    '{{WRAPPER}} .maptps-icon i'  => 'font-size: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .maptps-icon svg' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important',
                ],
                'condition'   => [
                    'item_type' => 'icon',
                ],
            ]
        );
        $repeater->add_control(
            'item_icon_color',
            [
                'label'     => esc_html__( 'Color', 'mt-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .maptps-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .maptps-icon svg, {{WRAPPER}} .maptps-icon svg svg *' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    'item_type' => 'icon',
                ],
            ]
        );
        $repeater->add_responsive_control(
            'opacity',
            [
                'label'     => esc_html__( 'Opacity', 'mt-addons' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-premium-textual-project-showcase' => 'opacity: {{SIZE}};',
                ],
            ]
        );
        $repeater->add_responsive_control(
            'item_img_width',
            [
                'label'      => esc_html__( 'Width', 'mt-addons' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                ],
                'default'    => [
                    'size' => 100,
                    'unit' => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} img.maptps-img' => 'width: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} img.maptps-img' => 'max-width: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'item_type' => 'image',
                ],
            ]
        );
        $repeater->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .maptps-text',
                'condition' => [
                    'item_type' => 'text',
                ],
            ]
        );
        $repeater->add_control(
            'text_color',
            [
                'label'     => esc_html__( 'Text Color', 'mt-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'condition' =>[
                    'item_type' => 'text',
                ],
            ]
        );
        $this->add_control(
            'content',
            [
                'label' => esc_html__( 'Content', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [],
                'title_field' => '{{{ item_txt }}}',
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $content = $settings['content'];
        ?>
        <div class="mt-addons-premium-textual-project-showcase">
            <?php if ($content) { ?>
                <?php foreach ($content as $item) {
                    $item_type = $item['item_type'];
                    $item_txt = $item['item_txt'];
                    $item_txt_tag = $item['item_txt_tag'];
                    $item_id = $item['_id']; 
                    $text_color = isset($item['text_color']) ? $item['text_color'] : ''; 
                    $item_cls   = empty( $elem_type ) ? 'maptps-text' : 'maptps-text';
                    $style = '';
                    if ($text_color) {
                        $style = 'style="color: ' . esc_attr($text_color) . ';"';
                    }

                    $icon = $item['icon'];
                    if ($item_type === "image") {
                        $content_image = $item['content_image']['url'];
                    }
                    ?>

                    <?php if ($item_type === "icon") { ?>
                        <div class="maptps-icon">
                            <?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true']); ?>
                        </div>
                    <?php } else if ($item_type === "text") { ?>
                        <<?php echo \Elementor\Utils::validate_html_tag($item_txt_tag); ?> 
                            class="<?php echo esc_attr($item_cls); ?> maptps-text-<?php echo esc_attr($item_id); ?>" 
                            <?php echo $style;?>>
                            <?php echo esc_html($item['item_txt']); ?>
                        </<?php echo \Elementor\Utils::validate_html_tag($item_txt_tag); ?>>
                    <?php } else if ($item_type === "image") { ?>
                        <img class="maptps-img" src="<?php echo esc_url($content_image); ?>" alt="mt-addons-premium-image">
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        </div>
    <?php
    }




    protected function content_template() {}
}


