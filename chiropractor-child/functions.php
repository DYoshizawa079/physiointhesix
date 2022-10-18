<?php

add_action('wp_enqueue_scripts', 'chiropractor_child_css', 100);
 
// Load CSS
function chiropractor_child_css() {
    // Chiropractor child theme styles
	
    $parent_style = 'chiropractor-style';

    wp_enqueue_style( 'chiropractor-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );


    if (is_rtl()) {

        $parent_style = 'chiropractor-rtl';

        wp_enqueue_style( 'chiropractor-child-rtl',
            get_stylesheet_directory_uri() . '/rtl.css',
            array( $parent_style ),
            wp_get_theme()->get('Version')
        );
    }
	
}

function wpb_image_editor_default_to_gd( $editors ) {
    $gd_editor = 'WP_Image_Editor_GD';
    $editors = array_diff( $editors, array( $gd_editor ) );
    array_unshift( $editors, $gd_editor );
    return $editors;
}
add_filter( 'wp_image_editors', 'wpb_image_editor_default_to_gd' );
// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

// END ENQUEUE PARENT ACTION

// Override /js/main.js of parent theme
add_action('wp_enqueue_scripts', 'remove_main', 100);
function remove_main()
{
    wp_dequeue_script('main-script');
    wp_enqueue_script('child_theme_main-script', get_stylesheet_directory_uri() . '/js/main.js', array( 'jquery' ), "all", true);
}
