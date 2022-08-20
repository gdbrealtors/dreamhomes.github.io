<?php

use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

use Elementor\Group_Control_Typography;

use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;

class OSF_Elementor_Team_Box extends Elementor\Widget_Base
{

    /**
     * Get widget name.
     *
     * Retrieve testimonial widget name.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'opal-team-box';
    }

    /**
     * Get widget title.
     *
     * Retrieve testimonial widget title.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('Opal Team Box', 'rehomes-core');
    }

    /**
     * Get widget icon.
     *
     * Retrieve testimonial widget icon.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-person';
    }

    public function get_categories()
    {
        return array('opal-addons');
    }

    /**
     * Register testimonial widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function register_controls()
    {
        $this->start_controls_section(
            'section_team',
            [
                'label' => __('Team', 'rehomes-core'),
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'default' => 'full',
                'separator' => 'none',
            ]
        );

        $this->add_control(
            'view',
            [
                'label' => __('View', 'rehomes-core'),
                'type' => Controls_Manager::HIDDEN,
                'default' => 'traditional',
            ]
        );

        $this->add_control(
            'teams',
            [
                'label' => __('Team Item', 'rehomes-core'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => __('Choose Image', 'rehomes-core'),
                'default' => [
                    'url' => Elementor\Utils::get_placeholder_image_src(),
                ],
                'type' => Controls_Manager::MEDIA,
                'show_label' => false,
            ]
        );

        $this->add_control(
            'name',
            [
                'label' => __('Name', 'rehomes-core'),
                'default' => 'John Doe',
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'job',
            [
                'label' => __('Job', 'rehomes-core'),
                'default' => 'Designer',
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'phone',
            [
                'label' => __('Phone', 'rehomes-core'),
                'default' => '+(84)4 1800 33555',
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'contact',
            [
                'label' => __('Contact', 'rehomes-core'),
                'default' => 'contact@example.com',
                'placeholder' => __('contact@example.com', 'rehomes-core'),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __('Link to', 'rehomes-core'),
                'placeholder' => __('https://your-link.com', 'rehomes-core'),
                'type' => Controls_Manager::URL,
            ]
        );

        $this->add_control(
            'facebook',
            [
                'label' => __('Facebook', 'rehomes-core'),
                'placeholder' => __('https://www.facebook.com/opalwordpress', 'rehomes-core'),
                'default' => 'https://www.facebook.com/opalwordpress',
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'twitter',
            [
                'label' => __('Twitter', 'rehomes-core'),
                'placeholder' => __('https://twitter.com/opalwordpress', 'rehomes-core'),
                'default' => 'https://twitter.com/opalwordpress',
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'youtube',
            [
                'label' => __('Youtube', 'rehomes-core'),
                'placeholder' => __('https://www.youtube.com/user/WPOpalTheme', 'rehomes-core'),
                'default' => 'https://www.youtube.com/user/WPOpalTheme',
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'google',
            [
                'label' => __('Google', 'rehomes-core'),
                'placeholder' => __('https://plus.google.com/u/0/+WPOpal', 'rehomes-core'),
                'default' => 'https://plus.google.com/u/0/+WPOpal',
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->add_responsive_control(
            'team_align',
            [
                'label' => __('Alignment', 'rehomes-core'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'rehomes-core'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'rehomes-core'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'rehomes-core'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .elementor-teams-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();


        // Wrapper.
        $this->start_controls_section(
            'section_style_team_wrapper',
            [
                'label' => __('Wrapper', 'rehomes-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'wrapper_padding_inner',
            [
                'label'      => __( 'Padding', 'rehomes-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-teams-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrapper_margin',
            [
                'label'      => __( 'Margin', 'rehomes-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-teams-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        // Image.
        $this->start_controls_section(
            'section_style_team_image',
            [
                'label' => __('Image', 'rehomes-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'border_image',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .elementor-team-image img',
                'separator'   => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'image_box_shadow',
                'selector' => '{{WRAPPER}} .elementor-team-image img',
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label'      => __( 'Border Radius', 'rehomes-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-team-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_padding',
            [
                'label'      => __( 'Padding', 'rehomes-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-team-image img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_margin',
            [
                'label'      => __( 'Margin', 'rehomes-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-team-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Name.
        $this->start_controls_section(
            'section_style_team_name',
            [
                'label' => __('Name', 'rehomes-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'name_text_color',
            [
                'label' => __('Color', 'rehomes-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-teams-wrapper .elementor-team-name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'name_text_color_hover',
            [
                'label' => __('Hover Color', 'rehomes-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-teams-wrapper .elementor-team-name:hover' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'name_typography',
                'selector' => '{{WRAPPER}} .elementor-teams-wrapper .elementor-team-name',
            ]
        );

        $this->add_responsive_control(
            'name_space',
            [
                'label' => __('Spacing', 'rehomes-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-teams-wrapper .elementor-team-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Job.
        $this->start_controls_section(
            'section_style_team_job',
            [
                'label' => __('Job', 'rehomes-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'job_text_color',
            [
                'label' => __('Text Color', 'rehomes-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-teams-wrapper .elementor-team-job' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'job_typography',
                'selector' => '{{WRAPPER}} .elementor-teams-wrapper .elementor-team-job',
            ]
        );

        $this->end_controls_section();
        // Phone
        $this->start_controls_section(
            'section_style_team_phone',
            [
                'label' => __('Phone', 'rehomes-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'phone_text_color',
            [
                'label' => __('Color', 'rehomes-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-teams-wrapper .elementor-team-phone' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'phone_text_color_hover',
            [
                'label' => __('Hover Color', 'rehomes-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-teams-wrapper .elementor-team-phone:hover' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'phone_typography',
                'selector' => '{{WRAPPER}} .elementor-teams-wrapper .elementor-team-phone',
            ]
        );

        $this->add_responsive_control(
            'phone_space',
            [
                'label' => __('Spacing', 'rehomes-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-teams-wrapper .elementor-team-phone' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        // Contact
        $this->start_controls_section(
            'section_style_team_text-contact',
            [
                'label' => __('Contact', 'rehomes-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text-contact_text_color',
            [
                'label' => __('Color', 'rehomes-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-teams-wrapper .elementor-team-text-contact' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'text-contact_color_hover',
            [
                'label' => __('Hover Color', 'rehomes-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-teams-wrapper .elementor-team-text-contact:hover' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text-contact_typography',
                'selector' => '{{WRAPPER}} .elementor-teams-wrapper .elementor-team-text-contact',
            ]
        );

        $this->add_responsive_control(
            'text-contact_space',
            [
                'label' => __('Spacing', 'rehomes-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-teams-wrapper .elementor-team-text-contact' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Icon Social.
        $this->start_controls_section(
            'section_style_icon_social',
            [
                'label' => __('Icon Social', 'rehomes-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'icon_social_font_size',
            [
                'label' => __('Font Size', 'rehomes-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .team-icon-socials' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->start_controls_tabs('tabs_icon_social_style');

        $this->start_controls_tab(
            'tab_icon_social_normal',
            [
                'label' => __('Normal', 'rehomes-core'),
            ]
        );

        $this->add_control(
            'color_icon_social',
            [
                'label' => __('Color', 'rehomes-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',

                'selectors' => [
                    '{{WRAPPER}} .team-icon-socials a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_icon_social_hover',
            [
                'label' => __('Hover', 'rehomes-core'),
            ]
        );

        $this->add_control(
            'color_icon_social_hover',
            [
                'label' => __('Color', 'rehomes-core'),
                'type' => Controls_Manager::COLOR,
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-team-socials li:hover a' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_wrapper',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .team-icon-socials',
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Render testimonial widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('wrapper', 'class', 'elementor-teams-wrapper');


        // Item
        $this->add_render_attribute('item', 'class', 'elementor-team-item');

        $this->add_render_attribute('meta', 'class', 'elementor-team-meta');

        ?>
        <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
            <div <?php echo $this->get_render_attribute_string('item'); ?>>
                <?php $this->render_style($settings) ?>
            </div>
        </div>
        <?php
    }

    protected function render_style($settings)
    {
        $team_name_html = $settings['name'];
        if (!empty($settings['link']['url'])) :
            $team_name_html = '<a href="' . esc_url($settings['link']['url']) . '">' . $team_name_html . '</a>';
        endif;
        ?>
        <div class="elementor-team-meta-inner">
            <div class="elementor-team-image">
                <?php
                if (!empty($settings['image']['url'])) :
                    $image_html = Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'image');
                    echo $image_html;
                endif;
                ?>

                <div class="elementor-team-socials">

                    <span class="elementor-team-phone"><?php echo $settings['phone']; ?></span>
                    <span class="elementor-team-text-contact"><?php echo $settings['contact']; ?></span>

                    <ul class="team-icon-socials">
                        <?php foreach ($this->get_socials() as $key => $social): ?>
                            <?php if (!empty($settings[$key])) : ?>
                                <li class="social">
                                    <a href="<?php echo esc_url($settings[$key]) ?>">
                                        <i class="fa <?php echo esc_attr($social); ?>"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>

            </div>
            <div class="elementor-team-details">
                <div class="elementor-team-job"><?php echo $settings['job']; ?></div>
                <div class="elementor-team-name"><?php echo $team_name_html; ?></div>

            </div>
        </div>
        <?php
    }

    private function get_socials()
    {
        return array(
            'facebook'  => 'fa-facebook',
            'twitter'   => 'fa-twitter',
            'youtube'   => 'fa-youtube',
            'google'    => 'fa-google-plus',
        );
    }

}

$widgets_manager->register_widget_type(new OSF_Elementor_Team_Box());
