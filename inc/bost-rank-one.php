<?php
/**
 * inc/bost-rank-one.php
 * =============================================================================
 * BOOST RANK ONE — SEO Engine untuk Nusa Penida Tattoo
 * =============================================================================
 *
 * Tujuan: memperkuat SEO teknis di SELURUH halaman agar Google mudah
 * memahami & menyukai situs (E-E-A-T), preview share di WhatsApp/sosmed
 * menarik (mendorong chat), dan Core Web Vitals membaik (mendorong ranking).
 *
 * CATATAN JUJUR:
 * File ini adalah FONDASI TEKNIS. Tidak ada skrip yang bisa MENJAMIN rank #1
 * atau jumlah client tertentu. Ranking = fondasi teknis (file ini) + konten
 * berkualitas + review Google + backlink + waktu. Lihat checklist di bagian
 * paling bawah file ini untuk langkah non-teknis yang WAJIB dilakukan.
 *
 * Yang dikerjakan file ini:
 *  1.  KONFIGURASI bisnis (NAP) — sumber data tunggal, ambil dari customizer.
 *  2.  META DESCRIPTION dinamis per halaman.
 *  3.  CANONICAL URL terpadu (anti duplicate content).
 *  4.  OPEN GRAPH + TWITTER CARD (preview cantik di WA/FB/IG/X).
 *  5.  ROBOTS meta cerdas (index halaman penting, noindex halaman tipis).
 *  6.  SCHEMA WebSite + Breadcrumb (sitelinks & rich result).
 *  7.  PERFORMANCE: preconnect, dns-prefetch, hapus bloat WordPress.
 *  8.  SITEMAP + robots.txt: pastikan aktif & terdaftar.
 *  9.  ALT gambar otomatis (aksesibilitas + image SEO).
 *  10. Judul halaman (title) yang rapi & branded.
 *
 * @package nusatatto
 */

// Cegah akses langsung
if (!defined('ABSPATH')) {
    exit;
}

/* =============================================================================
   1. KONFIGURASI BISNIS (NAP — Name, Address, Phone)
   Satu sumber data. Ambil dari Customizer bila ada, fallback ke nilai default.
============================================================================= */
function bostrank_config() {
    static $cfg = null;
    if ($cfg !== null) {
        return $cfg;
    }

    $cfg = [
        'name'        => get_theme_mod('nusatatto_site_title', get_bloginfo('name')) ?: 'Nusa Penida Tattoo',
        'description' => get_bloginfo('description') ?: 'Professional tattoo studio in Nusa Penida, Bali — fine line, minimalist & custom tattoo for travelers.',
        'whatsapp'    => preg_replace('/[^0-9]/', '', get_theme_mod('nusatatto_whatsapp', '6285792283479')),
        'phone'       => get_theme_mod('nusatatto_phone', '+6285792283479'),
        'email'       => get_theme_mod('nusatatto_email', ''),
        'address'     => get_theme_mod('nusatatto_address', 'Nusa Penida, Bali, Indonesia'),
        'maps'        => get_theme_mod('nusatatto_google_maps', ''),
        'instagram'   => get_theme_mod('nusatatto_instagram', ''),
        'facebook'    => get_theme_mod('nusatatto_facebook', ''),
        'tiktok'      => get_theme_mod('nusatatto_tiktok', ''),
        // Gambar default untuk share (OG). Prioritas: hero bg → custom logo → site icon.
        'default_image' => bostrank_default_share_image(),
    ];

    return $cfg;
}

/**
 * Tentukan gambar default untuk share / OG image.
 */
function bostrank_default_share_image() {
    $hero = get_theme_mod('nusatatto_hero_bg', '');
    if ($hero) {
        $url = is_numeric($hero) ? wp_get_attachment_url((int) $hero) : $hero;
        if ($url) {
            return $url;
        }
    }

    $logo_id = get_theme_mod('nusatatto_header_logo', '');
    if ($logo_id && is_numeric($logo_id)) {
        $url = wp_get_attachment_url((int) $logo_id);
        if ($url) {
            return $url;
        }
    }

    $icon = get_site_icon_url(512);
    return $icon ?: '';
}

/* =============================================================================
   1b. DETEKSI PLUGIN SEO (ANTI-BENTROK)
   Jika Rank Math / Yoast / AIOSEO / SEOPress / dll AKTIF, plugin tsb sudah
   mengeluarkan meta description, canonical, OG, robots, schema, & sitemap.
   Maka file ini akan MENONAKTIFKAN bagian yang sama agar TIDAK duplikat
   (duplikat tag = sinyal buruk untuk Google). Yang tetap jalan hanyalah
   peningkatan yang AMAN & melengkapi (preconnect, hapus bloat, auto-alt).
============================================================================= */
function bostrank_seo_plugin_active() {
    static $active = null;
    if ($active !== null) {
        return $active;
    }

    $active = false;

    // Deteksi via class/constant/function khas tiap plugin (paling andal).
    if (
        defined('RANK_MATH_VERSION') || class_exists('RankMath')                 // Rank Math
        || defined('WPSEO_VERSION')  || class_exists('WPSEO_Options')            // Yoast SEO
        || defined('AIOSEO_VERSION') || function_exists('aioseo')                // All in One SEO
        || defined('SEOPRESS_VERSION')                                           // SEOPress
        || class_exists('The_SEO_Framework\\Load') || defined('THE_SEO_FRAMEWORK_VERSION') // The SEO Framework
        || defined('SLIM_SEO_VER')   || class_exists('SlimSEO\\Plugin')          // Slim SEO
        || defined('SQ_VERSION')                                                 // Squirrly SEO
    ) {
        $active = true;
    }

    /**
     * Filter agar bisa dipaksa true/false bila perlu.
     * Mis. add_filter('bostrank_seo_plugin_active', '__return_true');
     */
    return $active = (bool) apply_filters('bostrank_seo_plugin_active', $active);
}

/* =============================================================================
   2. META DESCRIPTION DINAMIS
   Deskripsi unik per halaman — kunci agar Google menampilkan snippet relevan.
============================================================================= */
function bostrank_get_description() {
    $cfg  = bostrank_config();
    $desc = '';

    if (is_front_page()) {
        // Front page: pakai hero description bila ada, lalu tagline.
        $desc = get_theme_mod('nusatatto_hero_description', '') ?: $cfg['description'];
    } elseif (is_singular()) {
        global $post;
        if ($post) {
            if (has_excerpt($post)) {
                $desc = get_the_excerpt($post);
            } else {
                $desc = wp_strip_all_tags(strip_shortcodes($post->post_content));
            }
        }
    } elseif (is_category() || is_tag() || is_tax()) {
        $desc = term_description();
    } elseif (is_post_type_archive()) {
        $desc = get_the_archive_description();
    } elseif (is_search()) {
        $desc = sprintf('Hasil pencarian untuk "%s" di %s.', get_search_query(), $cfg['name']);
    } elseif (is_author()) {
        $desc = get_the_author_meta('description');
    }

    // Fallback terakhir: tagline bisnis.
    if (!$desc) {
        $desc = $cfg['description'];
    }

    // Bersihkan & potong ~160 karakter (panjang ideal snippet).
    $desc = wp_strip_all_tags($desc);
    $desc = preg_replace('/\s+/', ' ', trim($desc));
    if (mb_strlen($desc) > 160) {
        $desc = mb_substr($desc, 0, 157) . '…';
    }

    /**
     * Filter agar deskripsi bisa di-override per halaman bila perlu.
     */
    return apply_filters('bostrank_description', $desc);
}

/* =============================================================================
   3 & 4 & 5 & 6. OUTPUT SEMUA TAG SEO KE <head>
   Dipasang via wp_head priority 2 (setelah charset, sebelum aset lain).
============================================================================= */
add_action('wp_head', 'bostrank_output_head_tags', 2);
function bostrank_output_head_tags() {
    // ANTI-BENTROK: plugin SEO sudah mengeluarkan tag ini — jangan duplikat.
    if (bostrank_seo_plugin_active()) {
        return;
    }

    $cfg   = bostrank_config();
    $desc  = bostrank_get_description();
    $title = wp_get_document_title();
    $url   = bostrank_current_url();
    $image = bostrank_get_share_image();

    echo "\n<!-- Boost Rank One SEO -->\n";

    /* ---- META DESCRIPTION ---- */
    if ($desc) {
        printf('<meta name="description" content="%s">' . "\n", esc_attr($desc));
    }

    /* ---- ROBOTS (index/noindex cerdas) ---- */
    printf('<meta name="robots" content="%s">' . "\n", esc_attr(bostrank_robots_value()));

    /* ---- CANONICAL ---- */
    if ($url) {
        printf('<link rel="canonical" href="%s">' . "\n", esc_url($url));
    }

    /* ---- OPEN GRAPH (WhatsApp / Facebook / LinkedIn) ---- */
    $og_type = is_singular(['post']) ? 'article' : 'website';
    printf('<meta property="og:locale" content="%s">' . "\n", esc_attr(get_bloginfo('language') ? str_replace('-', '_', get_bloginfo('language')) : 'en_US'));
    printf('<meta property="og:type" content="%s">' . "\n", esc_attr($og_type));
    printf('<meta property="og:site_name" content="%s">' . "\n", esc_attr($cfg['name']));
    printf('<meta property="og:title" content="%s">' . "\n", esc_attr($title));
    if ($desc) {
        printf('<meta property="og:description" content="%s">' . "\n", esc_attr($desc));
    }
    if ($url) {
        printf('<meta property="og:url" content="%s">' . "\n", esc_url($url));
    }
    if ($image) {
        printf('<meta property="og:image" content="%s">' . "\n", esc_url($image));
        printf('<meta property="og:image:alt" content="%s">' . "\n", esc_attr($title));
    }

    /* ---- TWITTER CARD ---- */
    printf('<meta name="twitter:card" content="%s">' . "\n", $image ? 'summary_large_image' : 'summary');
    printf('<meta name="twitter:title" content="%s">' . "\n", esc_attr($title));
    if ($desc) {
        printf('<meta name="twitter:description" content="%s">' . "\n", esc_attr($desc));
    }
    if ($image) {
        printf('<meta name="twitter:image" content="%s">' . "\n", esc_url($image));
    }

    /* ---- ARTICLE meta (untuk post tunggal) ---- */
    if (is_singular('post')) {
        printf('<meta property="article:published_time" content="%s">' . "\n", esc_attr(get_the_date('c')));
        printf('<meta property="article:modified_time" content="%s">' . "\n", esc_attr(get_the_modified_date('c')));
    }

    /* ---- SCHEMA: WebSite (sitelinks searchbox) — di semua halaman ---- */
    echo bostrank_schema_website($cfg);

    /* ---- SCHEMA: BreadcrumbList — di halaman non-front ---- */
    if (!is_front_page()) {
        echo bostrank_schema_breadcrumb($cfg);
    }

    /* ---- SCHEMA: TattooParlor + FAQ + Review — khusus HOMEPAGE ----
       (dipindahkan dari front-page.php agar ikut terlindungi anti-bentrok) */
    if (is_front_page()) {
        echo bostrank_schema_homepage();
    }

    /* ---- SCHEMA: Article — khusus POST tunggal ----
       (dipindahkan dari single.php agar ikut terlindungi anti-bentrok) */
    if (is_singular('post')) {
        echo bostrank_schema_article();
    }

    echo "<!-- /Boost Rank One SEO -->\n\n";
}

/**
 * Schema HOMEPAGE: TattooParlor (LocalBusiness) + FAQPage + Review.
 * Dipindahkan verbatim dari front-page.php. Membuat rich result:
 * rating bintang, FAQ accordion, & info bisnis lokal di Google.
 */
function bostrank_schema_homepage() {
    return <<<'JSONLD'
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [

    {
      "@type": "WebSite",
      "@id": "https://nusapenidatattoo.com/#website",
      "url": "https://nusapenidatattoo.com/",
      "name": "Nusa Penida Tattoo",
      "description": "Tattoo studio in Nusa Penida, Bali — fine-line, minimalist and custom Balinese tattoos for travelers. Walk-ins welcome.",
      "publisher": { "@id": "https://nusapenidatattoo.com/#tattoo-studio" },
      "inLanguage": "en"
    },

    {
      "@type": ["TattooParlor", "LocalBusiness"],
      "@id": "https://nusapenidatattoo.com/#tattoo-studio",
      "name": "Nusa Penida Tattoo",
      "url": "https://nusapenidatattoo.com/",
      "logo": "https://nusapenidatattoo.com/wp-content/uploads/2025/10/nusa-penida-tatto.png",
      "image": [
        "https://nusapenidatattoo.com/wp-content/uploads/2025/10/anime-tatto-naruto-nusapenidattato.webp",
        "https://nusapenidatattoo.com/wp-content/uploads/2025/10/manta-animal-and-traditional-balinese-tatto-nusapenidatto.webp"
      ],
      "description": "Nusa Penida Tattoo is a professional, fully-sterile tattoo studio on Nusa Penida island, Bali, specializing in fine-line, minimalist, blackwork and custom Balinese-inspired tattoos for international travelers. Walk-ins welcome, English-speaking artists.",
      "slogan": "Ink Your Island Story",
      "paymentAccepted": "Cash, QRIS, Bank Transfer",
      "telephone": "+6285792283479",
      "email": "info@nusapenidatattoo.com",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Jl. Raya Nusa Penida",
        "addressLocality": "Nusa Penida",
        "addressRegion": "Bali",
        "postalCode": "80771",
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
      "knowsLanguage": ["en", "id"],
      "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "4.8",
        "bestRating": "5",
        "ratingCount": "27"
      },
      "makesOffer": [
        {
          "@type": "Offer",
          "itemOffered": {
            "@type": "Service",
            "name": "Fine-line & Minimalist Tattoo",
            "description": "Delicate fine-line and minimalist tattoos, ideal for first-timers and travelers."
          }
        },
        {
          "@type": "Offer",
          "itemOffered": {
            "@type": "Service",
            "name": "Blackwork & Tribal Tattoo",
            "description": "Bold blackwork, tribal and geometric tattoos crafted by professional artists."
          }
        },
        {
          "@type": "Offer",
          "itemOffered": {
            "@type": "Service",
            "name": "Traditional Balinese & Custom Tattoo",
            "description": "Personalized Balinese-inspired and fully custom tattoo designs created with you in consultation."
          }
        }
      ],
      "speakable": {
        "@type": "SpeakableSpecification",
        "cssSelector": [".seo-answer", "#faq"]
      }
    },

    {
      "@type": "FAQPage",
      "@id": "https://nusapenidatattoo.com/#faq",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "Is a fine-line tattoo good for first-timers?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Yes. Fine-line tattoos are ideal for first-time clients because they are minimalist, less painful and heal faster than larger tattoo styles. Our artists will guide you through design, size and placement during a friendly consultation."
          }
        },
        {
          "@type": "Question",
          "name": "Do you accept walk-in tattoos in Nusa Penida?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Yes, walk-ins are welcome every day from 10:00 AM to 9:00 PM. To guarantee your preferred time and artist, we recommend messaging us on WhatsApp first, especially during high season."
          }
        },
        {
          "@type": "Question",
          "name": "What tattoo styles does Nusa Penida Tattoo offer?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "We specialize in fine-line, minimalist, lettering, blackwork, tribal and traditional Balinese tattoos, as well as fully custom designs inspired by the ocean and island life."
          }
        },
        {
          "@type": "Question",
          "name": "Is it safe and hygienic to get a tattoo while traveling in Nusa Penida?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Yes. We follow strict hygiene standards using single-use sterile needles, premium ink and professional procedures, making it safe for international travelers."
          }
        },
        {
          "@type": "Question",
          "name": "How long does a fine-line tattoo take to heal?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Fine-line tattoos usually heal within 7 to 14 days. Proper aftercare is essential in a tropical climate like Bali — avoid sun, sea water and pools until fully healed. We provide complete aftercare guidance."
          }
        },
        {
          "@type": "Question",
          "name": "Do your tattoo artists speak English?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Yes. Our artists speak fluent English, so it is easy for international travelers to discuss design, size and placement clearly."
          }
        },
        {
          "@type": "Question",
          "name": "Can I bring my own tattoo design?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Absolutely. You can bring your own design or idea, and our artists will refine it or create a fully custom piece that fits your story."
          }
        },
        {
          "@type": "Question",
          "name": "How do I book a tattoo appointment in Nusa Penida?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "You can book in seconds on our booking page or message us on WhatsApp at +62 857-9228-3479 before or during your visit to Nusa Penida."
          }
        }
      ]
    },

    {
      "@type": "Review",
      "itemReviewed": { "@id": "https://nusapenidatattoo.com/#tattoo-studio" },
      "author": { "@type": "Person", "name": "Emily Carter" },
      "reviewRating": { "@type": "Rating", "ratingValue": "5", "bestRating": "5" },
      "reviewBody": "Amazing tattoo experience in Nusa Penida! Clean studio, friendly artists, and professional service."
    },
    {
      "@type": "Review",
      "itemReviewed": { "@id": "https://nusapenidatattoo.com/#tattoo-studio" },
      "author": { "@type": "Person", "name": "Wayan Putra" },
      "reviewRating": { "@type": "Rating", "ratingValue": "5", "bestRating": "5" },
      "reviewBody": "Best tattoo studio in Nusa Penida. Highly recommended!"
    },
    {
      "@type": "Review",
      "itemReviewed": { "@id": "https://nusapenidatattoo.com/#tattoo-studio" },
      "author": { "@type": "Person", "name": "Sophie Lee" },
      "reviewRating": { "@type": "Rating", "ratingValue": "5", "bestRating": "5" },
      "reviewBody": "Super clean, safe, and creative tattoo artists. Totally worth visiting!"
    }

  ]
}
</script>

JSONLD;
}

/**
 * Schema Article untuk post tunggal. Dipindahkan dari single.php.
 */
function bostrank_schema_article() {
    if (!have_posts() && !get_post()) {
        return '';
    }

    $data = [
        '@context'      => 'https://schema.org',
        '@type'         => 'Article',
        'headline'      => get_the_title(),
        'datePublished' => get_the_date('c'),
        'dateModified'  => get_the_modified_date('c'),
        'wordCount'     => (string) str_word_count(wp_strip_all_tags(get_the_content())),
        'author'        => [
            '@type' => 'Person',
            'name'  => get_the_author_meta('display_name'),
        ],
        'publisher'     => [
            '@type' => 'Organization',
            'name'  => get_bloginfo('name'),
            'logo'  => [
                '@type' => 'ImageObject',
                'url'   => get_site_icon_url() ?: bostrank_config()['default_image'],
            ],
        ],
        'mainEntityOfPage' => [
            '@type' => 'WebPage',
            '@id'   => get_permalink(),
        ],
    ];

    if (has_post_thumbnail()) {
        $data['image'] = get_the_post_thumbnail_url(get_the_ID(), 'blog-single') ?: get_the_post_thumbnail_url();
    }

    return '<script type="application/ld+json">' . wp_json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "</script>\n";
}

/**
 * URL kanonik halaman saat ini.
 */
function bostrank_current_url() {
    if (is_front_page()) {
        return home_url('/');
    }
    if (is_singular()) {
        return get_permalink();
    }
    if (is_category() || is_tag() || is_tax()) {
        $link = get_term_link(get_queried_object());
        return is_wp_error($link) ? '' : $link;
    }
    if (is_post_type_archive()) {
        return get_post_type_archive_link(get_post_type());
    }
    if (is_author()) {
        return get_author_posts_url(get_queried_object_id());
    }
    if (is_home()) {
        return get_permalink(get_option('page_for_posts')) ?: home_url('/');
    }
    // Fallback: URL request yang dibersihkan.
    return home_url(add_query_arg([], $GLOBALS['wp']->request ? '/' . $GLOBALS['wp']->request . '/' : '/'));
}

/**
 * Gambar share untuk halaman saat ini.
 */
function bostrank_get_share_image() {
    $cfg = bostrank_config();
    if (is_singular() && has_post_thumbnail()) {
        $img = get_the_post_thumbnail_url(get_the_ID(), 'blog-single');
        if ($img) {
            return $img;
        }
    }
    return $cfg['default_image'];
}

/**
 * Nilai meta robots: noindex untuk halaman tipis/duplikat, index untuk sisanya.
 */
function bostrank_robots_value() {
    $noindex = is_search() || is_404() || is_paged() && (is_author() || is_date());

    if (is_search() || is_404()) {
        $value = 'noindex, follow';
    } else {
        // max-image-preview:large → izinkan Google tampilkan gambar besar di hasil.
        $value = 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1';
    }

    return apply_filters('bostrank_robots', $value);
}

/* ---- SCHEMA BUILDERS ---- */

/**
 * Schema WebSite + Organization (publisher). Aman berdampingan dengan
 * TattooParlor schema yang sudah ada di front-page.php (node berbeda).
 */
function bostrank_schema_website($cfg) {
    $sameas = array_values(array_filter([
        $cfg['instagram'],
        $cfg['facebook'],
        $cfg['tiktok'],
    ]));

    $data = [
        '@context' => 'https://schema.org',
        '@graph'   => [
            [
                '@type'           => 'WebSite',
                '@id'             => home_url('/#website'),
                'url'             => home_url('/'),
                'name'            => $cfg['name'],
                'description'     => $cfg['description'],
                'inLanguage'      => get_bloginfo('language'),
                'publisher'       => ['@id' => home_url('/#organization')],
                'potentialAction' => [
                    '@type'       => 'SearchAction',
                    'target'      => [
                        '@type'       => 'EntryPoint',
                        'urlTemplate' => home_url('/?s={search_term_string}'),
                    ],
                    'query-input' => 'required name=search_term_string',
                ],
            ],
            array_filter([
                '@type'  => 'Organization',
                '@id'    => home_url('/#organization'),
                'name'   => $cfg['name'],
                'url'    => home_url('/'),
                'logo'   => $cfg['default_image'] ?: null,
                'image'  => $cfg['default_image'] ?: null,
                'email'  => $cfg['email'] ?: null,
                'telephone' => $cfg['phone'] ?: null,
                'sameAs' => $sameas ?: null,
            ]),
        ],
    ];

    return '<script type="application/ld+json">' . wp_json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "</script>\n";
}

/**
 * Schema BreadcrumbList untuk halaman non-front (membantu Google memetakan struktur).
 */
function bostrank_schema_breadcrumb($cfg) {
    $items = [];
    $position = 1;

    // Home selalu pertama.
    $items[] = [
        '@type'    => 'ListItem',
        'position' => $position++,
        'name'     => 'Home',
        'item'     => home_url('/'),
    ];

    if (is_singular('post')) {
        // Blog index bila ada.
        $blog_id = get_option('page_for_posts');
        if ($blog_id) {
            $items[] = [
                '@type'    => 'ListItem',
                'position' => $position++,
                'name'     => get_the_title($blog_id),
                'item'     => get_permalink($blog_id),
            ];
        }
        $items[] = [
            '@type'    => 'ListItem',
            'position' => $position++,
            'name'     => get_the_title(),
            'item'     => get_permalink(),
        ];
    } elseif (is_page()) {
        $items[] = [
            '@type'    => 'ListItem',
            'position' => $position++,
            'name'     => get_the_title(),
            'item'     => get_permalink(),
        ];
    } elseif (is_category() || is_tag() || is_tax()) {
        $term = get_queried_object();
        if ($term && !is_wp_error($term)) {
            $items[] = [
                '@type'    => 'ListItem',
                'position' => $position++,
                'name'     => $term->name,
                'item'     => get_term_link($term),
            ];
        }
    }

    if (count($items) < 2) {
        return '';
    }

    $data = [
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => $items,
    ];

    return '<script type="application/ld+json">' . wp_json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "</script>\n";
}

/* =============================================================================
   7. PERFORMANCE — preconnect, dns-prefetch & hapus bloat WordPress
   Halaman cepat = Core Web Vitals bagus = sinyal ranking positif.
============================================================================= */

/**
 * Preconnect / dns-prefetch ke domain pihak ketiga (GA, GTM, fonts).
 * Dipasang paling awal (priority 0) agar koneksi dibuka secepatnya.
 */
add_action('wp_head', 'bostrank_resource_hints', 0);
function bostrank_resource_hints() {
    $hints = [
        'https://www.googletagmanager.com',
        'https://www.google-analytics.com',
        'https://fonts.googleapis.com',
        'https://fonts.gstatic.com',
    ];
    foreach ($hints as $host) {
        printf('<link rel="preconnect" href="%s" crossorigin>' . "\n", esc_url($host));
        printf('<link rel="dns-prefetch" href="%s">' . "\n", esc_url($host));
    }
}

/**
 * Hapus bloat default WordPress yang memperlambat & tidak berguna untuk SEO.
 */
add_action('init', 'bostrank_clean_head');
function bostrank_clean_head() {
    // Emoji script & style (berat, tidak perlu).
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

    // WLW manifest & RSD (legacy, tak terpakai).
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');

    // Versi WordPress (sembunyikan = sedikit lebih aman).
    remove_action('wp_head', 'wp_generator');

    // Shortlink (duplikat URL).
    remove_action('wp_head', 'wp_shortlink_wp_head');

    // rel_canonical bawaan — kita ganti dengan canonical terpadu sendiri,
    // TAPI hanya bila tidak ada plugin SEO (plugin mengurus canonical-nya sendiri).
    if (!bostrank_seo_plugin_active()) {
        remove_action('wp_head', 'rel_canonical');
    }

    // Hapus emoji dari TinyMCE.
    add_filter('tiny_mce_plugins', function ($plugins) {
        return is_array($plugins) ? array_diff($plugins, ['wpemoji']) : $plugins;
    });
}

/**
 * Tambahkan defer ke script non-kritis (mempercepat render).
 * Hanya untuk script frontend yang tidak butuh eksekusi segera.
 */
add_filter('script_loader_tag', 'bostrank_defer_scripts', 10, 2);
function bostrank_defer_scripts($tag, $handle) {
    if (is_admin()) {
        return $tag;
    }
    // Daftar handle yang AMAN di-defer. gtag/gtm dibiarkan (analitik butuh awal).
    $defer = apply_filters('bostrank_defer_handles', []);
    if (in_array($handle, $defer, true) && strpos($tag, ' defer') === false) {
        $tag = str_replace(' src', ' defer src', $tag);
    }
    return $tag;
}

/* =============================================================================
   8. SITEMAP & ROBOTS.TXT
   Pastikan sitemap bawaan WP (sejak WP 5.5) aktif & terdaftar di robots.txt.
============================================================================= */

// Pastikan WP sitemap aktif — KECUALI bila plugin SEO punya sitemap sendiri
// (Rank Math/Yoast/dll menonaktifkan sitemap core & memakai milik mereka).
add_filter('wp_sitemaps_enabled', function ($enabled) {
    return bostrank_seo_plugin_active() ? $enabled : true;
});

/**
 * Tambahkan baris Sitemap & aturan ramah-SEO ke robots.txt virtual WordPress.
 */
add_filter('robots_txt', 'bostrank_robots_txt', 10, 2);
function bostrank_robots_txt($output, $public) {
    if (!$public) {
        // Situs di-set "discourage search engines" — jangan utak-atik.
        return $output;
    }

    // ANTI-BENTROK: biarkan plugin SEO yang mengelola robots.txt & baris Sitemap.
    if (bostrank_seo_plugin_active()) {
        return $output;
    }

    $lines   = [];
    $lines[] = 'User-agent: *';
    $lines[] = 'Allow: /';
    $lines[] = 'Disallow: /wp-admin/';
    $lines[] = 'Allow: /wp-admin/admin-ajax.php';
    $lines[] = 'Disallow: /?s=';            // halaman pencarian (tipis)
    $lines[] = 'Disallow: /search/';
    $lines[] = '';
    $lines[] = 'Sitemap: ' . home_url('/wp-sitemap.xml');

    return implode("\n", $lines) . "\n";
}

/* =============================================================================
   9. ALT GAMBAR OTOMATIS
   Gambar tanpa alt = peluang image SEO & aksesibilitas hilang.
   Isi alt kosong dengan judul konten + nama bisnis (fallback aman).
============================================================================= */
add_filter('wp_get_attachment_image_attributes', 'bostrank_auto_alt', 10, 2);
function bostrank_auto_alt($attr, $attachment) {
    if (empty($attr['alt'])) {
        $alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
        if (!$alt) {
            $alt = $attachment->post_title ?: bostrank_config()['name'];
        }
        $attr['alt'] = $alt;
    }
    return $attr;
}

/* =============================================================================
   10. TITLE RAPI & BRANDED
   Pemisah title konsisten + tagline untuk homepage (branding di SERP).
============================================================================= */
add_filter('document_title_separator', function ($sep) {
    return bostrank_seo_plugin_active() ? $sep : '|';
});

add_filter('document_title_parts', 'bostrank_title_parts');
function bostrank_title_parts($parts) {
    // ANTI-BENTROK: plugin SEO mengatur judul sendiri.
    if (bostrank_seo_plugin_active()) {
        return $parts;
    }

    $cfg = bostrank_config();

    // Homepage: tampilkan tagline lokal yang kaya keyword (jika belum ada).
    if (is_front_page() && empty($parts['tagline'])) {
        $parts['tagline'] = 'Tattoo Studio Nusa Penida, Bali';
    }

    // Pastikan nama situs konsisten dengan nama bisnis.
    if (!empty($cfg['name'])) {
        $parts['site'] = $cfg['name'];
    }

    return $parts;
}

/* =============================================================================
   CHECKLIST NON-TEKNIS (WAJIB — ini yang benar-benar mendatangkan client)
   =============================================================================
   File ini menyiapkan fondasinya. Untuk benar-benar dapat banyak client:
   1.  GOOGLE BUSINESS PROFILE: daftarkan "Nusa Penida Tattoo", isi lengkap,
       upload foto, minta REVIEW dari setiap customer (paling berpengaruh untuk
       client lokal/turis + muncul di Google Maps).
   2.  SUBMIT SITEMAP: Google Search Console → Sitemaps → kirim
       https://nusapenidatattoo.com/wp-sitemap.xml
   3.  KONTEN: tulis artikel/landing dengan keyword turis cari, mis.
       "tattoo in Nusa Penida", "best tattoo studio Bali", "fine line tattoo Bali",
       sertakan foto karya + harga + lokasi + cara booking WhatsApp.
   4.  KECEPATAN: kompres gambar (WebP), uji di PageSpeed Insights.
   5.  BACKLINK: minta listing di blog travel Bali, direktori wisata, partner hostel.
   6.  KONSISTEN NAP: nama, alamat, no. WA harus sama persis di website, Google
       Business, Instagram, dll.
   7.  CTA WhatsApp jelas di setiap halaman (sudah ada di header — pertahankan).
   ============================================================================= */
