<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
if (!class_exists('FlexMLS_IDX')) {
    return;
}

class OSF_Elementor_Idx_Search extends Elementor\Widget_Base {

    public function get_name() {
        return 'opal-idx-search';
    }

    public function get_title() {
        return __('Opal IDX Seach', 'rehomes-core');
    }

    public function get_categories() {
        return array('opal-addons');
    }

    public function get_icon() {
        return 'eicon-form-horizontal';
    }


    protected function register_controls() {
        $this->start_controls_section(
            'idx_search',
            [
                'label' => __('General', 'rehomes-core'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label'   => __('Title', 'rehomes-core'),
                'type'    => Controls_Manager::TEXT,
                'default' => __('MLS Property Search', 'rehomes-core'),
            ]
        );

        $this->add_control(
            'idx_link',
            [
                'label'   => __('IDX Link', 'rehomes-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => $this->get_all_idx_links_id()
            ]
        );

        $this->add_control(
            'buttontext',
            [
                'label'   => __('Submit Button Text', 'rehomes-core'),
                'type'    => Controls_Manager::TEXT,
                'default' => __('Let it Search', 'rehomes-core'),
            ]
        );

        $this->add_control(
            'detailed_search',
            [
                'label'   => __('Detailed Search', 'rehomes-core'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'destination',
            [
                'label'   => __('Send users to', 'rehomes-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => flexmlsConnect::possible_destinations()
            ]
        );

        $this->add_control(
            'hr_sort',
            [
                'label'     => __('Sorting', 'rehomes-core'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'user_sorting',
            [
                'label'   => __('User Sorting', 'rehomes-core'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => '',
            ]
        );

        $this->add_control(
            'hr_filters',
            [
                'label'     => __('Filters', 'rehomes-core'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'location_search',
            [
                'label'   => __('Location Search', 'rehomes-core'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'property_type_enabled',
            [
                'label'   => __('Property Type', 'rehomes-core'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        global $fmc_api;

        $this->add_control(
            'property_type',
            [
                'label'     => __('Property Types', 'rehomes-core'),
                'type'      => Controls_Manager::SELECT2,
                'multiple'  => true,
                'options'   => $fmc_api->GetPropertyTypes(),
                'condition' => [
                    'property_type_enabled' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'std_fields',
            [
                'label'    => __('Fields', 'rehomes-core'),
                'type'     => Controls_Manager::SELECT2,
                'multiple' => true,
                'options'  => array(
                    "age"            => "Year Built",
                    "baths"          => "Bathrooms",
                    "beds"           => "Bedrooms",
                    "square_footage" => "Square Footage",
                    "list_price"     => "Price"
                ),
            ]
        );

        $this->add_control(
            'default_view',
            [
                'label'   => __('Default view', 'rehomes-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => array(
                    "list" => "List view",
                    "map"  => "Map view",
                ),
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => __('Title', 'rehomes-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography_title',
                'selector' => '{{WRAPPER}} .flexmls_connect__search form .flexmls_connect__search_new_title',
            ]
        );

        $this->add_control(
            'color_title',
            [
                'label'     => __( 'Color', 'rehomes-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .flexmls_connect__search form .flexmls_connect__search_new_title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_button',
            [
                'label' => __('Button', 'rehomes-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography_button',
                'selector' => '{{WRAPPER}} input[type=submit].flexmls_connect__search_new_submit',
            ]
        );

        $this->add_control(
            'color_button',
            [
                'label'     => __( 'Color', 'rehomes-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} input[type=submit].flexmls_connect__search_new_submit' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background_button',
            [
                'label'     => __( 'Background Color', 'rehomes-core' ),
                'type'      => Controls_Manager::COLOR,
                'default' => '#bda588',
                'selectors' => [
                    '{{WRAPPER}} input[type=submit].flexmls_connect__search_new_submit' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function get_all_idx_links_id() {
        $obj   = flexmlsConnect::get_all_idx_links();
        $resul = array();
        foreach ($obj as $value) {
            $k         = $value['LinkId'];
            $resul[$k] = $value['Name'];
        }
        return $resul;

    }

    protected function render() {
        $settings                      = $this->get_settings_for_display();
        $args['title']                 = $settings['title'];
        $args['link']                  = $settings['idx_link'];
        $args['buttontext']            = $settings['buttontext'];
        $args['detailed_search']       = $settings['detailed_search'] == 'yes' ? 'on' : 'off';
        $args['destination']           = $settings['destination'];
        $args['user_sorting']          = $settings['user_sorting'] == 'yes' ? 'on' : 'off';
        $args['location_search']       = $settings['location_search'] == 'yes' ? 'on' : 'off';
        $args['property_type_enabled'] = $settings['property_type_enabled'] == 'yes' ? 'on' : 'off';
        $args['property_type']         = implode(',', $settings['property_type']);
        $args['std_fields']            = implode(',', $settings['std_fields']);
        $args['default_view']          = $settings['default_view'];
        $args['width']                 = '1920';
        $args['orientation']           = "vertical";
        $args['submit_button_shine']   = "none";
        $args['submit_button_background']   =  $settings['background_button'];

        echo osf_do_shortcode('idx_search', $args);
    }
}

$widgets_manager->register_widget_type(new OSF_Elementor_Idx_Search());