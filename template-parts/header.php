<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="google-site-verification" content="gNu4zK200q_2gDanWGUXUTcsegYsZ1fo5Twb8dIarQ8" />
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-98H0LM5X4F"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-98H0LM5X4F');
</script>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KMKH4HZR');</script>
<!-- End Google Tag Manager -->
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KMKH4HZR"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    <!-- Navigation -->
    <nav class="glass fixed top-0 w-full z-[1000] backdrop-blur-10 border-b border-white border-opacity-10" style="background: rgba(15, 15, 15, 0.7);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="site-logo">
                    <?php
                    // Get header logo from customizer
                    $header_logo_id = get_theme_mod('nusatatto_header_logo', '');
                    $header_logo_width = get_theme_mod('nusatatto_header_logo_width', '150');

                    if ($header_logo_id) {
                        // Display header logo
                        $logo = wp_get_attachment_image_src($header_logo_id, 'full');
                        ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center">
                            <img src="<?php echo esc_url($logo[0]); ?>"
                                 alt="<?php echo esc_attr(get_bloginfo('name')); ?>"
                                 class="max-h-[60px] object-contain"
                                 style="width: <?php echo esc_attr($header_logo_width); ?>px;">
                        </a>
                        <?php
                    } else {
                        // Fallback to site title with gradient
                        $site_title = get_theme_mod('nusatatto_site_title', get_bloginfo('name'));
                        ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="text-2xl font-bold text-gradient">
                            <?php echo esc_html($site_title); ?>
                        </a>
                        <?php
                    }
                    ?>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex gap-8 items-center">
                    <?php
                    if (has_nav_menu('primary')) {
                        wp_nav_menu([
                            'theme_location'  => 'primary',
                            'container'       => false,
                            'menu_class'      => 'flex gap-8 items-center',
                            'fallback_cb'     => false,
                            'depth'           => 1,
                            'link_before'     => '',
                            'link_after'      => '',
                            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        ]);
                    } else {
                        // Fallback menu if no menu is assigned
                        ?>
                        <ul class="flex gap-8 items-center">
                            <li><a href="#about" class="text-[#f5f5f5] hover:text-[#d4af37] transition-colors">About</a></li>
                            <li><a href="#portfolio" class="text-[#f5f5f5] hover:text-[#d4af37] transition-colors">Portfolio</a></li>
                            <li><a href="#why-us" class="text-[#f5f5f5] hover:text-[#d4af37] transition-colors">Why Us</a></li>
                            <li><a href="#faq" class="text-[#f5f5f5] hover:text-[#d4af37] transition-colors">FAQ</a></li>
                        </ul>
                        <?php
                    }
                    ?>
                </div>

                <!-- CTA Button Desktop -->
                <?php
                $whatsapp = get_theme_mod('nusatatto_whatsapp', '6285792283479');
                $whatsapp_url = 'https://wa.me/' . $whatsapp . '?text=' . rawurlencode('Hi nusapenidatattoo.com, I want to book a tattoo session');
                ?>
                <a href="<?php echo esc_url($whatsapp_url); ?>" target="_blank" class="hidden md:block glass px-6 py-2 rounded-full hover:bg-[#d4af37] hover:text-[#0f0f0f] transition-all">
                    Contact
                </a>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-button" class="md:hidden p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#d4af37]" aria-label="Toggle Mobile Menu">
                    <svg id="menu-icon" class="w-6 h-6 text-[#f5f5f5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg id="close-icon" class="w-6 h-6 text-[#f5f5f5] hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden px-4 pb-4 border-t border-white border-opacity-10" style="background: rgba(15, 15, 15, 0.95);">
            <div class="flex flex-col space-y-3 py-4">
                <?php
                if (has_nav_menu('primary')) {
                    wp_nav_menu([
                        'theme_location'  => 'primary',
                        'container'       => false,
                        'menu_class'      => 'flex flex-col space-y-3',
                        'fallback_cb'     => false,
                        'depth'           => 1,
                        'link_before'     => '',
                        'link_after'      => '',
                        'items_wrap'      => '%3$s',
                    ]);
                } else {
                    // Fallback menu
                    ?>
                    <a href="#about" class="text-[#f5f5f5] hover:text-[#d4af37] transition-colors py-2">About</a>
                    <a href="#portfolio" class="text-[#f5f5f5] hover:text-[#d4af37] transition-colors py-2">Portfolio</a>
                    <a href="#why-us" class="text-[#f5f5f5] hover:text-[#d4af37] transition-colors py-2">Why Us</a>
                    <a href="#faq" class="text-[#f5f5f5] hover:text-[#d4af37] transition-colors py-2">FAQ</a>
                    <?php
                }
                ?>
                <a href="<?php echo esc_url($whatsapp_url); ?>" target="_blank" class="text-[#d4af37] border border-[#d4af37] px-4 py-2 rounded-full text-center hover:bg-[#d4af37] hover:text-[#0f0f0f] transition-all">
                    Contact
                </a>
            </div>
        </div>
    </nav>