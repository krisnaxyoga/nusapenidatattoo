<?php
/**
 * Template Name: Fine Line Tattoo (SEO Landing)
 * Landing page SEO untuk menyasar turis yang mencari tato di Nusa Penida.
 *
 * Primary keywords : fine line tattoo nusa penida, fine line tattoo bali,
 *                    minimalist tattoo bali, small tattoo nusa penida,
 *                    tattoo for travelers bali, best tattoo studio nusa penida.
 *
 * Catatan: meta description, canonical, Open Graph, schema WebSite/Breadcrumb
 * di-handle otomatis oleh inc/bost-rank-one.php. Halaman ini menambahkan
 * FAQPage schema khusus (cocok dgn FAQ yang terlihat) — diberi guard agar
 * tidak bentrok dengan plugin SEO.
 */

get_template_part('template-parts/header');

// Kontak dari Customizer (fallback aman)
$whatsapp = preg_replace('/[^0-9]/', '', get_theme_mod('nusatatto_whatsapp', '6285792283479'));
$wa_url   = 'https://wa.me/' . $whatsapp . '?text=' . rawurlencode('Hi nusapenidatattoo.com, I want a fine line tattoo. Can you help me book a session?');

// URL halaman gallery & booking (jika ada), fallback ke anchor/home
$gallery_url = get_page_link(get_page_by_path('gallery')) ?: home_url('/gallery/');
$book_url    = get_page_link(get_page_by_path('book')) ?: $wa_url;

// WhatsApp icon (dipakai ulang)
$wa_icon = '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M.057 24l1.687-6.163a11.867 11.867 0 01-1.587-5.945C.16 5.335 5.495 0 12.05 0a11.817 11.817 0 018.413 3.488 11.824 11.824 0 013.48 8.414c-.003 6.557-5.338 11.892-11.893 11.892a11.9 11.9 0 01-5.688-1.448L.057 24zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884a9.86 9.86 0 001.51 5.26l-.999 3.648 3.477-.918zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.71.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>';

// Data styles (DRY)
$styles = [
    ['Fine Line', 'Delicate single-needle linework — clean, elegant and timeless. Perfect for your first tattoo.'],
    ['Minimalist', 'Small, simple designs with big meaning. Subtle ink that travels well and heals fast.'],
    ['Ocean & Island', 'Manta rays, waves and Nusa Penida-inspired art to remember your Bali trip forever.'],
    ['Fine Line Lettering', 'Names, dates and quotes in crisp, refined script.'],
    ['Blackwork & Linework', 'Bold botanical and geometric pieces with a fine, detailed finish.'],
    ['Custom Design', 'Bring your idea — our artist draws a one-of-a-kind design just for you.'],
];

// FAQ (dipakai untuk tampilan + schema; HARUS sama persis agar valid)
$faqs = [
    ['How much does a fine line tattoo cost in Nusa Penida?', 'Small fine line tattoos start from around IDR 600.000. The final price depends on size, detail and placement. Send us a photo on WhatsApp for a free, instant quote.'],
    ['Do I need an appointment or can I walk in?', 'Both work. Walk-ins are welcome whenever we have an open slot, but booking ahead on WhatsApp guarantees your preferred time — especially during high season.'],
    ['Is it safe and hygienic for travelers?', 'Yes. We use single-use sterile needles, fresh ink caps and hospital-grade disinfection for every session, so you can get inked safely while traveling in Bali.'],
    ['How long does a small fine line tattoo take to heal?', 'Most fine line tattoos heal in 7–14 days. We give you full aftercare instructions for tropical climates so it heals perfectly even while you travel.'],
    ['Can I get a tattoo before swimming or diving in Nusa Penida?', 'We recommend getting your tattoo after your water activities, or allowing it to heal first. Fresh tattoos should avoid the ocean for about 2 weeks — ask us and we will plan the timing with you.'],
];
?>

<!-- ============ HERO ============ -->
<section class="min-h-[70vh] flex items-center justify-center relative overflow-hidden pt-20 bg-gradient-dark">
    <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
        <div class="inline-flex items-center gap-2 mb-6 px-4 py-2 rounded-full glass text-sm font-semibold text-[#d4af37] animate-fade-in-up">
            <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
            Trusted by travelers · Walk-ins Welcome
        </div>

        <h1 class="text-4xl md:text-6xl font-bold mb-6 text-[#f5f5f5] animate-fade-in-up leading-tight">
            Fine Line <span class="text-gradient">Tattoo</span> in Nusa Penida, Bali
        </h1>

        <p class="text-xl text-gray-300 max-w-2xl mx-auto mb-8">
            Minimalist, custom and fine line tattoos for travelers — done by a professional artist
            in a clean, sterile studio on Nusa Penida. Take home more than a photo from Bali.
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="<?php echo esc_url($wa_url); ?>" target="_blank" rel="noopener"
               class="btn-glass-accent px-8 py-4 rounded-full font-semibold text-lg inline-flex items-center justify-center gap-2">
                <?php echo $wa_icon; ?> Get a Free Quote
            </a>
            <a href="#styles" class="glass px-8 py-4 rounded-full font-semibold text-lg text-[#f5f5f5] hover:bg-[#d4af37] hover:text-[#0f0f0f] transition-all">
                See Tattoo Styles
            </a>
        </div>
    </div>
</section>

<!-- ============ TRUST BAR ============ -->
<section class="py-10 px-4 bg-gradient-dark border-y border-white border-opacity-10">
    <div class="max-w-6xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
        <?php
        $trust = [
            ['100% Sterile', 'Single-use needles'],
            ['Pro Artist', '10+ years experience'],
            ['English Friendly', 'Easy for travelers'],
            ['Open Daily', '10:00 – 21:00'],
        ];
        foreach ($trust as $t) : ?>
        <div class="flex flex-col items-center gap-1">
            <div class="font-bold text-[#d4af37] text-lg"><?php echo esc_html($t[0]); ?></div>
            <div class="text-sm text-gray-400"><?php echo esc_html($t[1]); ?></div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- ============ INTRO ============ -->
<section class="py-20 px-4 bg-gradient-dark-reverse">
    <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-6 text-[#f5f5f5]">
            The Best Place to Get a <span class="text-gradient">Fine Line Tattoo</span> on the Island
        </h2>
        <p class="text-gray-300 leading-relaxed mb-4">
            Visiting Nusa Penida and dreaming of a meaningful souvenir? A fine line tattoo is the
            perfect way to carry a piece of Bali with you. Our studio specializes in delicate,
            minimalist linework that looks elegant, heals quickly and suits first-timers and
            seasoned collectors alike.
        </p>
        <p class="text-gray-300 leading-relaxed">
            From ocean-inspired manta rays to tiny symbolic designs, every tattoo is drawn custom
            and applied with sterile, single-use equipment. Just steps from Nusa Penida's most
            famous beaches, we make it easy to book between adventures.
        </p>
    </div>
</section>

<!-- ============ STYLES ============ -->
<section id="styles" class="py-20 px-4 bg-gradient-dark">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-14">
            <h2 class="text-3xl md:text-4xl font-bold mb-4 text-[#f5f5f5]">
                Tattoo <span class="text-gradient">Styles</span> We Specialize In
            </h2>
            <p class="text-gray-300 max-w-2xl mx-auto">Whatever your story, we have a style for it.</p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($styles as $i => $s) : ?>
            <div class="glass-lg rounded-2xl p-8 hover-lift stagger-item">
                <div class="w-12 h-12 rounded-full bg-[#d4af37] bg-opacity-20 flex items-center justify-center mb-5 text-[#d4af37] font-bold text-lg">
                    <?php echo esc_html(str_pad($i + 1, 2, '0', STR_PAD_LEFT)); ?>
                </div>
                <h3 class="text-xl font-bold mb-3 text-[#f5f5f5]"><?php echo esc_html($s[0]); ?></h3>
                <p class="text-gray-300 leading-relaxed"><?php echo esc_html($s[1]); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============ WHY US ============ -->
<section class="py-20 px-4 bg-gradient-dark-reverse">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-14">
            <h2 class="text-3xl md:text-4xl font-bold mb-4 text-[#f5f5f5]">
                Why Travelers Choose <span class="text-gradient">Us</span>
            </h2>
        </div>
        <div class="grid md:grid-cols-2 gap-6">
            <?php
            $reasons = [
                ['Sterile & Safe', 'Brand-new needles every session, sealed inks and full disinfection — your health comes first.'],
                ['Custom-Drawn Art', 'No flash-only catalog. We design around your idea so your tattoo is truly one of a kind.'],
                ['Fast, Travel-Friendly Healing', 'Fine line tattoos are small and gentle, with simple aftercare made for Bali\'s tropical weather.'],
                ['Right by the Beaches', 'Conveniently located near Kelingking, Crystal Bay and Diamond Beach — book between adventures.'],
            ];
            foreach ($reasons as $r) : ?>
            <div class="flex gap-4 glass rounded-2xl p-6">
                <svg class="w-7 h-7 text-[#d4af37] flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <div>
                    <h3 class="text-lg font-bold mb-1 text-[#f5f5f5]"><?php echo esc_html($r[0]); ?></h3>
                    <p class="text-gray-300"><?php echo esc_html($r[1]); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============ PROCESS ============ -->
<section class="py-20 px-4 bg-gradient-dark">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-14">
            <h2 class="text-3xl md:text-4xl font-bold mb-4 text-[#f5f5f5]">
                How to Get Your <span class="text-gradient">Tattoo</span>
            </h2>
            <p class="text-gray-300">Four simple steps — from idea to ink.</p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php
            $steps = [
                ['Chat on WhatsApp', 'Send us your idea, reference photos, size and placement for a free quote.'],
                ['Pick Your Time', 'Book a slot that fits your itinerary, or simply walk in.'],
                ['Approve the Design', 'We sketch a custom design and refine it together before we start.'],
                ['Get Inked', 'Relax in our clean studio and leave with your new fine line tattoo.'],
            ];
            foreach ($steps as $i => $st) : ?>
            <div class="text-center">
                <div class="w-14 h-14 mx-auto rounded-full bg-[#d4af37] text-[#0f0f0f] flex items-center justify-center font-bold text-xl mb-4">
                    <?php echo (int) ($i + 1); ?>
                </div>
                <h3 class="text-lg font-bold mb-2 text-[#f5f5f5]"><?php echo esc_html($st[0]); ?></h3>
                <p class="text-gray-300 text-sm leading-relaxed"><?php echo esc_html($st[1]); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============ PORTFOLIO TEASER ============ -->
<section class="py-20 px-4 bg-gradient-dark-reverse">
    <div class="max-w-4xl mx-auto text-center glass-lg rounded-2xl p-10 md:p-14">
        <h2 class="text-3xl md:text-4xl font-bold mb-4 text-[#f5f5f5]">
            See Our <span class="text-gradient">Fine Line</span> Work
        </h2>
        <p class="text-gray-300 max-w-2xl mx-auto mb-8">
            Browse real tattoos created for travelers in Nusa Penida — minimalist linework,
            ocean art and custom designs.
        </p>
        <a href="<?php echo esc_url($gallery_url); ?>" class="btn-glass-accent px-8 py-4 rounded-full font-semibold text-lg inline-block">
            View the Gallery
        </a>
    </div>
</section>

<!-- ============ TESTIMONIALS ============ -->
<section class="py-20 px-4 bg-gradient-dark">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-14">
            <h2 class="text-3xl md:text-4xl font-bold mb-4 text-[#f5f5f5]">
                Loved by <span class="text-gradient">Travelers</span>
            </h2>
        </div>
        <div class="grid md:grid-cols-3 gap-6">
            <?php
            $reviews = [
                ['Amazing fine line work and the cleanest studio I found in Bali. Perfect souvenir from Nusa Penida!', 'Sophie — France'],
                ['Walked in, showed my idea, and walked out with a beautiful minimalist tattoo. Super friendly artist.', 'Liam — Australia'],
                ['Booked on WhatsApp in minutes. Hygienic, professional and healed perfectly during my trip.', 'Mara — Germany'],
            ];
            foreach ($reviews as $rv) : ?>
            <div class="glass-lg rounded-2xl p-8 hover-lift">
                <div class="text-[#d4af37] mb-4 text-lg">★★★★★</div>
                <p class="text-gray-200 italic mb-5 leading-relaxed">“<?php echo esc_html($rv[0]); ?>”</p>
                <div class="font-semibold text-[#f5f5f5]"><?php echo esc_html($rv[1]); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============ LOCATION / LOCAL SEO ============ -->
<section class="py-20 px-4 bg-gradient-dark-reverse">
    <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-6 text-[#f5f5f5]">
            Tattoo Studio Near Nusa Penida's <span class="text-gradient">Top Spots</span>
        </h2>
        <p class="text-gray-300 leading-relaxed mb-6">
            We're easy to reach from the island's most popular destinations — making it simple to
            fit a tattoo into your travel plans.
        </p>
        <div class="flex flex-wrap justify-center gap-3">
            <?php
            $places = ['Kelingking Beach', 'Crystal Bay', 'Diamond Beach', 'Angel\'s Billabong', 'Broken Beach', 'Atuh Beach'];
            foreach ($places as $p) : ?>
            <span class="glass px-4 py-2 rounded-full text-sm text-[#f5f5f5]"><?php echo esc_html($p); ?></span>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============ FAQ ============ -->
<section class="py-20 px-4 bg-gradient-dark">
    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-14">
            <h2 class="text-3xl md:text-4xl font-bold mb-4 text-[#f5f5f5]">
                Fine Line Tattoo <span class="text-gradient">FAQ</span>
            </h2>
        </div>
        <div class="space-y-4">
            <?php foreach ($faqs as $faq) : ?>
            <details class="glass rounded-xl p-6 group">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-[#f5f5f5] list-none">
                    <span><?php echo esc_html($faq[0]); ?></span>
                    <svg class="w-5 h-5 text-[#d4af37] flex-shrink-0 ml-4 transition-transform group-open:rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </summary>
                <p class="text-gray-300 mt-4 leading-relaxed"><?php echo esc_html($faq[1]); ?></p>
            </details>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============ FINAL CTA ============ -->
<section class="py-24 px-4 bg-gradient-dark-reverse">
    <div class="max-w-3xl mx-auto text-center">
        <h2 class="text-3xl md:text-5xl font-bold mb-6 text-[#f5f5f5]">
            Ready for Your <span class="text-gradient">Bali Tattoo?</span>
        </h2>
        <p class="text-xl text-gray-300 mb-8">
            Message us now for a free quote — no commitment. Your fine line tattoo in Nusa Penida
            is just one chat away.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="<?php echo esc_url($wa_url); ?>" target="_blank" rel="noopener"
               class="btn-glass-accent px-8 py-4 rounded-full font-semibold text-lg inline-flex items-center justify-center gap-2">
                <?php echo $wa_icon; ?> Chat on WhatsApp
            </a>
            <a href="<?php echo esc_url($book_url); ?>" class="glass px-8 py-4 rounded-full font-semibold text-lg text-[#f5f5f5] hover:bg-[#d4af37] hover:text-[#0f0f0f] transition-all inline-block">
                Book Online
            </a>
        </div>
    </div>
</section>

<?php
/* ---- FAQPage schema (sama persis dgn FAQ di atas) ----
   Guard anti-bentrok: lewati bila plugin SEO aktif. */
if (!function_exists('bostrank_seo_plugin_active') || !bostrank_seo_plugin_active()) :
    $faq_entities = [];
    foreach ($faqs as $faq) {
        $faq_entities[] = [
            '@type'          => 'Question',
            'name'           => $faq[0],
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq[1]],
        ];
    }
    $faq_schema = [
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        '@id'        => get_permalink() . '#faq',
        'mainEntity' => $faq_entities,
    ];
    echo '<script type="application/ld+json">' . wp_json_encode($faq_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
endif;

get_template_part('template-parts/footer');
