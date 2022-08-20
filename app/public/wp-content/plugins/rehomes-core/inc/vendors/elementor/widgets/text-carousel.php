<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

use Elementor\Group_Control_Typography;

use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Group_Control_Image_Size;
use Elementor\Control_Media;

class OSF_Elementor_Text_Carousel extends OSF_Elementor_Carousel_Base {

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
    public function get_name() {
        return 'opal-text_carousel';
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
    public function get_title() {
        return __('Opal Carousel', 'rehomes-core');
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
    public function get_icon() {
        return 'eicon-slider-push';
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

        $templates = Elementor\Plugin::instance()->templates_manager->get_source('local')->get_items();

        $options = [
            '0' => '— ' . __('Select', 'rehomes-core') . ' —',
        ];

        foreach ($templates as $template) {
            $options[$template['template_id']] = $template['title'] . ' (' . $template['type'] . ')';
        }

        $this->start_controls_section(
            'section_text_carousel',
            [
                'label' => __('Content', 'rehomes-core'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'source',
            [
                'label'   => __('Type', 'rehomes-core'),
                'type'    => Controls_Manager::SELECT,
                'default'   => 'default',
                'options' => [
                    'default' => __('Default', 'rehomes-core'),
                    'template' => __('Template', 'rehomes-core'),
                ],
            ]
        );


        $repeater->add_control(
            'image',
            [
                'label'   => __('Choose Image', 'rehomes-core'),
                'type'    => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' =>  [
                        'source'    => 'default'
                ]
            ]
        );

        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'default'   => 'full',
                'separator' => 'none',
                'condition' =>  [
                    'source'    => 'default'
                ]
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label'       => __('Title', 'rehomes-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => __('Title', 'rehomes-core'),
                'label_block' => true,
                'condition' =>  [
                    'source'    => 'default'
                ]
            ]
        );

        $repeater->add_control(
            'content',
            [
                'name'        => 'content',
                'label'       => __('Content', 'rehomes-core'),
                'type'        => Controls_Manager::WYSIWYG,
                'default'     => 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
                'label_block' => true,
                'rows'        => '10',
                'condition' =>  [
                    'source'    => 'default'
                ]
            ]
        );

        $repeater->add_control(
            'template',
            [
                'label'       => __('Choose template', 'rehomes-core'),
                'type' => Controls_Manager::SELECT,
                'options' => $options,
                'default' => 0,
                'label_block' => 'true',
                'condition' =>  [
                    'source'    => 'template'
                ]
            ]
        );

        $this->add_control(
            'contents',
            [
                'label'       => __('Content Item', 'rehomes-core'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->add_control(
            'text_alignment',
            [
                'label'     => __('Alignment', 'rehomes-core'),
                'type'      => Controls_Manager::CHOOSE,
                'default'   => 'center',
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
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'header_size',
            [
                'label'   => __('HTML Tag', 'rehomes-core'),
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
                'default' => 'h4',
            ]
        );


        $this->add_responsive_control(
            'column',
            [
                'label'           => __('Columns', 'rehomes-core'),
                'type'            => \Elementor\Controls_Manager::SELECT,
                'options'         => [1 => 1, 2 => 2, 3 => 3],
                'desktop_default' => 2,
                'tablet_default'  => 1,
                'mobile_default'  => 1,
            ]
        );

        $this->add_responsive_control(
            'gutter',
            [
                'label'      => __('Gutter', 'rehomes-core'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 60,
                    ],
                ],
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .column-item' => 'padding-left: calc({{SIZE}}{{UNIT}} / 2); padding-right: calc({{SIZE}}{{UNIT}} / 2); padding-bottom: calc({{SIZE}}{{UNIT}})',
                    '{{WRAPPER}} .row'         => 'margin-left: calc({{SIZE}}{{UNIT}} / -2); margin-right: calc({{SIZE}}{{UNIT}} / -2);',
                ],
            ]
        );

        $this->add_responsive_control(
            'style',
            [
                'label'        => __('Style', 'rehomes-core'),
                'type'         => \Elementor\Controls_Manager::SELECT,
                'default'      => 1,
                'options'      => [
                    1 => __('Style 1', 'rehomes-core'),
                    2 => __('Style 2', 'rehomes-core'),
                ],
                'prefix_class' => 'text-carousel-style-'
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

        // Wrapper Style.
        $this->start_controls_section(
            'text_carousel_style_wrapper',
            [
                'label' => __('Wrapper', 'rehomes-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'wrapper_bkg',
            [
                'label'     => __('Background', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-content-item-inner' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'padding_wrapper',
            [
                'label'      => __('Padding', 'rehomes-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-content-item-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style.
        $this->start_controls_section(
            'section_text_carousel_style',
            [
                'label' => __('Content', 'rehomes-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label'     => __('Text Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_TEXT,
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_TEXT,
                ],
                'selector' => '{{WRAPPER}} .elementor-content',
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label'      => __('Padding', 'rehomes-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_margin',
            [
                'label'      => __('Margin', 'rehomes-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Title Style.
        $this->start_controls_section(
            'section_title_style',
            [
                'label' => __('Title', 'rehomes-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __('Title Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .elementor-heading-title',
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label'      => __('Padding', 'rehomes-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-heading-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => __('Margin', 'rehomes-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-heading-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_image',
            [
                'label' => __('Image', 'rehomes-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
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

        $this->add_responsive_control(
            'image_size',
            [
                'label'      => __('Width', 'rehomes-core'),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 2000,
                    ],
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ]

                ],
                'size_units' => [
                    'px', '%'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-image-box-img img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_height',
            [
                'label'      => __('Height', 'rehomes-core'),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 2000,
                    ],
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ]

                ],
                'size_units' => [
                    'px', '%'
                ],
                'selectors'  => [
                    '{{WRAPPER}}  .elementor-image-box-img img' => 'height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}}  .elementor-image-box-img img' => 'opacity: {{SIZE}};',
                    '{{WRAPPER}}  .elementor-image-box-img svg' => 'opacity: {{SIZE}};',
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
                    '{{WRAPPER}}:hover  .elementor-image-box-img img' => 'opacity: {{SIZE}};',
                    '{{WRAPPER}}:hover  .elementor-image-box-img svg' => 'opacity: {{SIZE}};',
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

        $this->add_responsive_control(
            'wrapper_padding_image',
            [
                'label'      => __('Padding', 'rehomes-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-image-framed' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Carousel Option
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
        if (!empty($settings['contents']) && is_array($settings['contents'])) {

            $this->add_render_attribute('wrapper', 'class', 'elementor-text_carousel-wrapper');

            // Row
            $this->add_render_attribute('row', 'class', 'row');

            if ($settings['enable_carousel'] === 'yes') {
                $this->add_render_attribute('row', 'class', 'owl-carousel owl-theme');
                $carousel_settings = $this->get_carousel_settings();
                $this->add_render_attribute('row', 'data-settings', wp_json_encode($carousel_settings));
            } else {
                if (!empty($settings['column'])) {
                    $this->add_render_attribute('row', 'data-elementor-columns', $settings['column']);
                }

                if (!empty($settings['column_tablet'])) {
                    $this->add_render_attribute('row', 'data-elementor-columns-tablet', $settings['column_tablet']);
                }
                if (!empty($settings['column_mobile'])) {
                    $this->add_render_attribute('row', 'data-elementor-columns-mobile', $settings['column_mobile']);
                }
                $this->add_render_attribute('item', 'class', 'column-item');
            }
            // Item
            $this->add_render_attribute('item', 'class', 'elementor-content-item');

            $this->add_render_attribute('meta', 'class', 'elementor-content-meta');

            $this->add_render_attribute('title', 'class', 'elementor-heading-title');


            ?>
            <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
                <div <?php echo $this->get_render_attribute_string('row') ?>>
                    <?php foreach ($settings['contents'] as $content): ?>
                        <div <?php echo $this->get_render_attribute_string('item'); ?>>
                            <div class="elementor-content-item-inner">
                                <?php
                                if ($content['source'] == 'default'){
                                    $html = '';
                                    if (!empty($content['image']['url'])) {
                                        $this->add_render_attribute('image', 'src', $content['image']['url']);
                                        $this->add_render_attribute('image', 'alt', Control_Media::get_image_alt($content['image']));
                                        $this->add_render_attribute('image', 'title', Control_Media::get_image_title($content['image']));

                                        if ($settings['hover_animation']) {
                                            $this->add_render_attribute('image-wrapper', 'class', 'elementor-animation-' . $settings['hover_animation']);
                                        }
                                        $this->add_render_attribute('image-wrapper', 'class', 'elementor-image-box-img');

                                        $image_html = Group_Control_Image_Size::get_attachment_image_html($content, 'thumbnail', 'image');
                                        if (!empty($content['image']['url'])) {
                                            $image_url = $content['image']['url'];
                                            $path_parts = pathinfo($image_url);
                                            if ($path_parts['extension'] === 'svg') {
                                                $image = $this->get_settings_for_display('image');
                                                if ($image['id']) {
                                                    $pathSvg = get_attached_file($image['id']);
                                                    $image_html = osf_get_icon_svg($pathSvg);
                                                }

                                            }
                                        }
                                        //SVG
                                        $html .= '<div class="elementor-image-framed">';
                                        $html .= '<figure ' . $this->get_render_attribute_string("image-wrapper") . '>' . $image_html . '</figure>';
                                        $html .= '</div>';
                                        echo $html;
                                    }
                                }else {
                                    echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($content['template']);
                                }

                                ?>
                                <div class="elementor-content-wrap">
                                    <?php printf('<%1$s %2$s>%3$s</%1$s>', $settings['header_size'], $this->get_render_attribute_string('title'), $content['title']); ?>
                                    <div class="elementor-content">
                                        <?php echo $content['content']; ?>
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

}

$widgets_manager->register_widget_type(new OSF_Elementor_Text_Carousel());
