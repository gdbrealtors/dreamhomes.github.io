<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Group_Control_Css_Filter;
use Elementor\Controls_Manager;
use Elementor\Utils;

use Elementor\Group_Control_Typography;

use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;

class OSF_Elementor_Testimonials extends OSF_Elementor_Carousel_Base {

    /**
     * Get widget name.
     *
     * Retrieve testimonial widget name.
     *
     * @return string Widget name.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_name() {
        return 'opal-testimonials';
    }

    /**
     * Get widget title.
     *
     * Retrieve testimonial widget title.
     *
     * @return string Widget title.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_title() {
        return __('Opal Testimonials', 'rehomes-core');
    }

    /**
     * Get widget icon.
     *
     * Retrieve testimonial widget icon.
     *
     * @return string Widget icon.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_icon() {
        return 'eicon-testimonial';
    }

    public function get_categories() {
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
    protected function register_controls() {
        $this->start_controls_section(
            'section_testimonial',
            [
                'label' => __('Testimonials', 'rehomes-core'),
            ]
        );


        $repeater = new \Elementor\Repeater();

        $repeater->add_control('testimonial_icon', [
            'label'   => __('Icon', 'rehomes-core'),
            'type'    => Controls_Manager::ICON,
            'default' => 'fa fa-star',
        ]);

        $repeater->add_control('testimonial_sub_title', [
            'label'   => __('Sub Title', 'rehomes-core'),
            'type'    => Controls_Manager::TEXT,
            'default' => 'TESTIMONIALS',
        ]);

        $repeater->add_control('testimonial_title', [
            'label'       => __('Title', 'rehomes-core'),
            'type'        => Controls_Manager::TEXTAREA,
            'default'     => 'Click edit button to change this text',
            'label_block' => true,
            'rows'        => '5',
        ]);

        $repeater->add_control('testimonial_content', [
            'label'       => __('Content', 'rehomes-core'),
            'type'        => Controls_Manager::TEXTAREA,
            'default'     => 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
            'label_block' => true,
            'rows'        => '10',
        ]);

        $repeater->add_control('testimonial_image', [
            'label'      => __('Choose Image', 'rehomes-core'),
            'default'    => [
                'url' => Utils::get_placeholder_image_src(),
            ],
            'type'       => Controls_Manager::MEDIA,
            'show_label' => false,
        ]);

        $repeater->add_control('testimonial_name', [
            'label'   => __('Name', 'rehomes-core'),
            'default' => 'John Doe',
            'type'    => Controls_Manager::TEXT,
        ]);

        $repeater->add_control('testimonial_job', [
            'label'   => __('Job', 'rehomes-core'),
            'default' => 'Design',
            'type'    => Controls_Manager::TEXT,
        ]);

        $repeater->add_control('testimonial_link', [
            'label'       => __('Link to', 'rehomes-core'),
            'placeholder' => __('https://your-link.com', 'rehomes-core'),
            'type'        => Controls_Manager::URL,
        ]);

        $this->add_control(
            'testimonials',
            [
                'label'       => __('Testimonials Item', 'rehomes-core'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ testimonial_name }}}',
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Image_Size::get_type(),
            [
                'name'      => 'testimonial_image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `testimonial_image_size` and `testimonial_image_custom_dimension`.
                'default'   => 'full',
                'separator' => 'none',
            ]
        );

        $this->add_control(
            'testimonial_alignment',
            [
                'label'        => __('Alignment', 'rehomes-core'),
                'type'         => Controls_Manager::CHOOSE,
                'default'      => 'center',
                'options'      => [
                    'left'   => [
                        'title' => __('Left', 'rehomes-core'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'rehomes-core'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => __('Right', 'rehomes-core'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'label_block'  => false,
                'prefix_class' => 'elementor-testimonial-text-align-',
            ]
        );

        $this->add_responsive_control(
            'column',
            [
                'label'   => __('Columns', 'rehomes-core'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 1,
                'options' => [1 => 1, 2 => 2, 3 => 3, 4 => 4, 6 => 6],
            ]
        );

        $this->add_control(
            'testimonial_layout',
            [
                'label'   => __('Layout', 'rehomes-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'layout_1',
                'options' => [
                    'layout_1' => __('Layout 1', 'rehomes-core'),
                    'layout_2' => __('Layout 2', 'rehomes-core'),
                ],
            ]
        );
        $this->add_control(
            'view',
            [
                'label'   => __('View', 'rehomes-core'),
                'type'    => Controls_Manager::HIDDEN,
                'default' => 'traditional',
            ]
        );
        $this->end_controls_section();


        // WRAPPER STYLE
        $this->start_controls_section(
            'section_style_testimonial_wrapper',
            [
                'label' => __('Wrapper', 'rehomes-core'),
                'tab'   => Controls_Manager::TAB_STYLE,

            ]
        );

        $this->add_responsive_control(
            'padding_estimonial_wrapper',
            [
                'label'      => __('Padding', 'rehomes-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .item-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'color_testimonial_wrapper',
            [
                'label'     => __('Background Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .item-box' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'wrapper_border',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .item-box',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'wrapper_radius',
            [
                'label'      => __('Border Radius', 'rehomes-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .item-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'wrapper_box_shadow',
                'selector' => '{{WRAPPER}} .item-box',
            ]
        );

        $this->end_controls_section();

        //Icon
        $this->start_controls_section(
            'section_style_testimonial_icon',
            [
                'label' => __('Icon', 'rehomes-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => __('Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-icon-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color_hover',
            [
                'label'     => __('Color Hover', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .item-box:hover .elementor-testimonial-icon-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_spacing',
            [
                'label'     => __('Spacing', 'rehomes-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'     => __('Size', 'rehomes-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-icon-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_margin',
            [
                'label'      => __('Margin', 'rehomes-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-testimonial-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_padding',
            [
                'label'      => __('Padding', 'rehomes-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-testimonial-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Image.
        $this->start_controls_section(
            'section_style_testimonial_image',
            [
                'label' => __('Image', 'rehomes-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'image_border',
                'selector'  => '{{WRAPPER}} .elementor-testimonial-item-wrapper .elementor-testimonial-image img',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label'      => __('Border Radius', 'rehomes-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-testimonial-item-wrapper .elementor-testimonial-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_margin',
            [
                'label'      => __('Margin', 'rehomes-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-testimonial-item-wrapper .elementor-testimonial-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Content style
        $this->start_controls_section(
            'section_style_testimonial_style',
            [
                'label' => __('Content', 'rehomes-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_content_color',
            [
                'label'     => __('Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_content_color_hover',
            [
                'label'     => __('Color Hover', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .item-box:hover .elementor-testimonial-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'selector' => '{{WRAPPER}} .elementor-testimonial-content',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_ACCENT,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'content_border',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .elementor-testimonial-content',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'content_radius',
            [
                'label'      => __('Border Radius', 'rehomes-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-testimonial-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_spacing',
            [
                'label'     => __('Spacing', 'rehomes-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Sub Title
        $this->start_controls_section(
            'section_style_testimonial_sub_title',
            [
                'label' => __('Sub Title', 'rehomes-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'subtitle_subtitle_color',
            [
                'label'     => __('Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-sub-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle_subtitle_color_hover',
            [
                'label'     => __('Color Hover', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .item-box:hover .elementor-testimonial-sub-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'subtitle_typography',
                'selector' => '{{WRAPPER}} .elementor-testimonial-sub-title',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_ACCENT,
                ],
            ]
        );

        $this->add_responsive_control(
            'subtitle_spacing',
            [
                'label'     => __('Spacing', 'rehomes-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => -65,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-title' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Title
        $this->start_controls_section(
            'section_style_testimonial_title',
            [
                'label' => __('Title', 'rehomes-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_title_color',
            [
                'label'     => __('Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_title_color_hover',
            [
                'label'     => __('Color Hover', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .item-box:hover .elementor-testimonial-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .elementor-testimonial-title',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_ACCENT,
                ],
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label'     => __('Spacing', 'rehomes-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Name.
        $this->start_controls_section(
            'section_style_testimonial_name',
            [
                'label' => __('Name', 'rehomes-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'name_text_color',
            [
                'label'     => __('Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-name, {{WRAPPER}} .elementor-testimonial-name a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'name_text_color_hover',
            [
                'label'     => __('Color Hover', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .item-box:hover .elementor-testimonial-name, {{WRAPPER}} .item-box:hover .elementor-testimonial-name a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'name_typography',
                'selector' => '{{WRAPPER}} .elementor-testimonial-name',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'name_border',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .elementor-testimonial-name',
                'separator'   => 'before',
            ]
        );

        $this->add_responsive_control(
            'name_padding',
            [
                'label'      => __('Padding', 'rehomes-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-testimonial-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'name_spacing',
            [
                'label'     => __('Spacing', 'rehomes-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-job' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Job.
        $this->start_controls_section(
            'section_style_testimonial_job',
            [
                'label' => __('Job', 'rehomes-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'job_text_color',
            [
                'label'     => __('Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-job' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'job_text_color_hover',
            [
                'label'     => __('Color Hover', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .item-box:hover .elementor-testimonial-job' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'job_typography',
                'selector' => '{{WRAPPER}} .elementor-testimonial-job',
            ]
        );

        $this->add_responsive_control(
            'job_spacing',
            [
                'label'     => __('Spacing', 'rehomes-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-job' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Add Carousel Control
        $this->add_control_carousel();

    }

    /**
     * Render testimonial widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        if (!empty($settings['testimonials']) && is_array($settings['testimonials'])) {

            $this->add_render_attribute('wrapper', 'class', 'elementor-testimonial-item-wrapper');
            $this->add_render_attribute('wrapper', 'class', $settings['testimonial_layout']);
//            if ($settings['testimonial_alignment']) {
//                $this->add_render_attribute('wrapper', 'class', 'elementor-testimonial-text-align-' . $settings['testimonial_alignment']);
//            }
            // Row
            $this->add_render_attribute('row', 'class', 'row');
            if ($settings['enable_carousel'] === 'yes') {
                $this->add_render_attribute('row', 'class', 'owl-carousel owl-theme');
                $carousel_settings = $this->get_carousel_settings();
                $this->add_render_attribute('row', 'data-settings', wp_json_encode($carousel_settings));
            } else {
                $this->add_render_attribute('item', 'class', 'column-item');

                $this->add_render_attribute('row', 'data-elementor-columns', $settings['column']);
                if (!empty($settings['column_tablet'])) {
                    $this->add_render_attribute('row', 'data-elementor-columns-tablet', $settings['column_tablet']);
                }
                if (!empty($settings['column_mobile'])) {
                    $this->add_render_attribute('row', 'data-elementor-columns-mobile', $settings['column_mobile']);
                }
            }

            foreach ($settings['testimonials'] as $testimonial1):
                $this->add_render_attribute('ic', 'class', $testimonial1['testimonial_icon']);
                $this->add_render_attribute('ic', 'aria-hidden', 'true');
            endforeach;

            // Item
            $this->add_render_attribute('item', 'class', 'elementor-testimonial-item');


            ?>
            <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
                <div <?php echo $this->get_render_attribute_string('row') ?>>
                    <?php foreach ($settings['testimonials'] as $testimonial): ?>
                        <div <?php echo $this->get_render_attribute_string('item'); ?>>
                            <div class="item-box">
                                <div class="elementor-testimonial-wrapper-head">
                                    <div class="elementor-testimonial-item-wrapper">
                                        <div class="elementor-testimonial-icon">
                                                <span class="elementor-testimonial-icon-icon">
                                                    <i class="<?php echo esc_attr($testimonial['testimonial_icon']); ?>"></i>
                                                </span>
                                        </div>
                                        <div class="elementor-testimonial-wrapper-inner">
                                                <span class="elementor-testimonial-sub-title">
                                                    <?php echo $testimonial['testimonial_sub_title']; ?>
                                                </span>
                                            <h2 class="elementor-testimonial-title">
                                                <?php echo $testimonial["testimonial_title"] ?>
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="elementor-testimonial-content">
                                        <?php echo $testimonial['testimonial_content']; ?>
                                    </div>
                                </div>
                                <div class="elementor-testimonial-wrapper-footer">
                                    <?php $this->render_image($settings, $testimonial); ?>
                                    <div class="elementor-testimonial-details">
                                        <div class="elementor-testimonial-flex">
                                            <?php
                                            $testimonial_name_html = $testimonial['testimonial_name'];
                                            if (!empty($testimonial['testimonial_link']['url'])) :
                                                $testimonial_name_html = '<a href="' . esc_url($testimonial['testimonial_link']['url']) . '">' . $testimonial_name_html . '</a>';
                                            endif;
                                            ?>
                                            <div class="elementor-testimonial-name"><?php echo $testimonial_name_html; ?></div>
                                            <div class="elementor-testimonial-job"><?php echo $testimonial['testimonial_job']; ?></div>
                                        </div>
                                        <span class="elementor-testimonial-rule"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php
        }
    }

    private function render_image($settings, $testimonial) { ?>
        <div class="elementor-testimonial-image">
            <?php
            $testimonial['testimonial_image_size']             = $settings['testimonial_image_size'];
            $testimonial['testimonial_image_custom_dimension'] = $settings['testimonial_image_custom_dimension'];
            if (!empty($testimonial['testimonial_image']['url'])) :
                $image_html = Group_Control_Image_Size::get_attachment_image_html($testimonial, 'testimonial_image');
                echo $image_html;
            endif;
            ?>
        </div>
        <?php
    }

}

$widgets_manager->register_widget_type(new OSF_Elementor_Testimonials());
