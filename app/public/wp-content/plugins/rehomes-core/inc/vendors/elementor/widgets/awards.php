<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;

use Elementor\Group_Control_Typography;

use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Group_Control_Image_Size;
use Elementor\Control_Media;

class OSF_Elementor_Awards extends OSF_Elementor_Carousel_Base {

    public function get_name() {
        return 'opal-awards';
    }

    public function get_title() {
        return __('Opal Awards', 'rehomes-core');
    }

    public function get_icon() {
        return 'eicon-slider-push';
    }

    public function get_categories() {
        return array('opal-addons');
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_awards',
            [
                'label' => __('Content', 'rehomes-core'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'awards_type',
            [
                'label'   => __('Type', 'rehomes-core'),
                'type'    => Controls_Manager::SELECT,
                'options'   => [
                    'image' => __('Image','rehomes-core'),
                    'icon' => __('Icon & SVG','rehomes-core'),
                ],
                'default'     => 'image',
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
                'condition' => [
                    'awards_type'    => 'image'
                ]
            ]
        );

        $repeater->add_control(
            'icon',
            [
                'label'   => __('Icon & SVG', 'rehomes-core'),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'awards_type'    => 'icon'
                ]
            ]
        );

        $repeater->add_control(
            'years',
            [
                'label'       => __('Years', 'rehomes-core'),
                'type'        => Controls_Manager::NUMBER,
                'default'     => 2019,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label'       => __('Title', 'rehomes-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => __('Title', 'rehomes-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'content',
            [
                'name'        => 'content',
                'label'       => __('Description', 'rehomes-core'),
                'type'        => Controls_Manager::WYSIWYG,
                'default'     => 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
                'label_block' => true,
                'rows'        => '10',
            ]
        );

        $this->add_control(
            'contents',
            [
                'label'       => __('Awards Item', 'rehomes-core'),
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

        $this->add_responsive_control(
            'column',
            [
                'label'           => __('Columns', 'rehomes-core'),
                'type'            => \Elementor\Controls_Manager::SELECT,
                'options'         => [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6],
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
                'condition' => [
                        'enable_carousel'   => ''
                ]
            ]
        );

        $this->add_responsive_control(
            'style',
            [
                'label'        => __('Style', 'rehomes-core'),
                'type'         => \Elementor\Controls_Manager::SELECT,
                'default'      => '1',
                'options'      => [
                    '1' => __('Style 1', 'rehomes-core'),
                    '2' => __('Style 2', 'rehomes-core'),
                ],
            ]
        );

        $this->end_controls_section();

        // Style Icon.

        $this->start_controls_section(
            'section_awards_wrapper',
            [
                'label' => __('Wrapper', 'rehomes-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'wrapper_border_radius',
            [
                'label'      => __( 'Border Radius', 'rehomes-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-content-item-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'award_wrapper_boxshadow',
                'selector' => '{{WRAPPER}} .elementor-content-item-inner',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_awards_icon',
            [
                'label' => __('Icon', 'rehomes-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __( 'Size', 'rehomes-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                        'min' => 0,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor_awards_image' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_icon' );

        $this->start_controls_tab(
            'tab_icon_normal',
            [
                'label' => __( 'Normal', 'rehomes-core' ),
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => __('Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-content-item-inner' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_icon_hover',
            [
                'label' => __( 'Hover', 'rehomes-core' ),
            ]
        );

        $this->add_control(
            'icon_color_hover',
            [
                'label'     => __('Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-content-item-inner:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // Style.
        $this->start_controls_section(
            'section_text_carousel_style',
            [
                'label' => __('Content Box', 'rehomes-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_bkg',
            [
                'label'     => __('Background', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-content-wrap' => 'background: {{VALUE}};',
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
                    '{{WRAPPER}} .elementor-content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Year Style.
        $this->start_controls_section(
            'section_years_style',
            [
                'label' => __('Year', 'rehomes-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'year_color',
            [
                'label'     => __('Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-years' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'year_typography',
                'selector' => '{{WRAPPER}} .elementor-years',
            ]
        );

        $this->add_control(
            'year_spacing',
            [
                'label' => __( 'Spacing', 'rehomes-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 50,
                        'min' => 0,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-years' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
                'selectors' => [
                    '{{WRAPPER}} .elementor-awards-title' => 'color: {{VALUE}};',
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
                'selector' => '{{WRAPPER}} .elementor-awards-title',
            ]
        );

        $this->add_control(
            'title_spacing',
            [
                'label' => __( 'Spacing', 'rehomes-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 50,
                        'min' => 0,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-awards-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Description Style.
        $this->start_controls_section(
            'section_description_style',
            [
                'label' => __('Description', 'rehomes-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label'     => __('Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'description_typography',
                'selector' => '{{WRAPPER}} .elementor-content',
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

            $this->add_render_attribute('wrapper', 'class', 'elementor-awards-wrapper');
            $this->add_render_attribute('wrapper', 'class', 'awards-style-'.esc_attr__($settings['style'], 'rehomes-core'));

            // Row
            $this->add_render_attribute('row', 'class', 'row');

            if ($settings['enable_carousel'] === 'yes') {
                $this->add_render_attribute('row', 'class', 'owl-carousel owl-theme');
                $carousel_settings = $this->get_carousel_settings();
                $this->add_render_attribute('row', 'data-settings', wp_json_encode($carousel_settings));
            } else {
                $this->add_render_attribute('item', 'class', 'column-item');

                if (!empty($settings['column'])) {
                    $this->add_render_attribute('row', 'data-elementor-columns', $settings['column']);
                }

                if (!empty($settings['column_tablet'])) {
                    $this->add_render_attribute('row', 'data-elementor-columns-tablet', $settings['column_tablet']);
                }
                if (!empty($settings['column_mobile'])) {
                    $this->add_render_attribute('row', 'data-elementor-columns-mobile', $settings['column_mobile']);
                }
            }
            // Item
            $this->add_render_attribute('item', 'class', 'elementor-content-item');

            $this->add_render_attribute('meta', 'class', 'elementor-content-meta');

            $this->add_render_attribute('title', 'class', 'elementor-awards-title');

            $migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
            $is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

            if ( empty( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
                // add old default
                $settings['icon'] = 'fa fa-star';
            }

            if ( ! empty( $settings['icon'] ) ) {
                $this->add_render_attribute( 'icon', 'class', $settings['icon'] );
                $this->add_render_attribute( 'icon', 'aria-hidden', 'true' );
            }

            ?>
            <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
                <div <?php echo $this->get_render_attribute_string('row') ?>>
                    <?php foreach ($settings['contents'] as $content): ?>
                        <div <?php echo $this->get_render_attribute_string('item'); ?>>
                            <div class="elementor-content-item-inner">
                                <div class="elementor_awards_image">
                                    <?php if ($settings['style'] == '2' && $content['awards_type'] == 'image'):?>
                                        <span class="awards_icon_overlay">
                                            <i aria-hidden="true" class="opal-icon-award"></i>
                                        </span>
                                    <?php endif;?>
                                <?php
                                if ($content['awards_type'] == 'image'){
                                    $html = '';
                                    if (!empty($content['image']['url'])) {
                                        $this->add_render_attribute('image', 'src', $content['image']['url']);
                                        $this->add_render_attribute('image', 'alt', Control_Media::get_image_alt($content['image']));
                                        $this->add_render_attribute('image', 'title', Control_Media::get_image_title($content['image']));

                                        $this->add_render_attribute('image-wrapper', 'class', 'elementor-image-box-img');

                                        $image_html = Group_Control_Image_Size::get_attachment_image_html($content);
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
                                        $html .= '<figure ' . $this->get_render_attribute_string("image-wrapper") . '>' . $image_html . '</figure>';
                                        echo $html;
                                    }
                                }else{
                                    if ($is_new || $migrated) {
                                        Icons_Manager::render_icon($content['icon'], ['aria-hidden' => 'true']);
                                    } else { ?>
                                        <i <?php echo $this->get_render_attribute_string('icon'); ?>></i>
                                        <?php
                                    }
                                }
                                ?>
                                </div>
                                <div class="elementor-content-wrap">
                                    <span class="elementor-years"><?php echo $content['years'];?></span>
                                    <?php printf('<h5 %1$s>%2$s</h5>', $this->get_render_attribute_string('title'), $content['title']); ?>
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

$widgets_manager->register_widget_type(new OSF_Elementor_Awards());
