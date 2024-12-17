<?php
class MT_Addons_Premium_OnePage_Navigation extends \Elementor\Widget_Base {
    public function get_style_depends() {
      wp_enqueue_style( 'mt-addons-premium-onepage-navigation', plugin_dir_url( __FILE__ ).'css/onepage-navigation.css');
        return [
          'mt-addons-premium-onepage-navigation',
        ];
    }
    public function get_script_depends() {
      wp_register_script( 'menuspy', plugin_dir_url( __FILE__ ).'js/menuspy.min.js');
      wp_register_script( 'mt-addons-premium-onepage-navigation', plugin_dir_url( __FILE__ ).'js/onepage-navigation.js');
        
        return [ 'jquery', 'elementor-frontend',  'menuspy', 'mt-addons-premium-onepage-navigation' ];
    }
    public function get_name()
    {
      return 'mtap-onepage-navigation';
    }

    public function get_title()
    {
      return esc_html__('MT OnePage Navigation', 'mt-addons');
    }

    public function get_icon() {
      return 'eicon-anchor';
    }

    public function get_categories() {
      return [ 'mt-addons-premium' ];
    }

    public function get_keywords() {
      return [ 'onepage navigation', 'navigation', 'onepage' ];
    }

    protected function register_controls() {
      $this->all_controls();
    }

    private function all_controls() {
      $this->start_controls_section(
        'category_info',
        [
          'label'     => esc_html__('Content', 'mt-addons'),
          'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
        ]
      );
      $this->add_control(
        'version',
        [
         'label' => esc_html__( 'Version', 'mt-addons' ),
         'type' => \Elementor\Controls_Manager::SELECT,
         'default' => 'mtap-v1',
         'options' => [
            'mtap-v1' => 'V1',
            'mtap-v2' => 'V2',
            'mtap-v3' => 'V3',
            'mtap-v4' => 'V4',
            'mtap-v5' => 'V5',
          ],
        ]
      );
      $this->add_control(
        'position',
        [
          'label' => esc_html__( 'Position', 'mt-addons' ),
          'type' => \Elementor\Controls_Manager::SELECT,
          'default' => 'bottom-center',
          'options' => [
              'top-left' => esc_html__( 'Top Left', 'mt-addons' ),
              'top-center' => esc_html__( 'Top Center', 'mt-addons' ),
              'top-right' => esc_html__( 'Top Right', 'mt-addons' ),
              'middle-left' => esc_html__( 'Middle Left', 'mt-addons' ),
              'middle-center' => esc_html__( 'Middle Center', 'mt-addons' ),
              'middle-right' => esc_html__( 'Middle Right', 'mt-addons' ),
              'bottom-left' => esc_html__( 'Bottom Left', 'mt-addons' ),
              'bottom-center' => esc_html__( 'Bottom Center', 'mt-addons' ),
              'bottom-right' => esc_html__( 'Bottom Right', 'mt-addons' ),
          ],
        ]
      );
      $this->add_control(
        'orientation',
        [
          'label' => esc_html__( 'Orientation', 'mt-addons' ),
          'type' => \Elementor\Controls_Manager::SELECT,
          'default' => 'mtap-horizontal',
          'options' => [
              'mtap-horizontal' => esc_html__( 'Horizontal', 'mt-addons' ),
              'mtap-vertical' => esc_html__( 'Vertical', 'mt-addons' ),
          ],
          'condition' => [
            'version' => 'mtap-v1',
          ],
        ]
       );
      $this->add_control(
        'icons_mobile',
        [
         'label' => esc_html__( 'Icons Visibility', 'mt-addons' ),
          'type' => \Elementor\Controls_Manager::SELECT,
          'default' => 'mtap-default-icons',
          'options' => [
              'mtap-default-icons'  => esc_html__( 'All Devices', 'mt-addons' ),
              'mtap-icons-desktop' => esc_html__( 'Desktop Only', 'mt-addons' ),
              'mtap-icons-mobile' => esc_html__( 'Mobile Only', 'mt-addons' ),
              'mtap-icons-none' => esc_html__( 'No Icons', 'mt-addons' ),
          ],
          'condition' => [
             'version' => 'mtap-v1',
         ],
        ]
      );
      $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
          'label' => esc_html__( 'Label Typography', 'mt-addons' ),
          'name' => 'mt-addons',
          'selectors' => [
              '{{WRAPPER}} .mtap-onepage-side-menu.mtap-v1 ul li a',
              '{{WRAPPER}} .mtap-onepage-side-menu.mtap-v2 ul li a',
          ],
        ]
      );
      $this->add_control(
        'label_color_active_v1',
        [
          'label' => esc_html__( 'Label Color Active', 'mt-addons' ),
          'type' => \Elementor\Controls_Manager::COLOR,
          'selectors' => [
              '{{WRAPPER}} .mtap-onepage-side-menu.mtap-v1 ul li.active a' => 'color: {{VALUE}}',
              '{{WRAPPER}} .mtap-onepage-side-menu.mtap-v1 ul li.active a svg' => 'fill: {{VALUE}}',
          ],
           'condition' => [
              'version' => 'mtap-v1',
          ],
        ]
      );
      $this->add_control(
        'bg_color_active_v1',
        [
          'label' => esc_html__( 'Background Color Active', 'mt-addons' ),
          'type' => \Elementor\Controls_Manager::COLOR,
          'selectors' => [
            '{{WRAPPER}} .mtap-onepage-side-menu.mtap-v1 ul li.active' => 'background-color: {{VALUE}}',
          ],
          'condition' => [
            'version' => 'mtap-v1',
          ],
        ]
      );
      $this->add_control(
        'label_color_active_v2',
        [
          'label' => esc_html__( 'Label Color Active', 'mt-addons' ),
          'type' => \Elementor\Controls_Manager::COLOR,
          'selectors' => [
              '{{WRAPPER}} .mtap-onepage-side-menu.mtap-v2 ul li a' => 'color: {{VALUE}}',
          ],
          'condition' => [
              'version' => 'mtap-v2',
          ],
        ]
      );
      $this->add_control(
        'border_color_v2',
        [
          'label' => esc_html__( 'Circle Border Color', 'mt-addons' ),
          'type' => \Elementor\Controls_Manager::COLOR,
          'selectors' => [
              '{{WRAPPER}} .mtap-onepage-side-menu.mtap-v2 ul li a:after' => 'border-color: {{VALUE}}',
           ],
           'condition' => [
              'version' => 'mtap-v2',
           ],
        ]
      );
      $this->add_control(
       'bg_color_active_v2',
       [
          'label' => esc_html__( 'Circle Background Color Active', 'mt-addons' ),
          'type' => \Elementor\Controls_Manager::COLOR,
          'selectors' => [
            '{{WRAPPER}} .mtap-onepage-side-menu.mtap-v2 ul li.active a:after' => 'background: {{VALUE}}',
            '{{WRAPPER}} .mtap-onepage-side-menu.mtap-v2 ul li:hover a:after' => 'background: {{VALUE}}',
           ],
           'condition' => [
              'version' => 'mtap-v2',
           ],
        ]
      );
      $this->add_control(
        'label_color_active_v3',
        [
            'label' => esc_html__( 'Label Color Active', 'mt-addons' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
              '{{WRAPPER}} .mtap-onepage-side-menu.mtap-v3 ul li a span' => 'color: {{VALUE}}',
            ],
            'condition' => [
              'version' => 'mtap-v3',
            ],
        ]
      );
      $this->add_control(
        'icon_color_v3',
        [
          'label' => esc_html__( 'Icon Color', 'mt-addons' ),
          'type' => \Elementor\Controls_Manager::COLOR,
          'selectors' => [
            '{{WRAPPER}} .mtap-onepage-side-menu.mtap-v3 ul li a svg' => 'fill: {{VALUE}}',
          ],
          'condition' => [
            'version' => 'mtap-v3',
          ],
        ]
      );
      $this->add_control(
        'bg_icon_active_v3',
        [
          'label' => esc_html__( 'Icon Color Active', 'mt-addons' ),
          'type' => \Elementor\Controls_Manager::COLOR,
          'selectors' => [
              '{{WRAPPER}} .mtap-onepage-side-menu.mtap-v3 ul li.active a svg' => 'fill: {{VALUE}}',
              '{{WRAPPER}} .mtap-onepage-side-menu.mtap-v3 ul li:hover a svg' => 'fill: {{VALUE}}',
          ],
          'condition' => [
            'version' => 'mtap-v3',
          ],
        ]
      );
      $this->add_control(
        'bg_color_active_v3',
        [
          'label' => esc_html__( 'Background Color Active', 'mt-addons' ),
          'type' => \Elementor\Controls_Manager::COLOR,
          'selectors' => [
            '{{WRAPPER}} .mtap-onepage-side-menu.mtap-v3 ul li.active a svg' => 'background: {{VALUE}}',
            '{{WRAPPER}} .mtap-onepage-side-menu.mtap-v3 ul li:hover a svg' => 'background: {{VALUE}}',
          ],
          'condition' => [
            'version' => 'mtap-v3',
          ],
        ]
      );
      $this->add_control(
        'label_color_v4',
        [
          'label' => esc_html__( 'Label Color', 'mt-addons' ),
          'type' => \Elementor\Controls_Manager::COLOR,
          'selectors' => [
            '{{WRAPPER}} .mtap-onepage-side-menu.mtap-v4 ul li a span' => 'color: {{VALUE}}',
          ],
          'condition' => [
            'version' => 'mtap-v4',
          ],
        ]
      );
      $this->add_control(
        'label_color_active_v4',
        [
          'label' => esc_html__( 'Label Color Active', 'mt-addons' ),
          'type' => \Elementor\Controls_Manager::COLOR,
          'selectors' => [
            '{{WRAPPER}} .mtap-onepage-side-menu.mtap-v4 ul li.active a span' => 'color: {{VALUE}}',
            '{{WRAPPER}} .mtap-onepage-side-menu.mtap-v4 ul li:hover a span' => 'color: {{VALUE}}',
          ],
          'condition' => [
            'version' => 'mtap-v4',
          ],
        ]
      );
      $this->add_control(
          'bg_color_active_v4',
          [
            'label' => esc_html__( 'Background Color Active', 'mt-addons' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
              '{{WRAPPER}} .mtap-onepage-side-menu.mtap-v4 ul li.active' => 'background: {{VALUE}}',
              '{{WRAPPER}} .mtap-onepage-side-menu.mtap-v4 ul li:hover' => 'background: {{VALUE}}',
            ],
            'condition' => [
              'version' => 'mtap-v4',
            ],
          ]
      );
      $this->add_control(
        'label_color_v5',
        [
          'label' => esc_html__( 'Label Color', 'mt-addons' ),
          'type' => \Elementor\Controls_Manager::COLOR,
          'selectors' => [
            '{{WRAPPER}} .mtap-onepage-side-menu.mtap-v5 ul li a span' => 'color: {{VALUE}}',
          ],
          'condition' => [
            'version' => 'mtap-v5',
          ],
        ]
      );
      $this->add_control(
        'icon_active_color_v5',
        [
          'label' => esc_html__( 'Icon Active Color', 'mt-addons' ),
          'type' => \Elementor\Controls_Manager::COLOR,
          'selectors' => [
            '{{WRAPPER}} .mtap-onepage-side-menu.mtap-v5 ul li.active a svg' => 'fill: {{VALUE}}',
            '{{WRAPPER}} .mtap-onepage-side-menu.mtap-v5 ul li.active a' => 'border-left: 3px solid {{VALUE}}',
            '{{WRAPPER}} .mtap-onepage-side-menu.mtap-v5 ul li.active a span' => 'color: {{VALUE}}',
          ],
          'condition' => [
            'version' => 'mtap-v5',
          ],
        ]
      );
      $this->end_controls_section();
      $this->start_controls_section(
        'repeater_section',
        [
          'label' => esc_html__( 'Hyperlinks', 'mt-addons' ),
          'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
        'label',
        [
          'label' => esc_html__( 'Title Label', 'mt-addons' ),
          'type' => \Elementor\Controls_Manager::TEXT,
          'default' => esc_html__( 'Title Label', 'mt-addons' ),
          'placeholder' => esc_html__( 'Type your label here', 'mt-addons' ),
        ]
      );
      $repeater->add_control(
        'link_section',
        [
          'label' => esc_html__( 'Link', 'mt-addons' ),
          'type' => \Elementor\Controls_Manager::TEXT,
          'default' => esc_html__( 'section', 'mt-addons' ),
          'placeholder' => esc_html__( 'Type your section here', 'mt-addons' ),
        ]
      );
      $this->add_control(
        'list',
        [
          'label' => __( 'Nav Items', 'mt-addons' ),
          'type' => \Elementor\Controls_Manager::REPEATER,
          'fields' => $repeater->get_controls(),
          'default' => [
            [                      
              'icon'           => esc_html__( 'fas fa-circle', 'mt-addons' ),
              'label'          => esc_html__( 'Title Label', 'mt-addons' ),
              'link_section'   => esc_url( '#section', 'mt-addons' ),
            ],
            [                      
              'icon'           => esc_html__( 'fas fa-circle', 'mt-addons' ),
              'label'          => esc_html__( 'Title Label', 'mt-addons' ),
              'link_section'   => esc_url( '#section', 'mt-addons' ),
            ],
            [                      
              'icon'           => esc_html__( 'fas fa-circle', 'mt-addons' ),
              'label'          => esc_html__( 'Title Label', 'mt-addons' ),
              'link_section'   => esc_url( '#section', 'mt-addons' ),
            ],
          ],
          'title_field' => 'Nav Item',
        ]
      );
      $this->end_controls_section();
    }

    protected function render() {
      $settings                   = $this->get_settings_for_display();
      $version                    = $settings['version'];
      $position                   = $settings['position'];
      $orientation                = $settings['orientation'];
      $icons_mobile               = $settings['icons_mobile'];
      $label_color_active_v1      = $settings['label_color_active_v1'];
      $bg_color_active_v1         = $settings['bg_color_active_v1'];
      $label_color_active_v2      = $settings['label_color_active_v2'];
      $border_color_v2            = $settings['border_color_v2'];
      $bg_color_active_v2         = $settings['bg_color_active_v2'];
      $label_color_active_v3      = $settings['label_color_active_v3'];
      $icon_color_v3              = $settings['icon_color_v3'];
      $bg_icon_active_v3          = $settings['bg_icon_active_v3'];
      $bg_color_active_v3         = $settings['bg_color_active_v3'];
      $label_color_v4             = $settings['label_color_v4'];
      $label_color_active_v4      = $settings['label_color_active_v4'];
      $bg_color_active_v4         = $settings['bg_color_active_v4'];
      $label_color_v5             = $settings['label_color_v5'];
      $icon_active_color_v5       = $settings['icon_active_color_v5'];
      $list                       = $settings['list'];

      $version_class = 'v1';
      $position_class = 'bottom-center';
      $orientation_class = 'mtap-horizontal';
      $icons_mobile_class = 'all';

      if($version) {
        $version_class = $version;
      }

      if($position) {
        $position_class = $position;
      }

      if($orientation) {
        $orientation_class = $orientation;
      }

      if($orientation == 'mtap-horizontal') {
        $position_based = 'horizontal';
      } else {
        $position_based = 'vertical';
      }

      if($icons_mobile) {
        $icons_mobile_class = $icons_mobile;
      }
      ?>

      <nav id="mtap-onepage-navigation" class="mtap-onepage-side-menu <?php echo esc_attr($version_class.' '.$position_class.' '.$position_based); ?>">
          <ul class="<?php echo esc_attr($orientation_class.' '.$icons_mobile_class); ?>">
              <?php if (is_array($list) || is_object($list)) {
                  $first_item = true;
                  foreach ($list as $item) {
                      $label = $item['label'];
                      $link_section = $item['link_section'];
                      ?>
                      <li<?php if ($first_item) : ?> class="active"<?php $first_item = false; endif; ?>>
                          <a href="<?php echo esc_attr($link_section); ?>">
                              <?php if (in_array($version_class, ['mtap-v1', 'mtap-v3', 'mtap-v5'])) {
                                  \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true']);
                              } ?>
                              <span><?php echo esc_html($label); ?></span>
                          </a>
                      </li>
                  <?php } ?>
              <?php } ?>
          </ul>
      </nav>
      <?php
    }
  protected function content_template() {}
}