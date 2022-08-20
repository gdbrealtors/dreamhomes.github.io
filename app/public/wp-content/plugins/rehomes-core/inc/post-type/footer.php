<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class OSF_Custom_Post_Type_Footer
 */
class OSF_Custom_Post_Type_Footer extends OSF_Custom_Post_Type_Abstract
{

    /**
     * @return void
     */
    public function create_post_type()
    {

        $labels = array(
            'name'               => __('Footer', "rehomes-core"),
            'singular_name'      => __('Footer', "rehomes-core"),
            'add_new'            => __('Add New Footer', "rehomes-core"),
            'add_new_item'       => __('Add New Footer', "rehomes-core"),
            'edit_item'          => __('Edit Footer', "rehomes-core"),
            'new_item'           => __('New Footer', "rehomes-core"),
            'view_item'          => __('View Footer', "rehomes-core"),
            'search_items'       => __('Search Footers', "rehomes-core"),
            'not_found'          => __('No Footers found', "rehomes-core"),
            'not_found_in_trash' => __('No Footers found in Trash', "rehomes-core"),
            'parent_item_colon'  => __('Parent Footer:', "rehomes-core"),
            'menu_name'          => __('Footer Builder', "rehomes-core"),
        );

        $args = array(
            'labels'              => $labels,
            'hierarchical'        => true,
            'description'         => __('List Footer', "rehomes-core"),
            'supports'            => array('title', 'editor', 'thumbnail'), //page-attributes, post-formats
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_position'       => 5,
            'menu_icon'           => $this->get_icon(__FILE__),
            'show_in_nav_menus'   => false,
            'publicly_queryable'  => true,
            'exclude_from_search' => true,
            'has_archive'         => true,
            'query_var'           => true,
            'can_export'          => true,
            'rewrite'             => true,
            'capability_type'     => 'post'
        );
        register_post_type('footer', $args);
    }


}

new OSF_Custom_Post_Type_Footer;