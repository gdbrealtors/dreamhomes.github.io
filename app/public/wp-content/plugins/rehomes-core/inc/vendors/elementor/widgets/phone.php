<?php



use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

class OSF_Elementor_Phone extends Elementor\Widget_Base {

    public function get_name() {
        return 'opal-phone';
    }

    public function get_title() {
        return __('Opal Phone', 'rehomes-core');
    }

    public function get_categories() {
        return array('opal-addons');
    }


    protected function register_controls() {
        $this->start_controls_section(
            'section_phone',
            [
                'label' => __('Phone', 'rehomes-core'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'phone',
            [
                'label'       => __('Phone', 'rehomes-core'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __('Enter your phone', 'rehomes-core'),
                'default'     => __('844 1800 33 555', 'rehomes-core'),
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => __( 'Choose Icon', 'rehomes-core' ),
                'type' => Controls_Manager::ICON,
                'default' => 'fa fa-phone',
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => __('Title', 'rehomes-core'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __('Enter your title', 'rehomes-core'),
                'default'     => __('Make a call', 'rehomes-core'),
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label'       => __('Sub Title', 'rehomes-core'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __('Enter your sub title', 'rehomes-core'),
                'default'     => __('+844 1800 33 555', 'rehomes-core'),
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __( 'Alignment', 'rehomes-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'rehomes-core' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'rehomes-core' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'rehomes-core' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'prefix_class' => 'elementor%s-align-',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'phone_type',
            [
                'label'       => __('Type', 'rehomes-core'),
                'type'        => Controls_Manager::SELECT,
                'options'   => [
                        'style1'    => __("Style 1", 'rehomes-core'),
                        'style2'    => __("Style 2", 'rehomes-core'),
                ],
                'default'     => 'style1',
                'prefix_class'  => 'elementor-phone-'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_wrapper_style',
            [
                'label' => __( 'Wrapper', 'rehomes-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'tabs_wrapper_style' );

        $this->start_controls_tab(
            'tab_wrapper_normal',
            [
                'label' => __( 'Normal', 'rehomes-core' ),
            ]
        );

        $this->add_control(
            'wrapper_bkg',
            [
                'label' => __( 'Background', 'rehomes-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-phone ' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_wrapper_hover',
            [
                'label' => __( 'Hover', 'rehomes-core' ),
            ]
        );

        $this->add_control(
            'wrapper_bkg_hover',
            [
                'label' => __( 'Background', 'rehomes-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-phone:hover ' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'wrapper_phone_border',
                'selector'    => '{{WRAPPER}} .elementor-phone',
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'wrapper_phone_padding',
            [
                'label'      => __( 'Padding', 'rehomes-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-phone' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrapper_phone_radius',
            [
                'label'      => __( 'Border Radius', 'rehomes-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em','%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-phone' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_icon_style',
            [
                'label' => __( 'Icon', 'rehomes-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'icon_font_size',
            [
                'label' => __( 'Font Size', 'rehomes-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 14,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_margin',
            [
                'label'      => __( 'Margin', 'rehomes-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_icon_style' );

        $this->start_controls_tab(
            'tab_icon_normal',
            [
                'label' => __( 'Normal', 'rehomes-core' ),
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => __( 'Color', 'rehomes-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}:not(:hover) i' => 'color: {{VALUE}};',
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
                'label' => __( 'Color', 'rehomes-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}:hover i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => __( 'Title', 'rehomes-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
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
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-phone-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .elementor-phone-title',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_text_style' );

        $this->start_controls_tab(
            'tab_text_normal',
            [
                'label' => __( 'Normal', 'rehomes-core' ),
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __( 'Color', 'rehomes-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}:not(:hover) .elementor-phone-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_text_hover',
            [
                'label' => __( 'Hover', 'rehomes-core' ),
            ]
        );

        $this->add_control(
            'text_color_hover',
            [
                'label' => __( 'Hover', 'rehomes-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}:hover .elementor-phone-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();


        $this->start_controls_section(
            'section_subtitle_style',
            [
                'label' => __( 'Sub Title', 'rehomes-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typography',
                'selector' => '{{WRAPPER}} .elementor-phone-subtitle',
            ]
        );

        $this->start_controls_tabs( 'tabs_subtitle_style' );

        $this->start_controls_tab(
            'tab_subtitle_normal',
            [
                'label' => __( 'Normal', 'rehomes-core' ),
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => __( 'Color', 'rehomes-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}:not(:hover) .elementor-phone-subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_subtitle_hover',
            [
                'label' => __( 'Hover', 'rehomes-core' ),
            ]
        );

        $this->add_control(
            'subtitle_color_hover',
            [
                'label' => __( 'Hover', 'rehomes-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}:hover .elementor-phone-subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute( 'phone_item', 'class', 'elementor-phone' );
        $this->add_render_attribute( 'phone_link', 'class', 'elementor-phone-link' );
        $this->add_render_attribute( 'phone_title', 'class', 'elementor-phone-title' );
        $this->add_render_attribute( 'phone_sub_title', 'class', 'elementor-phone-subtitle' );

        if ( ! empty( $settings['icon'] ) ) {
            $this->add_render_attribute( 'icon', 'class', $settings['icon'] );
            $this->add_render_attribute( 'icon', 'aria-hidden', 'true' );
        }

        ?>

        <div <?php echo $this->get_render_attribute_string( 'phone_item' ); ?>>
            <i <?php echo $this->get_render_attribute_string( 'icon' ); ?>></i>
            <div class="phone-box">
                <?php
                if ( ! empty( $settings['title'] ) ) {
                    ?>
                    <span <?php echo $this->get_render_attribute_string( 'phone_title' ); ?>>
                    <?php echo $settings['title']; ?>
                </span>
                    <?php
                }
                if ( ! empty( $settings['sub_title'] ) ) {
                    ?>
                    <span <?php echo $this->get_render_attribute_string( 'phone_sub_title' ); ?>>
                    <?php echo $settings['sub_title']; ?>
                </span>
                    <?php
                }
                ?>
            </div>
            <a href="tel:<?php echo esc_attr(preg_replace('/\s+/m', '', $settings['phone'])); ?>" <?php echo $this->get_render_attribute_string( 'phone_link' ); ?>></a>
        </div>

        <?php
    }

}
$widgets_manager->register_widget_type(new OSF_Elementor_Phone());