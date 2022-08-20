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

class OSF_Elementor_Building_Carousel extends OSF_Elementor_Carousel_Base
{

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
    public function get_name()
    {
        return 'opal-building_carousel';
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
    public function get_title()
    {
        return __('Opal Building Carousel', 'rehomes-core');
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
    public function get_icon()
    {
        return 'eicon-slider-push';
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
            'section_text_carousel',
            [
                'label' => __('Content', 'rehomes-core'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'style',
            [
                'label' => __('Style', 'rehomes-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'icon' => __('Icon', 'rehomes-core'),
                    'number' => __('Number', 'rehomes-core')
                ],
                'default' => 'icon'
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => __('Choose Image', 'rehomes-core'),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'default' => 'full',
            ]
        );

        $repeater->add_control(
            'icon',
            [
                'label' => __('Choose Icon', 'rehomes-core'),
                'type' => Controls_Manager::ICON,
                'default' => 'fa fa-star',
                'condition' => [
                    'style' => 'icon'
                ],
                'separator' => 'before'
            ]
        );

        $repeater->add_control(
            'number',
            [
                'label' => __('Number', 'rehomes-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 25,
                'condition' => [
                    'style' => 'number'
                ],
                'separator' => 'before'
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => __('Title', 'rehomes-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __('This is the heading', 'rehomes-core'),
                'placeholder' => __('Enter your title', 'rehomes-core'),
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => __('Description', 'rehomes-core'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'rehomes-core'),
                'placeholder' => __('Enter your description', 'rehomes-core'),
            ]
        );

        $this->add_control(
            'contents',
            [
                'label' => __('Content Item', 'rehomes-core'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );
        $this->add_responsive_control(
            'column',
            [
                'label'           => __('Columns', 'rehomes-core'),
                'type'            => \Elementor\Controls_Manager::SELECT,
                'options'         => [1 => 1, 2 => 2, 3 => 3],
                'desktop_default' => 1,
                'tablet_default'  => 1,
                'mobile_default'  => 1,
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
            'image_width',
            [
                'label'     => __('Wrapper Image', 'rehomes-core'),
                'type'      => Controls_Manager::SLIDER,
                'size_units'    => ['%', 'px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-building-image' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .owl-carousel' => 'width: calc(100% - {{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_control(
            'border_radius_image',
            [
                'label'      => __( 'Border Radius', 'rehomes-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-image-framed img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'padding_image',
            [
                'label'      => __( 'Padding', 'rehomes-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-image-framed img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'margin_image',
            [
                'label'      => __( 'Margin', 'rehomes-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-image-framed img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_icon',
            [
                'label' => __('Icon', 'rehomes-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'primary_color',
            [
                'label' => __('Color', 'rehomes-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'icon_space',
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
                    '{{WRAPPER}} .elementor-building-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __('Size', 'rehomes-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_number',
            [
                'label' => __('Number', 'rehomes-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'number_space',
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
                    '{{WRAPPER}} .elementor-building-number' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'number_color',
            [
                'label' => __('Color', 'rehomes-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-building-number' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'number_typography',
                'selector' => '{{WRAPPER}} .elementor-building-number',
            ]
        );

        $this->add_control(
            'show_plus',
            [
                'label'     => __('Show Plus', 'rehomes-core'),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => __('Show', 'rehomes-core'),
                'label_off' => __('Hide', 'rehomes-core'),
            ]
        );

        $this->add_responsive_control(
            'plus_size',
            [
                'label'     => __('Size', 'rehomes-core'),
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
                    '{{WRAPPER}} .elementor-building-number .plus' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                        'show_plus!'    => ''
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_content',
            [
                'label' => __('Content', 'rehomes-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'heading_title',
            [
                'label' => __('Title', 'rehomes-core'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'title_bottom_space',
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
                    '{{WRAPPER}} .elementor-building-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Color', 'rehomes-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-building-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .elementor-building-title',
            ]
        );

        $this->add_control(
            'heading_description',
            [
                'label' => __('Description', 'rehomes-core'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __('Color', 'rehomes-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-building-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .elementor-building-description',
            ]
        );

        $this->add_responsive_control(
            'padding_content',
            [
                'label'      => __( 'Padding', 'rehomes-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-content-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'margin_content',
            [
                'label'      => __( 'Margin', 'rehomes-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-content-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Carousel Option
        $this->add_control_carousel('yes');

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
        if (!empty($settings['contents']) && is_array($settings['contents'])) {

            $this->add_render_attribute('wrapper', 'class', 'elementor-building_carousel-wrapper');

            // Row
            $this->add_render_attribute('row', 'class', 'row');

            if($settings['enable_carousel']) {
                $this->add_render_attribute('row', 'class', 'owl-carousel owl-theme');
                $carousel_settings = $this->get_carousel_settings();
                $this->add_render_attribute('row', 'data-settings', wp_json_encode($carousel_settings));
            }

            // Item
            $this->add_render_attribute('item', 'class', 'elementor-content-item');

            $this->add_render_attribute('meta', 'class', 'elementor-content-meta');

            $this->add_render_attribute('image-wrapper', 'class', 'elementor-image-box-img');
            ?>
            <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
                <div class="elementor-building-image">

                <?php


                foreach ($settings['contents'] as $content):
                    $html = '';
                    if (!empty($content['image']['url'])) {
                        $this->add_render_attribute('image', 'src', $content['image']['url']);
                        $this->add_render_attribute('image', 'alt', Control_Media::get_image_alt($content['image']));
                        $this->add_render_attribute('image', 'title', Control_Media::get_image_title($content['image']));

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
                        $html .= '<div class="image-item-'.esc_attr__($content['_id'], 'rehomes-core').' elementor-image-framed">';
                        $html .= '<figure ' . $this->get_render_attribute_string("image-wrapper") . '>' . $image_html . '</figure>';
                        $html .= '</div>';
                        echo $html;
                    }
                    endforeach;
                    ?>
                </div>

                <div <?php echo $this->get_render_attribute_string('row') ?>>
                    <?php foreach ($settings['contents'] as $content): ?>
                        <div class="elementor-content-item" data-trigger="<?php echo '.image-item-' . $content['_id']; ?>">
                            <div class="elementor-content-item-inner">
                                    <?php if ($content['style'] == 'icon'):?>
                                    <div class="elementor-building-icon">
                                        <span class="elementor-icon elementor-animation-">
                                            <i class="<?php echo esc_attr( $content['icon'] ); ?>" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <?php else:?>
                                    <div class="elementor-building-number"><span class="number"><?php echo $content['number'];?></span><?php if ($settings['show_plus']):?><span class="plus">+</span><?php endif;?></div>
                                    <?php endif;?>
                                    <div class="elementor-building-content">
                                        <h3 class="elementor-building-title"><?php echo $content['title'];?></h3>
                                        <p class="elementor-building-description"><?php echo $content['description'];?></p>
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

$widgets_manager->register_widget_type(new OSF_Elementor_Building_Carousel());
