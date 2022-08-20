<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

use Elementor\Group_Control_Typography;

use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

/**
 * Elementor tabs widget.
 *
 * Elementor widget that displays vertical or horizontal tabs with different
 * pieces of content.
 *
 * @since 1.0.0
 */
class OSF_Elementor_Tabs extends Elementor\Widget_Base {

    public function get_categories() {
        return array('opal-addons');
    }

    /**
     * Get widget name.
     *
     * Retrieve tabs widget name.
     *
     * @return string Widget name.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_name() {
        return 'opal-tabs';
    }

    /**
     * Get widget title.
     *
     * Retrieve tabs widget title.
     *
     * @return string Widget title.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_title() {
        return __('Opal Tabs', 'rehomes-core');
    }

    /**
     * Get widget icon.
     *
     * Retrieve tabs widget icon.
     *
     * @return string Widget icon.
     * @since  1.0.0
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
     * @since  1.0.0
     * @access protected
     */
    protected function register_controls() {

        $templates = Elementor\Plugin::instance()->templates_manager->get_source('local')->get_items();

        $options = [
            '0' => '— ' . __('Select', 'rehomes-core') . ' —',
        ];

        $types = [];

        foreach ($templates as $template) {
            $options[$template['template_id']] = $template['title'] . ' (' . $template['type'] . ')';
            $types[$template['template_id']]   = $template['type'];
        }

        $this->start_controls_section(
            'section_tabs',
            [
                'label' => __('Tabs', 'rehomes-core'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control('tab_icon', [
            'label'       => __('Icon', 'rehomes-core'),
            'type'        => Controls_Manager::ICON,
            'label_block' => true,
            'default'     => 'fa fa-check',
        ]);

        $repeater->add_control('tab_title', [
            'label'       => __('Title & Content', 'rehomes-core'),
            'type'        => Controls_Manager::TEXT,
            'default'     => __('Tab Title', 'rehomes-core'),
            'placeholder' => __('Tab Title', 'rehomes-core'),
            'label_block' => true,
        ]);

        $repeater->add_control('source', [
            'label'   => __('Source', 'rehomes-core'),
            'type'    => Controls_Manager::SELECT,
            'default' => 'html',
            'options' => [
                'html'     => __('HTML', 'rehomes-core'),
                'template' => __('Template', 'rehomes-core'),
            ],
        ]);

        $repeater->add_control('tab_html', [
            'label'       => __('Content', 'rehomes-core'),
            'default'     => __('Tab Content', 'rehomes-core'),
            'placeholder' => __('Tab Content', 'rehomes-core'),
            'type'        => Controls_Manager::WYSIWYG,
            'show_label'  => false,
            'condition'   => [
                'source' => 'html',
            ],
        ]);

        $repeater->add_control('tab_template', [
            'label'       => __('Choose Template', 'rehomes-core'),
            'default'     => 0,
            'type'        => Controls_Manager::SELECT,
            'options'     => $options,
            'types'       => $types,
            'label_block' => 'true',
            'condition'   => [
                'source' => 'template',
            ],
        ]);

        $repeater->add_control('bg_tab_a', [
            'label'     => __('Color', 'rehomes-core'),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}};',
            ]
        ]);

        $this->add_control(
            'tabs',
            [
                'label'       => __('Tabs Items', 'rehomes-core'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'tab_icon'  => __('opal-icon-manager', 'rehomes-core'),
                        'tab_title' => __('Tab #1', 'rehomes-core'),
                        'source'    => 'html',
                        'tab_html'  => __('I am tab content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'rehomes-core'),
                    ],
                    [
                        'tab_icon'  => __('opal-icon-monitor', 'rehomes-core'),
                        'tab_title' => __('Tab #2', 'rehomes-core'),
                        'source'    => 'html',
                        'tab_html'  => __('I am tab content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'rehomes-core'),
                    ],
                    [
                        'tab_icon'  => __('opal-icon-performance', 'rehomes-core'),
                        'tab_title' => __('Tab #3', 'rehomes-core'),
                        'source'    => 'html',
                        'tab_html'  => __('I am tab content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'rehomes-core'),
                    ],
                ],
                'title_field' => '{{{ tab_title }}}',
            ]
        );

        $this->add_control(
            'style',
            [
                'label'        => __('Style', 'rehomes-core'),
                'type'         => Controls_Manager::SELECT,
                'default'      => 'style1',
                'options'      => [
                    'style1' => __('Style 1', 'rehomes-core'),
                    'style2' => __('Style 2', 'rehomes-core'),
                ],
                'prefix_class' => 'tab-tile-'
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

        $this->add_control(
            'type',
            [
                'label'        => __('Type', 'rehomes-core'),
                'type'         => Controls_Manager::SELECT,
                'default'      => 'horizontal',
                'options'      => [
                    'horizontal' => __('Horizontal', 'rehomes-core'),
                    'vertical'   => __('Vertical', 'rehomes-core'),
                ],
                'prefix_class' => 'elementor-tabs-view-',
                'separator'    => 'before',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_tabs_style',
            [
                'label' => __('Tabs', 'rehomes-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'navigation_width',
            [
                'label'      => __('Navigation Width', 'rehomes-core'),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'unit' => '%',
                ],
                'range'      => [
                    '%'  => [
                        'min' => 10,
                        'max' => 50,
                    ],
                    'px' => [
                        'min' => 250,
                        'max' => 500,
                    ],
                ],
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-tabs-wrapper' => 'width: {{SIZE}}{{UNIT}}',
                ],
                'condition'  => [
                    'type' => 'vertical',
                ],
            ]
        );

        $this->add_control(
            'background_tabs',
            [
                'label'     => __('Background Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-tabs' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'border_tabs',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .elementor-tabs',
            ]
        );

        $this->add_control(
            'tabs_border_radius',
            [
                'label'      => __('Border Radius', 'rehomes-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-tabs' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'tabs_shadow',
                'selector' => '{{WRAPPER}} .elementor-tabs',
            ]
        );

        $this->add_responsive_control(
            'tabs_padding',
            [
                'label'      => __('Padding', 'rehomes-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-tabs' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tabs_margin',
            [
                'label'      => __('Margin', 'rehomes-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-tabs' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_tab_header_style',
            [
                'label' => __('Header', 'rehomes-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'background_tab_header',
            [
                'label'     => __('Background Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-tabs-wrapper' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_header_width',
            [
                'label'      => __('Width', 'rehomes-core'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-tabs-wrapper' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'type' => 'horizontal'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'border_tab_header',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .elementor-tabs-wrapper',
            ]
        );

        $this->add_control(
            'tabs_header_border_radius',
            [
                'label'      => __('Border Radius', 'rehomes-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-tabs-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_header_padding',
            [
                'label'      => __('Padding', 'rehomes-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-tabs-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_header_margin',
            [
                'label'      => __('Margin', 'rehomes-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-tabs-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'align_items',
            [
                'label'        => __('Align', 'rehomes-core'),
                'type'         => Controls_Manager::CHOOSE,
                'label_block'  => false,
                'options'      => [
                    'flex-start' => [
                        'title' => __('Left', 'rehomes-core'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center'     => [
                        'title' => __('Center', 'rehomes-core'),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'flex-end'   => [
                        'title' => __('Right', 'rehomes-core'),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'condition'    => [
                    'type' => 'horizontal',
                ],
                'default'      => 'center',
                'selectors'    => [
                    '{{WRAPPER}} .elementor-tabs-wrapper' => 'display: inline-flex; flex-wrap: wrap; justify-content: {{VALUE}};',
                ],
                'prefix_class' => 'elementor-tabs-align%s-'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => __('Title', 'rehomes-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'show_line',
            [
                'label'     => __('Show Separator', 'rehomes-core'),
                'type'      => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title:before' => 'content: "";',
                ],
                'condition' => [
                    'type' => 'horizontal'
                ],
            ]
        );

        $this->add_responsive_control(
            'line_size',
            [
                'label'      => __('Line Size', 'rehomes-core'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}}.elementor-widget-tabs .elementor-tab-title:not(:last-child):before' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'show_line!' => '',
                ],
            ]
        );


        $this->add_responsive_control(
            'tab_title_width',
            [
                'label'      => __('Title Width', 'rehomes-core'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-tab-title' => 'min-width: {{SIZE}}{{UNIT}};',
                ],
                'separator'  => 'before',
                'condition'  => [
                    'type' => 'horizontal'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'tab_typography',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .elementor-tab-title',
            ]
        );

        $this->start_controls_tabs('tabs_title_style');

        $this->start_controls_tab(
            'tab_title_normal',
            [
                'label' => __('Normal', 'rehomes-core'),
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __('Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_background_color',
            [
                'label'     => __('Background Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title' => 'background-color: {{VALUE}};'
                ],
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_title_hover',
            [
                'label' => __('Hover', 'rehomes-core'),
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label'     => __('Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title:hover' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'title_background_hover_color',
            [
                'label'     => __('Background Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title:hover' => 'background-color: {{VALUE}} !important;'
                ],
            ]
        );

        $this->add_control(
            'title_hover_border_color',
            [
                'label'     => __('Border Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title:hover' => 'border-color: {{VALUE}} !important;'
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_title_active',
            [
                'label' => __('Active', 'rehomes-core'),
            ]
        );

        $this->add_control(
            'title_active_color',
            [
                'label'     => __('Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title.elementor-active' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'title_background_active_color',
            [
                'label'     => __('Background Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title.elementor-active' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'title_active_border_color',
            [
                'label'     => __('Border Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title.elementor-active' => 'border-color: {{VALUE}} !important;'
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'border_tabs_title',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .elementor-tab-title',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'tabs_title_border_radius',
            [
                'label'      => __('Border Radius', 'rehomes-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-tab-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_title_padding',
            [
                'label'      => __('Padding', 'rehomes-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-tab-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_title_margin',
            [
                'label'      => __('Margin', 'rehomes-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-tab-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'align_title',
            [
                'label'       => __('Align', 'rehomes-core'),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'flex-start' => [
                        'title' => __('Left', 'rehomes-core'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center'     => [
                        'title' => __('Center', 'rehomes-core'),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'flex-end'   => [
                        'title' => __('Right', 'rehomes-core'),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'condition'   => [
                    'type' => 'vertical',
                ],
                'default'     => 'flex-start',
                'selectors'   => [
                    '{{WRAPPER}}.elementor-widget-tabs.elementor-tabs-view-vertical .elementor-tab-desktop-title' => 'justify-content: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_icon_style',
            [
                'label' => __('Icon', 'rehomes-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'      => __('Size', 'rehomes-core'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-tab-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_spacing',
            [
                'label'      => __('Spacing', 'rehomes-core'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-tab-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .elementor-tab-title .elementor-tab-icon' => 'color: {{VALUE}};',
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
            'icon_hover_color',
            [
                'label'     => __('Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title:hover .elementor-tab-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_icon_active',
            [
                'label' => __('Active', 'rehomes-core'),
            ]
        );

        $this->add_control(
            'icon_active_color',
            [
                'label'     => __('Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title.elementor-active .elementor-tab-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_style',
            [
                'label' => __('Content', 'rehomes-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'selector' => '{{WRAPPER}} .elementor-tab-content',
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label'     => __('Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_background',
            [
                'label'     => __('Background Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'border_content',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .elementor-tab-content',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'content_border_radius',
            [
                'label'      => __('Border Radius', 'rehomes-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-tab-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_margin',
            [
                'label'      => __('Margin', 'rehomes-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-tab-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label'      => __('Padding', 'rehomes-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'align_content',
            [
                'label'       => __('Align', 'rehomes-core'),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'left'   => [
                        'title' => __('Left', 'rehomes-core'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'rehomes-core'),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'right'  => [
                        'title' => __('Right', 'rehomes-core'),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'default'     => 'center',
                'selectors'   => [
                    '{{WRAPPER}} .elementor-tab-content' => 'text-align: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_section();
    }

    /**
     * Render tabs widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function render() {
        $tabs = $this->get_settings_for_display('tabs');

        $id_int = substr($this->get_id_int(), 0, 3);
        ?>
        <div class="elementor-tabs" role="tablist">
            <div class="elementor-tabs-wrapper">
                <?php
                foreach ($tabs as $index => $item) :
                    $tab_count = $index + 1;
                    $class_item = 'elementor-repeater-item-' . $item['_id'];
                    $class = ($index == 0) ? 'elementor-active' : '';

                    $tab_title_setting_key = $this->get_repeater_setting_key('tab_title', 'tabs', $index);

                    $this->add_render_attribute($tab_title_setting_key, [
                        'id'            => 'elementor-tab-title-' . $id_int . $tab_count,
                        'class'         => ['elementor-tab-title', 'elementor-tab-desktop-title', $class, $class_item],
                        'data-tab'      => $tab_count,
                        'tabindex'      => $id_int . $tab_count,
                        'role'          => 'tab',
                        'aria-controls' => 'elementor-tab-content-' . $id_int . $tab_count,
                    ]);
                    ?>
                    <div <?php echo $this->get_render_attribute_string($tab_title_setting_key); ?>>

                        <?php if (!empty($item['tab_icon'])) {
                            ?>
                            <span class="elementor-tab-icon">
							<i class="<?php echo esc_attr($item['tab_icon']); ?>" aria-hidden="true"></i>
						</span>
                        <?php } ?>

                        <?php echo $item['tab_title']; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="elementor-tabs-content-wrapper">
                <?php
                foreach ($tabs as $index => $item) :
                    $tab_count = $index + 1;
                    $class_item = 'elementor-repeater-item-' . $item['_id'];
                    $class_content = ($index == 0) ? 'elementor-active' : '';

                    $tab_content_setting_key = $this->get_repeater_setting_key('tab_content', 'tabs', $index);

                    $this->add_render_attribute($tab_content_setting_key, [
                        'id'              => 'elementor-tab-content-' . $id_int . $tab_count,
                        'class'           => ['elementor-tab-content', 'elementor-clearfix', $class_content, $class_item],
                        'data-tab'        => $tab_count,
                        'role'            => 'tabpanel',
                        'aria-labelledby' => 'elementor-tab-title-' . $id_int . $tab_count,
                    ]);

                    $this->add_inline_editing_attributes($tab_content_setting_key, 'advanced');
                    ?>
                    <div <?php echo $this->get_render_attribute_string($tab_content_setting_key); ?>>
                        <?php if ('html' === $item['source']): ?>
                            <?php echo do_shortcode($item['tab_html']); ?>
                        <?php else: ?>
                            <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($item['tab_template']); ?>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
    }
}

$widgets_manager->register_widget_type(new OSF_Elementor_Tabs());
