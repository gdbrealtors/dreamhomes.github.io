<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}


class OSF_Elementor_Progress extends Widget_Progress {


    public function get_title() {
        return __( 'Opal Progress Bar', 'rehomes-core' );
    }


    protected function register_controls() {
        $this->start_controls_section(
            'section_progress',
            [
                'label' => __( 'Progress Bar', 'rehomes-core' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'rehomes-core' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __( 'Enter your title', 'rehomes-core' ),
                'default' => __( 'My Skill', 'rehomes-core' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'progress_type',
            [
                'label' => __( 'Type', 'rehomes-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => __( 'Default', 'rehomes-core' ),
                    'info' => __( 'Info', 'rehomes-core' ),
                    'success' => __( 'Success', 'rehomes-core' ),
                    'warning' => __( 'Warning', 'rehomes-core' ),
                    'danger' => __( 'Danger', 'rehomes-core' ),
                ],
            ]
        );

        $this->add_control(
            'percent',
            [
                'label' => __( 'Percentage', 'rehomes-core' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 50,
                    'unit' => '%',
                ],
                'label_block' => true,
            ]
        );

        $this->add_control( 'display_percentage', [
            'label' => __( 'Display Percentage', 'rehomes-core' ),
            'type' => Controls_Manager::SELECT,
            'default' => 'show',
            'options' => [
                'show' => __( 'Show', 'rehomes-core' ),
                'hide' => __( 'Hide', 'rehomes-core' ),
            ],
        ] );

        $this->add_control(
            'view',
            [
                'label' => __( 'View', 'rehomes-core' ),
                'type' => Controls_Manager::HIDDEN,
                'default' => 'traditional',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_progress_style',
            [
                'label' => __( 'Progress Bar', 'rehomes-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bar_bg_color',
            [
                'label' => __( 'Background Color', 'rehomes-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-progress-wrapper' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'label' => __( 'Color', 'rehomes-core' ),
                'name' => 'bar_color',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .elementor-progress-wrapper .elementor-progress-bar',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title',
            [
                'label' => __( 'Title Style', 'rehomes-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Text Color', 'rehomes-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-title' => 'color: {{VALUE}};',
                ],
            ]
        );

//        $this->add_group_control(
//            Group_Control_Typography::get_type(),
//            [
//                'name' => 'typography',
//                'selector' => '{{WRAPPER}} .elementor-title',
//            ]
//        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_percentage',
            [
                'label' => __( 'Percentage Style', 'rehomes-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'percentage_color',
            [
                'label' => __( 'Text Color', 'rehomes-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-progress-percentage' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute( 'wrapper', [
            'class' => 'elementor-progress-wrapper',
            'role' => 'progressbar',
            'aria-valuemin' => '0',
            'aria-valuemax' => '100',
            'aria-valuenow' => $settings['percent']['size'],
        ] );

        if ( ! empty( $settings['progress_type'] ) ) {
            $this->add_render_attribute( 'wrapper', 'class', 'progress-' . $settings['progress_type'] );
        }

        $this->add_render_attribute( 'progress-bar', [
            'class' => 'elementor-progress-bar',
            'data-max' => $settings['percent']['size'],
        ] );

        if ( ! empty( $settings['title'] ) ) { ?>
            <span class="elementor-title"><?php echo $settings['title']; ?></span>
        <?php } ?>

        <div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
            <div <?php echo $this->get_render_attribute_string( 'progress-bar' ); ?>>
                <?php if ( 'hide' !== $settings['display_percentage'] ) { ?>
                    <span class="elementor-progress-percentage"><?php echo $settings['percent']['size']; ?>%</span>
                <?php } ?>
            </div>
        </div>
        <?php
    }

    protected function content_template() {
        ?>
        <#
        view.addRenderAttribute( 'progressWrapper', {
        'class': [ 'elementor-progress-wrapper', 'progress-' + settings.progress_type ],
        'role': 'progressbar',
        'aria-valuemin': '0',
        'aria-valuemax': '100',
        'aria-valuenow': settings.percent.size,
        } );


        #>
        <# if ( settings.title ) { #>
        <span class="elementor-title">{{{ settings.title }}}</span><#
        } #>
        <div {{{ view.getRenderAttributeString( 'progressWrapper' ) }}}>
        <div class="elementor-progress-bar" data-max="{{ settings.percent.size }}">
            <# if ( 'hide' !== settings.display_percentage ) { #>
            <span class="elementor-progress-percentage">{{{ settings.percent.size }}}%</span>
            <# } #>
        </div>
        </div>
        <?php
    }
}

$widgets_manager->register_widget_type(new OSF_Elementor_Progress());