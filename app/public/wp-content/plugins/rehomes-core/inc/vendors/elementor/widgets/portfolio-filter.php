<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Class Rehomes_Elementor_Filter_Project
 */
class Rehomes_Elementor_Filter_Project extends Elementor\Widget_Base {

    public function get_name() {
        return 'rehomes_filter_portfolio';
    }

    public function get_title() {
        return esc_html__('Filter Portfolio', 'rehomes-core');
    }


    public function get_categories() {
        return array('opal-addons');
    }

    protected function register_controls() {

    }


    protected function render() {
        $array = OSF_Custom_Post_Type_Portfolio::getInstance()->get_all_meta_field_value();
        ?>
        <div class="search-project">
            <form action="<?php echo esc_attr(get_post_type_archive_link('osf_portfolio')); ?>" method="get">
                <div class="d-flex justify-content-center project-group">
                    <?php if (!portfolio_get_option('hide_status')): ?>
                        <div class="project-inner">
                            <label><?php echo esc_html__('Project Status', 'rehomes-core'); ?></label>
                            <select name="osf_portfolio_status">
                                <option value=""><?php echo esc_html__('Any', 'rehomes-core'); ?></option>
                                <?php
                                foreach ($array['osf_portfolio_status'] as $item) {
                                    ?>
                                    <option value="<?php echo esc_attr($item); ?>" <?php echo esc_attr(isset($_GET['osf_portfolio_status']) && $item == $_GET['osf_portfolio_status'] ? 'selected' : ''); ?>><?php echo esc_html($item); ?></option>
                                    <?php
                                }

                                ?>
                            </select>
                        </div>
                    <?php endif; ?>
                    <?php if (!portfolio_get_option('hide_type')): ?>
                        <div class="project-inner">
                            <label><?php echo esc_html__('Project Type', 'rehomes-core'); ?></label>
                            <select name="osf_portfolio_type">
                                <option value=""><?php echo esc_html__('Any', 'rehomes-core'); ?></option>
                                <?php
                                foreach ($array['osf_portfolio_type'] as $item) {
                                    ?>
                                    <option value="<?php echo esc_attr($item); ?>" <?php echo esc_attr(isset($_GET['osf_portfolio_type']) && $item == $_GET['osf_portfolio_type'] ? 'selected' : ''); ?>><?php echo esc_html($item); ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    <?php endif; ?>
                    <?php if (!portfolio_get_option('hide_location')): ?>
                        <div class="project-inner">
                            <label><?php echo esc_html__('Location', 'rehomes-core'); ?></label>
                            <select name="osf_portfolio_location">
                                <option value=""><?php echo esc_html__('Any', 'rehomes-core'); ?></option>
                                <?php
                                foreach ($array['osf_portfolio_location'] as $item) {
                                    ?>
                                    <option value="<?php echo esc_attr($item); ?>" <?php echo esc_attr(isset($_GET['osf_portfolio_location']) && $item == $_GET['osf_portfolio_location'] ? 'selected' : ''); ?>><?php echo esc_html($item); ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    <?php endif; ?>
                    <?php if (!portfolio_get_option('hide_budget')): ?>
                        <div class="project-inner">
                            <label><?php echo esc_html__('Budget', 'rehomes-core'); ?></label>
                            <select name="osf_portfolio_budget">
                                <option value=""><?php echo esc_html__('Any', 'rehomes-core'); ?></option>
                                <?php

                                $symbol = !empty(portfolio_get_option('currency_symbol')) ? portfolio_get_option('currency_symbol') : '$';
                                $range  = portfolio_get_option('range');
                                if ($range) {
                                    foreach ($range as $k => $number) {
                                        $min = $number['min'];
                                        $max = $number['max'];
                                        if (!$min && !$max) {
                                            continue;
                                        }
                                        $text_min = $min ? $symbol . $min : '';
                                        $text_min = $max ? $text_min : '> ' . $text_min;
                                        $text_max = $max ? $symbol . $max : '';
                                        $text_max = $min ? $text_max : '< ' . $text_max;

                                        $text_min_max = $text_min && $text_max ? $text_min . ' - ' : $text_min;
                                        $text_min_max = $text_max ? $text_min_max . $text_max : $text_min_max;
                                        ?>
                                        <option value="<?php echo esc_attr($number['min'] . '|' . $number['max']); ?>" <?php echo isset($_GET['osf_portfolio_budget']) && ($number['min'] . '|' . $number['max']) == $_GET['osf_portfolio_budget'] ? 'selected' : ''; ?>><?php echo esc_html($text_min_max); ?></option>
                                        <?php
                                    }
                                } else {
                                    foreach ($arr = range(0, floatval($array['osf_portfolio_price_max']), floatval($array['osf_portfolio_price_max']) / 10) as $k => $number) {
                                        if ($k > 0) {
                                            ?>
                                            <option value="<?php echo esc_attr($arr[$k - 1] . '|' . $number); ?>" <?php echo isset($_GET['osf_portfolio_budget']) && ($arr[$k - 1] . '|' . $number) == $_GET['osf_portfolio_budget'] ? 'selected' : ''; ?>><?php echo esc_html($symbol . $arr[$k - 1] . ' - ' . $symbol . $number); ?></option>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    <?php endif; ?>
                    <div class="project-inner align-self-end">
                        <button type="submit" class="btn btn-primary btn-block">
                            <?php echo esc_html__('Search', 'rehomes-core'); ?>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <?php
    }

}

$widgets_manager->register_widget_type(new Rehomes_Elementor_Filter_Project());
