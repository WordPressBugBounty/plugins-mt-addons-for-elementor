<?php
class MT_Addons_Premium_Flipbox extends \Elementor\Widget_Base {
    public function get_style_depends() {
        wp_enqueue_style( 'mt-addons-premium-flipbox', plugin_dir_url( __FILE__ ).'css/flipbox.css');
        return [
            'mt-addons-premium-flipbox',
        ];
    }

    public function get_name()
    {
        return 'mtap-flipbox';
    }

    public function get_title()
    {
        return esc_html__('MT Flipbox', 'mt-addons');
    }

    public function get_icon() {
        return 'eicon-flip-box';
    }

    public function get_categories() {
        return [ 'mt-addons-premium' ];
    }

    public function get_keywords() {
        return [ 'flipbox', 'box' ];
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
                'name' => 'background',
                'types' => [ 'classic'],
                'selector' => '{{WRAPPER}} .mt-addons-premium-flip-card-front',
            ]
        );
        $this->add_control(
            'icon',
            [
                'label' => esc_html__( 'Choose Icon', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Default title', 'mt-addons' ),
                'placeholder' => esc_html__( 'Type your title here', 'mt-addons' ),
            ]
        );
        $this->add_control(
            'content',
            [
                'label' => esc_html__( 'Description', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__( 'Default description', 'mt-addons' ),
                'placeholder' => esc_html__( 'Type your description here', 'mt-addons' ),
            ]
        );
        $this->add_control(
            'direction',
            [
                'label' => esc_html__( 'Border Style', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'mt-addons-premium-flip-horizontal',
                'options' => [
                    '' => esc_html__( 'Default', 'mt-addons' ),
                    'mt-addons-premium-flip-vertical'  => esc_html__( 'Vertical', 'mt-addons' ),
                    'mt-addons-premium-flip-horizontal' => esc_html__( 'Horizontal', 'mt-addons' ),
                ],
            ]
        );
        $this->add_control(
            'bg_color',
            [
                'label' => esc_html__( 'Background Color', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-premium-flip-card-back' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'text_color',
            [
                'type'              => \Elementor\Controls_Manager::COLOR,
                'label'             => esc_html__( 'Text Color', 'mt-addons' ),
                'label_block'       => true,
                'default'           => '#111',
                'selectors'         => [
                    '{{WRAPPER}} .mt-addons-premium-flip-card-back h3' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .mt-addons-premium-flip-card-back p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings           = $this->get_settings_for_display();
        $title              = $settings['title'];
        $content            = $settings['content'];
        $direction          = $settings['direction'];
        ?>

        <div class="mt-addons-premium-flipbox-card">
            <div class="mt-addons-premium-flip-card-inner <?php echo esc_attr($direction);?>">
                <div class="mt-addons-premium-flip-card-front">
                </div>
                <div class="mt-addons-premium-flip-card-back <?php echo esc_attr($direction);?>">
                    <img src="<?php echo esc_url( $settings['icon']['url'] )?>" alt="<?php echo esc_html($title);?>" class="mt-addons-premium-flipbox-card-icon">
                     <h3><?php echo esc_html($title);?></h3>
                     <p><?php echo esc_html($content);?></p>
                </div>
            </div>
        </div>
        <?php
    }

    protected function content_template() {}
}


