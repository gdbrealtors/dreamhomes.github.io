<?php



use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

class OSF_Elementor_Video_Popup extends Elementor\Widget_Base {

    public function get_name() {
        return 'opal-video-popup';
    }

    public function get_title() {
        return __('Opal Video', 'rehomes-core');
    }

    public function get_categories() {
        return array('opal-addons');
    }

    public function get_icon() {
        return 'eicon-youtube';
    }

    public function get_script_depends() {
        return ['magnific-popup'];
    }

    public function get_style_depends() {
        return ['magnific-popup'];
    }


    protected function register_controls() {
        $this->start_controls_section(
            'section_videos',
            [
                'label' => __('General', 'rehomes-core'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'video_link',
            [
                'label' => __( 'Link to', 'rehomes-core' ),
                'type' => Controls_Manager::TEXT,
                'description' => __('Support video from Youtube and Vimeo', 'rehomes-core'),
                'placeholder' => __( 'https://your-link.com', 'rehomes-core' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'rehomes-core' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Tile', 'rehomes-core' ),
                'default'     => '',
            ]
        );

        $this->add_responsive_control(
            'video_align',
            [
                'label'     => __('Alignment', 'rehomes-core'),
                'type'      => Controls_Manager::CHOOSE,
                'default'     => 'center',
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
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_font',
            [
                'label' => __( 'Icon Font', 'rehomes-core' ),
                'type' => Controls_Manager::ICON,
                'label_block' => true,
                'default' => 'opal-icon-play',
            ]
        );

        $this->end_controls_section();

        //Icon
        $this->start_controls_section(
            'section_video_style',
            [
                'label' => __( 'Icon', 'rehomes-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'video_size',
            [
                'label'     => __('Font Size', 'rehomes-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .opal-video-popup .elementor-video-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'video_width',
            [
                'label'     => __('Width', 'rehomes-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .opal-video-popup .elementor-video-icon' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'video_height',
            [
                'label'     => __('Height', 'rehomes-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .opal-video-popup .elementor-video-icon' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_video_style' );

        $this->start_controls_tab(
            'tab_video_normal',
            [
                'label' => __( 'Normal', 'rehomes-core' ),
            ]
        );

        $this->add_control(
            'video_color',
            [
                'label' => __( 'Color', 'rehomes-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .opal-video-popup .elementor-video-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'video_background_color',
            [
                'label' => __( 'Background Color', 'rehomes-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .opal-video-popup .elementor-video-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_video_hover',
            [
                'label' => __( 'Hover', 'rehomes-core' ),
            ]
        );

        $this->add_control(
            'video_hover_color',
            [
                'label' => __( 'Color', 'rehomes-core' ),
                'type' => Controls_Manager::COLOR,
                'default'     => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .opal-video-popup :hover .elementor-video-icon' => 'color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'video_hover_background_color',
            [
                'label' => __( 'Background Color', 'rehomes-core' ),
                'type' => Controls_Manager::COLOR,
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .opal-video-popup :hover .elementor-video-icon' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'video_hover_border_color',
            [
                'label' => __( 'Border Color', 'rehomes-core' ),
                'type' => Controls_Manager::COLOR,
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .opal-video-popup :hover .elementor-video-icon' => 'border-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'border_video',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .opal-video-popup .elementor-video-icon',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label'      => __( 'Border Radius', 'rehomes-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .opal-video-popup .elementor-video-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'video_padding',
            [
                'label' => __('Padding', 'rehomes-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .opal-video-popup .elementor-video-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'video_margin',
            [
                'label' => __('Margin', 'rehomes-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .opal-video-popup .elementor-video-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        //title
        $this->start_controls_section(
            'section_video_title',
            [
                'label' => __( 'Title', 'rehomes-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Color', 'rehomes-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .opal-video-popup .elementor-video-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label' => __( 'Color Hover', 'rehomes-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-popup:hover .elementor-video-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'selector' => '{{WRAPPER}} .opal-video-popup .elementor-video-title',
            ]
        );

        $this->add_control(
            'show_title_block',
            [
                'label' => __( 'Style Block', 'rehomes-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => __( 'Off', 'rehomes-core' ),
                'label_on' => __( 'On', 'rehomes-core' ),
                'selectors' => [
                    '{{WRAPPER}} .opal-video-popup .elementor-video-popup' => 'flex-direction: column;',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label' => __('Padding', 'rehomes-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'label' => __('Margin', 'rehomes-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if(empty($settings['video_link'])){
            return;
        }

        $this->add_render_attribute( 'wrapper', 'class', 'elementor-video-wrapper' );
        $this->add_render_attribute( 'wrapper', 'class', 'opal-video-popup' );

        $this->add_render_attribute( 'button', 'class', 'elementor-video-popup' );
        $this->add_render_attribute( 'button', 'role', 'button' );
        $this->add_render_attribute( 'button', 'href',  esc_url( $settings['video_link']));
        $this->add_render_attribute( 'button', 'data-effect', 'mfp-zoom-in' );

        $contentHtml = '<i class="'. esc_attr( $settings['icon_font'] ).'"></i>';

        $titleHtml = !empty($settings['title']) ? '<span class="elementor-video-title">'.$settings['title'].'</span>' : '';


        ?>
        <div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
            <a <?php echo $this->get_render_attribute_string( 'button' ); ?>>
                <span class="elementor-video-icon"><?php echo $contentHtml; ?></span>
                <?php echo ($titleHtml);?>
            </a>

        </div>
        <?php
    }

}
$widgets_manager->register_widget_type(new OSF_Elementor_Video_Popup());