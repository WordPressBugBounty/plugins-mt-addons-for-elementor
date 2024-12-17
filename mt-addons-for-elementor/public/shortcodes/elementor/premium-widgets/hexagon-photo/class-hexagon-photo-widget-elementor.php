<?php
class MT_Addons_Premium_Hexagon_Photo extends \Elementor\Widget_Base {
    public function get_style_depends() {
        wp_enqueue_style( 'mt-addons-premium-hexagon-photo', plugin_dir_url( __FILE__ ).'css/hexagon-photo.css');
        return [
            'mt-addons-premium-hexagon-photo',
        ];
    }

    public function get_name()
    {
        return 'mtap-hexagon-photo';
    }

    public function get_title()
    {
        return esc_html__('MT Hexagon Photo', 'mt-addons');
    }

    public function get_icon() {
        return 'eicon-photo-library';
    }

    public function get_categories() {
        return [ 'mt-addons-premium' ];
    }

    public function get_keywords() {
        return [ 'hexagon photo', 'photo' ];
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
            'title_color',
            [
                'label'             => esc_html__( 'Title Color', 'mt-addons' ),
                'type'              => \Elementor\Controls_Manager::COLOR,
                'selectors'         => [
                    '{{WRAPPER}} #maphp-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'subtitle_color',
            [
                'label'             => esc_html__( 'Subtitle Color', 'mt-addons' ),
                'type'              => \Elementor\Controls_Manager::COLOR,
                'selectors'         => [
                    '{{WRAPPER}} #maphp-subtitle' => 'color: {{VALUE}}',
                ],
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
                'selector' => '{{WRAPPER}} .maphp-img:after',
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'title', 
            [
                'label'         => esc_html__( 'Title', 'mt-addons' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        ); 
        $repeater->add_control(
            'subtitle',
            [
                'label' => esc_html__( 'Subtitle', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Enter your content', 'mt-addons' ),
            ]
        );
        $repeater->add_control(
            'image',
            [
                'label' => esc_html__( 'Image', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} ' => 'background-image: url("{{URL}}");',
                ],
            ]
        );
        $repeater->add_control(
            'maphp_link',
            [
                'label'             => esc_html__( 'Link', 'mt-addons' ),
                'type'              => \Elementor\Controls_Manager::URL,
                'placeholder'       => esc_html__( 'https://your-link.com', 'mt-addons' ),
                'options'           => [ 'url', 'is_external', 'nofollow' ],
                'default'           => [
                    'url'           => '#',
                    'is_external'   => true,
                    'nofollow'      => true,
                ],
                'label_block'       => true,
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
                        'title'           => esc_html__( 'Phone', 'mt-addons' ),
                        'subtitle'        => esc_html__( 'Showcase', 'mt-addons' ),
                    ],
                    [
                        'title'           => esc_html__( 'Keyboard', 'mt-addons' ),
                        'subtitle'        => esc_html__( 'Showcase', 'mt-addons' ),
                    ],
                    [
                        'title'           => esc_html__( 'Watch', 'mt-addons' ),
                        'subtitle'        => esc_html__( 'Showcase', 'mt-addons' ),
                    ],
                    [
                        'title'           => esc_html__( 'Smart Watch', 'mt-addons' ),
                        'subtitle'        => esc_html__( 'Showcase', 'mt-addons' ),
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

        <div class="maphp-grid">
            <ul id="maphp-hexGrid">
                <?php if ($items_groups) { ?>
                    <?php foreach ($items_groups as $item) { 
                        $title       = $item['title'];
                        $subtitle    = $item['subtitle'];
                        $maphp_link  = $item['maphp_link']['url'];
                        
                     
                        ?>
                        <li class="maphp-hex">
                            <div class="maphp-hexIn">
                                <a class="maphp-link" href="<?php echo esc_url($maphp_link); ?>">
                                    <div class='maphp-img elementor-repeater-item-<?php echo esc_attr($item['_id'])?>'>
                                    </div>
                                    <h3 id="maphp-title"><?php echo esc_html($title);?></h3>
                                    <p id="maphp-subtitle"><?php echo esc_html($subtitle);?></p>
                                </a>
                            </div>
                        </li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </div>

        <?php
    }

    protected function content_template() {}
}


