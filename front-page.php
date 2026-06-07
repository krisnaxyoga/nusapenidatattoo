<?php get_template_part('template-parts/header'); ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [

    {
      "@type": "TattooParlor",
      "@id": "https://nusapenidatattoo.com/#tattoo-studio",
      "name": "Nusa Penida Tattoo",
      "url": "https://nusapenidatattoo.com/",
      "logo": "https://nusapenidatattoo.com/wp-content/uploads/2025/10/nusa-penida-tatto.png",
      "image": [
        "https://nusapenidatattoo.com/wp-content/uploads/2025/10/anime-tatto-naruto-nusapenidattato.webp",
        "https://nusapenidatattoo.com/wp-content/uploads/2025/10/manta-animal-and-traditional-balinese-tatto-nusapenidatto.webp"
      ],
      "description": "Professional tattoo studio in Nusa Penida, Bali, specializing in fine line and minimalist tattoos for international travelers. Safe, sterile, and custom tattoo designs.",
      "priceRange": "$$",
      "telephone": "+6285792283479",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Nusa Penida",
        "addressLocality": "Nusa Penida",
        "addressRegion": "Bali",
        "addressCountry": "ID"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": "-8.7278",
        "longitude": "115.5444"
      },
      "openingHoursSpecification": {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday",
          "Sunday"
        ],
        "opens": "10:00",
        "closes": "21:00"
      },
      "sameAs": [
        "https://www.instagram.com/dwiki_balinusa",
        "https://www.tiktok.com/@dwiki_balinusa",
        "https://wa.me/6285792283479"
      ],
      "areaServed": {
        "@type": "TouristDestination",
        "name": "Nusa Penida, Bali"
      },
      "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "4.8",
        "bestRating": "5",
        "ratingCount": "27"
      },
      "makesOffer": {
        "@type": "Offer",
        "itemOffered": [
          {
            "@type": "Service",
            "name": "Fineline Tattoo",
            "description": "Minimalist and fine line tattoo designs ideal for travelers visiting Bali."
          },
          {
            "@type": "Service",
            "name": "Custom Tattoo Design",
            "description": "Personalized tattoo designs created by professional tattoo artists."
          }
        ]
      }
    },

    {
      "@type": "FAQPage",
      "@id": "https://nusapenidatattoo.com/#faq",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "Is fineline tattoo suitable for first-time tattoo clients?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Yes. Fineline tattoos are ideal for first-time clients because they are minimalist, less painful, and heal faster compared to larger tattoo styles."
          }
        },
        {
          "@type": "Question",
          "name": "Is it safe to get a tattoo while traveling in Nusa Penida?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Yes. Nusa Penida Tattoo follows strict hygiene standards using sterile equipment and professional procedures, making it safe for international travelers."
          }
        },
        {
          "@type": "Question",
          "name": "How long does a fineline tattoo take to heal?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Fineline tattoos usually heal within 7–14 days. Proper aftercare is essential, especially when traveling in tropical climates like Bali."
          }
        },
        {
          "@type": "Question",
          "name": "Can I book a tattoo appointment online?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Yes. You can easily book your tattoo session via WhatsApp or social media before or during your visit to Nusa Penida."
          }
        }
      ]
    },

    {
      "@type": "Review",
      "@id": "https://nusapenidatattoo.com/#review-1",
      "itemReviewed": {
        "@type": "TattooParlor",
        "name": "Nusa Penida Tattoo"
      },
      "author": {
        "@type": "Person",
        "name": "International Traveler"
      },
      "reviewRating": {
        "@type": "Rating",
        "ratingValue": "5",
        "bestRating": "5"
      },
      "reviewBody": "Amazing fineline tattoo experience in Nusa Penida. Very clean studio, professional artist, and perfect for travelers looking for minimalist tattoo designs."
    }

  ]
}
</script>


<!-- Hero Section -->
<?php
$hero_headline = get_theme_mod('nusatatto_hero_headline', 'Nusa Penida Tattoo – Ink Your Island Story');
$hero_description = get_theme_mod('nusatatto_hero_description', 'Experience the art of tattooing in paradise. Our certified artists in Nusa Penida create custom designs that tell your Bali story — with care, creativity, and clean precision.');
$hero_bg_id = get_theme_mod('nusatatto_hero_bg', '');
$hero_bg_url = $hero_bg_id ? wp_get_attachment_image_url($hero_bg_id, 'full') : get_template_directory_uri() . '/assets/images/hero-bg.jpg';
$whatsapp = get_theme_mod('nusatatto_whatsapp', '6285792283479');
?>
<section class="hero bg-gradient-dark">
    <!-- Background Image Overlay -->
    <div class="hero-bg-overlay" style="background-image: url('<?php echo esc_url($hero_bg_url); ?>');"></div>

    <div class="hero-content max-w-4xl mx-auto px-4 relative z-10 text-center">
        <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight text-[#f5f5f5]">
            <?php echo esc_html($hero_headline); ?>
        </h1>
        <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">
            <?php echo esc_html($hero_description); ?>
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="https://wa.me/<?php echo esc_attr($whatsapp); ?>?text=Hello,Nusa Penida Tattoo%20I%20want%20to%20book%20a%20tattoo%20session" target="_blank" class="btn-glass-accent px-8 py-4 rounded-full font-semibold hover-lift">
                Book Your Tattoo
            </a>
            <a href="#portfolio" class="glass-lg px-8 py-4 rounded-full font-semibold hover-lift text-[#f5f5f5]">
                View Our Portfolio
            </a>
        </div>
    </div>
</section>

<!-- About Section -->
<?php
$about_title = get_theme_mod('nusatatto_about_title', 'Authentic Tattoo Studio in Nusa Penida');
$about_desc1 = get_theme_mod('nusatatto_about_desc1', 'At Nusa Penida Tattoo, we blend world-class tattoo artistry with the island\'s natural beauty. Our professional team offers a safe, hygienic, and welcoming space for travelers seeking meaningful tattoos — inspired by the ocean, island life, and personal stories.');
$about_desc2 = get_theme_mod('nusatatto_about_desc2', 'Whether it\'s your first ink or your next masterpiece, our artists will make it unforgettable.');
$about_img_id = get_theme_mod('nusatatto_about_image', '');
$about_img_url = $about_img_id ? wp_get_attachment_image_url($about_img_id, 'full') : get_template_directory_uri() . '/assets/images/about-studio.jpg';
$stat1_num = get_theme_mod('nusatatto_stat1_number', '500+');
$stat1_label = get_theme_mod('nusatatto_stat1_label', 'Happy Clients');
$stat2_num = get_theme_mod('nusatatto_stat2_number', '10+');
$stat2_label = get_theme_mod('nusatatto_stat2_label', 'Years Experience');
$stat3_num = get_theme_mod('nusatatto_stat3_number', '100%');
$stat3_label = get_theme_mod('nusatatto_stat3_label', 'Satisfaction');
?>
<section id="about" class="py-20 px-4 bg-gradient-dark">
    <div class="max-w-6xl mx-auto">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="animate-fade-in-up">
                <img src="<?php echo esc_url($about_img_url); ?>" alt="<?php echo esc_attr($about_title); ?>" class="rounded-2xl glass">
            </div>
            <div class="animate-slide-in-left">
                <h2 class="text-4xl font-bold mb-6 text-[#f5f5f5]"><?php echo esc_html($about_title); ?></h2>
                <p class="text-gray-300 mb-4 leading-relaxed">
                    <?php echo esc_html($about_desc1); ?>
                </p>
                <p class="text-gray-300 mb-8 leading-relaxed">
                    <?php echo esc_html($about_desc2); ?>
                </p>
                <div class="grid grid-cols-3 gap-4">
                    <div class="glass p-4 rounded-lg text-center">
                        <div class="text-3xl font-bold text-[#d4af37] mb-2"><?php echo esc_html($stat1_num); ?></div>
                        <div class="text-sm text-gray-400"><?php echo esc_html($stat1_label); ?></div>
                    </div>
                    <div class="glass p-4 rounded-lg text-center">
                        <div class="text-3xl font-bold text-[#d4af37] mb-2"><?php echo esc_html($stat2_num); ?></div>
                        <div class="text-sm text-gray-400"><?php echo esc_html($stat2_label); ?></div>
                    </div>
                    <div class="glass p-4 rounded-lg text-center">
                        <div class="text-3xl font-bold text-[#d4af37] mb-2"><?php echo esc_html($stat3_num); ?></div>
                        <div class="text-sm text-gray-400"><?php echo esc_html($stat3_label); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Portfolio Section -->
<?php
$portfolio_title = get_theme_mod('nusatatto_portfolio_title', 'Our Work Speaks for Itself');
$portfolio_desc = get_theme_mod('nusatatto_portfolio_desc', 'From fine-line art to bold tribal pieces — each tattoo is crafted with precision and passion.');
?>
<section id="portfolio" class="py-20 px-4 bg-gradient-dark">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold mb-4 text-[#f5f5f5]"><?php echo esc_html($portfolio_title); ?></h2>
            <p class="text-gray-300 max-w-2xl mx-auto"><?php echo esc_html($portfolio_desc); ?></p>
        </div>
        <div class="portfolio-grid">
            <?php
            // Loop through 6 portfolio items
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
        <h2 class="text-4xl font-bold text-center mb-16 text-[#f5f5f5]">Why Choose Nusa Penida Tattoo</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="glass-lg p-8 rounded-2xl hover-lift stagger-item">
                <div class="mb-4 text-[#d4af37]">
                    <svg class="w-12 h-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-3 text-[#f5f5f5]">Certified & Experienced Artists</h3>
                <p class="text-gray-300">Professional team with international certification and impressive portfolios to bring your vision to life.</p>
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
                <h3 class="text-xl font-semibold mb-3 text-[#f5f5f5]">100% Hygienic, Sterile Equipment</h3>
                <p class="text-gray-300">Using premium ink and sterile equipment for the best results and maximum safety for every client.</p>
            </div>

            <!-- Feature 3 -->
            <div class="glass-lg p-8 rounded-2xl hover-lift stagger-item">
                <div class="mb-4 text-[#d4af37]">
                    <svg class="w-12 h-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-3 text-[#f5f5f5]">Custom Designs, Island Inspiration</h3>
                <p class="text-gray-300">In-depth discussion about design, size, and placement to create your perfect tattoo inspired by island life.</p>
            </div>

            <!-- Feature 4 -->
            <div class="glass-lg p-8 rounded-2xl hover-lift stagger-item">
                <div class="mb-4 text-[#d4af37]">
                    <svg class="w-12 h-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                        <circle cx="12" cy="10" r="3"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-3 text-[#f5f5f5]">English-Speaking Staff</h3>
                <p class="text-gray-300">Our team speaks fluent English to ensure clear communication and understanding of your tattoo vision.</p>
            </div>

            <!-- Feature 5 -->
            <div class="glass-lg p-8 rounded-2xl hover-lift stagger-item">
                <div class="mb-4 text-[#d4af37]">
                    <svg class="w-12 h-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                        <polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-3 text-[#f5f5f5]">Easy WhatsApp Booking & Fast Replies</h3>
                <p class="text-gray-300">Complete aftercare guidance and post-service support for optimal healing and results.</p>
            </div>

            <!-- Feature 6 -->
            <div class="glass-lg p-8 rounded-2xl hover-lift stagger-item">
                <div class="mb-4 text-[#d4af37]">
                    <svg class="w-12 h-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="1" x2="12" y2="23"/>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-3 text-[#f5f5f5]">Competitive Pricing</h3>
                <p class="text-gray-300">Affordable pricing packages without sacrificing quality and professionalism in every work.</p>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section id="faq" class="py-20 px-4 bg-gradient-dark">
    <div class="max-w-3xl mx-auto">
        <h2 class="text-4xl font-bold text-center mb-16 text-[#f5f5f5]">Frequently Asked Questions</h2>
        <div class="glass-lg p-8 rounded-2xl">
            <!-- FAQ Item 1 -->
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span class="font-semibold">Do I need to book in advance?</span>
                    <svg class="faq-icon w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M7 10l5 5 5-5z"/>
                    </svg>
                </div>
                <div class="faq-answer">
                    <p class="text-gray-300">We recommend booking 1–2 days in advance, especially during high season to ensure availability of our artists.</p>
                </div>
            </div>

            <!-- FAQ Item 2 -->
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span class="font-semibold">Is your studio clean and safe?</span>
                    <svg class="faq-icon w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M7 10l5 5 5-5z"/>
                    </svg>
                </div>
                <div class="faq-answer">
                    <p class="text-gray-300">Absolutely. We follow strict hygiene standards, using sterile needles and professional-grade ink for every client.</p>
                </div>
            </div>

            <!-- FAQ Item 3 -->
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span class="font-semibold">Can I bring my own design?</span>
                    <svg class="faq-icon w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M7 10l5 5 5-5z"/>
                    </svg>
                </div>
                <div class="faq-answer">
                    <p class="text-gray-300">Yes! Our artists love collaborating on custom designs that fit your story and bring your vision to life.</p>
                </div>
            </div>

            <!-- FAQ Item 4 -->
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span class="font-semibold">How long does it take?</span>
                    <svg class="faq-icon w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M7 10l5 5 5-5z"/>
                    </svg>
                </div>
                <div class="faq-answer">
                    <p class="text-gray-300">Depends on size and detail — our team will guide you during consultation. Typically ranges from 1-4 hours.</p>
                </div>
            </div>

            <!-- FAQ Item 5 -->
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span class="font-semibold">What about aftercare?</span>
                    <svg class="faq-icon w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M7 10l5 5 5-5z"/>
                    </svg>
                </div>
                <div class="faq-answer">
                    <p class="text-gray-300">We provide complete aftercare guidance and support to ensure optimal healing and long-lasting results for your tattoo.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Location Section -->
<section class="py-20 px-4 bg-gradient-dark">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-4xl font-bold text-center mb-16 text-[#f5f5f5]">Find Us in the Heart of Nusa Penida</h2>
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="glass-lg p-8 rounded-2xl">
                <h3 class="text-2xl font-semibold mb-6 text-[#f5f5f5]">Nusa Penida Tattoo Studio</h3>
                <div class="space-y-4 text-gray-300">
                    <div class="flex gap-4">
                        <svg class="flex-shrink-0 mt-1 text-[#d4af37] w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                        <div>
                            <div class="font-semibold text-[#f5f5f5]">Address</div>
                            <div>Jl. Raya Nusa Penida, Bali 80771</div>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <svg class="flex-shrink-0 mt-1 text-[#d4af37] w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                        </svg>
                        <div>
                            <div class="font-semibold text-[#f5f5f5]">Phone</div>
                            <div>+62 813-3756-7256</div>
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
                            <div>Monday - Sunday: 10:00 AM - 8:00 PM</div>
                        </div>
                    </div>
                </div>
                <div class="mt-8">
                    <p class="text-gray-300 mb-4">We're located just minutes from the harbor — easy to reach for travelers staying in Toyapakeh, Crystal Bay, or anywhere on the island.</p>
                    <a href="https://wa.me/6285792283479?text=Hello,%20I%20want%20to%20book%20a%20tattoo%20session" target="_blank" class="inline-block btn-glass-accent px-6 py-3 rounded-full font-semibold">
                        Book via WhatsApp
                    </a>
                </div>
            </div>
            <div class="rounded-2xl overflow-hidden glass h-[450px]">
                <?php
                $google_maps_url = get_theme_mod('nusatatto_google_maps', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63081.45856797374!2d115.47419427910156!3d-8.729167099999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd244e04111b941%3A0x5030bfbca82fd40!2sNusa%20Penida%2C%20Klungkung%20Regency%2C%20Bali%2C%20Indonesia!5e0!3m2!1sen!2s!4v1234567890123!5m2!1sen!2s');

                if (!empty($google_maps_url) && filter_var($google_maps_url, FILTER_VALIDATE_URL)) {
                    // Display Google Maps iframe
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
                    // Fallback to location image if available
                    $location_img = get_template_directory_uri() . '/assets/images/location-map.jpg';
                    if (file_exists(get_template_directory() . '/assets/images/location-map.jpg')) {
                        ?>
                        <img src="<?php echo esc_url($location_img); ?>" alt="Nusa Penida Tattoo Studio Location" class="w-full h-full object-cover">
                        <?php
                    } else {
                        // Fallback placeholder
                        ?>
                        <div class="w-full h-full flex items-center justify-center bg-gray-800">
                            <div class="text-center p-8">
                                <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <p class="text-gray-400">Google Maps akan ditampilkan di sini</p>
                                <p class="text-sm text-gray-500 mt-2">Set URL di WordPress Customizer → Contact Info</p>
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
    <h2 class="text-4xl font-bold mb-8">Our Clients Love the Studio</h2>
    <p class="text-gray-400 mb-12 max-w-2xl mx-auto">
      Hear what our happy clients say about their tattoo experience in Nusa Penida.
    </p>

    <div class="grid md:grid-cols-3 gap-8">
      <div class="p-6 rounded-2xl bg-gray-900 shadow-lg border border-gray-800">
        <div class="flex justify-center mb-3 text-yellow-400">
          ⭐⭐⭐⭐⭐
        </div>
        <p class="italic mb-4">
          “Amazing tattoo experience in Nusa Penida! Clean studio, friendly artists, and professional service.”
        </p>
        <h4 class="font-semibold">Emily Carter</h4>
      </div>

      <div class="p-6 rounded-2xl bg-gray-900 shadow-lg border border-gray-800">
        <div class="flex justify-center mb-3 text-yellow-400">
          ⭐⭐⭐⭐⭐
        </div>
        <p class="italic mb-4">
          “Best tattoo studio in Nusa Penida. Highly recommended!”
        </p>
        <h4 class="font-semibold">Wayan Putra</h4>
      </div>

      <div class="p-6 rounded-2xl bg-gray-900 shadow-lg border border-gray-800">
        <div class="flex justify-center mb-3 text-yellow-400">
          ⭐⭐⭐⭐⭐
        </div>
        <p class="italic mb-4">
          “Super clean, safe, and creative tattoo artists. Totally worth visiting!”
        </p>
        <h4 class="font-semibold">Sophie Lee</h4>
      </div>
    </div>
  </div>
</section>


<!-- CTA Section -->
<section class="py-20 px-4 bg-gradient-dark">
    <div class="max-w-4xl mx-auto text-center">
        <div class="glass-lg p-12 rounded-2xl">
            <h2 class="text-4xl font-bold mb-6 text-[#f5f5f5]">Ready for Your Dream Tattoo?</h2>
            <p class="text-xl text-gray-300 mb-8">Book your tattoo session today and make your Bali trip unforgettable.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="https://wa.me/6285792283479?text=Hello,%20I%20want%20to%20book%20a%20tattoo%20session" target="_blank" class="btn-glass-accent px-8 py-4 rounded-full font-semibold hover-lift">
                    Contact Now
                </a>
                <a href="https://wa.me/6285792283479?text=Hello,%20I%20have%20a%20question%20about%20tattoo%20services" target="_blank" class="glass-lg px-8 py-4 rounded-full font-semibold hover-lift text-[#f5f5f5]">
                    Chat WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Portfolio Modal -->
<div id="portfolioModal" class="modal" onclick="closePortfolioModal(event)">
    <span class="modal-close" onclick="closePortfolioModal(event)">&times;</span>

<!--     <button class="modal-nav modal-nav-prev" onclick="navigatePortfolio(-1, event)">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
    </button>

    <button class="modal-nav modal-nav-next" onclick="navigatePortfolio(1, event)">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
    </button> -->

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
