<?php

if (!function_exists('wpt_attachment_cat_init')) {
/**
 * Registers the `wpt_attachment_cat` taxonomy,
 * for use with 'attachment'.
 */
    function wpt_attachment_cat_init()
    {
        register_taxonomy('wpt-attachment-cat', ['attachment'], [
            'hierarchical'          => false,
            'public'                => false,
            'show_in_nav_menus'     => true,
            'show_ui'               => true,
            'show_admin_column'     => true,
            'query_var'             => true,
            'rewrite'               => true,
            'capabilities'          => [
                'manage_terms' => 'edit_posts',
                'edit_terms'   => 'edit_posts',
                'delete_terms' => 'edit_posts',
                'assign_terms' => 'edit_posts',
            ],
            'labels'                => [
                'name'                       => __('Categories', 'masonry-gallery-and-posts-for-divi'),
                'singular_name'              => _x('Category', 'taxonomy general name', 'masonry-gallery-and-posts-for-divi'),
                'search_items'               => __('Search Categories', 'masonry-gallery-and-posts-for-divi'),
                'popular_items'              => __('Popular Categories', 'masonry-gallery-and-posts-for-divi'),
                'all_items'                  => __('All Categories', 'masonry-gallery-and-posts-for-divi'),
                'parent_item'                => __('Parent Category', 'masonry-gallery-and-posts-for-divi'),
                'parent_item_colon'          => __('Parent Category:', 'masonry-gallery-and-posts-for-divi'),
                'edit_item'                  => __('Edit Category', 'masonry-gallery-and-posts-for-divi'),
                'update_item'                => __('Update Category', 'masonry-gallery-and-posts-for-divi'),
                'view_item'                  => __('View Category', 'masonry-gallery-and-posts-for-divi'),
                'add_new_item'               => __('Add New Category', 'masonry-gallery-and-posts-for-divi'),
                'new_item_name'              => __('New Category', 'masonry-gallery-and-posts-for-divi'),
                'separate_items_with_commas' => __('Separate Categories with commas', 'masonry-gallery-and-posts-for-divi'),
                'add_or_remove_items'        => __('Add or remove Categories', 'masonry-gallery-and-posts-for-divi'),
                'choose_from_most_used'      => __('Choose from the most used Categories', 'masonry-gallery-and-posts-for-divi'),
                'not_found'                  => __('No Categories found.', 'masonry-gallery-and-posts-for-divi'),
                'no_terms'                   => __('No Categories', 'masonry-gallery-and-posts-for-divi'),
                'menu_name'                  => __('Categories', 'masonry-gallery-and-posts-for-divi'),
                'items_list_navigation'      => __('Categories list navigation', 'masonry-gallery-and-posts-for-divi'),
                'items_list'                 => __('Categories list', 'masonry-gallery-and-posts-for-divi'),
                'most_used'                  => _x('Most Used', 'wpt-attachment-cat', 'masonry-gallery-and-posts-for-divi'),
                'back_to_items'              => __('&larr; Back to Categories', 'masonry-gallery-and-posts-for-divi'),
            ],
            'show_in_rest'          => true,
            'rest_base'             => 'wpt-attachment-cat',
            'rest_controller_class' => 'WP_REST_Terms_Controller',
        ]);

    }
}

add_action('init', 'wpt_attachment_cat_init');

if (!function_exists('wpt_attachment_cat_updated_messages')) {
/**
 * Sets the post updated messages for the `wpt_attachment_cat` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `wpt_attachment_cat` taxonomy.
 */
    function wpt_attachment_cat_updated_messages($messages)
    {

        $messages['wpt-attachment-cat'] = [
            0 => '', // Unused. Messages start at index 1.
            1 => __('Category added.', 'masonry-gallery-and-posts-for-divi'),
            2 => __('Category deleted.', 'masonry-gallery-and-posts-for-divi'),
            3 => __('Category updated.', 'masonry-gallery-and-posts-for-divi'),
            4 => __('Category not added.', 'masonry-gallery-and-posts-for-divi'),
            5 => __('Category not updated.', 'masonry-gallery-and-posts-for-divi'),
            6 => __('Categories deleted.', 'masonry-gallery-and-posts-for-divi'),
        ];

        return $messages;
    }

}

add_filter('term_updated_messages', 'wpt_attachment_cat_updated_messages');
