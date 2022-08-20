<?php

namespace Elementor;
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor image box widget.
 *
 * Elementor widget that displays an image, a headline and a text.
 *
 * @since 1.0.0
 */
class OSF_Widget_Image_Box extends Widget_Image_Box {

    /**
     * Get widget name.
     *
     * Retrieve image box widget name.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'image-box';
    }

    /**
     * Get widget title.
     *
     * Retrieve image box widget title.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Image Box', 'rehomes-core');
    }

    /**
     * Get widget icon.
     *
     * Retrieve image box widget icon.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-image-box';
    }

    public function get_categories() {
        return ['opal-addons'];
    }

    /**
     * Retrieve the list of scripts the counter widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since  1.3.0
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends() {
        return ['anime'];
    }

    /**
     * Register image box widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
            'section_image',
            [
                'label' => __('Image Box', 'rehomes-core'),
            ]
        );

        $this->add_control(
            'media_type',
            [
                'label'   => __('Media Type', 'rehomes-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'image' => __('Image', 'rehomes-core'),
                    'svg'   => __('SVG Code', 'rehomes-core'),
                ],
                'default' => 'image',
            ]
        );

        $this->add_control(
            'svgcode',
            [
                'label'     => __('Code', 'rehomes-core'),
                'type'      => Controls_Manager::TEXTAREA,
                'condition' => [
                    'media_type' => 'svg'
                ]
            ]
        );

        $this->add_control(
            'image',
            [
                'label'     => __('Choose Image', 'rehomes-core'),
                'type'      => Controls_Manager::MEDIA,
                'dynamic'   => [
                    'active' => true,
                ],
                'default'   => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'media_type' => 'image'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumbnail',
                // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'default'   => 'full',
                'separator' => 'none',
                'condition' => [
                    'media_type' => 'image'
                ]
            ]
        );


        $this->add_control(
            'title_text',
            [
                'label'       => __('Title & Description', 'rehomes-core'),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [
                    'active' => true,
                ],
                'default'     => __('This is the heading', 'rehomes-core'),
                'placeholder' => __('Enter your title', 'rehomes-core'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'sub_title_text',
            [
                'label'       => __('Sub Title', 'rehomes-core'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __('Enter your sub-title', 'rehomes-core'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'description_text',
            [
                'label'       => __('Description', 'rehomes-core'),
                'type'        => Controls_Manager::TEXTAREA,
                'dynamic'     => [
                    'active' => true,
                ],
                'default'     => __('Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'rehomes-core'),
                'placeholder' => __('Enter your description', 'rehomes-core'),
                'separator'   => 'none',
                'rows'        => 10,
            ]
        );
        $this->add_control(
            'hover_animation_wrapper',
            [
                'label'        => __('Hover Wrapper Animation', 'rehomes-core'),
                'type'         => Controls_Manager::HOVER_ANIMATION,
                'prefix_class' => 'elementor-animation-',
            ]
        );

        $this->add_control(
            'link',
            [
                'label'       => __('Link to', 'rehomes-core'),
                'type'        => Controls_Manager::URL,
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => __('https://your-link.com', 'rehomes-core'),
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'link_download',
            [
                'label' => __('Download Link ?', 'rehomes-core'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'position',
            [
                'label'        => __('Image Position', 'rehomes-core'),
                'type'         => Controls_Manager::CHOOSE,
                'default'      => 'top',
                'options'      => [
                    'left'  => [
                        'title' => __('Left', 'rehomes-core'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'top'   => [
                        'title' => __('Top', 'rehomes-core'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'rehomes-core'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'prefix_class' => 'elementor-position-',
                'toggle'       => false,
            ]
        );

        $this->add_control(
            'title_size',
            [
                'label'   => __('Title HTML Tag', 'rehomes-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'h1'   => 'H1',
                    'h2'   => 'H2',
                    'h3'   => 'H3',
                    'h4'   => 'H4',
                    'h5'   => 'H5',
                    'h6'   => 'H6',
                    'div'  => 'div',
                    'span' => 'span',
                    'p'    => 'p',
                ],
                'default' => 'h3',
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
            'show_button',
            [
                'label'     => __('Button', 'rehomes-core'),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => __('Show', 'rehomes-core'),
                'label_off' => __('Hide', 'rehomes-core'),
            ]
        );

        $this->end_controls_section();

//        control button

        $this->start_controls_section(
            'section_button',
            [
                'label'     => __('Button', 'rehomes-core'),
                'condition' => [
                    'show_button' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'button_type',
            [
                'label'        => __('Type', 'rehomes-core'),
                'type'         => Controls_Manager::SELECT,
                'default'      => 'primary',
                'options'      => [
                    '' => __('Default', 'rehomes-core'),
                    'primary' => __('Primary', 'rehomes-core'),
                    'secondary' => __('Secondary', 'rehomes-core'),
                    'dark' => __('Dark', 'rehomes-core'),
                    'light' => __('Light', 'rehomes-core'),
                    'link' => __('Link', 'rehomes-core'),
                    'underline' => __('Underline Primary', 'rehomes-core'),
                    'outline_primary' => __('Outline Primary', 'rehomes-core'),
                    'outline_secondary' => __('Outline Secondary', 'rehomes-core'),
                    'info' => __('Info', 'rehomes-core'),
                    'success' => __('Success', 'rehomes-core'),
                    'warning' => __('Warning', 'rehomes-core'),
                    'danger' => __('Danger', 'rehomes-core'),
                ],
            ]
        );

        $this->add_control(
            'size',
            [
                'label'   => __('Size', 'rehomes-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'md',
                'options' => [
                    'xs' => __('Extra Small', 'rehomes-core'),
                    'sm' => __('Small', 'rehomes-core'),
                    'md' => __('Medium', 'rehomes-core'),
                    'lg' => __('Large', 'rehomes-core'),
                    'xl' => __('Extra Large', 'rehomes-core'),
                ],
                'condition' => [
                    'button_type!'  => 'underline'
                ]
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __('Button Text', 'rehomes-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Click Here', 'rehomes-core'),
            ]
        );

        $this->add_control(
            'link_button',
            [
                'label'       => __('Link', 'rehomes-core'),
                'type'        => Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'rehomes-core'),
                'default'     => [
                    'url' => '#',
                ],
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'section_animation_bg',
            [
                'label' => __('Animation Background', 'rehomes-core'),
            ]
        );

        $this->add_control(
            'hover_animation_bg',
            [
                'label' => __('Enable Animation', 'rehomes-core'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'hover_animation_style',
            [
                'label'     => __('Style', 'rehomes-core'),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    '0' => __('Style 1', 'rehomes-core'),
                    '1' => __('Style 2', 'rehomes-core'),
                    '2' => __('Style 3', 'rehomes-core'),
                ],
                'default'   => '1',
                'condition' => [
                    'hover_animation_bg' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'bg_animation_color',
            [
                'label'     => __('Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item__svg' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    'hover_animation_bg' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'bg_animation_width',
            [
                'label'      => __('Width', 'rehomes-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'default'    => [
                    'size' => 50,
                    'unit' => 'px'
                ],
                'selectors'  => [
                    '{{WRAPPER}} svg.item__svg ' => 'width: {{SIZE}}{{UNIT}}'
                ],
                'condition'  => [
                    'hover_animation_bg' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'bg_animation_height',
            [
                'label'      => __('Height', 'rehomes-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'default'    => [
                    'size' => 50,
                    'unit' => 'px'
                ],
                'selectors'  => [
                    '{{WRAPPER}} svg.item__svg ' => 'height: {{SIZE}}{{UNIT}}'
                ],
                'condition'  => [
                    'hover_animation_bg' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'bg_animation_rotate',
            [
                'label'     => __('Rotate', 'rehomes-core'),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 0,
                    'unit' => 'deg'
                ],
                'selectors' => [
                    '{{WRAPPER}} svg.item__svg ' => 'rotate({{SIZE}}{{UNIT}})'
                ],
                'condition' => [
                    'hover_animation_bg' => 'yes'
                ]
            ]
        );

        $this->add_control('bg_animation_duration',
            [
                'label'     => esc_html__('Duration', 'rehomes-core'),
                'type'      => Controls_Manager::NUMBER,
                'title'     => esc_html__('Set the animation duration in milliseconds, default is 1200', 'rehomes-core'),
                'default'   => 1200,
                'condition' => [
                    'hover_animation_bg' => 'yes'
                ]
            ]
        );

        $this->add_control('bg_animation_elasticity',
            [
                'label'     => esc_html__('Elasticity', 'rehomes-core'),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 400,
                'condition' => [
                    'hover_animation_bg' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

//        end control button

        $this->start_controls_section(
            'section_style_image',
            [
                'label' => __('Image', 'rehomes-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'image_wrapper',
            [
                'label'     => __('Wrapper Size', 'rehomes-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'size_units'    => ['px','%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-box-img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'background_wrapper',
            [
                'label'     => __('Background', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-box-img' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_space',
            [
                'label'     => __('Spacing', 'rehomes-core'),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 15,
                ],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}.elementor-position-right .elementor-image-box-img' => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.elementor-position-left .elementor-image-box-img'  => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.elementor-position-top .elementor-image-box-img'   => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}} .elementor-image-box-img'                  => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'image_hover_scale',
            [
                'label' => __('Hover Scale', 'rehomes-core'),
                'type'  => Controls_Manager::SWITCHER,
                'selectors' => [
                        '{{WRAPPER}} .elementor-widget-container:hover .elementor-image-box-img' => 'transform: scale(0.8);'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'border_image',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .elementor-image-box-wrapper .elementor-image-box-img',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label'      => __('Border Radius', 'rehomes-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-image-box-wrapper .elementor-image-box-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_image_hover_style');

        $this->start_controls_tab(
            'tab_image_hover_style_normal',
            [
                'label' => __('Normal', 'rehomes-core'),
            ]
        );

        $this->add_control(
            'image_opacity',
            [
                'label'     => __('Opacity', 'rehomes-core'),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 1,
                ],
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-box-wrapper .elementor-image-box-img img' => 'opacity: {{SIZE}};',
                    '{{WRAPPER}} .elementor-image-box-wrapper .elementor-image-box-img svg' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_image_hover_style_hover',
            [
                'label' => __('Hover', 'rehomes-core'),
            ]
        );

        $this->add_control(
            'image_opacity_hover',
            [
                'label'     => __('Opacity', 'rehomes-core'),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 1,
                ],
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}:hover .elementor-image-box-wrapper .elementor-image-box-img img' => 'opacity: {{SIZE}};',
                    '{{WRAPPER}}:hover .elementor-image-box-wrapper .elementor-image-box-img svg' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_control(
            'hover_animation',
            [
                'label' => __('Hover Animation', 'rehomes-core'),
                'type'  => Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'animation_moveup',
            [
                'label' => __('Hover Move Up', 'rehomes-core'),
                'type'  => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container:hover' => 'transform: translateY(-5px);',
                ],
                'label_on' => 'Show',
                'label_off' => 'Hide',
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_content',
            [
                'label' => __('Content', 'rehomes-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'text_align',
            [
                'label'     => __('Alignment', 'rehomes-core'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'    => [
                        'title' => __('Left', 'rehomes-core'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center'  => [
                        'title' => __('Center', 'rehomes-core'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'   => [
                        'title' => __('Right', 'rehomes-core'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => __('Justified', 'rehomes-core'),
                        'icon'  => 'eicon-text-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-box-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_vertical_alignment',
            [
                'label'        => __('Vertical Alignment', 'rehomes-core'),
                'type'         => Controls_Manager::SELECT,
                'options'      => [
                    'top'    => __('Top', 'rehomes-core'),
                    'middle' => __('Middle', 'rehomes-core'),
                    'bottom' => __('Bottom', 'rehomes-core'),
                ],
                'default'      => 'top',
                'prefix_class' => 'elementor-vertical-align-',
            ]
        );

        $this->add_responsive_control(
            'padding_image_box',
            [
                'label'      => __( 'Padding', 'rehomes-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-image-box-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_title',
            [
                'label'     => __('Title', 'rehomes-core'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .elementor-image-box-content .elementor-image-box-title',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
            ]
        );

        $this->add_responsive_control(
            'title_bottom_space',
            [
                'label'     => __('Spacing', 'rehomes-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-box-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->start_controls_tabs('tabs_view_title_style');

        $this->start_controls_tab(
            'view_title_button_normal',
            [
                'label' => __('Normal', 'rehomes-core'),
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __('Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-box-content .elementor-image-box-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'view_title_button_hover',
            [
                'label' => __('Hover', 'rehomes-core'),
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label'     => __('Color Hover (Wrapper)', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}}:hover .elementor-image-box-content .elementor-image-box-title' => 'color: {{VALUE}};',
                ],
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
                ],
            ]
        );

        $this->add_control(
            'title_hover_transition',
            [
                'label'     => __('Transition Duration', 'rehomes-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 3,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-box-content .elementor-image-box-title' => 'transition-duration: {{SIZE}}s',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->add_control(
            'heading_sub_title',
            [
                'label'     => __('Sub-title', 'rehomes-core'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'sub_title_typography',
                'selector' => '{{WRAPPER}} .elementor-image-box-content .elementor-image-box-sub-title',
            ]
        );

        $this->add_responsive_control(
            'sub_title_bottom_space',
            [
                'label'     => __('Spacing', 'rehomes-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-box-sub-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_view_subtitle_style');

        $this->start_controls_tab(
            'view_subtitle_button_normal',
            [
                'label' => __('Normal', 'rehomes-core'),
            ]
        );

        $this->add_control(
            'sub_title_color',
            [
                'label'     => __('Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-box-content .elementor-image-box-sub-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'view_subtitle_button_hover',
            [
                'label' => __('Hover', 'rehomes-core'),
            ]
        );

        $this->add_control(
            'sub_title_color_hover',
            [
                'label'     => __('Color Hover (Wrapper)', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}}:hover .elementor-image-box-content .elementor-image-box-sub-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'sub_title_hover_transition',
            [
                'label'     => __('Transition Duration', 'rehomes-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 3,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-box-content .elementor-image-box-sub-title' => 'transition-duration: {{SIZE}}s',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'heading_description',
            [
                'label'     => __('Description', 'rehomes-core'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'description_typography',
                'selector' => '{{WRAPPER}} .elementor-image-box-content .elementor-image-box-description',
            ]
        );

        $this->add_responsive_control(
            'sub_description_bottom_space',
            [
                'label'     => __('Spacing', 'rehomes-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-box-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_view_description_style');

        $this->start_controls_tab(
            'view_description_button_normal',
            [
                'label' => __('Normal', 'rehomes-core'),
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label'     => __('Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-box-content .elementor-image-box-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'view_description_button_hover',
            [
                'label' => __('Hover', 'rehomes-core'),
            ]
        );

        $this->add_control(
            'description_color_hover',
            [
                'label'     => __('Color Hover (Wrapper)', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}}:hover .elementor-image-box-content .elementor-image-box-description' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->add_control(
            'description_hover_transition',
            [
                'label'     => __('Transition Duration', 'rehomes-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 3,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-box-content .elementor-image-box-description' => 'transition-duration: {{SIZE}}s',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'button_style_tab',
            [
                'label'     => __('Button', 'rehomes-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_button' => 'yes',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .elementor-image-box-button a',
            ]
        );


        $this->start_controls_tabs('btn_style_hover');

        $this->start_controls_tab(
            'btn_normal_style',
            [
                'label' => __('Normal', 'rehomes-core'),
            ]
        );

        $this->add_control(
            'btn_icon_color',
            [
                'label'     => __('Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-box-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_icon_background',
            [
                'label'     => __('Background', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-box-button .elementor-button' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'btn_hover_style',
            [
                'label' => __('Hover', 'rehomes-core'),
            ]
        );

//        hover

        $this->add_control(
            'btn_icon_color_hover',
            [
                'label'     => __('Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-box-wrapper .elementor-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_icon_background_hover',
            [
                'label'     => __('Background', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-box-wrapper .elementor-button:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_border_hover_color',
            [
                'label' => __('Border Color', 'rehomes-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-box-wrapper .elementor-button:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->add_control(
            'btn_padding',
            [
                'label'     => __('Padding', 'rehomes-core'),
                'type'      => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-box-button .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'border_btn',
                'selector' => '{{WRAPPER}} .elementor-image-box-wrapper .elementor-button',
            ]
        );

        $this->add_control(
            'btn_border_radius',
            [
                'label'      => __('Border Radius', 'rehomes-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-image-box-button .elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function morph() {
        return [
            [
                "start" => 'M 4.799,29.57 C 4.425,25.29 7.233,19.57 11.04,16.7 16.96,12.24 25.9,10.61 32.96,12.88 38.13,14.54 42.8,19.3 44.37,24.5 45.33,27.7 46.49,32.24 42.46,34.35 36.9,37.27 30.42,31.01 23.91,31.9 19.09,32.55 15.3,38 10.76,37.34 6.497,36.73 5.068,32.64 4.799,29.57 Z',
                'end'   => 'M 3.003,24.04 C 3.135,18.62 3.967,12.0 8.595,8.614 16.25,3.012 30.2,0.3296 37.87,5.908 41.31,8.414 38.36,14.0 39.51,17.88 41.16,23.44 47.78,28.07 46.95,33.77 46.26,38.41 42.09,42.9 37.38,44.77 28.61,48.25 16.18,48.24 8.779,42.7 3.304,38.6 2.846,30.5 3.003,24.04 Z'
            ],
            [
                "start" => 'M 18.9,8.037 C 23.26,4.667 35.25,6.706 35.09,12.41 34.95,17.34 31.17,16.8 31.24,24.81 31.29,30.11 38.25,31.92 36.85,37.91 34.94,46.06 13.77,46.75 11.76,38.63 9.868,30.97 17.15,29.22 18.36,24.01 19.57,18.82 12.38,13.07 18.9,8.037 Z',
                'end'   => 'M 18.4,12.74 C 23.54,9.238999999999999 31.97,7.926999999999998 35.99,13.22 38.32,16.3 35.71,21.66 35.58,25.88 35.48,29.12 37.13,33.29 35.29,35.6 30.61,41.44 20.51,41.93 15.37,36.72 12.38,33.68 12.86,27.21 13.61,22.52 14.21,18.78 15.7,14.57 18.4,12.74 Z'
            ],
            [
                "start" => 'M 45.15,18.58 C 44.15,26.62 33.96,30.5 27.23,35.02 20.77,39.36 22.67,44.47 18.26,44.79 13.28,45.14 8.397,39.99 6.637,35.31 3.46,26.84 4.116,14.18 11.2,8.544 18.61,2.632999999999999 31.38,5.41 39.6,10.14 42.52,11.82 45.56,15.24 45.15,18.58 Z',
                'end'   => 'M 36.81,4.642 C 46.1,9.669 47.37,26.62 42.23,35.84 37.91,43.6 25.96,48.48 17.5,45.75 10.75,43.57 1.265,32.98 6.093,27.77 9.518,24.08 15.4,37.93 19.42,34.89 25.07,30.6 11.6,20.41 14.84,14.09 18.48,7.002 29.8,0.8455 36.81,4.642 Z'
            ]
        ];
    }

    protected function render() {

        $settings = $this->get_settings_for_display();
        $pathmorph = $this->morph();
        $has_content = !empty($settings['title_text']) || !empty($settings['description_text']);
        $this->add_render_attribute('wrapper', 'class', 'elementor-image-box-wrapper');
        $this->add_render_attribute('wrapper', 'class', 'elementor-button-'.esc_attr__($settings['button_type'], 'rehomes-core'));

        if ($settings['hover_animation_bg'] == 'yes') {
            $this->add_render_attribute('wrapper', 'data-morph-path', $pathmorph[$settings['hover_animation_style']]['start']);
            $this->add_render_attribute('wrapper', 'data-animation-path-duration', $settings['bg_animation_duration']);
            $this->add_render_attribute('wrapper', 'data-path-elasticity', $settings['bg_animation_elasticity']);
        }

        $html = '<div ' . $this->get_render_attribute_string("wrapper") . '>';

        if (!empty($settings['link']['url'])) {
            $this->add_render_attribute('link', 'href', $settings['link']['url']);

            if ($settings['link']['is_external']) {
                $this->add_render_attribute('link', 'target', '_blank');
            }

            if (!empty($settings['link']['nofollow'])) {
                $this->add_render_attribute('link', 'rel', 'nofollow');
            }

            if ($settings['link_download'] === 'yes') {
                $this->add_render_attribute('link', 'download');
            }
        }

//        button image box
        if (!empty($settings['link_button']['url'])) {
            $this->add_render_attribute('button_text', 'href', $settings['link_button']['url']);

            if (!empty($settings['link_button']['is_external'])) {
                $this->add_render_attribute('button_text', 'target', '_blank');
            }
        }

        $this->add_render_attribute('button_text', 'class', 'elementor-button');

        if (!empty($settings['size'])) {
            $this->add_render_attribute('button_text', 'class', 'elementor-size-' . $settings['size']);
        }

//        end button image box
        $image_html = '';
        $this->add_render_attribute('image-wrapper', 'class', 'elementor-image-box-img');
        if (!empty($settings['image']['url'])) {
            $this->add_render_attribute('image', 'src', $settings['image']['url']);
            $this->add_render_attribute('image', 'alt', Control_Media::get_image_alt($settings['image']));
            $this->add_render_attribute('image', 'title', Control_Media::get_image_title($settings['image']));
            if ($settings['hover_animation']) {
                $this->add_render_attribute('image', 'class', 'elementor-animation-' . $settings['hover_animation']);
            }

            $image_html = Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'image');
            if (!empty($settings['image']['url'])) {
                $image_url = $settings['image']['url'];
                $path_parts = pathinfo($image_url);
                if ($path_parts['extension'] === 'svg') {
                    $image = $this->get_settings_for_display('image');
                    if ($image['id']) {
                        $pathSvg = get_attached_file($image['id']);
                        $image_html = osf_get_icon_svg($pathSvg);
                    }

                }
            }
        }

        if (!empty($settings['svgcode'])) {
            $image_html = force_balance_tags($settings['svgcode']);
        }

        if (!empty($settings['link']['url'])) {
            $image_html = '<a ' . $this->get_render_attribute_string('link') . '>' . $image_html . '</a>';
        }

        $html .= '<div class="elementor-image-framed">';
        if ($settings['hover_animation_bg'] == 'yes') {
            $html .= '<div class="item-svg"><svg class="item__svg" viewBox="0 0 50 50"><g class=""><path d="' . $pathmorph[$settings['hover_animation_style']]['end'] . '"></path></g></svg></div>';
        }
        $html .= '<figure ' . $this->get_render_attribute_string("image-wrapper") . '>' . $image_html . '</figure>';
        $html .= '</div>';


        if ($has_content) {
            $html .= '<div class="elementor-image-box-content">';

            if (!empty($settings['sub_title_text'])) {
                $this->add_render_attribute('sub_title_text', 'class', 'elementor-image-box-sub-title');
                $html .= '<div ' . $this->get_render_attribute_string("sub_title_text") . '>' . $settings["sub_title_text"] . '</div>';
            }

            if (!empty($settings['title_text'])) {
                $this->add_render_attribute('title_text', 'class', 'elementor-image-box-title');

                $this->add_inline_editing_attributes('title_text', 'none');

                $title_html = $settings['title_text'];

                if (!empty($settings['link']['url'])) {
                    $title_html = '<a ' . $this->get_render_attribute_string('link') . '>' . $title_html . '</a>';
                }

                $html .= sprintf('<%1$s %2$s>%3$s</%1$s>', $settings['title_size'], $this->get_render_attribute_string('title_text'), $title_html);
            }

            if (!empty($settings['description_text'])) {
                $this->add_render_attribute('description_text', 'class', 'elementor-image-box-description');

                $this->add_inline_editing_attributes('description_text');

                $html .= sprintf('<p %1$s>%2$s</p>', $this->get_render_attribute_string('description_text'), $settings['description_text']);
            }

//            button

            if (!empty($settings['show_button'])) :
                $html .= '<div class="elementor-image-box-button">';
                    if (!empty($settings['button_text'])) :
                        $html .='<a '.$this->get_render_attribute_string('button_text') .'>';
                        $html .='<span class="elementor-button-icon elementor-align-icon-right">';
                        $html .= '<i class="opal-icon-arrow-right" aria-hidden="true"></i>';
                        $html .= '</span>';
                        $html .= '<span class="icon-box_button-text">' .$settings['button_text'].'</span>';
                        $html .= '</a>';
                    endif;

                $html .= '</div>';
            endif;

            $html .= '</div>';
        }

        $html .= '</div>';

        echo $html;
    }

    protected function content_template() {}
}

$widgets_manager->register_widget_type(new OSF_Widget_Image_Box());