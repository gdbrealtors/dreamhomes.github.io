<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor image gallery widget.
 *
 * Elementor widget that displays a set of images in an aligned grid.
 *
 * @since 1.0.0
 */
class OSF_Elementor_Image_Gallery extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve image gallery widget name.
     *
     * @return string Widget name.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_name() {
        return 'opal-image-gallery';
    }

    /**
     * Get widget title.
     *
     * Retrieve image gallery widget title.
     *
     * @return string Widget title.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_title() {
        return __('Opal Image Gallery', 'rehomes-core');
    }

    public function get_script_depends() {
        return [
            'isotope',
            'imagesloaded',
            'magnific-popup',
            'hoverdir',
        ];
    }

    public function get_style_depends() {
        return ['magnific-popup'];
    }


    /**
     * Get widget icon.
     *
     * Retrieve image gallery widget icon.
     *
     * @return string Widget icon.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @return array Widget keywords.
     * @since  2.1.0
     * @access public
     *
     */
    public function get_keywords() {
        return ['image', 'photo', 'visual', 'gallery'];
    }

    /**
     * Register image gallery widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
            'section_gallery',
            [
                'label' => __('Image Gallery', 'rehomes-core'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'filter_title',
            [
                'label'       => __('Filter Title', 'rehomes-core'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __('List Item', 'rehomes-core'),
                'default'     => __('List Item', 'rehomes-core'),
            ]
        );

        $repeater->add_control(
            'wp_gallery',
            [
                'label'      => __('Add Images', 'rehomes-core'),
                'type'       => Controls_Manager::GALLERY,
                'show_label' => false,
                'dynamic'    => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'filter',
            [
                'label'       => '',
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'filter_title' => __('Gallery 1', 'rehomes-core'),
                    ],
                ],
                'title_field' => '{{{ filter_title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_layout',
            [
                'label' => __('Layout', 'rehomes-core'),
                'tab'   => Controls_Manager::TAB_LAYOUT
            ]
        );

        $this->add_control(
            'show_filter_bar',
            [
                'label'     => __('Filter Bar', 'rehomes-core'),
                'type'      => Controls_Manager::SWITCHER,
                'label_off' => __('Off', 'rehomes-core'),
                'label_on'  => __('On', 'rehomes-core'),
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumbnail',
                // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                //                'exclude'   => ['custom'],
                'separator' => 'none',
                'default'   => 'maisonco-gallery-image'
            ]
        );


        $this->add_responsive_control(
            'columns',
            [
                'label'   => __('Columns', 'rehomes-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 3,
                'options' => [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6],
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

        $this->add_control(
            'view',
            [
                'label'   => __('View', 'rehomes-core'),
                'type'    => Controls_Manager::HIDDEN,
                'default' => 'traditional',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_gallery_images',
            [
                'label' => __('Images', 'rehomes-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'image_spacing',
            [
                'label'        => __('Spacing', 'rehomes-core'),
                'type'         => Controls_Manager::SELECT,
                'options'      => [
                    ''       => __('Default', 'rehomes-core'),
                    'custom' => __('Custom', 'rehomes-core'),
                ],
                'prefix_class' => 'gallery-spacing-',
                'default'      => '',
            ]
        );

        $columns_margin  = is_rtl() ? '0 0 -{{SIZE}}{{UNIT}} -{{SIZE}}{{UNIT}};' : '0 -{{SIZE}}{{UNIT}} -{{SIZE}}{{UNIT}} 0;';
        $columns_padding = is_rtl() ? '0 0 {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}};' : '0 {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} 0;';

        $this->add_control(
            'image_spacing_custom',
            [
                'label'      => __('Image Spacing', 'rehomes-core'),
                'type'       => Controls_Manager::SLIDER,
                'show_label' => false,
                'range'      => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'size' => 15,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .gallery-item' => 'padding:' . $columns_padding,
                    '{{WRAPPER}} .gallery'      => 'margin: ' . $columns_margin,
                ],
                'condition'  => [
                    'image_spacing' => 'custom',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'image_border',
                'selector'  => '{{WRAPPER}} .gallery-item img',
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
                    '{{WRAPPER}} .gallery-item img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_design_filter',
            [
                'label'     => __('Filter Bar', 'rehomes-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_filter_bar' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography_filter',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_TEXT,
                ],
                'selector' => '{{WRAPPER}} .elementor-galerry__filter',
            ]
        );

        $this->add_control(
            'filter_item_spacing',
            [
                'label'     => __('Space Between', 'rehomes-core'),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 5,
                ],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-galerry__filter:not(:last-child)'  => 'margin-right: calc({{SIZE}}{{UNIT}}/2)',
                    '{{WRAPPER}} .elementor-galerry__filter:not(:first-child)' => 'margin-left: calc({{SIZE}}{{UNIT}}/2)',
                ],
            ]
        );

        $this->add_responsive_control(
            'filter_spacing',
            [
                'label'     => __('Spacing', 'rehomes-core'),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 45,
                ],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-galerry__filters' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'filter_padding',
            [
                'label'      => __('Filter Padding', 'rehomes-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-galerry__filters' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'filter_align',
            [
                'label'        => __('Alignment', 'rehomes-core'),
                'type'         => Controls_Manager::CHOOSE,
                'default'      => 'top',
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
                    ]
                ],
                'toggle'       => false,
                'prefix_class' => 'elementor-filter-',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render image gallery widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('row', 'class', 'row grid isotope-grid');

        if (!empty($settings['columns'])) {
            $this->add_render_attribute('row', 'data-elementor-columns', $settings['columns']);
        }

        if (!empty($settings['columns_tablet'])) {
            $this->add_render_attribute('row', 'data-elementor-columns-tablet', $settings['columns_tablet']);
        }
        if (!empty($settings['columns_mobile'])) {
            $this->add_render_attribute('row', 'data-elementor-columns-mobile', $settings['columns_mobile']);
        }

        if ($settings['show_filter_bar'] == 'yes') {
            ?>
            <ul class="elementor-galerry__filters"
                data-related="isotope-<?php echo esc_attr($this->get_id()); ?>">
                <?php foreach ($settings['filter'] as $key => $term) { ?>
                    <li class="elementor-galerry__filter <?php if ($key == 0) echo esc_attr('elementor-active'); ?>"
                        data-filter=".gallery_group_<?php echo esc_attr($key); ?>"><?php echo $term['filter_title']; ?></li>
                <?php } ?>
            </ul>
            <?php
        }
        ?>

        <div class="elementor-opal-image-gallery">
            <div <?php echo $this->get_render_attribute_string('row') ?>>
                <?php

                if (Plugin::$instance->editor->is_edit_mode()) {
                    $this->add_render_attribute('link', [
                        'class' => 'elementor-clickable',
                    ]);
                }
                $image_gallery = array();
                foreach ($settings['filter'] as $index => $item) {
                    if (!empty($item['wp_gallery'])):
                        foreach ($item['wp_gallery'] as $items => $attachment) {
                            $attachment['thumbnail_url'] = Group_Control_Image_Size::get_attachment_image_src($attachment['id'], 'thumbnail', $settings);
                            $attachment['group']         = $index;
                            $image_gallery[]             = $attachment;
                        }
                    endif;
                }
                foreach ($image_gallery as $index => $item) {
                    $image_url      = Group_Control_Image_Size::get_attachment_image_src($item['id'], 'thumbnail', $settings);
                    $image_url_full = wp_get_attachment_image_url($item['id'], 'full');
                    ?>
                    <div class="column-item grid__item masonry-item __all <?php echo 'gallery_group_' . esc_attr($item['group']); ?>">
                        <a data-elementor-open-lightbox="no" <?php echo $this->get_render_attribute_string('link'); ?>
                           href="<?php echo esc_attr($image_url_full); ?>">
                            <img src="<?php echo esc_attr($image_url); ?>"
                                 alt="<?php echo esc_attr(Control_Media::get_image_alt($item)); ?>"/>
                            <div class="gallery-item-overlay">
                                <i class="opal-icon-search"></i>
                            </div>
                        </a>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    }
}

$widgets_manager->register_widget_type(new OSF_Elementor_Image_Gallery());
