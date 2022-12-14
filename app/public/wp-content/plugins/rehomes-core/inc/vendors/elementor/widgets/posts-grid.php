<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;

/**
 * Class OSF_Elementor_Blog
 */
class OSF_Elementor_Post_Grid extends OSF_Elementor_Carousel_Base
{

    public function get_name()
    {
        return 'opal-post-grid';
    }

    public function get_title()
    {
        return __('Opal Posts Grid', 'rehomes-core');
    }

    /**
     * Get widget icon.
     *
     * Retrieve testimonial widget icon.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-posts-grid';
    }

    public function get_categories()
    {
        return array('opal-addons');
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_query',
            [
                'label' => __('Query', 'rehomes-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => __('Posts Per Page', 'rehomes-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );


        $this->add_control(
            'advanced',
            [
                'label' => __('Advanced', 'rehomes-core'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => __('Order By', 'rehomes-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'post_date',
                'options' => [
                    'post_date' => __('Date', 'rehomes-core'),
                    'post_title' => __('Title', 'rehomes-core'),
                    'menu_order' => __('Menu Order', 'rehomes-core'),
                    'rand' => __('Random', 'rehomes-core'),
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => __('Order', 'rehomes-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'asc' => __('ASC', 'rehomes-core'),
                    'desc' => __('DESC', 'rehomes-core'),
                ],
            ]
        );

        $this->add_control(
            'categories',
            [
                'label' => __('Categories', 'rehomes-core'),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->get_post_categories(),
                'multiple' => true,
            ]
        );

        $this->add_control(
            'cat_operator',
            [
                'label' => __('Category Operator', 'rehomes-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'IN',
                'options' => [
                    'AND' => __('AND', 'rehomes-core'),
                    'IN' => __('IN', 'rehomes-core'),
                    'NOT IN' => __('NOT IN', 'rehomes-core'),
                ],
                'condition' => [
                    'categories!' => ''
                ],
            ]
        );

        $this->add_control(
            'layout',
            [
                'label' => __('Layout', 'rehomes-core'),
                'type' => Controls_Manager::HEADING,
            ]
        );


        $this->add_responsive_control(
            'column',
            [
                'label' => __('Columns', 'rehomes-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 3,
                'options' => [1 => 1, 2 => 2, 3 => 3, 4 => 4, 6 => 6],
//                'conditions' => [
//                    'relation' => 'or',
//                    'terms' => [
//                        [
//                            'name' => 'style',
//                            'operator' => '==',
//                            'value' => 'post-style-1',
//                        ],
//                        [
//                            'name' => 'style',
//                            'operator' => '==',
//                            'value' => 'post-style-2',
//                        ],
//                        [
//                            'name' => 'style',
//                            'operator' => '==',
//                            'value' => 'post-style-3',
//                        ],
//                    ],
//                ],
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => __('Style', 'rehomes-core'),
                'default'   => 'post-style-1',
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $this->get_template_post_type(),
            ]
        );

        $this->add_control(
            'activate',
            [
                'label' => __('activate', 'rehomes-core'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'prefix_class' => 'elementor-activate-',
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'style',
                            'operator' => '==',
                            'value' => 'post-style-5',
                        ],
                    ],
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_pagination',
            [
                'label' => __('Pagination', 'rehomes-core'),
                'condition' => [
                    'enable_carousel!' => 'yes'
                ],
            ]

        );

        $this->add_control(
            'pagination_type',
            [
                'label' => __('Pagination', 'rehomes-core'),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => __('None', 'rehomes-core'),
                    'numbers' => __('Numbers', 'rehomes-core'),
                    'prev_next' => __('Previous/Next', 'rehomes-core'),
                    'numbers_and_prev_next' => __('Numbers', 'rehomes-core') . ' + ' . __('Previous/Next', 'rehomes-core'),
                ],
            ]
        );

        $this->add_control(
            'pagination_page_limit',
            [
                'label' => __('Page Limit', 'rehomes-core'),
                'default' => '5',
                'condition' => [
                    'pagination_type!' => '',
                ],
            ]
        );

        $this->add_control(
            'pagination_numbers_shorten',
            [
                'label' => __('Shorten', 'rehomes-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'condition' => [
                    'pagination_type' => [
                        'numbers',
                        'numbers_and_prev_next',
                    ],
                ],
            ]
        );

        $this->add_control(
            'pagination_prev_label',
            [
                'label' => __('Previous Label', 'rehomes-core'),
                'default' => __('&laquo; Previous', 'rehomes-core'),
                'condition' => [
                    'pagination_type' => [
                        'prev_next',
                        'numbers_and_prev_next',
                    ],
                ],
            ]
        );

        $this->add_control(
            'pagination_next_label',
            [
                'label' => __('Next Label', 'rehomes-core'),
                'default' => __('Next &raquo;', 'rehomes-core'),
                'condition' => [
                    'pagination_type' => [
                        'prev_next',
                        'numbers_and_prev_next',
                    ],
                ],
            ]
        );

        $this->add_control(
            'pagination_align',
            [
                'label' => __('Alignment', 'rehomes-core'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'rehomes-core'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'rehomes-core'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'rehomes-core'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .elementor-pagination' => 'text-align: {{VALUE}};',
                ],
                'condition' => [
                    'pagination_type!' => '',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function get_post_categories()
    {
        $categories = get_terms(array(
                'taxonomy' => 'category',
                'hide_empty' => false,
            )
        );
        $results = array();
        if (!is_wp_error($categories)) {
            foreach ($categories as $category) {
                $results[$category->slug] = $category->name;
            }
        }
        return $results;
    }


    public static function get_query_args($settings)
    {
        $query_args = [
            'post_type' => 'post',
            'orderby' => $settings['orderby'],
            'order' => $settings['order'],
            'ignore_sticky_posts' => 1,
            'post_status' => 'publish', // Hide drafts/private posts for admins
        ];

        if (!empty($settings['categories'])) {
            $categories = array();
            foreach ($settings['categories'] as $category) {
                $cat = get_term_by('slug', $category, 'category');
                if (!is_wp_error($cat) && is_object($cat)) {
                    $categories[] = $cat->term_id;
                }
            }

            if ($settings['cat_operator'] == 'AND') {
                $query_args['category__and'] = $categories;
            } elseif ($settings['cat_operator'] == 'IN') {
                $query_args['category__in'] = $categories;
            } else {
                $query_args['category__not_in'] = $categories;
            }
        }

        $query_args['posts_per_page'] = $settings['posts_per_page'];

        if (is_front_page()) {
            $query_args['paged'] = (get_query_var('page')) ? get_query_var('page') : 1;
        } else {
            $query_args['paged'] = (get_query_var('paged')) ? get_query_var('paged') : 1;
        }

        return $query_args;
    }

    public function get_current_page()
    {
        if ('' === $this->get_settings('pagination_type')) {
            return 1;
        }

        return max(1, get_query_var('paged'), get_query_var('page'));
    }

    public function get_posts_nav_link($page_limit = null)
    {
        if (!$page_limit) {
            $page_limit = $this->query_posts()->max_num_pages;
        }

        $return = [];

        $paged = $this->get_current_page();

        $link_template = '<a class="page-numbers %s" href="%s">%s</a>';
        $disabled_template = '<span class="page-numbers %s">%s</span>';

        if ($paged > 1) {
            $next_page = intval($paged) - 1;
            if ($next_page < 1) {
                $next_page = 1;
            }

            $return['prev'] = sprintf($link_template, 'prev', get_pagenum_link($next_page), $this->get_settings('pagination_prev_label'));
        } else {
            $return['prev'] = sprintf($disabled_template, 'prev', $this->get_settings('pagination_prev_label'));
        }

        $next_page = intval($paged) + 1;

        if ($next_page <= $page_limit) {
            $return['next'] = sprintf($link_template, 'next', get_pagenum_link($next_page), $this->get_settings('pagination_next_label'));
        } else {
            $return['next'] = sprintf($disabled_template, 'next', $this->get_settings('pagination_next_label'));
        }

        return $return;
    }

    protected function render_loop_footer()
    {

        $parent_settings = $this->get_settings();
        if ('' === $parent_settings['pagination_type']) {
            return;
        }

        $page_limit = $this->query_posts()->max_num_pages;
        if ('' !== $parent_settings['pagination_page_limit']) {
            $page_limit = min($parent_settings['pagination_page_limit'], $page_limit);
        }

        if (2 > $page_limit) {
            return;
        }

        $this->add_render_attribute('pagination', 'class', 'elementor-pagination');

        $has_numbers = in_array($parent_settings['pagination_type'], ['numbers', 'numbers_and_prev_next']);
        $has_prev_next = in_array($parent_settings['pagination_type'], ['prev_next', 'numbers_and_prev_next']);

        $links = [];

        if ($has_numbers) {
            $links = paginate_links([
                'type' => 'array',
                'current' => $this->get_current_page(),
                'total' => $page_limit,
                'prev_next' => false,
                'show_all' => 'yes' !== $parent_settings['pagination_numbers_shorten'],
                'before_page_number' => '<span class="elementor-screen-only">' . __('Page', 'rehomes-core') . '</span>',
            ]);
        }

        if ($has_prev_next) {
            $prev_next = $this->get_posts_nav_link($page_limit);
            array_unshift($links, $prev_next['prev']);
            $links[] = $prev_next['next'];
        }

        ?>
        <div class="pagination">
            <nav class="elementor-pagination" role="navigation"
                 aria-label="<?php esc_attr_e('Pagination', 'rehomes-core'); ?>">
                <?php echo implode(PHP_EOL, $links); ?>
            </nav>
        </div>
        <?php
    }


    public function query_posts()
    {
        $query_args = $this->get_query_args($this->get_settings());
        return new WP_Query($query_args);
    }


    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $query = $this->query_posts();

        if (!$query->found_posts) {
            return;
        }

        $this->add_render_attribute('wrapper', 'class', 'elementor-post-wrapper');
        $this->add_render_attribute('wrapper', 'class', $settings['style']);

        $this->add_render_attribute('row', 'class', 'row');

        if (!empty($settings['column'])) {
            $this->add_render_attribute('row', 'data-elementor-columns', $settings['column']);
        } else {
            $this->add_render_attribute('row', 'data-elementor-columns', 1);
        }

        if (!empty($settings['column_tablet'])) {
            $this->add_render_attribute('row', 'data-elementor-columns-tablet', $settings['column_tablet']);
        } else {
            $this->add_render_attribute('row', 'data-elementor-columns-tablet', 1);
        }

        if (!empty($settings['column_mobile'])) {
            $this->add_render_attribute('row', 'data-elementor-columns-mobile', $settings['column_mobile']);
        } else {
            $this->add_render_attribute('row', 'data-elementor-columns-mobile', 1);
        }
        ?>
        <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
            <div <?php echo $this->get_render_attribute_string('row') ?>>

                <?php
                while ($query->have_posts()) {
                    $query->the_post();
                    get_template_part('template-parts/posts-grid/item', $settings['style']);
                }

                ?>
            </div>

            <?php if ($settings['pagination_type'] && !empty($settings['pagination_type'])): ?>
                <div class="pagination">
                    <?php $this->render_loop_footer(); ?>
                </div>
            <?php endif; ?>
        </div>
        <?php

        wp_reset_postdata();

    }

    private function get_template_post_type()
    {
        $folderes = glob(get_template_directory() . '/template-parts/posts-grid/*');

        $output = array();

        foreach ($folderes as $folder) {
            $folder = str_replace("item-", '', str_replace('.php', '', wp_basename($folder)));
            $value = str_replace('_', ' ', str_replace('-', ' ', ucfirst($folder)));
            $output[$folder] = $value;
        }

        return $output;
    }

}

$widgets_manager->register_widget_type(new OSF_Elementor_Post_Grid());