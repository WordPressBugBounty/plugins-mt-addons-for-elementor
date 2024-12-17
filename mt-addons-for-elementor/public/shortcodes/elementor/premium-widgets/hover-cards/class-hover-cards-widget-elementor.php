<?php
class MT_Addons_Premium_Hover_Cards extends \Elementor\Widget_Base {
    public function get_style_depends() {
        wp_enqueue_style( 'mapt-hover-card', plugin_dir_url( __FILE__ ).'css/hover-cards.css');
        return [
            'mapt-hover-cards',
        ];
    }
    public function get_script_depends() {
      wp_register_script( 'mapt-hover-cards', plugin_dir_url( __FILE__ ).'js/hover-cards.js');
        
        return [ 'jquery', 'elementor-frontend',  'mapt-hover-cards' ];
    }
    public function get_name()
    {
        return 'mtap-tabs';
    }

    public function get_title()
    {
        return esc_html__('MT Hover Cards', 'mt-addons');
    }

    public function get_icon() {
        return 'eicon-tabs';
    }

    public function get_categories() {
        return [ 'mt-addons-premium' ];
    }

    public function get_keywords() {
        return [ 'hover cards'];
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
            'width',
            [
                'label' => esc_html__( 'Icon Width', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
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
                    '{{WRAPPER}} .mapt-item svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'             => esc_html__( 'Title Color', 'mt-addons' ),
                'type'              => \Elementor\Controls_Manager::COLOR,
                'selectors'         => [
                    '{{WRAPPER}} span.container__link' => 'color: {{VALUE}}',
                ],
                'default'           => '#111',
            ]
        );
        $this->add_control(
            'title_bg_color',
            [
                'label'             => esc_html__( 'Title Background Color', 'mt-addons' ),
                'type'              => \Elementor\Controls_Manager::COLOR,
                'selectors'         => [
                    '{{WRAPPER}} span.mapt-item-box' => 'background-color: {{VALUE}}',
                ],
                'default'           => '#5336ca',
            ]
        );
        $this->add_control(
            'container_bg',
            [
                'label'             => esc_html__( 'Container Background', 'mt-addons' ),
                'type'              => \Elementor\Controls_Manager::COLOR,
                'selectors'         => [
                    '{{WRAPPER}} .mapt-item' => 'background-color: {{VALUE}}',
                ],
                'default'           => '##fff',
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label'             => esc_html__( 'Icon Color', 'mt-addons' ),
                'type'              => \Elementor\Controls_Manager::COLOR,
                'selectors'         => [
                    '{{WRAPPER}} span.mapt-item-box svg' => 'fill: {{VALUE}}',
                ],
                'default'           => '#111',
            ]
        );
        $this->add_control(
            'arrow_bg_color',
            [
                'label'             => esc_html__( 'Arrow Background Color', 'mt-addons' ),
                'type'              => \Elementor\Controls_Manager::COLOR,
                'selectors'         => [
                    '{{WRAPPER}} .mapt-icon' => 'background-color: {{VALUE}}',
                ],
                'default'           => '#5336ca',
            ]
        );
        $this->add_control(
            'arrow_color',
            [
                'label'             => esc_html__( 'Arrow Color', 'mt-addons' ),
                'type'              => \Elementor\Controls_Manager::COLOR,
                'selectors'         => [
                    '{{WRAPPER}} .mapt-icon' => 'fill: {{VALUE}}',
                ],
                'default'           => '#5336ca',
            ]
        );
        $this->add_control(
            'position',
            [
                'label'                => esc_html__( 'Position', 'mt-addons' ),
                'type'                 => \Elementor\Controls_Manager::CHOOSE,
                'options'              => [
                    'left'  => [
                        'title' => esc_html__( 'Left', 'mt-addons' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'mt-addons' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'default'              => 'left',
                'selectors_dictionary' => [
                    'left'  => 'flex-flow: inherit',
                    'right' => 'flex-direction:row-reverse',
                ],
                'toggle'               => false,
                'selectors'            => [
                    '{{WRAPPER}} .mapt-container' => '{{VALUE}}',
                ],
            ]
        );
        $repeater = new \Elementor\Repeater();
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
            ]
        );
        $repeater->add_control(
            'link',
            [
                'label' => esc_html__( 'Link', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::URL,
                'options' => [ 'url', 'is_external', 'nofollow' ],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'title',
            [
                'label'       => esc_html__( 'Title', 'mt-addons' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'content',
            [
                'label' => esc_html__( 'Content', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'placeholder' => esc_html__( 'Type your description here', 'mt-addons' ),
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
        $this->add_control(
            'items_groups',
            [    
                'label'             => esc_html__('Items', 'mt-addons'),
                'type'              => \Elementor\Controls_Manager::REPEATER,
                'fields'            => $repeater->get_controls(),
                'default'           => [ 
                    [                      
                        'icon'              => esc_html__( 'fas fa-circle', 'mt-addons' ),
                        'title'             => esc_html__( 'Open to everyone', 'mt-addons' ),
                        'content'             => esc_html__( ' <h3>Vacation</h3>', 'mt-addons' ),
                        'description'       => esc_html__( ' <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h3>
                                    <p>Nullam nec gravida diam, sed aliquet metus. Pellentesque fermentum orci tincidunt nibh vestibulum, ut dignissim augue aliquet. Proin porta nec massa vel tincidunt. Aliquam ac rutrum elit. Proin ut fringilla orci, eget ultrices ligula. Nulla sed tincidunt ipsum. Nullam scelerisque vel massa nec tempus. Maecenas fermentum leo ut malesuada porta.</p>', 'mt-addons' ),
                    ],
                    [                      
                        'icon'              => esc_html__( 'fas fa-circle', 'mt-addons' ),
                        'title'             => esc_html__( 'Open to everyone', 'mt-addons' ),
                        'content'             => esc_html__( '<h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h3>', 'mt-addons' ),
                        'description'       => esc_html__( ' <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h3>
                                    <p>Nullam nec gravida diam, sed aliquet metus. Pellentesque fermentum orci tincidunt nibh vestibulum, ut dignissim augue aliquet. Proin porta nec massa vel tincidunt. Aliquam ac rutrum elit. Proin ut fringilla orci, eget ultrices ligula. Nulla sed tincidunt ipsum. Nullam scelerisque vel massa nec tempus. Maecenas fermentum leo ut malesuada porta.</p>', 'mt-addons' ),
                    ],
                    [                      
                        'icon'              => esc_html__( 'fas fa-circle', 'mt-addons' ),
                        'title'             => esc_html__( 'Open to everyone', 'mt-addons' ),
                        'content'             => esc_html__( 'Aenean', 'mt-addons' ),
                        'description'       => esc_html__( ' <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h3>
                                    <p>Nullam nec gravida diam, sed aliquet metus. Pellentesque fermentum orci tincidunt nibh vestibulum, ut dignissim augue aliquet. Proin porta nec massa vel tincidunt. Aliquam ac rutrum elit. Proin ut fringilla orci, eget ultrices ligula. Nulla sed tincidunt ipsum. Nullam scelerisque vel massa nec tempus. Maecenas fermentum leo ut malesuada porta.</p>', 'mt-addons' ),
                    ],
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings      = $this->get_settings_for_display();
        $items_groups  = $settings['items_groups'];
        $position       = $settings['position'];
        ?>
            <div class="mtap-vertical-tab">
                <?php if ($items_groups) { ?>
                    <?php foreach ($items_groups as $item) { 
                        $icon           = $item['icon'];
                        $title          = $item['title'];
                        $description    = $item['description'];
                        $content        = $item['content'];
                        $link           = $item['link']['url'];

                        ?>
                        <div class="mapt-container">
                            <div class="mapt-nav-tabs">
                                <ul class="mapt-nav-list">
                                    <a href="<?php echo esc_url($link);?>">
                                        <li class="mapt-item mapt-item_active">
                                            <span class="mapt-item-box">
                                                <?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true']);?>
                                                <span class="container__link"><?php echo esc_html($title); ?></span>
                                             </span>
                                             <span>
                                            <?php echo html_entity_decode($content); ?>
                                            </span>
                                            <div class="mapt-icon">
                                                <svg class="mapt-svg-first" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                  <polygon points="11.293 4.707 17.586 11 4 11 4 13 17.586 13 11.293 19.293 12.707 20.707 21.414 12 12.707 3.293 11.293 4.707"/></svg>
                                                  <svg class="mapt-svg-second" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                  <polygon points="7 7 15.586 7 5.293 17.293 6.707 18.707 17 8.414 17 17 19 17 19 5 7 5 7 7"/>
                                                </svg>
                                            </div>
                                        </li>
                                    </a>
                                </ul>
                            </div>
                            <div class="mapt-inner <?php echo esc_html($position); ?>">
                                <p class="mapt-description">
                                    <?php echo html_entity_decode($description); ?>
                                </p>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        <?php
        if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
            ?>
                <script type="text/javascript">
                    let tabContent = document.querySelectorAll(".mapt-inner");
                    let tabItem = document.querySelectorAll(".mapt-item");
                    for (let i = 1; i < tabContent.length; i++) {
                      tabContent[i].classList.add("mapt-inner_hidden");
                    }
                    tabItem[0].classList.add("mapt-item_active");
                    for (let i = 0; i < tabItem.length; i++) {
                      tabItem[i].addEventListener("mouseover", () => {
                        tabContent.forEach((item) => {
                          item.classList.add("mapt-inner_hidden");
                        });
                        tabItem.forEach((item) => {
                          item.classList.remove("mapt-item_active");
                        });
                        tabContent[i].classList.remove("mapt-inner_hidden");
                        tabItem[i].classList.add("mapt-item_active");
                      });
                    }
                </script>
            <?php
        }
    }

    protected function content_template() {}
}


