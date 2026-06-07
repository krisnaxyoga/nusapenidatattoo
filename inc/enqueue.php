<?php
/**
 * Enqueue styles and scripts with optimizations
 */
function theme_enqueue() {
    // Cache version based on file modification time (better cache busting)
    $theme_version = wp_get_theme()->get('Version');
    $css_main_ver  = filemtime(get_template_directory() . '/dist/css/main.css');
    $css_custom_ver = filemtime(get_template_directory() . '/dist/css/customs.css');
    $js_ver        = filemtime(get_template_directory() . '/dist/js/main.js');
    
    // ================== STYLES ==================
    
    // Main stylesheet
    wp_enqueue_style(
        'theme-main-style',
        get_template_directory_uri() . '/dist/css/main.css',
        array(),
        $css_main_ver,
        'all'
    );
    
    // Custom stylesheet (depends on main)
    wp_enqueue_style(
        'theme-custom-style',
        get_template_directory_uri() . '/dist/css/customs.css',
        array('theme-main-style'),
        $css_custom_ver,
        'all'
    );
    
    // ================== SCRIPTS ==================
    
    // Main JavaScript (async loading)
    wp_enqueue_script(
        'theme-script',
        get_template_directory_uri() . '/dist/js/main.js',
        array('jquery'), // Remove if you don't use jQuery
        $js_ver,
        true // Load in footer
    );
    
    // Add async/defer attributes
    add_filter('script_loader_tag', function($tag, $handle) {
        if ('theme-script' === $handle) {
            return str_replace(' src', ' defer src', $tag);
        }
        return $tag;
    }, 10, 2);
    
    // Pass data to JavaScript
    wp_localize_script('theme-script', 'themeData', array(
        'ajaxUrl'  => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('theme-nonce'),
        'homeUrl'  => home_url('/'),
        'themeUrl' => get_template_directory_uri(),
        'isRTL'    => is_rtl(),
    ));
}
add_action('wp_enqueue_scripts', 'theme_enqueue');