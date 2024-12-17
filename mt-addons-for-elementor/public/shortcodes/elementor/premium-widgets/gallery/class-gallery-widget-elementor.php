<?php
class MT_Addons_Premium_Gallery extends \Elementor\Widget_Base {
    public function get_style_depends() {
        wp_enqueue_style( 'mt-addons-premium-gallery', plugin_dir_url( __FILE__ ).'css/gallery.css');
        return [
            'mt-addons-premium-gallery' 
        ];
    }
    public function get_script_depends() {
        wp_register_script( 'mt-addons-premium-gallery', plugin_dir_url( __FILE__ ).'js/gallery.js');

        
        return [ 'jquery', 'elementor-frontend','mt-addons-premium-gallery'];
    }
    public function get_name()
    {
        return 'mtap-gallery';
    }

    public function get_title()
    {
        return esc_html__('MT: Gallery', 'mt-addons');
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return [ 'mt-addons-premium' ];
    }

    public function get_keywords() {
        return [ 'gallery', 'image' ];
    }

    protected function register_controls() {
        $this->all_controls();
    }

    private function all_controls() {
        $this->start_controls_section(
            'image_info',
            [
                'label'             => esc_html__('Settings', 'mt-addons'),
                'tab'               => \Elementor\Controls_Manager::TAB_CONTENT,
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
                'label' => esc_html__( 'Choose Image', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
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
                        'above_title'     => esc_html__( 'Watch', 'mt-addons' ),
                        'title'           => esc_html__( 'Showcase', 'mt-addons' ),
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
        <section class="map-gallery">
            <div class="map-grid">
                <?php if ($items_groups) { ?>
                    <?php foreach ($items_groups as $item) {
                        $title      = $item['title']; 
                        $subtitle   = $item['subtitle']; 
                        $image      = $item['image']['url']; 

                        ?>
                        <div class="column-xs-12 column-md-4">
                            <figure class="map-img-container">
                                <img class="map-img-class" src="<?php echo esc_url($image); ?>" />
                                <figcaption class="map-img-content">
                                    <h2 class="title"><?php echo esc_html($title);?></h2>
                                    <h3 class="category"><?php echo esc_html($subtitle);?></h3>
                                </figcaption>
                                  <span class="map-img-content-hover">
                                    <h2 class="title"><?php echo esc_html($title);?></h2>
                                    <h3 class="category"><?php echo esc_html($subtitle);?></h3>
                                  </span>
                            </figure>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </section>

        <?php
            ?>
            <script type="text/javascript">
                const imgContent = document.querySelectorAll('.map-img-content-hover');
                function showImgContent(e) {
                  const offsetX = 15;
                  const offsetY = 15; 

                  for (let i = 0; i < imgContent.length; i++) {
                    const x = e.pageX + offsetX;
                    const y = e.pageY + offsetY;
                    imgContent[i].style.transform = `translate3d(${x}px, ${y}px, 0)`;
                  }
                }
                document.addEventListener('mousemove', showImgContent);
            </script>
        <?php
    }

    protected function content_template() {}
}