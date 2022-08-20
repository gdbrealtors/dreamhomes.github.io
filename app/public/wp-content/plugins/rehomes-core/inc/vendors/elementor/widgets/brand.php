<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;


/**
 * Elementor tabs widget.
 *
 * Elementor widget that displays vertical or horizontal tabs with different
 * pieces of content.
 *
 * @since 1.0.0
 */
class OSF_Elementor_Brand extends OSF_Elementor_Carousel_Base {

    public function get_categories() {
        return array('opal-addons');
    }

    /**
     * Get widget name.
     *
     * Retrieve tabs widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name() {
        return 'opal-brand';
    }

    /**
     * Get widget title.
     *
     * Retrieve tabs widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title() {
        return __('Opal Brands', 'rehomes-core');
    }

    /**
     * Get widget icon.
     *
     * Retrieve tabs widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_icon() {
        return 'eicon-tabs';
    }

    /**
     * Register tabs widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {

        $this->start_controls_section(
            'section_brands',
            [
                'label' => __('Brands', 'rehomes-core'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control('brand_title', [
            'label'       => __('Brand name', 'rehomes-core'),
            'type'        => Controls_Manager::TEXT,
            'default'     => __('Brand Name', 'rehomes-core'),
            'placeholder' => __('Brand Name', 'rehomes-core'),
            'label_block' => true,
        ]);

        $repeater->add_control('type_brand', [
            'label'   => __('Type', 'rehomes-core'),
            'type'    => Controls_Manager::SELECT,
            'options' => [
                'image' => __('Image', 'rehomes-core'),
                'icon'  => __('Icon & SVG', 'rehomes-core'),
            ],
            'default' => 'image',
        ]);

        $repeater->add_control('brand_image', [
            'label'     => __('Choose Image', 'rehomes-core'),
            'type'      => Controls_Manager::MEDIA,
            'dynamic'   => [
                'active' => true,
            ],
            'default'   => [
                'url' => Elementor\Utils::get_placeholder_image_src(),
            ],
            'condition' => [
                'type_brand' => 'image'
            ]
        ]);

        $repeater->add_control('selected_icon', [
            'label'     => __('Icon', 'rehomes-core'),
            'type'      => Controls_Manager::ICONS,
            'default'   => [
                'value'   => 'fas fa-star',
                'library' => 'fa-solid',
            ],
            'condition' => [
                'type_brand' => 'icon'
            ]
        ]);

        $repeater->add_control('link', [
            'label'       => __('Link to', 'rehomes-core'),
            'type'        => Controls_Manager::URL,
            'dynamic'     => [
                'active' => true,
            ],
            'placeholder' => __('https://your-link.com', 'rehomes-core'),
        ]);

        $this->add_control(
            'brands',
            [
                'label'       => __('Brand Items', 'rehomes-core'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ brand_title }}}',
            ]
        );

        $this->add_control(
            'heading_settings',
            [
                'label'     => __('Settings', 'rehomes-core'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );


        $this->add_group_control(
            Elementor\Group_Control_Image_Size::get_type(),
            [
                'name'      => 'brand_image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `brand_image_size` and `brand_image_custom_dimension`.
                'default'   => 'full',
                'separator' => 'none',
            ]
        );

        $this->add_responsive_control(
            'column',
            [
                'label'   => __('Columns', 'rehomes-core'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 3,
                'options' => [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6],
            ]
        );

        $this->add_responsive_control(
            'brand_align',
            [
                'label'     => __('Alignment', 'rehomes-core'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
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
                'selectors' => [
                    '{{WRAPPER}} .elementor-brand-image a' => 'text-align: {{VALUE}};',
                    //'{{WRAPPER}} .elementor-brand-wrapper .row' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_brand_wrapper',
            [
                'label' => __('Wrapper', 'rehomes-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'image_move_up',
            [
                'label'     => __('Move Up', 'rehomes-core'),
                'type'      => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-brand-image:hover' => 'transform: translateY(-5px);',
                    '{{WRAPPER}} .owl-stage-outer'             => 'padding-top: 5px;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'border_image',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .elementor-brand-image',
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label'      => __('Border Radius', 'rehomes-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-brand-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_padding',
            [
                'label'      => __('Padding', 'rehomes-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-brand-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .elementor-brand-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_brand_wrapper');

        $this->start_controls_tab(
            'tab_wrapper_normal',
            [
                'label' => __('Normal', 'rehomes-core'),
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'brand_wrapper',
                'selector' => '{{WRAPPER}} .elementor-brand-image',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_brand_wrapper_hover',
            [
                'label' => __('Hover', 'rehomes-core'),
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'brand_wrapper_hover',
                'selector' => '{{WRAPPER}} .elementor-brand-image:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'style_brand_image',
            [
                'label' => __('Image', 'rehomes-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tabs_image_style');

        $this->start_controls_tab(
            'tab_image_normal',
            [
                'label' => __('Normal', 'rehomes-core'),
            ]
        );

        $this->add_control(
            'image_opacity',
            [
                'label'     => __('Opacity', 'rehomes-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-brand-image img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_image_hover',
            [
                'label' => __('Hover', 'rehomes-core'),
            ]
        );

        $this->add_control(
            'image_opacity_hover',
            [
                'label'     => __('Opacity', 'rehomes-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'default'   => [
                    'size' => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-brand-image a:hover img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'style_brand_icon',
            [
                'label' => __('Icon & SVG', 'rehomes-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_size',
            [
                'label'     => __('Size', 'rehomes-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 200,
                        'min'  => 0,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-brand-image i'   => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .elementor-brand-image svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_icon_style');
        $this->start_controls_tab(
            'tab_icon_normal',
            [
                'label' => __('Normal', 'rehomes-core'),
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label'     => __('Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-brand-image i'                    => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-brand-image:not(:hover) svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'tab_icon_hover',
            [
                'label' => __('Hover', 'rehomes-core'),
            ]
        );
        $this->add_control(
            'icon_color_hover',
            [
                'label'     => __('Primary Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-brand-image:hover i'        => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-brand-image:hover svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->end_controls_section();

        // Add Carousel Control
        $this->add_control_carousel();
    }

    /**
     * Render tabs widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        if (!empty($settings['brands']) && is_array($settings['brands'])) {

            $this->add_render_attribute('wrapper', 'class', 'elementor-brand-wrapper');

            // Row
            $this->add_render_attribute('row', 'class', 'row');

            $this->add_render_attribute('item', 'class', 'elementor-brand-item');

            if ($settings['enable_carousel'] === 'yes') {
                $this->add_render_attribute('row', 'class', 'owl-carousel owl-theme');
                $carousel_settings = $this->get_carousel_settings();
                $this->add_render_attribute('row', 'data-settings', wp_json_encode($carousel_settings));
            } else {
                // Item
                $this->add_render_attribute('item', 'class', 'column-item');
            }

            $this->add_render_attribute('row', 'data-elementor-columns', $settings['column']);
            if (!empty($settings['column_tablet'])) {
                $this->add_render_attribute('row', 'data-elementor-columns-tablet', $settings['column_tablet']);
            }
            if (!empty($settings['column_mobile'])) {
                $this->add_render_attribute('row', 'data-elementor-columns-mobile', $settings['column_mobile']);
            }


        }

        $migrated = isset($settings['__fa4_migrated']['selected_icon']);
        $is_new   = empty($settings['icon']) && Icons_Manager::is_migration_allowed();

        if (empty($settings['icon']) && !Icons_Manager::is_migration_allowed()) {
            // add old default
            $settings['icon'] = 'fa fa-star';
        }

        if (!empty($settings['icon'])) {
            $this->add_render_attribute('icon', 'class', $settings['icon']);
            $this->add_render_attribute('icon', 'aria-hidden', 'true');
        }

        ?>
        <div class="elementor-brands">
            <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
                <div <?php echo $this->get_render_attribute_string('row') ?>>
                    <?php foreach ($settings['brands'] as $item) : ?>
                        <div <?php echo $this->get_render_attribute_string('item'); ?>>
                            <div class="elementor-brand-image">
                                <?php
                                if ($item['type_brand'] == 'image') {
                                    $item['image_size']             = $settings['brand_image_size'];
                                    $item['image_custom_dimension'] = $settings['brand_image_custom_dimension'];

                                    if (!empty($item['link'])) {
                                        if (!empty($item['link']['is_external'])) {
                                            $this->add_render_attribute('brand-image', 'target', '_blank');
                                        }

                                        if (!empty($item['link']['nofollow'])) {
                                            $this->add_render_attribute('brand-image', 'rel', 'nofollow');
                                        }

                                        echo '<a href="' . esc_url($item['link']['url'] ? $item['link']['url'] : '#') . '" ' . $this->get_render_attribute_string('brand-image') . ' title="' . esc_attr($item['brand_title']) . '">';
                                    }

                                    if (!empty($item['brand_image']['url'])) {
                                        $image_html = Elementor\Group_Control_Image_Size::get_attachment_image_html($item, 'image', 'brand_image');
                                        echo($image_html);
                                    }

                                    if (!empty($item['link'])) {
                                        echo '</a>';
                                    }
                                } else {
                                    if ($is_new || $migrated) {
                                        Icons_Manager::render_icon($item['selected_icon'], ['aria-hidden' => 'true']);
                                    } else { ?>
                                        <i <?php echo $this->get_render_attribute_string('icon'); ?>></i>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php
    }
}

$widgets_manager->register_widget_type(new OSF_Elementor_Brand());
