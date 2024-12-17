<?php
class MT_Addons_Premium_Mailchimp_Form extends \Elementor\Widget_Base {
    public function get_style_depends() {
        wp_enqueue_style( 'mt-addons-premium-mailchimp-form', plugin_dir_url( __FILE__ ).'css/mailchimp-form.css');
        return [
            'mt-addons-premium-mailchimp-form',
        ];
    }

    public function get_name()
    {
        return 'mtap-mailchimp-form';
    }

    public function get_title()
    {
        return esc_html__('MT Mailchimp Form', 'mt-addons');
    }

    public function get_icon() {
        return 'eicon-mailchimp';
    }

    public function get_categories() {
        return [ 'mt-addons-premium' ];
    }

    public function get_keywords() {
        return [ 'mailchimp form', 'form' ];
    }

    protected function register_controls() {
        $this->all_controls();
    }

    private function all_controls() {
        $this->start_controls_section(
            'category_info',
            [
                'label'            => esc_html__('Content', 'mt-addons'),
                'tab'              => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $mc4 = get_posts( 'post_type="mc4wp-form"&numberposts=-1' );
        $mailchimp_forms = array();
        if ( $mc4 ) {
            foreach ( $mc4 as $mcform ) {
                $mailchimp_forms[ $mcform->ID ] = $mcform->post_title;
            }
        } else {
            $mailchimp_forms[ esc_html__( 'No contact forms found', 'mt-addons' ) ] = 0;
        }
        $this->add_control(
            'mailchimp_forms',
            [
                'label'         => esc_html__( 'Select Contact Form', 'mt-addons' ),
                'type'          =>  \Elementor\Controls_Manager::SELECT,
                'options'       => $mailchimp_forms,
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'style_sub_heading',
            [
                'label'         => esc_html__( 'Fields', 'mt-addons' ),
                'tab'           =>  \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'field_width',
            [
                'label'         => esc_html__('Field Width', 'mt-addons'),
                'placeholder'   => esc_html__( 'Type your width here', 'mt-addons' ),
                'type'          =>  \Elementor\Controls_Manager::NUMBER,
                'selectors'     => [
                    ' {{WRAPPER}} .mt-addons-premium-mailchimp-form .mc4wp-form textarea, {{WRAPPER}} .mc4wp-form-control:not(input[type="submit"])' => 'width: {{VALUE}}%',
                    ' {{WRAPPER}} .mt-addons-premium-mailchimp-form .mc4wp-form label' => 'width: {{VALUE}}%',
                ],
                    'default'   => 100,
            ]
        );
        $this->add_control(
            'field_padding',
            [
                'label'         => esc_html__('Field Padding', 'mt-addons'),
                'type'          =>  \Elementor\Controls_Manager::DIMENSIONS,
                'selectors'     => [
                    '{{WRAPPER}} .mc4wp-form-control:not(input[type="submit"])' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    '{{WRAPPER}} span.mc4wp-form-control-wrap textarea.mc4wp-form-control.wpcf7-textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    '{{WRAPPER}} span.mc4wp-form-control-wrap div.wpforms-container-full .wpforms-form textarea, textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]    
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'fields_typography', 
                'label'         => esc_html__( 'Field Typography', 'mt-addons' ),
                'selector'      => '{{WRAPPER}} body .mt-addons-premium-mailchimp-form .mc4wp-form input[type="text"], body .mt-addons-premium-mailchimp-form .mc4wp-form input, .mt-addons-premium-mailchimp-form .mc4wp-form textarea',
            ]
        );
        $this->add_control(
            'field_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Field Color', 'mt-addons' ),
                'selectors'     => [
                    '{{WRAPPER}} body .mt-addons-premium-mailchimp-form .mc4wp-form input[type="text"], body .mt-addons-premium-mailchimp-form .mc4wp-form input, .mt-addons-premium-mailchimp-form .mc4wp-form textarea' => 'color: {{VALUE}};'
                ],
                'default'       => '#000000',
            ]
        );
        $this->add_control(
            'contact_divider_1',
            [
                'type'          => \Elementor\Controls_Manager::DIVIDER,
            ]
        );
        $this->add_control(
            'label_spacing',
            [
                'label'             => esc_html__( 'Label Spacing', 'mt-addons' ),
                'type'              => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'        => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} body .mt-addons-premium-mailchimp-form .mc4wp-form input[type="text"], body .mt-addons-premium-mailchimp-form .mc4wp-form input, .mt-addons-premium-mailchimp-form .mc4wp-form textarea' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'label_typography', 
                'label'         => esc_html__( 'Label Typography', 'mt-addons' ),
                'selector'      => '{{WRAPPER}} .mt-addons-premium-mailchimp-form .mc4wp-form label',
            ]
        );
        $this->add_control(
            'label_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Label Color', 'mt-addons' ),
                'selectors'     => [
                    '{{WRAPPER}} .mt-addons-premium-mailchimp-form .mc4wp-form label' => 'color: {{VALUE}}',
                ],
                'default'       => '#000000',
            ]
        );
        $this->add_control(
            'contact_divider_2',
            [
                'type'          => \Elementor\Controls_Manager::DIVIDER,
            ]
        );
        $this->add_control(
            'placeholder_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Placeholder Color', 'mt-addons' ),
                'selectors'     => [
                    '{{WRAPPER}} .mt-addons-premium-mailchimp-form ::placeholder' => 'color: {{VALUE}} !important',
                ],
                'default'       => '#3B3F59',
            ]
        );
        $this->add_control(
            'contact_divider_3',
            [
                'type'          => \Elementor\Controls_Manager::DIVIDER,
            ]
        );
        $this->add_control(
            'background_label',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Background', 'mt-addons' ),
                'selectors'     => [
                    ' {{WRAPPER}} .mt-addons-premium-mailchimp-form .mc4wp-form .mc4wp-form-control:not(input[type="submit"]), .mt-addons-premium-mailchimp-form .mc4wp-form textarea' => 'background-color: {{VALUE}}',
                ],
                'default'       => 'transparent',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'field_padding_box_shadow',
                'selector'      => '{{WRAPPER}} .mc4wp-form input, .mc4wp-form textarea',
            ]
        );
        $this->add_control(
            'contact_divider_4',
            [
                'type'          => \Elementor\Controls_Manager::DIVIDER,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'          => 'field_border',
                'label'         => esc_html__( 'Border', 'mt-addons' ),
                'selector'      => '{{WRAPPER}} .mc4wp-form .mc4wp-form-control:not(input[type="submit"]), .mc4wp-form textarea',
            ]
        );
        $this->add_responsive_control(
            'field_border_radius',
            [
                'label'         => esc_html__( 'Border Radius', 'mt-addons' ),
                'type'          =>  \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', '%', 'em'],
                'selectors'     => [ 
                    '{{WRAPPER}} .mt-addons-premium-mailchimp-form .mc4wp-form input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .mt-addons-premium-mailchimp-form .mc4wp-form textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_section();

        $this->start_controls_section(
            'focus_fields',
            [
                'label'         => esc_html__( 'Focus Fields', 'mt-addons' ),
                'tab'           =>  \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'          => 'focus_border',
                'label'         => esc_html__( 'Border', 'mt-addons' ),
                'selector'      => '{{WRAPPER}} .mt-addons-premium-mailchimp-form .mc4wp-form .mc4wp-form-control:not(input[type="submit"]):focus, .mt-addons-premium-mailchimp-form .mc4wp-form textarea:focus',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_section();
        $this->start_controls_section(
            'style_button',
            [
                'label'         => esc_html__( 'Button', 'mt-addons' ),
                'tab'           =>  \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'button_width',
            [
                'label'         => esc_html__( 'Width', 'mt-addons' ),
                'type'          => \Elementor\Controls_Manager::NUMBER,
                'min'           => 1,
                'max'           => 100,
                'step'          => 5,
                'default'       => 100,
                'selectors'     => [
                    '{{WRAPPER}} .mt-addons-premium-mailchimp-form  .mc4wp-form [type=submit]' => 'width: {{VALUE}}%',
                ],
            ]
        );
        $this->add_control(
            'button_submit_padding',
            [
                'label'         => esc_html__( 'Padding', 'mt-addons' ),
                'type'          =>  \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', '%', 'em'],
                'selectors'     => [
                    '{{WRAPPER}} .mt-addons-premium-mailchimp-form  .mc4wp-form [type=submit]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default'       => [
                    'unit'          => 'px',
                    'top'           => 10,
                    'right'         => 30,
                    'bottom'        => 10,
                    'left'          => 30,
                ]
            ]
        );
        $this->add_control(
            'contact_divider_5',
            [
                'type'          => \Elementor\Controls_Manager::DIVIDER,
            ]
        );
        $this->add_control(
            'button_background_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Background', 'mt-addons' ),
                'selectors'     => [
                    '{{WRAPPER}} .mt-addons-premium-mailchimp-form  .mc4wp-form [type=submit]' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'button_background_hover_color',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Hover Background', 'mt-addons' ),
                'selectors'     => [
                    '{{WRAPPER}} .mt-addons-premium-mailchimp-form  .mc4wp-form [type=submit]:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'button_submit_box_shadow',
                'selector'      => '{{WRAPPER}} .mc4wp-form [type=submit]',
            ]
        );
        $this->add_control(
            'contact_divider_6',
            [
                'type'          => \Elementor\Controls_Manager::DIVIDER,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'button_typography',
                'label'         => esc_html__( 'Typography', 'mt-addons' ),
                'selector'      => '{{WRAPPER}} .mc4wp-form [type=submit]',
            ]
        );
        $this->add_control(
            'button_background_text',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Text Color', 'mt-addons' ),
                'selectors'     => [
                    '{{WRAPPER}} .mt-addons-premium-mailchimp-form  .mc4wp-form [type=submit]' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'button_background_text_hover',
            [
                'type'          => \Elementor\Controls_Manager::COLOR,
                'label'         => esc_html__( 'Hover Text Color', 'mt-addons' ),
                'selectors'     => [
                    '{{WRAPPER}} .mt-addons-premium-mailchimp-form  .mc4wp-form [type=submit]:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'contact_divider_7',
            [
                'type'          => \Elementor\Controls_Manager::DIVIDER,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'          => 'button_submit_border',
                'label'         => esc_html__( 'Border', 'mt-addons' ),
                'selector'      => '{{WRAPPER}} .mt-addons-premium-mailchimp-form .mc4wp-form [type=submit]',
            ]
        );
        $this->add_responsive_control(
            'button_submit_border',
            [
                'label'         => esc_html__( 'Border Radius', 'mt-addons' ),
                'type'          =>  \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', '%', 'em'],
                'selectors'     => [
                    '{{WRAPPER}} .mc4wp-form [type=submit]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default'       => [
                    'unit'          => 'px',
                    'top'           => 30,
                    'right'         => 30,
                    'bottom'        => 30,
                    'left'          => 30,
                ]
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_section();
    }

    protected function render() {
        $settings           = $this->get_settings_for_display();
        $mailchimp_forms      = $settings['mailchimp_forms'];

        $id = 'mt-addons-premium-mailchimp-form-'.uniqid();
        
        ?>

        <div class="mt-addons-premium-mailchimp-form" id="<?php echo esc_attr($id); ?>">
            <?php if (!empty($mailchimp_forms)) {
                echo do_shortcode( '[mc4wp_form id="' . esc_attr($mailchimp_forms) . '" title="'.esc_html__('Mailchimp Form','mt-addons').'"]' );
            } ?>
        </div>
        <?php
    }

    protected function content_template() {}
}