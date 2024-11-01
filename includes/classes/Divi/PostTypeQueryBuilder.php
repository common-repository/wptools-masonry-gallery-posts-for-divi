<?php

namespace WPT\Masonry\Divi;

/**
 * PostTypeQueryBuilder.
 */
class PostTypeQueryBuilder
{
    protected  $container ;
    public  $props ;
    public  $query ;
    /**
     * Constructor.
     */
    public function __construct( $container )
    {
        $this->container = $container;
    }
    
    public function get_fields(
        $name,
        $label,
        $tab_slug,
        $toggle_slug,
        $description = '',
        $default = array()
    )
    {
        $default = $this->setup_args( $default );
        $fields = [];
        $fields[$name] = [
            'label'       => esc_html__( 'Post Type', 'et_builder' ),
            'type'        => 'wpdt_masonry_post_type_query_builder',
            'options'     => [
            '' => '-- Select Post Type --',
        ] + $this->get_all_post_types(),
            'tab_slug'    => $tab_slug,
            'toggle_slug' => $toggle_slug,
            'description' => esc_html__( $description, 'et_builder' ),
            'show_if'     => [],
            'default'     => base64_encode( json_encode( $default ) ),
        ];
        return $fields;
    }
    
    /**
     * Get the posts.
     */
    public function get_posts( $name, $module, $props )
    {
        // phpcs:ignore
        $prop_values = json_decode( base64_decode( $module->props[$name] ), true );
        $this->props = $prop_values;
        $show_pagination = $this->container['divi']->get_prop_value( $module, 'show_pagination' );
        $prop_values = $this->setup_args( $prop_values );
        
        if ( isset( $prop_values['post_type'] ) && $prop_values['post_type'] ) {
            $args = [
                'post_type'      => $prop_values['post_type'],
                'post_status'    => $prop_values['post_status'],
                'orderby'        => 'date',
                'order'          => 'ASC',
                'posts_per_page' => 6,
            ];
            $query = new \WP_Query();
            $posts = $query->query( $args );
            $this->query = $query;
            return $posts;
        }
        
        return [];
    }
    
    public function setup_args( $args )
    {
        $args = shortcode_atts( $this->get_defaults(), $args );
        $args['post_statuses'] = get_post_statuses();
        return $args;
    }
    
    /**
     * Get defaults for the field.
     */
    public function get_defaults()
    {
        return [
            'post_type'           => '',
            'orderby'             => 'date',
            'order'               => 'ASC',
            'filter_by'           => 'none',
            'categories'          => [],
            'category_taxonomies' => [],
            'selected_categories' => [],
            'post_tags'           => [],
            'selected_tags'       => [],
            'post_status'         => [ 'publish' ],
            'post__in'            => '',
            'post__not_in'        => '',
            'posts_per_page'      => [
            'min'   => -1,
            'max'   => 500,
            'step'  => 1,
            'value' => 12,
        ],
        ];
    }
    
    /**
     * Initialize the REST API
     */
    public function rest_api_init()
    {
        register_rest_route( 'wpt-masonry-post-type-query-builder/v1', '/get_categories_by_rest_api', [
            'methods'             => 'GET',
            'callback'            => [ $this, 'get_categories_by_rest_api' ],
            'permission_callback' => function () {
            return current_user_can( 'manage_options' );
        },
        ] );
        register_rest_route( 'wpt-masonry-post-type-query-builder/v1', '/get_tags_by_rest_api', [
            'methods'             => 'GET',
            'callback'            => [ $this, 'get_tags_by_rest_api' ],
            'permission_callback' => function () {
            return current_user_can( 'manage_options' );
        },
        ] );
    }
    
    /**
     * Get the categories for a post type via rest api
     */
    public function get_categories_by_rest_api( $request )
    {
        if ( !$request->has_param( 'post_type' ) && $request->get_param( 'post_type' ) ) {
            return [
                'success' => false,
            ];
        }
        $categories = [];
        $post_type = $request->get_param( 'post_type' );
        $taxonomies = get_object_taxonomies( $post_type );
        if ( !$taxonomies ) {
            $taxonomies = [];
        }
        foreach ( $taxonomies as $i => $taxonomy ) {
            if ( in_array( $taxonomy, [ $post_type . '_format', $post_type . '_tag' ] ) ) {
                unset( $taxonomies[$i] );
            }
        }
        
        if ( !empty($taxonomies) ) {
            $terms = get_terms( [
                'taxonomy'   => $taxonomies,
                'hide_empty' => false,
            ] );
            foreach ( $terms as $term ) {
                $categories[$term->term_id] = $term;
            }
        }
        
        return [
            'success'    => true,
            'categories' => $categories,
        ];
    }
    
    /**
     * Get the tags for a post type via rest api
     */
    public function get_tags_by_rest_api( $request )
    {
        if ( !$request->has_param( 'post_type' ) && $request->get_param( 'post_type' ) ) {
            return [
                'success' => false,
            ];
        }
        $tags = [];
        $post_type = $request->get_param( 'post_type' );
        $taxonomies = get_object_taxonomies( $post_type );
        if ( !$taxonomies ) {
            $taxonomies = [];
        }
        if ( !in_array( $post_type . '_tag', $taxonomies ) ) {
            return [];
        }
        $terms = get_terms( [
            'taxonomy'   => $post_type . '_tag',
            'hide_empty' => false,
        ] );
        foreach ( $terms as $term ) {
            $tags[$term->term_id] = $term->name;
        }
        return [
            'success'   => true,
            'post_tags' => $tags,
        ];
    }
    
    /**
     * Get the available post type definitions.
     */
    public function get_all_post_types()
    {
        // et_builder_get_public_post_types() use this.
        $post_types = [];
        $all_post_types = get_post_types( [], 'objects' );
        if ( !empty($all_post_types) ) {
            $post_types = array_merge( $post_types, $all_post_types );
        }
        $response = [];
        foreach ( $post_types as $post_type ) {
            $response[$post_type->name] = $post_type->label;
        }
        return $response;
    }

}