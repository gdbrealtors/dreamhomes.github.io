<?php

namespace Elementor;
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

class OSF_Elementor_Chart extends Widget_Base
{

    public function get_name()
    {
        return 'opal-chart';
    }

    public function get_title()
    {
        return __('Opal Chart', 'rehomes-core');
    }

    public function get_categories()
    {
        return array('opal-addons');
    }

//    public function get_icon() {
//        return 'eicon-chart';
//    }

    public function get_script_depends()
    {
        return [
            'chart'
        ];
    }


    protected function register_controls()
    {
        $this->start_controls_section(
            'section_general',
            [
                'label' => __('General', 'rehomes-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'type',
            [
                'label' => __('Type', 'rehomes-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'doughnut',
                'options' => [
                    'doughnut' => __('Doughnut', 'rehomes-core'),
                    'pie' => __('Pie', 'rehomes-core'),
                ],
                'prefix_class' => 'elementor-chart-view-',
                'separator' => 'before',
                'frontend_available' => true,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'name',
            [
                'label' => __('Name', 'rehomes-core'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __('Chart Name', 'rehomes-core'),
                'default' => __('Chart Name', 'rehomes-core'),
            ]
        );
        $repeater->add_control(
            'number',
            [
                'label' => __('Nunber', 'rehomes-core'),
                'type' => Controls_Manager::NUMBER,
                'label_block' => true,
                'default' => '20',
            ]
        );
        $repeater->add_control(
            'color',
            [
                'label' => __('Color', 'rehomes-core'),
                'type' => Controls_Manager::COLOR,
                'label_block' => true,
                'default' => '#1f9a47',
            ]
        );
        $this->add_control(
            'chart_list',
            [
                'label' => 'Chart list',
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'name' => __('Fundrasing', 'rehomes-core'),
                        'number' => '40',
                        'color' => '#1f9a47',
                    ],
                    [
                        'name' => __('Research and Advoccy', 'rehomes-core'),
                        'number' => '25',
                        'color' => '#37b560',
                    ],
                    [
                        'name' => __('Operations ', 'rehomes-core'),
                        'number' => '15',
                        'color' => '#68d89d',
                    ],
                    [
                        'name' => __('Education & Prevention', 'rehomes-core'),
                        'number' => '10',
                        'color' => '#6bdbc5',
                    ],
                    [
                        'name' => __('Reserve', 'rehomes-core'),
                        'number' => '5',
                        'color' => '#8de8dc',
                    ],
                    [
                        'name' => __('Smart MFG Tech', 'rehomes-core'),
                        'number' => '5',
                        'color' => '#aefff1',
                    ],
                ],
                'title_field' => '<i class="fa fa-dot-circle-o" aria-hidden="true" style="color:{{{color}}}"></i> {{{ name }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_canvas',
            [
                'label' => __('Canvas', 'rehomes-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'width_canvas',
            [
                'label' => __('Canvas Size', 'rehomes-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 500,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .chart-canvas' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'legend_indent',
            [
                'label' => __('Legend Indent', 'rehomes-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .chart-legend' => is_rtl() ? 'padding-right {{SIZE}}{{UNIT}};' : 'padding-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_icon',
            [
                'label' => __('icon', 'rehomes-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __('Size', 'rehomes-core'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 30,
                ],
                'range' => [
                    'px' => [
                        'min' => 6,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_name',
            [
                'label' => __('Name', 'rehomes-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'name_color',
            [
                'label' => __('Name Color', 'rehomes-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .chart-name' => 'color: {{VALUE}};',
                ],
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_TEXT,
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'name_typography',
                'selector' => '{{WRAPPER}} .chart-name',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_TEXT,
                ],
            ]
        );
        $this->add_control(
            'name_indent',
            [
                'label' => __('Name Indent', 'rehomes-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .chart-name' => is_rtl() ? 'padding-right: {{SIZE}}{{UNIT}};' : 'padding-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_number',
            [
                'label' => __('Number', 'rehomes-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'number_color',
            [
                'label' => __('Number Color', 'rehomes-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .chart-number' => 'color: {{VALUE}};',
                ],
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_TEXT,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'number_typography',
                'selector' => '{{WRAPPER}} .chart-number',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_TEXT,
                ],
            ]
        );

        $this->end_controls_section();
    }

    public function set_render_attribute($element, $key = null, $value = null)
    {
        return $this->add_render_attribute($element, $key, $value, true);
    }

    protected function render()
    {

        $settings = $this->get_settings_for_display();
        $total = 0;
        $chart_settings = [];
        $chart_settings['type'][] = $settings['type'];
        foreach ($settings['chart_list'] as $item) {
            $chart_settings['name'][] = $item['name'];
            $chart_settings['color'][] = $item['color'];
            $chart_settings['number'][] = $item['number'];
            $total += $item['number'];
        }
        $this->add_render_attribute('canvas', 'data-settings', wp_json_encode($chart_settings));
        ?>
        <div class="elementor-chart-wrapper d-flex align-items-center">
            <div class="chart-canvas">
                <canvas width="500px" height="500px"
                        class="chart-area"<?php echo $this->get_render_attribute_string('canvas') ?>></canvas>
            </div>

            <div class="chart-legend">
                <ul <?php echo $this->get_render_attribute_string('chart_list'); ?>>
                    <?php
                    foreach ($settings['chart_list'] as $index => $item) :
                        ?>
                        <li class="elementor-chart-list-item">
                            <i class="fa fa-circle" aria-hidden="true"
                               style="color: <?php echo esc_attr($item['color']) ?>"></i>
                            <span class="chart-name"><?php echo $item['name']; ?> - </span>
                            <span class="chart-number"><?php echo $this->check($total, $item['number']) ?>
                                &percnt;</span>
                        </li>
                    <?php
                    endforeach;
                    ?>

                </ul>
            </div>
        </div>

        <?php
    }

    private function check($total, $number)
    {
        return ceil($number / $total * 100);
    }


}

$widgets_manager->register_widget_type(new OSF_Elementor_Chart());