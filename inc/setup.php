<?php
/**
 * inc/setup.php
 * Semua setup dasar theme
 */

/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
1. Theme setup
2. Custom image sizes
3. JPEG quality
4. Nav menu attributes (smooth-scroll anchor fix)
--------------------------------------------------------------*/

/*--------------------------------------------------------------
1. Theme setup
--------------------------------------------------------------*/
add_action('after_setup_theme', 'theme_setup');
function theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

    // Custom Logo Support
    add_theme_support('custom-logo', [
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => ['site-title', 'site-description'],
        'unlink-homepage-logo' => false,
    ]);

    // Register Navigation Menus
    register_nav_menus([
        'primary' => __('Primary Menu (Header)', 'nusatatto'),
        'footer'  => __('Footer Menu', 'nusatatto'),
    ]);

    // HTML5 Support
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);

    // Add support for Block Styles
    add_theme_support('wp-block-styles');

    // Add support for responsive embeds
    add_theme_support('responsive-embeds');
}

/*--------------------------------------------------------------
2. Custom image sizes
--------------------------------------------------------------*/
add_action('init', 'theme_image_sizes');
function theme_image_sizes() {
    add_image_size('blog-thumbnail', 800, 450, true); // 16:9
    add_image_size('blog-single',    1200, 630, true); // 1.91:1
}

/*--------------------------------------------------------------
3. JPEG quality
--------------------------------------------------------------*/
add_filter('jpeg_quality', fn() => 95);
add_filter('wp_editor_set_quality', fn() => 95);

/*--------------------------------------------------------------
4. Nav menu attributes
   Ubah href="/#section" menjadi full URL
--------------------------------------------------------------*/
add_filter('nav_menu_link_attributes', 'theme_fix_anchor_links', 10, 3);
function theme_fix_anchor_links($atts, $item, $args) {
    if (!isset($atts['href'])) return $atts;

    $href = $atts['href'];
    $hashPos = strpos($href, '#');

    if ($hashPos !== false) {
        $hash = substr($href, $hashPos);
        $href = home_url() . $hash;
    }

    $atts['href'] = $href;

    return $atts;
}

/*--------------------------------------------------------------
5. Calculate reading time
--------------------------------------------------------------*/
function calculate_reading_time($post_id) {
    $post = get_post($post_id);
    if (!$post) return 0;

    $content = strip_tags($post->post_content);
    $word_count = str_word_count($content);
    $reading_time = ceil($word_count / 200); // 200 words per minute

    return max(1, $reading_time); // minimum 1 minute
}