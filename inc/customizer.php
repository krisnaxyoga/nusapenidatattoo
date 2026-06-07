<?php
/**
 * Theme Customizer
 * Add custom settings to WordPress Customizer
 */

add_action('customize_register', 'nusatatto_customize_register');
function nusatatto_customize_register($wp_customize) {

    /*--------------------------------------------------------------
    1. Logo Settings Section
    --------------------------------------------------------------*/
    $wp_customize->add_section('nusatatto_logo_settings', [
        'title'    => __('Logo & Branding', 'nusatatto'),
        'priority' => 30,
    ]);

    // Header Logo
    $wp_customize->add_setting('nusatatto_header_logo', [
        'default'           => '',
        'sanitize_callback' => 'absint',
    ]);

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'nusatatto_header_logo', [
        'label'       => __('Header Logo', 'nusatatto'),
        'description' => __('Upload logo for header navigation', 'nusatatto'),
        'section'     => 'nusatatto_logo_settings',
        'mime_type'   => 'image',
    ]));

    // Header Logo Width
    $wp_customize->add_setting('nusatatto_header_logo_width', [
        'default'           => '150',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ]);

    $wp_customize->add_control('nusatatto_header_logo_width', [
        'label'       => __('Header Logo Width (pixels)', 'nusatatto'),
        'description' => __('Set the width of header logo in pixels', 'nusatatto'),
        'section'     => 'nusatatto_logo_settings',
        'type'        => 'number',
        'input_attrs' => [
            'min'  => 50,
            'max'  => 500,
            'step' => 5,
        ],
    ]);

    // Footer Logo
    $wp_customize->add_setting('nusatatto_footer_logo', [
        'default'           => '',
        'sanitize_callback' => 'absint',
    ]);

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'nusatatto_footer_logo', [
        'label'       => __('Footer Logo', 'nusatatto'),
        'description' => __('Upload logo for footer (can be different from header)', 'nusatatto'),
        'section'     => 'nusatatto_logo_settings',
        'mime_type'   => 'image',
    ]));

    // Footer Logo Width
    $wp_customize->add_setting('nusatatto_footer_logo_width', [
        'default'           => '150',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ]);

    $wp_customize->add_control('nusatatto_footer_logo_width', [
        'label'       => __('Footer Logo Width (pixels)', 'nusatatto'),
        'description' => __('Set the width of footer logo in pixels', 'nusatatto'),
        'section'     => 'nusatatto_logo_settings',
        'type'        => 'number',
        'input_attrs' => [
            'min'  => 50,
            'max'  => 500,
            'step' => 5,
        ],
    ]);

    // Site Title for non-logo fallback
    $wp_customize->add_setting('nusatatto_site_title', [
        'default'           => 'Nusa Penida Tattoo',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ]);

    $wp_customize->add_control('nusatatto_site_title', [
        'label'       => __('Site Title (Fallback)', 'nusatatto'),
        'description' => __('Shown when no logo is uploaded', 'nusatatto'),
        'section'     => 'nusatatto_logo_settings',
        'type'        => 'text',
    ]);

    /*--------------------------------------------------------------
    2. Contact Information
    --------------------------------------------------------------*/
    $wp_customize->add_section('nusatatto_contact', [
        'title'    => __('Contact Information', 'nusatatto'),
        'priority' => 40,
    ]);

    // WhatsApp Number
    $wp_customize->add_setting('nusatatto_whatsapp', [
        'default'           => '6281337567256',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('nusatatto_whatsapp', [
        'label'       => __('WhatsApp Number', 'nusatatto'),
        'description' => __('Format: 6281234567890 (without + or spaces)', 'nusatatto'),
        'section'     => 'nusatatto_contact',
        'type'        => 'text',
    ]);

    // Phone Number
    $wp_customize->add_setting('nusatatto_phone', [
        'default'           => '+62 813-3756-7256',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('nusatatto_phone', [
        'label'       => __('Phone Number', 'nusatatto'),
        'description' => __('Displayed on website', 'nusatatto'),
        'section'     => 'nusatatto_contact',
        'type'        => 'text',
    ]);

    // Email
    $wp_customize->add_setting('nusatatto_email', [
        'default'           => 'info@nusapenidatattoo.com',
        'sanitize_callback' => 'sanitize_email',
    ]);

    $wp_customize->add_control('nusatatto_email', [
        'label'   => __('Email Address', 'nusatatto'),
        'section' => 'nusatatto_contact',
        'type'    => 'email',
    ]);

    // Address
    $wp_customize->add_setting('nusatatto_address', [
        'default'           => 'Jl. Raya Nusa Penida, Bali 80771',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);

    $wp_customize->add_control('nusatatto_address', [
        'label'   => __('Studio Address', 'nusatatto'),
        'section' => 'nusatatto_contact',
        'type'    => 'textarea',
    ]);

    // Google Maps Embed URL
    $wp_customize->add_setting('nusatatto_google_maps', [
        'default'           => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63081.45856797374!2d115.47419427910156!3d-8.729167099999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd244e04111b941%3A0x5030bfbca82fd40!2sNusa%20Penida%2C%20Klungkung%20Regency%2C%20Bali%2C%20Indonesia!5e0!3m2!1sen!2s!4v1234567890123!5m2!1sen!2s',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control('nusatatto_google_maps', [
        'label'       => __('Google Maps Embed URL', 'nusatatto'),
        'description' => __('Cara mengisi: 1) Buka Google Maps, 2) Klik "Share", 3) Klik "Embed a map", 4) Copy URL yang ada di src="..." dari kode iframe. Contoh: https://www.google.com/maps/embed?pb=...', 'nusatatto'),
        'section'     => 'nusatatto_contact',
        'type'        => 'textarea',
    ]);

    /*--------------------------------------------------------------
    3. Social Media Links
    --------------------------------------------------------------*/
    $wp_customize->add_section('nusatatto_social', [
        'title'    => __('Social Media Links', 'nusatatto'),
        'priority' => 50,
    ]);

    // Facebook
    $wp_customize->add_setting('nusatatto_facebook', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control('nusatatto_facebook', [
        'label'   => __('Facebook URL', 'nusatatto'),
        'section' => 'nusatatto_social',
        'type'    => 'url',
    ]);

    // Instagram
    $wp_customize->add_setting('nusatatto_instagram', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control('nusatatto_instagram', [
        'label'   => __('Instagram URL', 'nusatatto'),
        'section' => 'nusatatto_social',
        'type'    => 'url',
    ]);

    // TikTok
    $wp_customize->add_setting('nusatatto_tiktok', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control('nusatatto_tiktok', [
        'label'   => __('TikTok URL', 'nusatatto'),
        'section' => 'nusatatto_social',
        'type'    => 'url',
    ]);

    /*--------------------------------------------------------------
    4. Hero Section Settings
    --------------------------------------------------------------*/
    $wp_customize->add_section('nusatatto_hero', [
        'title'    => __('Hero Section', 'nusatatto'),
        'priority' => 60,
    ]);

    // Hero Headline
    $wp_customize->add_setting('nusatatto_hero_headline', [
        'default'           => 'Nusa Penida Tattoo – Ink Your Island Story',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('nusatatto_hero_headline', [
        'label'   => __('Hero Headline', 'nusatatto'),
        'section' => 'nusatatto_hero',
        'type'    => 'text',
    ]);

    // Hero Description
    $wp_customize->add_setting('nusatatto_hero_description', [
        'default'           => 'Experience the art of tattooing in paradise. Our certified artists in Nusa Penida create custom designs that tell your Bali story — with care, creativity, and clean precision.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);

    $wp_customize->add_control('nusatatto_hero_description', [
        'label'   => __('Hero Description', 'nusatatto'),
        'section' => 'nusatatto_hero',
        'type'    => 'textarea',
    ]);

    // Hero Background Image
    $wp_customize->add_setting('nusatatto_hero_bg', [
        'default'           => '',
        'sanitize_callback' => 'absint',
    ]);

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'nusatatto_hero_bg', [
        'label'       => __('Hero Background Image', 'nusatatto'),
        'description' => __('Upload a background image for hero section', 'nusatatto'),
        'section'     => 'nusatatto_hero',
        'mime_type'   => 'image',
    ]));

    /*--------------------------------------------------------------
    5. About Section Settings
    --------------------------------------------------------------*/
    $wp_customize->add_section('nusatatto_about', [
        'title'    => __('About Section', 'nusatatto'),
        'priority' => 61,
    ]);

    // About Title
    $wp_customize->add_setting('nusatatto_about_title', [
        'default'           => 'Authentic Tattoo Studio in Nusa Penida',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('nusatatto_about_title', [
        'label'   => __('About Title', 'nusatatto'),
        'section' => 'nusatatto_about',
        'type'    => 'text',
    ]);

    // About Description 1
    $wp_customize->add_setting('nusatatto_about_desc1', [
        'default'           => 'At Nusa Penida Tattoo, we blend world-class tattoo artistry with the island\'s natural beauty. Our professional team offers a safe, hygienic, and welcoming space for travelers seeking meaningful tattoos — inspired by the ocean, island life, and personal stories.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);

    $wp_customize->add_control('nusatatto_about_desc1', [
        'label'   => __('About Description (Paragraph 1)', 'nusatatto'),
        'section' => 'nusatatto_about',
        'type'    => 'textarea',
    ]);

    // About Description 2
    $wp_customize->add_setting('nusatatto_about_desc2', [
        'default'           => 'Whether it\'s your first ink or your next masterpiece, our artists will make it unforgettable.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);

    $wp_customize->add_control('nusatatto_about_desc2', [
        'label'   => __('About Description (Paragraph 2)', 'nusatatto'),
        'section' => 'nusatatto_about',
        'type'    => 'textarea',
    ]);

    // About Image
    $wp_customize->add_setting('nusatatto_about_image', [
        'default'           => '',
        'sanitize_callback' => 'absint',
    ]);

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'nusatatto_about_image', [
        'label'    => __('About Image', 'nusatatto'),
        'section'  => 'nusatatto_about',
        'mime_type' => 'image',
    ]));

    // Statistics
    $wp_customize->add_setting('nusatatto_stat1_number', [
        'default'           => '500+',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('nusatatto_stat1_number', [
        'label'   => __('Statistic 1 - Number', 'nusatatto'),
        'section' => 'nusatatto_about',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('nusatatto_stat1_label', [
        'default'           => 'Happy Clients',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('nusatatto_stat1_label', [
        'label'   => __('Statistic 1 - Label', 'nusatatto'),
        'section' => 'nusatatto_about',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('nusatatto_stat2_number', [
        'default'           => '10+',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('nusatatto_stat2_number', [
        'label'   => __('Statistic 2 - Number', 'nusatatto'),
        'section' => 'nusatatto_about',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('nusatatto_stat2_label', [
        'default'           => 'Years Experience',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('nusatatto_stat2_label', [
        'label'   => __('Statistic 2 - Label', 'nusatatto'),
        'section' => 'nusatatto_about',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('nusatatto_stat3_number', [
        'default'           => '100%',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('nusatatto_stat3_number', [
        'label'   => __('Statistic 3 - Number', 'nusatatto'),
        'section' => 'nusatatto_about',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('nusatatto_stat3_label', [
        'default'           => 'Satisfaction',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('nusatatto_stat3_label', [
        'label'   => __('Statistic 3 - Label', 'nusatatto'),
        'section' => 'nusatatto_about',
        'type'    => 'text',
    ]);

    /*--------------------------------------------------------------
    6. Portfolio Section Settings
    --------------------------------------------------------------*/
    $wp_customize->add_section('nusatatto_portfolio', [
        'title'    => __('Portfolio Section', 'nusatatto'),
        'priority' => 62,
    ]);

    // Portfolio Title
    $wp_customize->add_setting('nusatatto_portfolio_title', [
        'default'           => 'Our Work Speaks for Itself',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('nusatatto_portfolio_title', [
        'label'   => __('Portfolio Title', 'nusatatto'),
        'section' => 'nusatatto_portfolio',
        'type'    => 'text',
    ]);

    // Portfolio Description
    $wp_customize->add_setting('nusatatto_portfolio_desc', [
        'default'           => 'From fine-line art to bold tribal pieces — each tattoo is crafted with precision and passion.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);

    $wp_customize->add_control('nusatatto_portfolio_desc', [
        'label'   => __('Portfolio Description', 'nusatatto'),
        'section' => 'nusatatto_portfolio',
        'type'    => 'textarea',
    ]);

    // Portfolio Images (6 images)
    for ($i = 1; $i <= 6; $i++) {
        $wp_customize->add_setting("nusatatto_portfolio_img{$i}", [
            'default'           => '',
            'sanitize_callback' => 'absint',
        ]);

        $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, "nusatatto_portfolio_img{$i}", [
            'label'     => sprintf(__('Portfolio Image %d', 'nusatatto'), $i),
            'section'   => 'nusatatto_portfolio',
            'mime_type' => 'image',
        ]));

        $wp_customize->add_setting("nusatatto_portfolio_img{$i}_title", [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ]);

        $wp_customize->add_control("nusatatto_portfolio_img{$i}_title", [
            'label'   => sprintf(__('Portfolio Image %d - Title', 'nusatatto'), $i),
            'section' => 'nusatatto_portfolio',
            'type'    => 'text',
        ]);

        $wp_customize->add_setting("nusatatto_portfolio_img{$i}_desc", [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ]);

        $wp_customize->add_control("nusatatto_portfolio_img{$i}_desc", [
            'label'   => sprintf(__('Portfolio Image %d - Description', 'nusatatto'), $i),
            'section' => 'nusatatto_portfolio',
            'type'    => 'text',
        ]);
    }

    /*--------------------------------------------------------------
    5. Footer Settings
    --------------------------------------------------------------*/
    $wp_customize->add_section('nusatatto_footer', [
        'title'    => __('Footer Settings', 'nusatatto'),
        'priority' => 70,
    ]);

    // Footer Copyright Text
    $wp_customize->add_setting('nusatatto_footer_copyright', [
        'default'           => '© ' . date('Y') . ' Nusa Penida Tattoo. All rights reserved.',
        'sanitize_callback' => 'wp_kses_post',
    ]);

    $wp_customize->add_control('nusatatto_footer_copyright', [
        'label'   => __('Copyright Text', 'nusatatto'),
        'section' => 'nusatatto_footer',
        'type'    => 'textarea',
    ]);

    // Footer About Text
    $wp_customize->add_setting('nusatatto_footer_about', [
        'default'           => 'Premium tattoo studio with experienced artists and guaranteed quality. We welcome travelers from all over the world.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);

    $wp_customize->add_control('nusatatto_footer_about', [
        'label'   => __('Footer About Text', 'nusatatto'),
        'section' => 'nusatatto_footer',
        'type'    => 'textarea',
    ]);
}

/**
 * Helper function to get customizer setting
 */
function nusatatto_get_option($option_name, $default = '') {
    $value = get_theme_mod($option_name, $default);
    return $value;
}
