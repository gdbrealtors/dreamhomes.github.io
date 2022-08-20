<?php

namespace Elementor;
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor featured box widget.
 *
 * Elementor widget that displays an image, a headline and a text.
 *
 * @since 1.0.0
 */
class OSF_Widget_Featured_Box extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve featured box widget name.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'featured-box';
    }

    /**
     * Get widget title.
     *
     * Retrieve featured box widget title.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Featured Box', 'rehomes-core');
    }

    /**
     * Get widget icon.
     *
     * Retrieve featured box widget icon.
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
     * Register featured box widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
            'section_icon',
            [
                'label' => __('Featured Box', 'rehomes-core'),
            ]
        );

        $this->add_control(
            'sub_title_text',
            [
                'label'       => __('Sub Title', 'rehomes-core'),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [
                    'active' => true,
                ],
                'default'     => __('', 'rehomes-core'),
                'placeholder' => __('Enter your subtitle', 'rehomes-core'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => __( 'Icon', 'rehomes-core' ),
                'type' => Controls_Manager::ICON,
                'default' => 'fa fa-star',
            ]
        );

        $this->add_control(
            'title_text',
            [
                'label'       => __('Title', 'rehomes-core'),
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
            'alignment',
            [
                'label' => __( 'Alignment', 'rehomes-core' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'left',
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'rehomes-core' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Top', 'rehomes-core' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'rehomes-core' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'prefix_class' => 'elementor-position-',
                'toggle' => false,
                'condition' => [
                    'icon!' => '',
                ],
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

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_wrapper',
            [
                'label' => __('Wrapper', 'rehomes-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tabs_view_wrapper_style');

        $this->start_controls_tab(
            'view_wrapper_button_normal',
            [
                'label' => __('Normal', 'rehomes-core'),
            ]
        );
        $this->add_control(
            'bg_wrapper',
            [
                'label'     => __('Background Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-wrapper' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'view_wrapper_button_hover',
            [
                'label' => __('Hover', 'rehomes-core'),
            ]
        );

        $this->add_control(
            'bg_wrapper_hover',
            [
                'label'     => __('Background Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-wrapper:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}}.activate .elementor-featured-box-wrapper' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'border_wrapper_hover',
            [
                'label'     => __('Border Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-wrapper:hover' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}}.activate .elementor-featured-box-wrapper' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'wrapper_box_shadow_hover',
                'selector' => '{{WRAPPER}} .elementor-featured-box-wrapper:hover,{{WRAPPER}}.activate .elementor-featured-box-wrapper',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'border_wrapper',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .elementor-featured-box-wrapper',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'wrapper_border_radius',
            [
                'label'      => __( 'Border Radius', 'rehomes-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-featured-box-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'wrapper_box_shadow',
                'selector' => '{{WRAPPER}} .elementor-featured-box-wrapper',
            ]
        );

        $this->add_responsive_control(
            'wrapper_padding_inner',
            [
                'label'      => __( 'Padding', 'rehomes-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-featured-box-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_icon',
            [
                'label' => __('Icon', 'rehomes-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_responsive_control(
            'size_icon',
            [
                'label'     => __( 'Font Size', 'rehomes-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-top i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'width_icon',
            [
                'label'     => __( 'Width', 'rehomes-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-icon' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'height_icon',
            [
                'label'     => __( 'Height', 'rehomes-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-icon' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_spacing',
            [
                'label'      => __( 'Margin', 'rehomes-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-featured-box-top' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_view_icon_style');

        $this->start_controls_tab(
            'view_icon_button_normal',
            [
                'label' => __('Normal', 'rehomes-core'),
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label'     => __('Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-top i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_bg_color',
            [
                'label'     => __('Background Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'view_icon_button_hover',
            [
                'label' => __('Hover', 'rehomes-core'),
            ]
        );
        $this->add_control(
            'icon_color_hover',
            [
                'label'     => __('Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-wrapper:hover .elementor-featured-box-top i' => 'color: {{VALUE}};',
                    '{{WRAPPER}}.activate .elementor-featured-box-wrapper .elementor-featured-box-top i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_bg_color_hover',
            [
                'label'     => __('Background Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-wrapper:hover .elementor-featured-box-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        //Content
        $this->start_controls_section(
            'section_style_content',
            [
                'label' => __('Content', 'rehomes-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
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
                'selector' => '{{WRAPPER}} .elementor-featured-box-title',
            ]
        );

        $this->add_responsive_control(
            'spacing_title',
            [
                'label'      => __( 'Margin', 'rehomes-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-featured-box-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .elementor-featured-box-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} a' => 'color: {{VALUE}};',
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
                'label'     => __('Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-wrapper:hover .elementor-featured-box-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-featured-box-wrapper:hover a' => 'color: {{VALUE}};',
                    '{{WRAPPER}}.activate .elementor-featured-box-wrapper .elementor-featured-box-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'sub_title',
            [
                'label'     => __('Sub Title', 'rehomes-core'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'subtitle_typography',
                'selector' => '{{WRAPPER}} .elementor-featured-box-sub-title',
            ]
        );

        $this->add_responsive_control(
            'spacing_subtitle',
            [
                'label'      => __( 'Margin', 'rehomes-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-featured-box-sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            'subtitle_color',
            [
                'label'     => __('Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-sub-title' => 'color: {{VALUE}};',
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
            'subtitle_color_hover',
            [
                'label'     => __('Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-wrapper:hover .elementor-featured-box-sub-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}}.activate .elementor-featured-box-wrapper .elementor-featured-box-sub-title' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'alignment_subtitle',
            [
                'label' => __( 'Alignment', 'rehomes-core' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'left',
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'rehomes-core' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Top', 'rehomes-core' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'rehomes-core' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-wrapper .elementor-featured-box-sub-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );


        //Description
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
                'selector' => '{{WRAPPER}} .elementor-featured-box-description',
            ]
        );

        $this->add_responsive_control(
            'spacing_description',
            [
                'label'      => __( 'Margin', 'rehomes-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-featured-box-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .elementor-featured-box-description' => 'color: {{VALUE}};',
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
                'label'     => __('Color', 'rehomes-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-wrapper:hover .elementor-featured-box-description' => 'color: {{VALUE}};',
                    '{{WRAPPER}}.activate .elementor-featured-box-wrapper .elementor-featured-box-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('wrapper', 'class', 'elementor-featured-box-wrapper');

        $html = '<div '.$this->get_render_attribute_string("wrapper").'>';

        $html .='<div class="elementor-featured-box-flex">';
            if ( ! empty( $settings['link']['url'] ) ) {
                $this->add_render_attribute( 'link', 'href', $settings['link']['url'] );

                if ( $settings['link']['is_external'] ) {
                    $this->add_render_attribute( 'link', 'target', '_blank' );
                }

                if ( ! empty( $settings['link']['nofollow'] ) ) {
                    $this->add_render_attribute( 'link', 'rel', 'nofollow' );
                }
            }

        //icon

        $html .= '<div class="elementor-featured-box-top">';

        if ( ! empty( $settings['sub_title_text'] ) ) {
            $this->add_render_attribute( 'sub_title_text', 'class', 'elementor-featured-box-sub-title' );

            $html .= sprintf( '<span %1$s>%2$s</span>', $this->get_render_attribute_string( 'sub_title_text' ), $settings['sub_title_text'] );
        }


        if ( ! empty( $settings['icon'] ) ) {

            $this->add_render_attribute( 'icon', 'class', $settings['icon'] );

            $this->add_render_attribute( 'icon', 'aria-hidden', 'true' );

            $html .= '<div class="elementor-featured-box-icon">';

            $html .= '<i class="'.$settings['icon'].'" aria-hidden="true" ></i>';

            $html .= '</div>';
        }

        $html .= '</div>';

        //end icon


        $html .= '<div class="elementor-featured-box-bottom">';

        if ( ! empty( $settings['title_text'] ) ) {
            $this->add_render_attribute( 'title_text', 'class', 'elementor-featured-box-title' );

            $title_html = $settings['title_text'];

            if ( ! empty( $settings['link']['url'] ) ) {
                $title_html = '<a ' . $this->get_render_attribute_string( 'link' ) . '>' . $title_html . '</a>';
            }

            $html .= sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['title_size'], $this->get_render_attribute_string( 'title_text' ), $title_html );
        }

        $html .= '</div>';
        $html.= '</div>';
        $html .='<div class="elementor-featured-box-content">';
        if ( ! empty( $settings['description_text'] ) ) {
            $this->add_render_attribute( 'description_text', 'class', 'elementor-featured-box-description' );

            $html .= sprintf( '<p %1$s>%2$s</p>', $this->get_render_attribute_string( 'description_text' ), $settings['description_text'] );
        }
        $html .='</div>';
        $html .= '</div>';


        echo $html;
    }
}
$widgets_manager->register_widget_type(new OSF_Widget_Featured_Box());
