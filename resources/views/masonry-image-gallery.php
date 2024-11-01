<?php if (empty($images)): ?>
<div style='text-align: center;'>
    <h3>No Images Found</h3>
    <p>Kindly select the images manually or use the custom query filter</p>
</div>
<?php else: ?>
<div class="<?php echo esc_attr(implode(' ', $classes)); ?>" data-class='<?php echo esc_attr($module_class); ?>' data-options='<?php echo wp_json_encode($masonry_js_options); ?>'>
	<div class="masonry-grid-sizer"></div>

	<?php foreach ($images as $image): ?>
<?php
    $item_overlay = '';

    if ($props['show_grid_item_overlay_on_hover'] == 'on') {
        $overlay_icon_html = '';
        if ($props['grid_item_hover_icon']) {
            $overlay_icon_html = sprintf('<span class="et-pb-icon">%s</span>', esc_attr(et_pb_process_font_icon($props['grid_item_hover_icon'])));
        }

        $item_overlay = $multi_view->render_element(
            [
                'tag'     => 'div',
                'attrs'   => [
                    'class' => 'masonry-item-overlay',
                ],
                'content' => $overlay_icon_html,
            ]
        );
    }

    $img = $multi_view->render_element(
        [
            'tag'          => 'img',
            'attrs'        => [
                'src' => '{{src}}',
                'alt' => '{{title}}',
            ],
            'custom_props' => $image,
            'required'     => 'src',
        ]
    );

    $image_title = '';

    if ($props['show_title'] == 'on') {
        $image_title = $multi_view->render_element(
            [
                'tag'     => $props['title_level'],
                'attrs'   => [
                    'class' => 'item-title',
                ],
                'content' => $image['title'],
            ]
        );
    }

    $description = '';

    if ($props['show_description'] != 'none') {
        $content = $props['show_description'] == 'caption' ? $image['caption'] : $image['description'];

        if ($content) {
            $description = $multi_view->render_element(
                [
                    'tag'     => 'div',
                    'attrs'   => [
                        'class' => 'item-description',
                    ],
                    'content' => $content,
                ]
            );
        }
    }

    echo et_core_intentionally_unescaped($multi_view->render_element(
        [
            'tag'     => 'a',
            'attrs'   => [
                'class' => 'masonry-grid-item',
                'href'  => esc_url($image['src']),
                'title' => esc_html($image['title']),
            ],
            'content' => $img . $image_title . $description . $item_overlay,
        ]

    ), 'html');

?>

	<?php endforeach?>

</div>
<?php endif?>