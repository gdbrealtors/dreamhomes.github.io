<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class OSF_Custom_Post_Type_Case_Study
 */
class OSF_Custom_Post_Type_Portfolio extends OSF_Custom_Post_Type_Abstract {
    public $post_type = 'osf_portfolio';
    public $taxonomy  = 'osf_portfolio_cat';

    static $instance;

    public static function getInstance() {
        if (!isset(self::$instance) && !(self::$instance instanceof OSF_Custom_Post_Type_Portfolio)) {
            self::$instance = new OSF_Custom_Post_Type_Portfolio();
        }

        return self::$instance;
    }

    public function __construct() {
        parent::__construct();

        add_filter('manage_' . $this->post_type . '_posts_columns', [$this, 'set_edit_columns']);
        add_action('manage_' . $this->post_type . '_posts_custom_column', [$this, 'column'], 10, 2);
        add_action( 'cmb2_admin_init', array($this,'rehomes_register_theme_options_metabox' ));
    }

    public function column($column, $post_id) {
        switch ($column) {
            case 'osf-thumbnail' :
                if (has_post_thumbnail($post_id)) {
                    echo get_the_post_thumbnail($post_id, 'thumbnail');
                }
                break;
        }
    }

    public function set_edit_columns($columns) {
        $newColumns = [];
        foreach ($columns as $key => $title) {
            if ($key === 'title') {
                $newColumns['osf-thumbnail'] = __('Image', 'rehomes-core');
                $newColumns[$key]            = $title;
            } else {
                $newColumns[$key] = $title;
            }
        }
        return $newColumns;
    }

    /**
     * @return void
     */
    public function create_post_type() {

        $labels = array(
            'name'               => __('Projects', 'rehomes-core'),
            'singular_name'      => __('Portfolio', 'rehomes-core'),
            'add_new'            => __('Add New Portfolio', 'rehomes-core'),
            'add_new_item'       => __('Add New Portfolio', 'rehomes-core'),
            'edit_item'          => __('Edit Portfolio', 'rehomes-core'),
            'new_item'           => __('New Portfolio', 'rehomes-core'),
            'view_item'          => __('View Portfolio', 'rehomes-core'),
            'search_items'       => __('Search Portfolios', 'rehomes-core'),
            'not_found'          => __('No Portfolios found', 'rehomes-core'),
            'not_found_in_trash' => __('No Portfolios found in Trash', 'rehomes-core'),
            'parent_item_colon'  => __('Parent Portfolio:', 'rehomes-core'),
            'menu_name'          => __('Portfolios', 'rehomes-core'),
        );

        $labels     = apply_filters('osf_postype_portfolio_labels', $labels);
        $slug_field = osf_get_option('portfolio_settings', 'slug_portfolio', 'portfolio');

        register_post_type($this->post_type,
            array(
                'labels'        => $labels,
                'supports'      => array('title', 'editor', 'excerpt', 'thumbnail'),
                'public'        => true,
                'has_archive'   => true,
                'rewrite'       => array('slug' => $slug_field),
                'menu_position' => 5,
                'categories'    => array(),
                'menu_icon'     => $this->get_icon(__FILE__),
                'taxonomies'    => array('post_tag')
            )
        );
    }

    /**
     * @return void
     */
    public function create_taxonomy() {
        $labels         = array(
            'name'              => __('Categories', 'rehomes-core'),
            'singular_name'     => __('Category', 'rehomes-core'),
            'search_items'      => __('Search Category', 'rehomes-core'),
            'all_items'         => __('All Categories', 'rehomes-core'),
            'parent_item'       => __('Parent Category', 'rehomes-core'),
            'parent_item_colon' => __('Parent Category:', 'rehomes-core'),
            'edit_item'         => __('Edit Category', 'rehomes-core'),
            'update_item'       => __('Update Category', 'rehomes-core'),
            'add_new_item'      => __('Add New Category', 'rehomes-core'),
            'new_item_name'     => __('New Category Name', 'rehomes-core'),
            'menu_name'         => __('Categories', 'rehomes-core'),
        );
        $labels         = apply_filters('osf_postype_portfolio_cat_labels', $labels);
        $slug_cat_field = osf_get_option('portfolio_settings', 'slug_category_portfolio', 'category-portfolio');
        $args           = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'show_in_nav_menus' => true,
            'rewrite'           => array('slug' => $slug_cat_field)
        );
        // Now register the taxonomy
        register_taxonomy($this->taxonomy, array($this->post_type), $args);
    }

    /**
     * @param $classes
     *
     * @return array
     */
    public function body_class($classes) {
        if (is_post_type_archive($this->post_type) || is_tax($this->taxonomy)) {
            $classes[] = 'opal-content-layout-' . get_theme_mod('osf_portfolio_archive_layout', '1c');
        } else if (is_singular($this->post_type)) {
            $classes[] = 'opal-content-layout-' . get_theme_mod('osf_portfolio_single_layout', '1c');
        }
        return $classes;
    }

    /**
     * @param array $arg
     *
     * @return WP_Query
     */
    public function create_query($per_page = -1, $taxonomies = array()) {
        $args = array(
            'post_type'      => $this->post_type,
            'posts_per_page' => $per_page,
            'post_status'    => 'publish',
        );
        if (!empty($taxonomies)) {
            $args ['tax_query'] = array(
                'taxonomy' => $this->taxonomy,
                'field'    => 'slug',
                'terms'    => $taxonomies
            );
        }
        return new WP_Query($args);
    }

    public function create_meta_box() {

        $symbol = !empty(get_option('osf_portfolio_archive')['currency_symbol']) ? get_option('osf_portfolio_archive')['currency_symbol'] : '$';

        $prefix = 'osf_';

        $cmb2 = new_cmb2_box(array(
            'id'           => $prefix . 'portfolio_setting',
            'title'        => __('Portfolio Infomation', 'rehomes-core'),
            'object_types' => array('osf_portfolio'),
        ));

        $cmb2->add_field(array(
            'name' => __('Locations', 'rehomes-core'),
            'id'   => 'osf_portfolio_location',
            'type' => 'text',
        ));

        $cmb2->add_field(array(
            'name' => __('Status', 'rehomes-core'),
            'id'   => 'osf_portfolio_status',
            'type' => 'text',
        ));

        $cmb2->add_field(array(
            'name' => __('Area', 'rehomes-core'),
            'id'   => 'osf_portfolio_area',
            'type' => 'text',
        ));

        $cmb2->add_field(array(
            'name' => __('Type', 'rehomes-core'),
            'id'   => 'osf_portfolio_type',
            'type' => 'text',
        ));

        $cmb2->add_field(array(
            'name' => __('Price Min (' . $symbol . ')', 'rehomes-core'),
            'id'   => 'osf_portfolio_price_min',
            'type' => 'text',
        ));

        $cmb2->add_field(array(
            'name' => __('Price Max (' . $symbol . ')', 'rehomes-core'),
            'id'   => 'osf_portfolio_price_max',
            'type' => 'text',
        ));

        $cmb2->add_field(array(
            'name' => __('Visit Website Url', 'rehomes-core'),
            'id'   => 'osf_portfolio_url_website',
            'type' => 'text_url',
        ));

        $group_field_id = $cmb2->add_field(array(
            'id'      => 'osf_portfolio_repeat_group',
            'type'    => 'group',
            'options' => array(
                'group_title'   => __('Info {#}', 'rehomes-core'), // since version 1.1.4, {#} gets replaced by row number
                'add_button'    => __('Add Another Entry', 'rehomes-core'),
                'remove_button' => __('Remove Entry', 'rehomes-core'),
                'sortable'      => true,

            ),
        ));

        $cmb2->add_group_field($group_field_id, array(
            'name' => __('Entry Title', 'rehomes-core'),
            'id'   => 'title',
            'type' => 'text',
        ));

        $cmb2->add_group_field($group_field_id, array(
            'name' => __('Description', 'rehomes-core'),
            'id'   => 'description',
            'type' => 'text',
        ));

        $cmb2->add_field(array(
            'name'    => __('Overview', 'rehomes-core'),
            'id'      => 'osf_portfolio_overview',
            'type'    => 'wysiwyg',
            'options' => array(),
        ));

        $cmb2->add_field(array(
            'name'         => __('Banner', 'rehomes-core'),
            'desc'         => 'Upload an image or enter an URL.',
            'id'           => 'osf_portfolio_banner',
            'type'         => 'file',
            'query_args'   => array(
                'type' => array(
                    'image/gif',
                    'image/jpeg',
                    'image/png',
                ),
            ),
            'preview_size' => 'large',
        ));

        $cmb2_menu = new_cmb2_box(array(
            'id'           => $prefix . 'portfolio_menu',
            'title'        => __('Portfolio Menu', 'rehomes-core'),
            'object_types' => array('osf_portfolio'),
        ));

        $group_field_id = $cmb2_menu->add_field(array(
            'id'      => 'osf_portfolio_repeat_menu',
            'type'    => 'group',
            'options' => array(
                'group_title'   => __('Menu item {#}', 'rehomes-core'),
                'add_button'    => __('Add another menu item', 'rehomes-core'),
                'remove_button' => __('Remove menu item', 'rehomes-core'),
                'sortable'      => true,

            ),
        ));

        $cmb2_menu->add_group_field($group_field_id, array(
            'name' => __('Menu name', 'rehomes-core'),
            'id'   => 'menu_name',
            'type' => 'text',
        ));

        $cmb2_menu->add_group_field($group_field_id, array(
            'name' => __('Link', 'rehomes-core'),
            'id'   => 'menu_link',
            'type' => 'text',
        ));

    }


    /**
     * @return array|int|WP_Error
     */
    public function get_terms() {
        return get_terms(array($this->taxonomy));
    }

    public function get_term_portfolio($post_id) {
        $terms  = get_the_terms($post_id, $this->taxonomy);
        $output = '';
        if (!is_wp_error($terms) && is_array($terms)) {
            foreach ($terms as $key => $term) {
                $term_link = get_term_link($term);
                if (is_wp_error($term_link)) {
                    continue;
                }
                $output .= '<a href="' . esc_url($term_link) . '">' . $term->name . '</a>';
                if ($key < count($terms) - 1) {
                    $output .= ', ';
                }
            }

        }
        return $output;
    }

    function rehomes_fnc_related_portfolio($relate_count = 3, $posttype = 'osf_portfolio', $taxonomy = 'osf_portfolio_cat') {

        $terms   = get_the_terms(get_the_ID(), $taxonomy);
        $termids = array();

        if ($terms) {
            foreach ($terms as $term) {
                $termids[] = $term->term_id;
            }
        }

        $args = array(
            'post_type'      => $posttype,
            'posts_per_page' => $relate_count,
            'post__not_in'   => array(get_the_ID()),
            'tax_query'      => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => $taxonomy,
                    'field'    => 'id',
                    'terms'    => $termids,
                    'operator' => 'IN'
                )
            )
        );

        $related = new WP_Query($args);

        if ($related->have_posts()) {
            echo '<div class="related-portfolio">';
            echo '<h3 class="related-heading">' . esc_html__('Related Project', 'rehomes-core') . '</h3>';
            echo '<div class="row elementor-portfolio-style-default" data-elementor-columns="3">';
            while ($related->have_posts()) : $related->the_post();
                ?>
                <div class="column-item portfolio-entries">
                    <?php get_template_part('template-parts/portfolio/content'); ?>
                </div>
            <?php
            endwhile;
            echo '</div>';
            echo '</div>';

            wp_reset_postdata();
        }


    }

    /**
     * @param $wp_customize WP_Customize_Manager
     */
    public function customize_register($wp_customize) {

        $wp_customize->add_panel('osf_portfolio', array(
            'title'      => __('Portfolio', 'rehomes-core'),
            'capability' => 'edit_theme_options',
            'priority'   => 1,
        ));

        //Portfolio Archive config
        $wp_customize->add_section('osf_portfolio_archive', array(
            'title'      => __('Archive', 'rehomes-core'),
            'capability' => 'edit_theme_options',
            'panel'      => 'osf_portfolio',
            'priority'   => 1,
        ));

        // =========================================
        // Select Layout
        // =========================================

        $wp_customize->add_control(new OSF_Customize_Control_Image_Select($wp_customize, 'osf_portfolio_archive_layout', array(
            'section' => 'osf_portfolio_archive',
            'label'   => __('Select Layout', 'rehomes-core'),
            'choices' => $this->options,
        )));

        $wp_customize->add_setting('osf_portfolio_archive_column', array(
            'default'           => '3',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control('osf_portfolio_archive_column', array(
            'section' => 'osf_portfolio_archive',
            'label'   => __('Columns', 'rehomes-core'),
            'type'    => 'select',
            'choices' => array(
                '1' => __('1 Column', 'rehomes-core'),
                '2' => __('2 Columns', 'rehomes-core'),
                '3' => __('3 Columns', 'rehomes-core'),
                '4' => __('4 Columns', 'rehomes-core'),
            ),
        ));

        if (class_exists('OSF_Customize_Control_Button_Group')) {
            $wp_customize->add_setting('osf_portfolio_archive_style', array(
                'default'           => 'default',
                'sanitize_callback' => 'sanitize_text_field',
            ));
            $wp_customize->add_control(new OSF_Customize_Control_Button_Group($wp_customize, 'osf_portfolio_archive_style', array(
                'section' => 'osf_portfolio_archive',
                'label'   => __('Select Style', 'rehomes-core'),
                'default' => 'default',
                'choices' => array(
                    'default1' => __('Default', 'rehomes-core'),
                    'overlay'  => __('Overlay', 'rehomes-core'),
                    'caption'  => __('Caption', 'rehomes-core'),
                ),
            )));
        }

    }

    public function get_all_meta_field_value() {
        $result = array(
            'osf_portfolio_status'    => array(),
            'osf_portfolio_location'  => array(),
            'osf_portfolio_type'      => array(),
            'osf_portfolio_price_min' => 0,
            'osf_portfolio_price_max' => 0
        );
        $args   = array(
            'post_type'      => 'osf_portfolio',
            'posts_per_page' => -1,
        );

        $items = new WP_Query($args);

        if ($items->have_posts()) {
            while ($items->have_posts()) : $items->the_post();
                if (get_post_meta(get_the_ID(), 'osf_portfolio_status')) {
                    if (!in_array(get_post_meta(get_the_ID(), 'osf_portfolio_status', true), $result['osf_portfolio_status'])) {
                        array_push($result['osf_portfolio_status'], get_post_meta(get_the_ID(), 'osf_portfolio_status', true));
                    }
                }

                if (get_post_meta(get_the_ID(), 'osf_portfolio_location')) {
                    if (!in_array(get_post_meta(get_the_ID(), 'osf_portfolio_location', true), $result['osf_portfolio_location'])) {
                        array_push($result['osf_portfolio_location'], get_post_meta(get_the_ID(), 'osf_portfolio_location', true));
                    }
                }

                if (get_post_meta(get_the_ID(), 'osf_portfolio_type')) {
                    if (!in_array(get_post_meta(get_the_ID(), 'osf_portfolio_type', true), $result['osf_portfolio_type'])) {
                        array_push($result['osf_portfolio_type'], get_post_meta(get_the_ID(), 'osf_portfolio_type', true));
                    }
                }

                if (get_post_meta(get_the_ID(), 'osf_portfolio_price_max')) {
                    if ((int)$result['osf_portfolio_price_max'] < floatval(get_post_meta(get_the_ID(), 'osf_portfolio_price_max', true))) {
                        $result['osf_portfolio_price_max'] = floatval(get_post_meta(get_the_ID(), 'osf_portfolio_price_max', true));
                    }
                }

            endwhile;
            wp_reset_postdata();
        }
        return $result;
    }

    /**
     * Hook in and register a metabox to handle a theme options page and adds a menu item.
     */
    function rehomes_register_theme_options_metabox() {

        /**
         * Registers options page menu item and form.
         */
        $cmb2 = new_cmb2_box( array(
            'id'           => 'osf_portfolio_archive',
            'title'        => esc_html__( 'Portfolios Setting', 'rehomes-core' ),
            'object_types' => array( 'options-page' ),
            'option_key'      => 'osf_portfolio_archive',
             'position'        => 8,
        ) );

        $cmb2->add_field( array(
            'name' => __( 'Portfolio Currency Symbol', 'rehomes-core' ),
            'id'   => 'currency_symbol',
            'type' => 'text',
            'default' => '$',
        ) );

        $cmb2->add_field( array(
            'name' => __( 'Hide Project Status', 'rehomes-core' ),
            'id'   => 'hide_status',
            'type' => 'checkbox',
        ) );

        $cmb2->add_field( array(
            'name' => __( 'Hide Project Type', 'rehomes-core' ),
            'id'   => 'hide_type',
            'type' => 'checkbox',
        ) );

        $cmb2->add_field( array(
            'name' => __( 'Hide Location', 'rehomes-core' ),
            'id'   => 'hide_location',
            'type' => 'checkbox',
        ) );

        $cmb2->add_field( array(
            'name' => __( 'Hide Budget', 'rehomes-core' ),
            'id'   => 'hide_budget',
            'type' => 'checkbox',
        ) );

        $group_field_id = $cmb2->add_field(array(
            'id'      => 'range',
            'type'    => 'group',
            'options' => array(
                'group_title'   => __('Budget range {#}', 'rehomes-core'),
                'add_button'    => __('Add Another Entry', 'rehomes-core'),
                'remove_button' => __('Remove Entry', 'rehomes-core'),
                'sortable'      => true,

            ),
        ));

        $cmb2->add_group_field($group_field_id, array(
            'name' => __('Min', 'rehomes-core'),
            'id'   => 'min',
            'type' => 'text',
        ));

        $cmb2->add_group_field($group_field_id, array(
            'name' => __('Max', 'rehomes-core'),
            'id'   => 'max',
            'type' => 'text',
        ));

    }

}

OSF_Custom_Post_Type_Portfolio::getInstance();

function set_posts_per_page_for_osf_portfolio($query) {
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('osf_portfolio')) {
        $query->set('posts_per_page', '9');
    }
}

add_action('pre_get_posts', 'set_posts_per_page_for_osf_portfolio');

function osf_override_meta_value($value, $object_id, $args, $field) {
    static $defaults = null;
    global $pagenow;
    // Only set the default if the original value has not been overridden
    if ('cmb2_field_no_override_val' !== $value) {
        return $value;
    }

    $data = 'options-page' === $args['type']
        ? cmb2_options($args['id'])->get($args['field_id'])
        : get_metadata($args['type'], $args['id'], $args['field_id'], ($args['single'] || $args['repeat']));


    $field_id = $args['field_id'];

    // This DOES work
    if ('osf_portfolio_repeat_group' === $field_id) {

        // Get the default values from JSON
        if ($pagenow === 'post-new.php') {
            // Get your JSON blob.. hard-coded for demo.
            $json = '[{"title":"Apartments","description":""},{"title":"Total Towers","description":""},{"title":"Flat Size","description":""}]';

            $defaults = json_decode($json, 1);


            $value = $defaults;


            if (!empty($data)) {
                $value = array();
                // Then loop the defaults and mash the field's value up w/ the default.
                foreach ($defaults as $key => $default_group_val) {
                    $value[$key] = isset($data[$key])
                        ? wp_parse_args($data[$key], $default_group_val)
                        : $default_group_val;
                }
            }
        }
    }

    return $value;
}

add_filter('cmb2_override_meta_value', 'osf_override_meta_value', 10, 4);

function osf_order_post_type_archive_portfolio($query) {
    if (is_admin()) {
        return;
    }
    if ($query->is_main_query() && is_post_type_archive('osf_portfolio')) {
        $args = array(
            'relation' => 'AND',
        );

        if (isset($_GET['osf_portfolio_status']) && $_GET['osf_portfolio_status'] != '') {
            $args[] = array(
                'key'     => 'osf_portfolio_status',
                'value'   => $_GET['osf_portfolio_status'],
                'compare' => '='
            );
        }

        if (isset($_GET['osf_portfolio_location']) && $_GET['osf_portfolio_location'] != '') {
            $args[] = array(
                'key'     => 'osf_portfolio_location',
                'value'   => $_GET['osf_portfolio_location'],
                'compare' => '='
            );
        }

        if (isset($_GET['osf_portfolio_type']) && $_GET['osf_portfolio_type'] != '') {
            $args[] = array(
                'key'     => 'osf_portfolio_type',
                'value'   => $_GET['osf_portfolio_type'],
                'compare' => '='
            );
        }

        if (isset($_GET['osf_portfolio_budget']) && $_GET['osf_portfolio_budget'] != '') {
            if(explode('|', $_GET['osf_portfolio_budget'])[0]) {
                $args[] = array(
                    'key'     => 'osf_portfolio_price_min',
                    'value'   => explode('|', $_GET['osf_portfolio_budget'])[0],
                    'compare' => '>=',
                    'type'    => 'NUMERIC',
                );
            }
        }
        if (isset($_GET['osf_portfolio_budget']) && $_GET['osf_portfolio_budget'] != '') {
            if(explode('|', $_GET['osf_portfolio_budget'])[1]) {
                $args[] = array(
                    'key'     => 'osf_portfolio_price_max',
                    'value'   => explode('|', $_GET['osf_portfolio_budget'])[1],
                    'compare' => '<=',
                    'type'    => 'NUMERIC',
                );
            }
        }

        $query->set('meta_query', $args);

    }
}

add_action('pre_get_posts', 'osf_order_post_type_archive_portfolio');

add_filter('portfolio_query_args', function ($query){

    $args = array(
        'relation' => 'AND',
    );

    if (isset($_GET['osf_portfolio_status']) && $_GET['osf_portfolio_status'] != '') {
        $args[] = array(
            'key'     => 'osf_portfolio_status',
            'value'   => $_GET['osf_portfolio_status'],
            'compare' => '='
        );
    }

    if (isset($_GET['osf_portfolio_location']) && $_GET['osf_portfolio_location'] != '') {
        $args[] = array(
            'key'     => 'osf_portfolio_location',
            'value'   => $_GET['osf_portfolio_location'],
            'compare' => '='
        );
    }

    if (isset($_GET['osf_portfolio_type']) && $_GET['osf_portfolio_type'] != '') {
        $args[] = array(
            'key'     => 'osf_portfolio_type',
            'value'   => $_GET['osf_portfolio_type'],
            'compare' => '='
        );
    }

    if (isset($_GET['osf_portfolio_budget']) && $_GET['osf_portfolio_budget'] != '') {
        if(explode('|', $_GET['osf_portfolio_budget'])[0]) {
            $args[] = array(
                'key'     => 'osf_portfolio_price_min',
                'value'   => explode('|', $_GET['osf_portfolio_budget'])[0],
                'compare' => '>=',
                'type'    => 'NUMERIC',
            );
        }
    }
    if (isset($_GET['osf_portfolio_budget']) && $_GET['osf_portfolio_budget'] != '') {
        if(explode('|', $_GET['osf_portfolio_budget'])[1]) {
            $args[] = array(
                'key'     => 'osf_portfolio_price_max',
                'value'   => explode('|', $_GET['osf_portfolio_budget'])[1],
                'compare' => '<=',
                'type'    => 'NUMERIC',
            );
        }
    }
    $query['meta_query'] = $args;

    return $query;
});

function portfolio_get_option( $key = '', $default = false ) {
    if ( function_exists( 'cmb2_get_option' ) ) {
        // Use cmb2_get_option as it passes through some key filters.
        return cmb2_get_option( 'osf_portfolio_archive', $key, $default );
    }

    // Fallback to get_option if CMB2 is not loaded yet.
    $opts = get_option( 'osf_portfolio_archive', $default );

    $val = $default;

    if ( 'all' == $key ) {
        $val = $opts;
    } elseif ( is_array( $opts ) && array_key_exists( $key, $opts ) && false !== $opts[ $key ] ) {
        $val = $opts[ $key ];
    }

    return $val;
}
