<?php

if ( empty($posts) ) {
    ?>
<div>
    <h3 class='no-post-error-heading'><?php 
    echo  esc_html( $props['no_posts_error_heading'] ) ;
    ?></h3>
    <p class='no-post-error-body'><?php 
    echo  esc_html( $props['no_posts_error_body'] ) ;
    ?></p>
</div>
<?php 
} else {
    ?>

<div class="<?php 
    echo  esc_attr( implode( ' ', $classes ) ) ;
    ?>" data-class='<?php 
    echo  esc_attr( $module_class ) ;
    ?>' data-options='<?php 
    echo  wp_json_encode( $masonry_js_options ) ;
    ?>'>
	<div class="masonry-grid-sizer"></div>

	<?php 
    foreach ( $posts as $post_item ) {
        ?>

<?php 
        $item_overlay = '';
        $overlay_icon_html = '';
        
        if ( $props['show_grid_item_overlay_on_hover'] == 'on' ) {
            $overlay_icon_html = '';
            if ( $props['grid_item_hover_icon'] ) {
                $overlay_icon_html = sprintf( '<span class="et-pb-icon">%s</span>', esc_attr( et_pb_process_font_icon( $props['grid_item_hover_icon'] ) ) );
            }
            $item_overlay = $multi_view->render_element( [
                'tag'     => 'a',
                'attrs'   => [
                'class'  => 'masonry-item-overlay',
                'href'   => get_the_permalink( $post_item ),
                'target' => $open_link_in,
            ],
                'content' => $overlay_icon_html,
            ] );
        }
        
        $attachment_id = get_post_thumbnail_id( $post_item->ID );
        $featured_image = '';
        $srcset = '';
        
        if ( $attachment_id ) {
            $featured_image = wp_get_attachment_image_url( $attachment_id, '' );
            $srcset = wp_get_attachment_image_srcset( $attachment_id, 'full' );
        }
        
        $img = '';
        
        if ( $props['show_image'] == 'on' ) {
            $img = $multi_view->render_element( [
                'tag'   => 'img',
                'attrs' => [
                'src'    => $featured_image,
                'srcset' => $srcset,
                'alt'    => $post_item->post_title,
            ],
            ] );
            $img = sprintf( '<div class="image-container" style="position:relative;">%s%s</div>', $img, $item_overlay );
        }
        
        $post_title = '';
        if ( $props['show_title'] == 'on' ) {
            $post_title = $multi_view->render_element( [
                'tag'     => $props['title_level'],
                'attrs'   => [
                'class' => 'item-title',
            ],
                'content' => $post_item->post_title,
            ] );
        }
        $meta = '';
        
        if ( $props['show_meta'] == 'on' ) {
            $meta_info = [];
            if ( $props['show_author'] == 'on' ) {
                $meta_info[] = sprintf( '<span class="post-author">by <a href="%s">%s</a></span>', get_author_posts_url( $post_item->post_author ), get_the_author_meta( 'display_name', $post_item->post_author ) );
            }
            if ( $props['show_date'] == 'on' ) {
                $meta_info[] = sprintf( '<span class="post-date">%s</span>', get_the_date( $props['date_format'], $post_item ) );
            }
            
            if ( $props['show_categories'] == 'on' ) {
                $taxonomies = get_object_taxonomies( $posts_query_props['post_type'] );
                $categories = [];
                foreach ( $taxonomies as $taxonomy_name ) {
                    
                    if ( !strpos( $taxonomy_name, '_tag' ) ) {
                        $taxonomy_terms = get_the_terms( $post_item->ID, $taxonomy_name );
                        if ( $taxonomy_terms ) {
                            $categories = array_merge( $categories, $taxonomy_terms );
                        }
                    }
                
                }
                $categories_html = [];
                foreach ( $categories as $category ) {
                    $categories_html[] = sprintf(
                        '<span class="post-category"><a href="%s" target="%s">%s</a></span>',
                        get_term_link( $category ),
                        $open_link_in,
                        $category->name
                    );
                }
                
                if ( $categories_html ) {
                    $categories_html = sprintf( '<span class="post-categories">%s</span>', implode( ', ', $categories_html ) );
                    $categories_html = apply_filters(
                        'wpt_masonry_gallery_post_item_categories_html',
                        $categories_html,
                        $post_item,
                        $categories,
                        $open_link_in
                    );
                    $meta_info[] = $categories_html;
                }
            
            }
            
            
            if ( $props['show_comment_count'] == 'on' ) {
                $count = get_comments_number( $post_item );
                $meta_info[] = sprintf( '<span class="post-comment-count">%s %s</span>', $count, ( $count > 1 ? 'Comments' : 'Comment' ) );
            }
            
            if ( !empty($meta_info) ) {
                $meta = $multi_view->render_element( [
                    'tag'     => 'span',
                    'attrs'   => [
                    'class' => 'item-meta',
                ],
                    'content' => implode( ' | ', $meta_info ),
                ] );
            }
        }
        
        $description = '';
        
        if ( $props['show_description'] != 'none' ) {
            $content = ( $props['show_description'] == 'excerpt' ? $post_item->post_excerpt : strip_tags( do_shortcode( et_delete_post_first_video( $post_item->post_content ), false ), '<p>' ) );
            
            if ( $props['description_char_count'] != '-1' ) {
                $content = substr( $content, 0, $props['description_char_count'] );
                $content = sprintf( '%s %s', $content, $props['description_suffix'] );
            }
            
            if ( $content ) {
                $description = $multi_view->render_element( [
                    'tag'     => 'div',
                    'attrs'   => [
                    'class' => 'item-description',
                ],
                    'content' => $content,
                ] );
            }
        }
        
        $button = '';
        if ( $props['show_read_more_button'] == 'on' ) {
            $button = $this->render_button( [
                'display_button'      => true,
                'button_text'         => $props['button_text'],
                'button_text_escaped' => true,
                'has_wrapper'         => true,
                'button_url'          => get_the_permalink( $post_item ),
                'url_new_window'      => ( $open_link_in == '_blank' ? 'on' : 'off' ),
                'button_custom'       => ( isset( $this->props['custom_button'] ) ? esc_attr( $this->props['custom_button'] ) : 'off' ),
                'custom_icon'         => ( isset( $this->props['button_icon'] ) ? $this->props['button_icon'] : '' ),
                'button_rel'          => ( isset( $this->props['button_rel'] ) ? esc_attr( $this->props['button_rel'] ) : '' ),
            ] );
        }
        echo  et_core_intentionally_unescaped( $multi_view->render_element( [
            'tag'     => 'div',
            'attrs'   => [
            'class' => 'masonry-grid-item',
            'href'  => get_the_permalink( $post_item ),
            'title' => $post_item->post_title,
        ],
            'content' => $img . $post_title . $meta . $description . $button,
        ] ), 'html' ) ;
        ?>

	<?php 
    }
    ?>

</div>

<?php 
    if ( $props['show_pagination'] == 'on' && $posts_query_props['posts_per_page'] > -1 ) {
    }
    ?>

<?php 
}
