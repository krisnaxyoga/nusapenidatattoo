<!-- Footer -->
<footer class="bg-gradient-dark border-t border-white border-opacity-10 text-[#f5f5f5]">
    <div class="py-12 px-4">
        <div class="max-w-6xl mx-auto">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <!-- About / Logo -->
                <div>
                    <?php
                    // Get footer logo from customizer
                    $footer_logo_id = get_theme_mod('nusatatto_footer_logo', '');
                    $footer_logo_width = get_theme_mod('nusatatto_footer_logo_width', '150');

                    if ($footer_logo_id) {
                        // Display footer logo
                        $logo = wp_get_attachment_image_src($footer_logo_id, 'full');
                        ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-block mb-4">
                            <img src="<?php echo esc_url($logo[0]); ?>"
                                 alt="<?php echo esc_attr(get_bloginfo('name')); ?>"
                                 class="max-h-[60px] object-contain"
                                 style="width: <?php echo esc_attr($footer_logo_width); ?>px;">
                        </a>
                        <?php
                    } else {
                        // Fallback to site title
                        ?>
                        <h3 class="text-lg font-semibold mb-4 text-[#f5f5f5]">
                            <?php echo esc_html(get_theme_mod('nusatatto_site_title', get_bloginfo('name'))); ?>
                        </h3>
                        <?php
                    }

                    // Footer About Text from Customizer
                    $footer_about = get_theme_mod('nusatatto_footer_about', 'Premium tattoo studio with experienced artists and guaranteed quality. We welcome travelers from all over the world.');
                    ?>
                    <p class="text-gray-400 text-sm"><?php echo esc_html($footer_about); ?></p>
                </div>

                <!-- Menu -->
                <div>
                    <h4 class="font-semibold mb-4 text-[#f5f5f5]">Menu</h4>
                    <?php
                    if (has_nav_menu('footer')) {
                        wp_nav_menu([
                            'theme_location' => 'footer',
                            'container'      => false,
                            'menu_class'     => 'space-y-2 text-sm text-gray-400',
                            'fallback_cb'    => false,
                        ]);
                    } else {
                        // Fallback menu
                        ?>
                        <ul class="space-y-2 text-sm text-gray-400">
                            <li><a href="#about" class="hover:text-[#d4af37] transition-colors">About</a></li>
                            <li><a href="#portfolio" class="hover:text-[#d4af37] transition-colors">Portfolio</a></li>
                            <li><a href="#why-us" class="hover:text-[#d4af37] transition-colors">Why Us</a></li>
                            <li><a href="#faq" class="hover:text-[#d4af37] transition-colors">FAQ</a></li>
                        </ul>
                        <?php
                    }
                    ?>
                </div>

                <!-- Social Media -->
                <div>
                    <h4 class="font-semibold mb-4 text-[#f5f5f5]">Follow Us</h4>
                    <div class="flex gap-4">
                        <?php
                        $facebook = get_theme_mod('nusatatto_facebook', '');
                        $instagram = get_theme_mod('nusatatto_instagram', '');
                        $tiktok = get_theme_mod('nusatatto_tiktok', '');
                        $whatsapp = get_theme_mod('nusatatto_whatsapp', '6285792283479');

                        if ($facebook) : ?>
                            <a href="<?php echo esc_url($facebook); ?>" target="_blank" rel="noopener" class="text-gray-400 hover:text-[#d4af37] transition-colors" aria-label="Facebook">
                                <svg style="width: 24px; height: 24px;" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                        <?php endif;

                        if ($instagram) : ?>
                            <a href="<?php echo esc_url($instagram); ?>" target="_blank" rel="noopener" class="text-gray-400 hover:text-[#d4af37] transition-colors" aria-label="Instagram">
                                <svg style="width: 24px; height: 24px;" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                            </a>
                        <?php endif;

                        if ($tiktok) : ?>
                            <a href="<?php echo esc_url($tiktok); ?>" target="_blank" rel="noopener" class="text-gray-400 hover:text-[#d4af37] transition-colors" aria-label="TikTok">
                                <svg style="width: 24px; height: 24px;" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                                </svg>
                            </a>
                        <?php endif; ?>

                        <a href="https://wa.me/<?php echo esc_attr($whatsapp); ?>?text=Hi%20nusapenidatattoo.com,%20I%20want%20to%20book%20a%20tattoo%20session" target="_blank" rel="noopener" class="text-gray-400 hover:text-[#d4af37] transition-colors" aria-label="WhatsApp">
                            <svg style="width: 24px; height: 24px;" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="font-semibold mb-4 text-[#f5f5f5]">Contact</h4>
                    <?php
                    $phone = get_theme_mod('nusatatto_phone', '+62 813-3756-7256');
                    $email = get_theme_mod('nusatatto_email', 'info@nusapenidatattoo.com');
                    $address = get_theme_mod('nusatatto_address', 'Jl. Raya Nusa Penida, Bali 80771');
                    ?>
                    <p class="text-sm text-gray-400 mb-2"><?php echo esc_html($phone); ?></p>
                    <p class="text-sm text-gray-400 mb-2"><?php echo esc_html($email); ?></p>
                    <p class="text-sm text-gray-400"><?php echo esc_html($address); ?></p>
                </div>
            </div>

            <!-- SEO Footer Text & Copyright -->
            <div class="pt-8 text-center border-t border-white border-opacity-10">
                <p class="text-sm text-gray-400 mb-4">
                    <strong class="text-[#f5f5f5]">Nusa Penida Tattoo – Professional Tattoo Studio in Nusa Penida, Bali.</strong><br>
                    Custom tattoos, fine-line art, and traditional designs created by certified artists. We welcome travelers from all over the world who want to get inked while exploring the island paradise of Nusa Penida.
                </p>
                <?php
                $copyright = get_theme_mod('nusatatto_footer_copyright', '© ' . date('Y') . ' Nusa Penida Tattoo. All rights reserved.');
                ?>
                <p class="text-gray-400 text-sm"><?php echo wp_kses_post($copyright); ?></p>

                <!-- Back to Top Button -->
                <button id="backToTop" class="mt-6 inline-flex items-center gap-2 px-6 py-3 glass-lg rounded-full font-semibold hover-lift text-[#f5f5f5] hover:text-[#d4af37] transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                    </svg>
                    Back to Top
                </button>
            </div>
        </div>
    </div>
</footer>
<!-- Floating Menu Container -->
<!-- Back to Top Button - LEFT SIDE -->
<div class="floating-backtop-wrapper">
    <button id="floatingBackTop" class="floating-back-top">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
        </svg>
    </button>
</div>

<!-- Floating Contact Menu - RIGHT SIDE -->
<div class="floating-contact-wrapper">
    <!-- Menu Toggle Button (3 dots) -->
    <button id="floatingContactToggle" class="floating-contact-toggle" aria-label="Contact Menu">
        <svg class="floating-menu-icon" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
            <circle cx="12" cy="5" r="2"/>
            <circle cx="12" cy="12" r="2"/>
            <circle cx="12" cy="19" r="2"/>
        </svg>
        <svg class="floating-close-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>

    <!-- Menu Items Container -->
    <div id="floatingContactItems" class="floating-contact-items">
        <?php
        // Get contact info from customizer
        $facebook = get_theme_mod('nusatatto_facebook', '');
        $instagram = get_theme_mod('nusatatto_instagram', '');
        $tiktok = get_theme_mod('nusatatto_tiktok', '');
        $whatsapp = get_theme_mod('nusatatto_whatsapp', '6285792283479');
        $email = get_theme_mod('nusatatto_email', 'info@nusapenidatattoo.com');
        $google_maps = get_theme_mod('nusatatto_google_maps', '');
        ?>

        <!-- Facebook -->
        <?php if ($facebook) : ?>
        <div class="floating-contact-item" data-delay="0.1">
            <span class="floating-contact-label">Facebook</span>
            <a href="<?php echo esc_url($facebook); ?>" target="_blank" rel="noopener" 
               class="floating-contact-btn floating-btn-facebook" aria-label="Facebook">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
            </a>
        </div>
        <?php endif; ?>

        <!-- Instagram -->
        <?php if ($instagram) : ?>
        <div class="floating-contact-item" data-delay="0.15">
            <span class="floating-contact-label">Instagram</span>
            <a href="<?php echo esc_url($instagram); ?>" target="_blank" rel="noopener" 
               class="floating-contact-btn floating-btn-instagram" aria-label="Instagram">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                </svg>
            </a>
        </div>
        <?php endif; ?>

        <!-- WhatsApp -->
        <div class="floating-contact-item" data-delay="0.2">
            <span class="floating-contact-label">WhatsApp</span>
            <a href="https://wa.me/<?php echo esc_attr($whatsapp); ?>?text=Hi%20nusapenidatattoo.com,%20I%20want%20to%20book%20a%20tattoo%20session"
               target="_blank" rel="noopener"
               class="floating-contact-btn floating-btn-whatsapp" aria-label="WhatsApp">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
            </a>
        </div>

        <!-- TikTok -->
        <?php if ($tiktok) : ?>
        <div class="floating-contact-item" data-delay="0.25">
            <span class="floating-contact-label">TikTok</span>
            <a href="<?php echo esc_url($tiktok); ?>" target="_blank" rel="noopener" 
               class="floating-contact-btn floating-btn-tiktok" aria-label="TikTok">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                </svg>
            </a>
        </div>
        <?php endif; ?>

        <!-- Email -->
        <?php if ($email) : ?>
        <div class="floating-contact-item" data-delay="0.3">
            <span class="floating-contact-label">Email</span>
            <a href="mailto:<?php echo esc_attr($email); ?>" 
               class="floating-contact-btn floating-btn-email" aria-label="Email">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </a>
        </div>
        <?php endif; ?>

        <!-- Google Maps -->
        <?php if ($google_maps) : ?>
        <div class="floating-contact-item" data-delay="0.35">
            <span class="floating-contact-label">Address</span>
            <a href="https://maps.app.goo.gl/Kn7se6d8tgYuk63M6" target="_blank" rel="noopener" 
               class="floating-contact-btn floating-btn-maps" aria-label="Google Maps">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </a>
        </div>
        <?php endif; ?>
    </div>
</div>

<script>
(function() {
    'use strict';
    
    // Wait for DOM
    function init() {
        initFloatingContact();
        initBackToTop();
    }
    
    // Floating Contact Menu
    function initFloatingContact() {
        const toggle = document.getElementById('floatingContactToggle');
        const items = document.getElementById('floatingContactItems');
        
        if (!toggle || !items) return;
        
        let isOpen = false;
        
        // Toggle menu
        toggle.addEventListener('click', function(e) {
            e.stopPropagation();
            isOpen = !isOpen;
            
            if (isOpen) {
                toggle.classList.add('is-open');
                items.classList.add('is-visible');
            } else {
                toggle.classList.remove('is-open');
                items.classList.remove('is-visible');
            }
        });
        
        // Close on outside click
        document.addEventListener('click', function(e) {
            if (isOpen && !toggle.contains(e.target) && !items.contains(e.target)) {
                isOpen = false;
                toggle.classList.remove('is-open');
                items.classList.remove('is-visible');
            }
        });
        
        // Close on scroll
        let scrollTimer;
        window.addEventListener('scroll', function() {
            if (isOpen) {
                clearTimeout(scrollTimer);
                scrollTimer = setTimeout(function() {
                    isOpen = false;
                    toggle.classList.remove('is-open');
                    items.classList.remove('is-visible');
                }, 100);
            }
        });
        
        // Close on escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && isOpen) {
                isOpen = false;
                toggle.classList.remove('is-open');
                items.classList.remove('is-visible');
            }
        });
    }
    
    // Back to Top Button
    function initBackToTop() {
        const backTop = document.getElementById('floatingBackTop');
        
        if (!backTop) return;
        
        // Show/hide on scroll
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backTop.classList.add('is-visible');
            } else {
                backTop.classList.remove('is-visible');
            }
        });
        
        // Scroll to top on click
        backTop.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
    
    // Initialize
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
</script>

<?php wp_footer(); ?>
</body>
</html>