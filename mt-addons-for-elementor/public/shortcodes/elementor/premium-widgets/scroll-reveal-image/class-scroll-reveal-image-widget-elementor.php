<?php
class MT_Addons_Premium_Scroll_Reveal_Image extends \Elementor\Widget_Base {
    public function get_style_depends() {
        wp_enqueue_style( 'mt-addons-premium-scroll-reveal-image', plugin_dir_url( __FILE__ ).'css/scroll-reveal-image.css');
        return [
            'mt-addons-premium-scroll-reveal-image',
        ];
    }
    public function get_script_depends() {
        wp_enqueue_script( 'mt-addons-premium-scroll-reveal-image', plugin_dir_url( __FILE__ ).'js/scroll-reveal-image.js' );   

        return [ 'jquery', 'elementor-frontend', 'mt-addons-premium-scroll-reveal-image'];
    }
    public function get_name()
    {
        return 'mtap-scroll-reveal-image';
    }

    public function get_title()
    {
        return esc_html__('MT Scroll Reveal Image', 'mt-addons');
    }

    public function get_icon() {
        return 'eicon-scroll';
    }

    public function get_categories() {
        return [ 'mt-addons-premium' ];
    }

    public function get_keywords() {
        return [ 'scroll reveal image', 'scroll image' ];
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
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'content',
            [
                'label' => esc_html__( 'Content', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'placeholder' => esc_html__( 'Type your description here', 'mt-addons' ),
            ]
        );
        $repeater->add_control(
            'url_title', 
            [
                'label'         => esc_html__( 'URL Name', 'mt-addons' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        ); 
        $repeater->add_control(
            'link', 
            [
                'label' => esc_html__( 'Link', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'mt-addons' ),
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'type',
            [
                'label' => esc_html__( 'Select type', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'video',
                'options' => [
                    '' => esc_html__( 'Default', 'mt-addons' ),
                    'none' => esc_html__( 'None', 'mt-addons' ),
                    'video'  => esc_html__( 'Video', 'mt-addons' ),
                    'image' => esc_html__( 'Image', 'mt-addons' ),
                ],
            ]
        );
        $repeater->add_control(
            'video',
            [
                'label' => esc_html__( 'Choose Video File', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'media_types' => [ 'video' ],
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'type' => 'video',
                ],
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
                'condition' => [
                    'type' => 'image',
                ],
            ]
        );
        $repeater->add_control(
            'review_name', 
            [
                'label'         => esc_html__( 'Name', 'mt-addons' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        ); 
        $repeater->add_control(
            'review_position', 
            [
                'label'         => esc_html__( 'Position', 'mt-addons' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
            ]
        );
        $repeater->add_control(
            'review_description',
            [
                'label' => esc_html__( 'Content', 'mt-addons' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Enter your content', 'mt-addons' ),
            ]
        );
        $repeater->add_control(
            'review_image',
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
                        'content'              => esc_html__( '<h1>Connect every part of your business</h1>
                        <p>Drag-and-drop editing helps you build them fast, with your choice of 750+ ready-to-use, free templates. You can also customize your own dynamic versions.</p>', 'mt-addons' ),
                        'review_name'           => esc_html__( 'Emma Roberts', 'mt-addons' ),
                        'review_position'       => esc_html__( 'CEO Yahoo', 'mt-addons' ),
                        'review_description'    => esc_html__( '"Unleash cross-media information without cross-media value maximize timely deliverables for real-time."', 'mt-addons' ),
                    ],
                    [
                        'content'              => esc_html__( '<h1>We Can Build Strategy</h1>
                        <p>Drag-and-drop editing helps you build them fast, with your choice of 750+ ready-to-use, free templates. You can also customize your own dynamic versions.</p>', 'mt-addons' ),
                        'review_name'           => esc_html__( 'Vanessa Daniel', 'mt-addons' ),
                        'review_position'       => esc_html__( 'CEO Cryptic', 'mt-addons' ),
                        'review_description'    => esc_html__( '"Iterative approaches to corporate strategy foster collaborative thinking to further."', 'mt-addons' ),
                    ],
                    [
                        'content'              => esc_html__( '<h1>Fits Your Requirements</h1>
                        <p>Drag-and-drop editing helps you build them fast, with your choice of 750+ ready-to-use, free templates. You can also customize your own dynamic versions.</p>', 'mt-addons' ),
                        'review_name'           => esc_html__( 'Thomas Moriz', 'mt-addons' ),
                        'review_position'       => esc_html__( 'CEO YouTube', 'mt-addons' ),
                        'review_description'    => esc_html__( '"Unleash cross-media information without cross-media value maximize timely deliverables for real-time."', 'mt-addons' ),
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
        <section class="mt-addons-premium-large-scroll mb-120" data-pd-block="mt-addons-premium-large-scroll">
            <div class="mapc mt-addons-premium-container-wide">
                <div class="mapc mt-addons-premium-container-wide-narrow"></div>
                <div class="mt-addons-premium-large-scroll-row">
                    <div class="mt-addons-premium-large-scroll-content">
                        <?php if ($items_groups) { ?>
                            <?php foreach ($items_groups as $item) { 
                                $type                   = $item['type'];
                                $video_url = isset($item['video']['url']) ? $item['video']['url'] : '';
                                $image                  = isset($item['image']['url']) ? $item['image']['url'] : '';
                                $content                = $item['content'];
                                $review_description     = $item['review_description'];
                                $review_name            = $item['review_name'];
                                $review_position        = $item['review_position'];
                                $review_image           = $item['review_image']['url'];
                                $link                   = $item['link']['url'];
                                $url_title              = $item['url_title'];

                                if ($type === 'video' && !empty($video_url)) { ?>
                                    <article class="mt-addons-premium-large-scroll-item" data-feature-large-scroll-section="" data-video="<?php echo esc_attr($video_url); ?>">
                                <?php } elseif ($type === 'image' && !empty($image)) { ?>
                                    <article class="mt-addons-premium-large-scroll-item" data-feature-large-scroll-section="" data-image="<?php echo esc_url($image); ?>">
                                        <!-- <img src="<?php // echo esc_url($image); ?>" alt="Image"> -->
                                <?php } ?>

                                <div class="mb-05em text-body-l typo-tiny typo-tiny--list-checked">
                                    <?php echo html_entity_decode($content); ?>
                                </div>
                                <?php if (!empty($url_title)) { ?>
                                    <a class="mt-addons-premium-url" href="<?php echo esc_url($link); ?>"><?php echo esc_html($url_title); ?></a>
                                <?php } ?>

                                <article class="mt-addons-premium-large-scroll-card-review mt-addons-premium-large-scroll-item-card">
                                    <div class="mt-addons-premium-large-scroll-card-review__content">
                                        <p class="mt-addons-premium-card-review-description mb-20"><?php echo esc_html($review_description); ?></p>
                                    </div>
                                    <div class="mt-addons-premium-large-scroll-card-review__footer">
                                        <div class="mt-addons-premium-author">
                                            <div class="mt-addons-premium-author-body">
                                                <div class="mt-addons-premium-avatar mt-addons-premium-author-avatar mt-addons-premium-author-avatar">
                                                    <img decoding="async" src="<?php echo esc_url($review_image); ?>" alt="<?php echo esc_html($review_name); ?>" loading="lazy" width="80" height="80" class="mt-addons-premium-image-block" fetchpriority="low">
                                                </div>
                                                <p class="mt-addons-premium-author-content">
                                                    <span class="mt-addons-premium-author-name"><?php echo esc_html($review_name); ?></span>
                                                    <span class="mt-addons-premium-author-position"><?php echo esc_html($review_position); ?></span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                                <div data-feature-large-scroll-section-media="" class="mt-30 hide-desktop feature-large-scroll__mobile-image feature-large-scroll__mobile-image--border ">
                                    <?php if ($type === 'video' && !empty($video_url)) { ?>
                                        <video width="700" height="460" muted="" playsinline="" loop="" autoplay="" class="mt-addons-premium-image-block" src="<?php echo esc_attr($video_url); ?>"></video>
                                    <?php } elseif ($type === 'image' && !empty($image)) { ?>
                                        <img class="mt-addons-premium-data-image" data-feature-large-scroll-section="" data-image="<?php echo esc_url($image); ?>">

                                    <?php } ?>
                                </div>
                            </article>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="mt-addons-premium-scroll__sticky hide-mobile-tablets">
                        <div class="mt-addons-premium-scroll__sticky-content bg-color-catchy-sand mt-addons-premium-scroll__sticky-content--border" style="top: -42px;" data-feature-large-scroll-sticky-content="">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php
    }

    protected function content_template() {}
}


