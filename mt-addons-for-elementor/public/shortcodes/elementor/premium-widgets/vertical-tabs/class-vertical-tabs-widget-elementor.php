<?php
class MT_Addons_Premium_Vertical_Tab extends \Elementor\Widget_Base {
    public function get_style_depends() {
        wp_enqueue_style( 'mt-addons-premium-vertical-tabs', plugin_dir_url( __FILE__ ).'css/vertical-tabs.css');
        return [
            'mt-addons-premium-vertical-tabs',
        ];
    }

    public function get_name()
    {
        return 'mtap-vertical-tabs';
    }

    public function get_title()
    {
        return esc_html__('MT Vertical Tabs', 'mt-addons');
    }

    public function get_icon() {
        return 'eicon-navigation-vertical';
    }

    public function get_categories() {
        return [ 'mt-addons-premium' ];
    }

    public function get_keywords() {
        return [ 'vertical tabs', 'tabs' ];
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
            'color_active',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Active Color', 'mt-addons' ),
                'label_block'   => true,
                'selectors'     => [ 
                    '{{WRAPPER}} .mtap-vertical-tabs > input:checked + label > p'     => 'color: {{VALUE}};',
                    '{{WRAPPER}} .mtap-vertical-tabs > input:checked + label::after' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .mtap-vertical-tabs > input:checked + label::after'     => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .mtap-vertical-tabs > input:checked + label::before'     => 'border-left-color: {{VALUE}};',
                    '{{WRAPPER}} .mtap-vertical-tabs label:hover > p'     => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'width',
            [
                'label' => esc_html__( 'Icon Width', 'mt-addons' ),
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
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mtap-vertical-tabs label > svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'image_width',
            [
                'label' => esc_html__( 'Image Width', 'mt-addons' ),
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
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mtap-vertical-tabs [class*="mtap-vertical-tab-img"]' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        ); 
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'              => 'title_typography',
                'label'             => esc_html__( 'Title Typography', 'mt-addons' ),
                'selector'          => '{{WRAPPER}} .mtap-vertical-tabs label>p',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'             => esc_html__( 'Title Color', 'mt-addons' ),
                'type'              => \Elementor\Controls_Manager::COLOR,
                'selectors'         => [
                    '{{WRAPPER}}  .mtap-vertical-tabs label>p'            => 'color: {{VALUE}}',
                ],
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'icon',
            [
              'label' => esc_html__( 'Icon', 'mt-addons' ),
              'type' => \Elementor\Controls_Manager::ICONS,
              'default' => [
                'value' => 'fas fa-circle',
                'library' => 'fa-solid',
              ],
            ]
        );
        $repeater->add_control(
            'title', 
            [
                'label'         => esc_html__( 'Item Title', 'mt-addons' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'default'       => esc_html__( 'Aenean' , 'mt-addons' ),
                'label_block'   => true,
            ]
        );
        $repeater->add_control(
            'description',
            [
                'label' => esc_html__( 'Description', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'Default description', 'mt-addons' ),
                'placeholder' => esc_html__( 'Type your description here', 'mt-addons' ),
            ]
        );
        $repeater->add_control(
            'image',
            [
                'label' => esc_html__( 'Choose Image', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'tabs_groups',
            [    
                'label'             => esc_html__('Tabs Items', 'mt-addons'),
                'type'              => \Elementor\Controls_Manager::REPEATER,
                'fields'            => $repeater->get_controls(),
                'default'           => [ 
                    [                      
                        'icon'              => esc_html__( 'fas fa-circle', 'mt-addons' ),
                        'title'             => esc_html__( 'Aenean', 'mt-addons' ),
                        'description'       => esc_html__( ' <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h3>
                                    <p>Nullam nec gravida diam, sed aliquet metus. Pellentesque fermentum orci tincidunt nibh vestibulum, ut dignissim augue aliquet. Proin porta nec massa vel tincidunt. Aliquam ac rutrum elit. Proin ut fringilla orci, eget ultrices ligula. Nulla sed tincidunt ipsum. Nullam scelerisque vel massa nec tempus. Maecenas fermentum leo ut malesuada porta.</p>', 'mt-addons' ),
                    ],
                    [                      
                        'icon'              => esc_html__( 'fas fa-fish', 'mt-addons' ),
                        'title'             => esc_html__( 'Vegetable', 'mt-addons' ),
                        'description'       => esc_html__( ' <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h3>
                                    <p>Nullam nec gravida diam, sed aliquet metus. Pellentesque fermentum orci tincidunt nibh vestibulum, ut dignissim augue aliquet. Proin porta nec massa vel tincidunt. Aliquam ac rutrum elit. Proin ut fringilla orci, eget ultrices ligula. Nulla sed tincidunt ipsum. Nullam scelerisque vel massa nec tempus. Maecenas fermentum leo ut malesuada porta.</p>', 'mt-addons' ),
                    ],
                    [                      
                        'icon'              => esc_html__( 'fas fa-fish', 'mt-addons' ),
                        'title'             => esc_html__( 'Vegetable', 'mt-addons' ),
                        'description'       => esc_html__( ' <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h3>
                                    <p>Nullam nec gravida diam, sed aliquet metus. Pellentesque fermentum orci tincidunt nibh vestibulum, ut dignissim augue aliquet. Proin porta nec massa vel tincidunt. Aliquam ac rutrum elit. Proin ut fringilla orci, eget ultrices ligula. Nulla sed tincidunt ipsum. Nullam scelerisque vel massa nec tempus. Maecenas fermentum leo ut malesuada porta.</p>', 'mt-addons' ),
                    ],
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings           = $this->get_settings_for_display();
        $tabs_groups        = $settings['tabs_groups'];
    
        ?>

        <div class="mtap-vertical-tabs">
            <?php $tab_id = 1; ?>
            <?php if ($tabs_groups) { ?>
                <?php foreach ($tabs_groups as $tab) { 
                    $icon         = $tab['icon'];
                    $title        = $tab['title'];
                    $description  = $tab['description'];
                    $image        = $tab['image']['url'];
                    ?>

                    <input type="radio" name="mtap-vertical-tabs" id="mtap-vertical-tab<?php echo esc_attr($tab_id);?>-v" <?php if ($tab_id === 1) echo 'checked'; ?>>
                    <label for="mtap-vertical-tab<?php echo esc_attr($tab_id);?>-v">
                        <?php if(!empty($icon)){?>
                            <?php \Elementor\Icons_Manager::render_icon( $tab['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        <?php } ?>
                        <p><?php echo esc_html($title); ?></p>
                    </label>
                    <div class="mtap-vertical-tab-content">
                        <div>
                            <div class="mtap-vertical-text-tab">
                                <img class="mtap-vertical-tab-img" src="<?php echo esc_url($image); ?>" alt="<?php echo esc_html($title);?>" />
                                <?php echo html_entity_decode($description); ?>
                            </div>
                        </div>
                    </div>
                <?php $tab_id++; ?>
                <?php } ?>
            <?php } ?>
        </div>

        <?php
    }

    protected function content_template() {}
}


