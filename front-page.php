<?php get_template_part('template-parts/header'); ?>
<?php
// ---- Contact details: single source of truth for NAP consistency (local SEO) ----
// Kontak & gambar tetap dari Customizer agar konsisten dengan header/footer/booking.
$whatsapp = get_theme_mod('nusatatto_whatsapp', '6285792283479');
$phone    = get_theme_mod('nusatatto_phone', '+62 857-9228-3479');
$email    = get_theme_mod('nusatatto_email', 'info@nusapenidatattoo.com');
$address  = get_theme_mod('nusatatto_address', 'Jl. Raya Nusa Penida, Bali 80771');
$tel_link = preg_replace('/[^0-9+]/', '', $phone);
$book_url = esc_url(home_url('/book'));
$wa_book  = 'https://wa.me/' . $whatsapp . '?text=' . rawurlencode('Hi nusapenidatattoo.com, I want to book a tattoo session');
?>

<!-- Hero Section -->
<?php
$hero_bg_id  = get_theme_mod('nusatatto_hero_bg', '');
$hero_bg_url = $hero_bg_id ? wp_get_attachment_image_url($hero_bg_id, 'full') : get_template_directory_uri() . '/assets/images/hero-bg.jpg';
?>
<section class="hero bg-gradient-dark">
    <!-- Background Image Overlay -->
    <div class="hero-bg-overlay" style="background-image: url('<?php echo esc_url($hero_bg_url); ?>');"></div>

    <div class="hero-content max-w-4xl mx-auto px-4 relative z-10 text-center">
        <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight text-[#f5f5f5]">
            <?php we('home_hero_headline'); ?>
        </h1>
        <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">
            <?php we('home_hero_description'); ?>
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="<?php echo esc_url($wa_book); ?>" target="_blank" class="btn-glass-accent px-8 py-4 rounded-full font-semibold hover-lift">
                <?php we('home_hero_btn_primary'); ?>
            </a>
            <a href="#portfolio" class="glass-lg px-8 py-4 rounded-full font-semibold hover-lift text-[#f5f5f5]">
                <?php we('home_hero_btn_secondary'); ?>
            </a>
        </div>
    </div>
</section>

<!-- SEO Intro / Quick Answer — optimized for AI Overviews & featured snippets -->
<section class="py-16 px-4 bg-gradient-dark">
    <div class="max-w-4xl mx-auto">
        <div class="glass-lg rounded-2xl p-8 md:p-10 seo-answer">
            <h2 class="text-2xl md:text-3xl font-bold mb-4 text-[#f5f5f5]"><?php we('home_intro_title'); ?></h2>
            <div class="text-gray-300 leading-relaxed mb-6">
                <?php we_html('home_intro_text'); ?>
            </div>
            <ul class="grid sm:grid-cols-2 gap-3 text-gray-300 mb-8">
                <li class="flex items-center gap-3"><span class="text-[#d4af37]">📍</span> <?php we('home_fact_1'); ?></li>
                <li class="flex items-center gap-3"><span class="text-[#d4af37]">🕙</span> <?php we('home_fact_2'); ?></li>
                <li class="flex items-center gap-3"><span class="text-[#d4af37]">💸</span> <?php we('home_fact_3'); ?></li>
                <li class="flex items-center gap-3"><span class="text-[#d4af37]">✅</span> <?php we('home_fact_4'); ?></li>
                <li class="flex items-center gap-3"><span class="text-[#d4af37]">🎨</span> <?php we('home_fact_5'); ?></li>
                <li class="flex items-center gap-3"><span class="text-[#d4af37]">🗣️</span> <?php we('home_fact_6'); ?></li>
            </ul>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="<?php echo $book_url; ?>" class="btn-glass-accent px-6 py-3 rounded-full font-semibold text-center"><?php we('home_hero_btn_primary'); ?></a>
                <a href="<?php echo esc_url($wa_book); ?>" target="_blank" rel="noopener" class="glass px-6 py-3 rounded-full font-semibold text-center text-[#f5f5f5] hover:bg-[#25D366] hover:text-white transition-all">WhatsApp Us</a>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<?php
$about_img_id  = get_theme_mod('nusatatto_about_image', '');
$about_img_url = $about_img_id ? wp_get_attachment_image_url($about_img_id, 'full') : get_template_directory_uri() . '/assets/images/about-studio.jpg';
?>
<section id="about" class="py-20 px-4 bg-gradient-dark">
    <div class="max-w-6xl mx-auto">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="animate-fade-in-up">
                <img src="<?php echo esc_url($about_img_url); ?>" alt="<?php echo esc_attr(w('home_about_title')); ?>" class="rounded-2xl glass">
            </div>
            <div class="animate-slide-in-left">
                <h2 class="text-4xl font-bold mb-6 text-[#f5f5f5]"><?php we('home_about_title'); ?></h2>
                <p class="text-gray-300 mb-4 leading-relaxed">
                    <?php we('home_about_desc1'); ?>
                </p>
                <p class="text-gray-300 mb-8 leading-relaxed">
                    <?php we('home_about_desc2'); ?>
                </p>
                <div class="grid grid-cols-3 gap-4">
                    <div class="glass p-4 rounded-lg text-center">
                        <div class="text-3xl font-bold text-[#d4af37] mb-2"><?php we('home_stat1_number'); ?></div>
                        <div class="text-sm text-gray-400"><?php we('home_stat1_label'); ?></div>
                    </div>
                    <div class="glass p-4 rounded-lg text-center">
                        <div class="text-3xl font-bold text-[#d4af37] mb-2"><?php we('home_stat2_number'); ?></div>
                        <div class="text-sm text-gray-400"><?php we('home_stat2_label'); ?></div>
                    </div>
                    <div class="glass p-4 rounded-lg text-center">
                        <div class="text-3xl font-bold text-[#d4af37] mb-2"><?php we('home_stat3_number'); ?></div>
                        <div class="text-sm text-gray-400"><?php we('home_stat3_label'); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Portfolio Section -->
<section id="portfolio" class="py-20 px-4 bg-gradient-dark">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold mb-4 text-[#f5f5f5]"><?php we('home_portfolio_title'); ?></h2>
            <p class="text-gray-300 max-w-2xl mx-auto"><?php we('home_portfolio_desc'); ?></p>
        </div>
        <div class="portfolio-grid">
            <?php
            // Portfolio images tetap dari Customizer (Portfolio Settings)
            for ($i = 1; $i <= 6; $i++) {
                $img_id = get_theme_mod("nusatatto_portfolio_img{$i}", '');
                $img_url = $img_id ? wp_get_attachment_image_url($img_id, 'full') : get_template_directory_uri() . "/assets/images/portfolio-{$i}.jpg";
                $img_title = get_theme_mod("nusatatto_portfolio_img{$i}_title", '');
                $img_desc = get_theme_mod("nusatatto_portfolio_img{$i}_desc", '');

                // Only show if image exists
                if ($img_id || file_exists(get_template_directory() . "/assets/images/portfolio-{$i}.jpg")) :
            ?>
            <!-- Portfolio Item <?php echo $i; ?> -->
            <div class="portfolio-item stagger-item cursor-pointer" onclick="openPortfolioModal(<?php echo $i; ?>)">
                <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_title ? $img_title : 'Portfolio Image ' . $i); ?>">
                <div class="portfolio-overlay">
                    <div class="text-center text-[#f5f5f5]">
                        <?php if ($img_title) : ?>
                        <div class="text-lg font-semibold mb-2"><?php echo esc_html($img_title); ?></div>
                        <?php endif; ?>
                        <?php if ($img_desc) : ?>
                        <div class="text-sm text-gray-300"><?php echo esc_html($img_desc); ?></div>
                        <?php else : ?>
                        <div class="text-sm text-gray-300">Click to view full size</div>
                        <?php endif; ?>
                        <div class="mt-2">
                            <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                endif;
            }
            ?>
        </div>
    </div>
</section>

<!-- Why Us Section -->
<section id="why-us" class="py-20 px-4 bg-gradient-dark">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-4xl font-bold text-center mb-16 text-[#f5f5f5]"><?php we('home_whyus_title'); ?></h2>
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="glass-lg p-8 rounded-2xl hover-lift stagger-item">
                <div class="mb-4 text-[#d4af37]">
                    <svg class="w-12 h-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-3 text-[#f5f5f5]"><?php we('home_feature1_title'); ?></h3>
                <p class="text-gray-300"><?php we('home_feature1_desc'); ?></p>
            </div>

            <!-- Feature 2 -->
            <div class="glass-lg p-8 rounded-2xl hover-lift stagger-item">
                <div class="mb-4 text-[#d4af37]">
                    <svg class="w-12 h-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M8 14s1.5 2 4 2 4-2 4-2"/>
                        <line x1="9" y1="9" x2="9.01" y2="9"/>
                        <line x1="15" y1="9" x2="15.01" y2="9"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-3 text-[#f5f5f5]"><?php we('home_feature2_title'); ?></h3>
                <p class="text-gray-300"><?php we('home_feature2_desc'); ?></p>
            </div>

            <!-- Feature 3 -->
            <div class="glass-lg p-8 rounded-2xl hover-lift stagger-item">
                <div class="mb-4 text-[#d4af37]">
                    <svg class="w-12 h-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-3 text-[#f5f5f5]"><?php we('home_feature3_title'); ?></h3>
                <p class="text-gray-300"><?php we('home_feature3_desc'); ?></p>
            </div>

            <!-- Feature 4 -->
            <div class="glass-lg p-8 rounded-2xl hover-lift stagger-item">
                <div class="mb-4 text-[#d4af37]">
                    <svg class="w-12 h-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                        <circle cx="12" cy="10" r="3"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-3 text-[#f5f5f5]"><?php we('home_feature4_title'); ?></h3>
                <p class="text-gray-300"><?php we('home_feature4_desc'); ?></p>
            </div>

            <!-- Feature 5 -->
            <div class="glass-lg p-8 rounded-2xl hover-lift stagger-item">
                <div class="mb-4 text-[#d4af37]">
                    <svg class="w-12 h-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                        <polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-3 text-[#f5f5f5]"><?php we('home_feature5_title'); ?></h3>
                <p class="text-gray-300"><?php we('home_feature5_desc'); ?></p>
            </div>

            <!-- Feature 6 -->
            <div class="glass-lg p-8 rounded-2xl hover-lift stagger-item">
                <div class="mb-4 text-[#d4af37]">
                    <svg class="w-12 h-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="1" x2="12" y2="23"/>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-3 text-[#f5f5f5]"><?php we('home_feature6_title'); ?></h3>
                <p class="text-gray-300"><?php we('home_feature6_desc'); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- Tattoo Styles & Pricing — commercial intent + AI-extractable -->
<section id="pricing" class="py-20 px-4 bg-gradient-dark">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold mb-4 text-[#f5f5f5]"><?php we('home_pricing_title'); ?></h2>
            <p class="text-gray-300 max-w-2xl mx-auto"><?php we_html('home_pricing_intro'); ?></p>
        </div>
        <div class="glass-lg rounded-2xl overflow-x-auto">
            <table class="w-full text-left min-w-[520px]">
                <thead>
                    <tr class="border-b border-white border-opacity-10 text-[#f5f5f5]">
                        <th class="px-6 py-4 font-semibold">Size</th>
                        <th class="px-6 py-4 font-semibold">Best for</th>
                        <th class="px-6 py-4 font-semibold text-right">Starting price</th>
                    </tr>
                </thead>
                <tbody class="text-gray-300">
                    <tr class="border-b border-white border-opacity-5">
                        <td class="px-6 py-4 font-medium text-[#f5f5f5]"><?php we('home_price1_size'); ?></td>
                        <td class="px-6 py-4"><?php we('home_price1_for'); ?></td>
                        <td class="px-6 py-4 text-right font-bold text-[#d4af37]"><?php we('home_price1_amount'); ?></td>
                    </tr>
                    <tr class="border-b border-white border-opacity-5">
                        <td class="px-6 py-4 font-medium text-[#f5f5f5]"><?php we('home_price2_size'); ?></td>
                        <td class="px-6 py-4"><?php we('home_price2_for'); ?></td>
                        <td class="px-6 py-4 text-right font-bold text-[#d4af37]"><?php we('home_price2_amount'); ?></td>
                    </tr>
                    <tr class="border-b border-white border-opacity-5">
                        <td class="px-6 py-4 font-medium text-[#f5f5f5]"><?php we('home_price3_size'); ?></td>
                        <td class="px-6 py-4"><?php we('home_price3_for'); ?></td>
                        <td class="px-6 py-4 text-right font-bold text-[#d4af37]"><?php we('home_price3_amount'); ?></td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 font-medium text-[#f5f5f5]"><?php we('home_price4_size'); ?></td>
                        <td class="px-6 py-4"><?php we('home_price4_for'); ?></td>
                        <td class="px-6 py-4 text-right font-bold text-[#d4af37]"><?php we('home_price4_amount'); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="text-center mt-8">
            <a href="<?php echo $book_url; ?>" class="inline-block btn-glass-accent px-8 py-4 rounded-full font-semibold"><?php we('home_pricing_btn'); ?></a>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section id="faq" class="py-20 px-4 bg-gradient-dark">
    <div class="max-w-3xl mx-auto">
        <h2 class="text-4xl font-bold text-center mb-16 text-[#f5f5f5]"><?php we('home_faq_title'); ?></h2>
        <div class="glass-lg p-8 rounded-2xl">
            <?php for ($i = 1; $i <= 8; $i++) : ?>
            <!-- FAQ Item <?php echo $i; ?> -->
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span class="font-semibold"><?php we("home_faq{$i}_q"); ?></span>
                    <svg class="faq-icon w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M7 10l5 5 5-5z"/>
                    </svg>
                </div>
                <div class="faq-answer">
                    <p class="text-gray-300"><?php we("home_faq{$i}_a"); ?></p>
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </div>
</section>

<!-- Location Section -->
<section class="py-20 px-4 bg-gradient-dark">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-4xl font-bold text-center mb-16 text-[#f5f5f5]"><?php we('home_location_title'); ?></h2>
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="glass-lg p-8 rounded-2xl">
                <h3 class="text-2xl font-semibold mb-6 text-[#f5f5f5]"><?php we('home_location_studio_name'); ?></h3>
                <div class="space-y-4 text-gray-300">
                    <div class="flex gap-4">
                        <svg class="flex-shrink-0 mt-1 text-[#d4af37] w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                        <div>
                            <div class="font-semibold text-[#f5f5f5]">Address</div>
                            <div><?php echo nl2br(esc_html($address)); ?></div>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <svg class="flex-shrink-0 mt-1 text-[#d4af37] w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                        </svg>
                        <div>
                            <div class="font-semibold text-[#f5f5f5]">Phone &amp; WhatsApp</div>
                            <div><a href="tel:<?php echo esc_attr($tel_link); ?>" class="hover:text-[#d4af37] transition-colors"><?php echo esc_html($phone); ?></a></div>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <svg class="flex-shrink-0 mt-1 text-[#d4af37] w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                            <line x1="16" y1="2" x2="16" y2="6"/>
                            <line x1="8" y1="2" x2="8" y2="6"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                        <div>
                            <div class="font-semibold text-[#f5f5f5]">Operating Hours</div>
                            <div><?php we('home_location_hours'); ?></div>
                            <div class="text-sm text-[#d4af37] mt-1"><?php we('home_location_walkin'); ?></div>
                        </div>
                    </div>
                </div>
                <div class="mt-8">
                    <p class="text-gray-300 mb-4"><?php we('home_location_intro'); ?></p>
                    <a href="<?php echo esc_url($wa_book); ?>" target="_blank" class="inline-block btn-glass-accent px-6 py-3 rounded-full font-semibold">
                        <?php we('home_location_btn'); ?>
                    </a>
                </div>
            </div>
            <div class="rounded-2xl overflow-hidden glass h-[450px]">
                <?php
                // DWIKI TATTOO map embed — dipakai sebagai fallback agar peta selalu tampil
                // walau field wording belum tersimpan/ter-deploy.
                $map_default = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3363.725387926036!2d115.48627867425559!3d-8.688486688492038!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd27362a09af4b3%3A0x70c52eca4430326f!2sDWIKI%20TATTOO!5e1!3m2!1sen!2sid!4v1780812458579!5m2!1sen!2sid';
                $google_maps_url = w('home_map_embed', $map_default);

                if (!empty($google_maps_url) && filter_var($google_maps_url, FILTER_VALIDATE_URL)) {
                    ?>
                    <iframe src="<?php echo esc_url($google_maps_url); ?>"
                            width="100%"
                            height="450"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            class="w-full h-full">
                    </iframe>
                    <?php
                } else {
                    $location_img = get_template_directory_uri() . '/assets/images/location-map.jpg';
                    if (file_exists(get_template_directory() . '/assets/images/location-map.jpg')) {
                        ?>
                        <img src="<?php echo esc_url($location_img); ?>" alt="Nusa Penida Tattoo Studio Location" class="w-full h-full object-cover">
                        <?php
                    } else {
                        ?>
                        <div class="w-full h-full flex items-center justify-center bg-gray-800">
                            <div class="text-center p-8">
                                <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <p class="text-gray-400">Set Google Maps Embed URL di Theme Wording → Homepage → Location</p>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</section>

<section id="reviews" class="py-16 bg-black text-white">
  <div class="max-w-6xl mx-auto px-4 text-center">
    <h2 class="text-4xl font-bold mb-8"><?php we('home_reviews_title'); ?></h2>
    <p class="text-gray-400 mb-12 max-w-2xl mx-auto">
      <?php we('home_reviews_subtitle'); ?>
    </p>

    <div class="grid md:grid-cols-3 gap-8">
      <?php for ($i = 1; $i <= 3; $i++) : ?>
      <div class="p-6 rounded-2xl bg-gray-900 shadow-lg border border-gray-800">
        <div class="flex justify-center mb-3 text-yellow-400">
          ⭐⭐⭐⭐⭐
        </div>
        <p class="italic mb-4">
          “<?php we("home_review{$i}_text"); ?>”
        </p>
        <h4 class="font-semibold"><?php we("home_review{$i}_name"); ?></h4>
      </div>
      <?php endfor; ?>
    </div>
  </div>
</section>


<!-- CTA Section -->
<section class="py-20 px-4 bg-gradient-dark">
    <div class="max-w-4xl mx-auto text-center">
        <div class="glass-lg p-12 rounded-2xl">
            <h2 class="text-4xl font-bold mb-6 text-[#f5f5f5]"><?php we('home_cta_title'); ?></h2>
            <p class="text-xl text-gray-300 mb-8"><?php we('home_cta_text'); ?></p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="<?php echo $book_url; ?>" class="btn-glass-accent px-8 py-4 rounded-full font-semibold hover-lift">
                    <?php we('home_cta_btn_primary'); ?>
                </a>
                <a href="<?php echo esc_url($wa_book); ?>" target="_blank" rel="noopener" class="glass-lg px-8 py-4 rounded-full font-semibold hover-lift text-[#f5f5f5]">
                    <?php we('home_cta_btn_whatsapp'); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Portfolio Modal -->
<div id="portfolioModal" class="modal" onclick="closePortfolioModal(event)">
    <span class="modal-close" onclick="closePortfolioModal(event)">&times;</span>

    <div class="modal-content-wrapper">
        <img id="modalImage" src="" alt="Portfolio Image" class="modal-img">
        <div id="modalCaption" class="modal-caption"></div>
    </div>
</div>

<script>
// Portfolio modal data
const portfolioData = [
    <?php
    for ($i = 1; $i <= 6; $i++) {
        $img_id = get_theme_mod("nusatatto_portfolio_img{$i}", '');
        $img_url = $img_id ? wp_get_attachment_image_url($img_id, 'full') : get_template_directory_uri() . "/assets/images/portfolio-{$i}.jpg";
        $img_title = get_theme_mod("nusatatto_portfolio_img{$i}_title", '');
        $img_desc = get_theme_mod("nusatatto_portfolio_img{$i}_desc", '');

        if ($img_id || file_exists(get_template_directory() . "/assets/images/portfolio-{$i}.jpg")) {
            echo "{";
            echo "url: '" . esc_js($img_url) . "',";
            echo "title: '" . esc_js($img_title) . "',";
            echo "desc: '" . esc_js($img_desc) . "'";
            echo "},\n";
        }
    }
    ?>
];

let currentPortfolioIndex = 0;

function openPortfolioModal(index) {
    currentPortfolioIndex = index - 1; // Convert to 0-based index
    const modal = document.getElementById('portfolioModal');
    const modalImage = document.getElementById('modalImage');
    const modalCaption = document.getElementById('modalCaption');

    if (portfolioData[currentPortfolioIndex]) {
        modalImage.src = portfolioData[currentPortfolioIndex].url;

        let captionHTML = '';
        if (portfolioData[currentPortfolioIndex].title) {
            captionHTML += '<div class="text-lg font-semibold mb-2">' + portfolioData[currentPortfolioIndex].title + '</div>';
        }
        if (portfolioData[currentPortfolioIndex].desc) {
            captionHTML += '<div class="text-sm text-gray-300">' + portfolioData[currentPortfolioIndex].desc + '</div>';
        }
        modalCaption.innerHTML = captionHTML;

        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
}

function closePortfolioModal(event) {
    if (event) {
        event.stopPropagation();
    }
    const modal = document.getElementById('portfolioModal');
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
}

function navigatePortfolio(direction, event) {
    if (event) {
        event.stopPropagation();
    }

    currentPortfolioIndex += direction;

    // Loop around
    if (currentPortfolioIndex < 0) {
        currentPortfolioIndex = portfolioData.length - 1;
    } else if (currentPortfolioIndex >= portfolioData.length) {
        currentPortfolioIndex = 0;
    }

    const modalImage = document.getElementById('modalImage');
    const modalCaption = document.getElementById('modalCaption');

    // Fade out effect
    modalImage.style.opacity = '0';

    setTimeout(() => {
        modalImage.src = portfolioData[currentPortfolioIndex].url;

        let captionHTML = '';
        if (portfolioData[currentPortfolioIndex].title) {
            captionHTML += '<div class="text-lg font-semibold mb-2">' + portfolioData[currentPortfolioIndex].title + '</div>';
        }
        if (portfolioData[currentPortfolioIndex].desc) {
            captionHTML += '<div class="text-sm text-gray-300">' + portfolioData[currentPortfolioIndex].desc + '</div>';
        }
        modalCaption.innerHTML = captionHTML;

        // Fade in effect
        modalImage.style.opacity = '1';
    }, 200);
}

// Keyboard navigation
document.addEventListener('keydown', function(event) {
    const modal = document.getElementById('portfolioModal');
    if (modal.style.display === 'flex') {
        if (event.key === 'Escape') {
            closePortfolioModal();
        } else if (event.key === 'ArrowLeft') {
            navigatePortfolio(-1);
        } else if (event.key === 'ArrowRight') {
            navigatePortfolio(1);
        }
    }
});
</script>

<?php get_template_part('template-parts/footer'); ?>
