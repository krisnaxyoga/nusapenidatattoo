<?php
/**
 * Template Name: Booking
 * The template for the tattoo booking / appointment page.
 *
 * SEO targets: book tattoo nusa penida, tattoo appointment bali,
 * walk in tattoo nusa penida, tattoo studio near me.
 */

get_template_part('template-parts/header');

// Contact details from the Customizer
$whatsapp   = get_theme_mod('nusatatto_whatsapp', '6285792283479');
$phone      = get_theme_mod('nusatatto_phone', '+62 813-3756-7256');
$email      = get_theme_mod('nusatatto_email', 'info@nusapenidatattoo.com');
$address    = get_theme_mod('nusatatto_address', 'Jl. Raya Nusa Penida, Bali 80771');
$google_map = get_theme_mod('nusatatto_google_maps', '');

$whatsapp_url = 'https://wa.me/' . $whatsapp . '?text=' . rawurlencode('Hi nusapenidatattoo.com, I want to book a tattoo session');
?>

<!-- Hero Section -->
<section class="min-h-[70vh] flex items-center justify-center relative overflow-hidden pt-20 bg-gradient-dark">
    <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
        <!-- Walk-ins badge -->
        <div class="inline-flex items-center gap-2 mb-6 px-4 py-2 rounded-full glass text-sm font-semibold text-[#d4af37] animate-fade-in-up">
            <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
            Walk-ins Welcome
        </div>

        <h1 class="text-4xl md:text-6xl font-bold mb-6 text-[#f5f5f5] animate-fade-in-up leading-tight">
            Book a <span class="text-gradient">Tattoo</span> in Nusa Penida
        </h1>

        <p class="text-xl text-gray-300 max-w-2xl mx-auto mb-8">
            Already on the island? Get inked today. Reserve your spot in seconds or just walk in —
            our artists in Nusa Penida, Bali are ready when you are.
        </p>

        <!-- Primary CTAs -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#booking-form" class="btn-glass-accent px-8 py-4 rounded-full font-semibold text-lg">
                Book Now
            </a>
            <a href="<?php echo esc_url($whatsapp_url); ?>" target="_blank" rel="noopener"
               class="glass px-8 py-4 rounded-full font-semibold text-lg text-[#f5f5f5] hover:bg-[#25D366] hover:text-white transition-all inline-flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M.057 24l1.687-6.163a11.867 11.867 0 01-1.587-5.945C.16 5.335 5.495 0 12.05 0a11.817 11.817 0 018.413 3.488 11.824 11.824 0 013.48 8.414c-.003 6.557-5.338 11.892-11.893 11.892a11.9 11.9 0 01-5.688-1.448L.057 24zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884a9.86 9.86 0 001.51 5.26l-.999 3.648 3.477-.918zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.71.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                </svg>
                WhatsApp Us
            </a>
        </div>
    </div>
</section>

<!-- Quick Info Bar -->
<section class="py-10 px-4 bg-gradient-dark border-y border-white border-opacity-10">
    <div class="max-w-6xl mx-auto grid sm:grid-cols-3 gap-6 text-center">
        <div class="flex flex-col items-center gap-2">
            <svg class="w-8 h-8 text-[#d4af37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div class="font-semibold text-[#f5f5f5]">Open Daily</div>
            <div class="text-sm text-gray-400">10:00 AM – 9:00 PM</div>
        </div>
        <div class="flex flex-col items-center gap-2">
            <svg class="w-8 h-8 text-[#d4af37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div class="font-semibold text-[#f5f5f5]">Walk-ins Welcome</div>
            <div class="text-sm text-gray-400">No appointment needed</div>
        </div>
        <div class="flex flex-col items-center gap-2">
            <svg class="w-8 h-8 text-[#d4af37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <div class="font-semibold text-[#f5f5f5]">Nusa Penida, Bali</div>
            <div class="text-sm text-gray-400">Tattoo studio near you</div>
        </div>
    </div>
</section>

<!-- Booking Form -->
<section id="booking-form" class="py-20 px-4 bg-gradient-dark-reverse">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold mb-4 text-[#f5f5f5]">
                Request Your <span class="text-gradient">Appointment</span>
            </h2>
            <p class="text-gray-300 max-w-2xl mx-auto">
                Fill in the form below and send it straight to our WhatsApp. We'll confirm your
                tattoo appointment within minutes.
            </p>
        </div>

        <div class="grid lg:grid-cols-5 gap-8">
            <!-- Form -->
            <div class="lg:col-span-3 glass-lg rounded-2xl p-8 md:p-10">
                <form id="bookingForm" class="space-y-6">
                    <!-- Name -->
                    <div>
                        <label for="bk-name" class="block text-sm font-semibold text-[#f5f5f5] mb-2">Full Name *</label>
                        <input type="text" id="bk-name" name="name" required
                               class="w-full px-4 py-3 rounded-lg bg-white bg-opacity-5 border border-white border-opacity-10 text-[#f5f5f5] placeholder-gray-500 focus:outline-none focus:border-[#d4af37] transition-colors"
                               placeholder="Your name">
                    </div>

                    <!-- Date + WhatsApp -->
                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <label for="bk-date" class="block text-sm font-semibold text-[#f5f5f5] mb-2">Preferred Date *</label>
                            <input type="date" id="bk-date" name="date" required
                                   class="w-full px-4 py-3 rounded-lg bg-white bg-opacity-5 border border-white border-opacity-10 text-[#f5f5f5] focus:outline-none focus:border-[#d4af37] transition-colors">
                        </div>
                        <div>
                            <label for="bk-contact" class="block text-sm font-semibold text-[#f5f5f5] mb-2">Your WhatsApp *</label>
                            <input type="tel" id="bk-contact" name="contact" required
                                   class="w-full px-4 py-3 rounded-lg bg-white bg-opacity-5 border border-white border-opacity-10 text-[#f5f5f5] placeholder-gray-500 focus:outline-none focus:border-[#d4af37] transition-colors"
                                   placeholder="+62 8xx xxxx xxxx">
                        </div>
                    </div>

                    <!-- Size -->
                    <div>
                        <label for="bk-size" class="block text-sm font-semibold text-[#f5f5f5] mb-2">Tattoo Size *</label>
                        <select id="bk-size" name="size" required
                                class="w-full px-4 py-3 rounded-lg bg-white bg-opacity-5 border border-white border-opacity-10 text-[#f5f5f5] focus:outline-none focus:border-[#d4af37] transition-colors">
                            <option value="" disabled selected>Select a size…</option>
                            <option value="Small (up to 5 cm)">Small — up to 5 cm</option>
                            <option value="Medium (6–10 cm)">Medium — 6 to 10 cm</option>
                            <option value="Large (11–20 cm)">Large — 11 to 20 cm</option>
                            <option value="Extra Large / Half Sleeve">Extra Large — Half Sleeve</option>
                            <option value="Full Sleeve / Custom">Full Sleeve / Custom piece</option>
                        </select>
                    </div>

                    <!-- Design idea -->
                    <div>
                        <label for="bk-design" class="block text-sm font-semibold text-[#f5f5f5] mb-2">Design Idea / Description</label>
                        <textarea id="bk-design" name="design" rows="4"
                                  class="w-full px-4 py-3 rounded-lg bg-white bg-opacity-5 border border-white border-opacity-10 text-[#f5f5f5] placeholder-gray-500 focus:outline-none focus:border-[#d4af37] transition-colors"
                                  placeholder="Tell us your idea, style (fine-line, tribal, lettering…), and body placement"></textarea>
                    </div>

                    <!-- Submit -->
                    <button type="submit"
                            class="w-full btn-glass-accent px-8 py-4 rounded-full font-semibold text-lg inline-flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M.057 24l1.687-6.163a11.867 11.867 0 01-1.587-5.945C.16 5.335 5.495 0 12.05 0a11.817 11.817 0 018.413 3.488 11.824 11.824 0 013.48 8.414c-.003 6.557-5.338 11.892-11.893 11.892a11.9 11.9 0 01-5.688-1.448L.057 24zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884a9.86 9.86 0 001.51 5.26l-.999 3.648 3.477-.918zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.71.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                        </svg>
                        Book via WhatsApp
                    </button>
                    <p class="text-xs text-gray-500 text-center">No payment now. We confirm everything on WhatsApp first.</p>
                </form>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-2 space-y-6">
                <div class="glass rounded-2xl p-6">
                    <h4 class="font-semibold text-[#f5f5f5] mb-2">Prefer to just message us?</h4>
                    <p class="text-sm text-gray-400 mb-4">Send a photo of your idea and we'll quote you right away.</p>
                    <a href="<?php echo esc_url($whatsapp_url); ?>" target="_blank" rel="noopener"
                       class="w-full inline-flex items-center justify-center gap-2 px-6 py-3 rounded-full font-semibold text-white bg-[#25D366] hover:opacity-90 transition-all">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M.057 24l1.687-6.163a11.867 11.867 0 01-1.587-5.945C.16 5.335 5.495 0 12.05 0a11.817 11.817 0 018.413 3.488 11.824 11.824 0 013.48 8.414c-.003 6.557-5.338 11.892-11.893 11.892a11.9 11.9 0 01-5.688-1.448L.057 24zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884a9.86 9.86 0 001.51 5.26l-.999 3.648 3.477-.918zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.71.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                        </svg>
                        WhatsApp Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Hours + Location -->
<section class="py-20 px-4 bg-gradient-dark">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold mb-4 text-[#f5f5f5]">
                Visit Our <span class="text-gradient">Studio</span>
            </h2>
            <p class="text-gray-300 max-w-2xl mx-auto">
                Walk in or drop by after booking — we're easy to find in Nusa Penida, Bali.
            </p>
        </div>

        <div class="grid lg:grid-cols-2 gap-8 items-stretch">
            <!-- Info -->
            <div class="space-y-6">
                <!-- Hours -->
                <div class="glass-lg rounded-2xl p-8">
                    <h3 class="text-xl font-bold text-[#f5f5f5] mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-[#d4af37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Opening Hours
                    </h3>
                    <ul class="space-y-2 text-gray-300">
                        <li class="flex justify-between"><span>Monday – Friday</span><span class="text-[#f5f5f5]">10:00 AM – 9:00 PM</span></li>
                        <li class="flex justify-between"><span>Saturday – Sunday</span><span class="text-[#f5f5f5]">10:00 AM – 10:00 PM</span></li>
                    </ul>
                    <div class="mt-4 inline-flex items-center gap-2 text-sm text-[#d4af37] font-semibold">
                        <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                        Walk-ins welcome — no appointment required
                    </div>
                </div>

                <!-- Contact -->
                <div class="glass-lg rounded-2xl p-8">
                    <h3 class="text-xl font-bold text-[#f5f5f5] mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-[#d4af37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Find Us
                    </h3>
                    <ul class="space-y-3 text-gray-300">
                        <li class="flex items-start gap-3">
                            <span class="text-[#d4af37] mt-0.5">📍</span>
                            <span><?php echo nl2br(esc_html($address)); ?></span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-[#d4af37]">📞</span>
                            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>" class="hover:text-[#d4af37] transition-colors"><?php echo esc_html($phone); ?></a>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-[#d4af37]">✉️</span>
                            <a href="mailto:<?php echo esc_attr($email); ?>" class="hover:text-[#d4af37] transition-colors"><?php echo esc_html($email); ?></a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Map -->
            <div class="glass-lg rounded-2xl overflow-hidden min-h-[400px]">
                <?php if ($google_map) : ?>
                <iframe src="<?php echo esc_url($google_map); ?>"
                        width="100%" height="100%" style="border:0; min-height:400px;"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                        title="Nusa Penida Tattoo studio location"></iframe>
                <?php else : ?>
                <div class="w-full h-full min-h-[400px] flex flex-col items-center justify-center text-center p-8">
                    <svg class="w-16 h-16 text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <p class="text-gray-400 text-sm">Add your Google Maps embed URL via<br>Customizer → Contact Settings.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Final CTA -->
<section class="py-20 px-4 bg-gradient-dark-reverse">
    <div class="max-w-3xl mx-auto text-center glass-lg rounded-2xl p-10 md:p-14">
        <h2 class="text-3xl md:text-4xl font-bold mb-4 text-[#f5f5f5]">
            Ready for Your <span class="text-gradient">Bali Ink</span>?
        </h2>
        <p class="text-gray-300 mb-8 max-w-xl mx-auto">
            Spontaneous traveler or planning ahead — book your tattoo in Nusa Penida today.
            Walk-ins welcome, and we'll confirm every detail before we start.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#booking-form" class="btn-glass-accent px-8 py-4 rounded-full font-semibold text-lg">
                Book Now
            </a>
            <a href="<?php echo esc_url($whatsapp_url); ?>" target="_blank" rel="noopener"
               class="inline-flex items-center justify-center gap-2 px-8 py-4 rounded-full font-semibold text-lg text-white bg-[#25D366] hover:opacity-90 transition-all">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M.057 24l1.687-6.163a11.867 11.867 0 01-1.587-5.945C.16 5.335 5.495 0 12.05 0a11.817 11.817 0 018.413 3.488 11.824 11.824 0 013.48 8.414c-.003 6.557-5.338 11.892-11.893 11.892a11.9 11.9 0 01-5.688-1.448L.057 24zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884a9.86 9.86 0 001.51 5.26l-.999 3.648 3.477-.918zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.71.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                </svg>
                WhatsApp Us
            </a>
        </div>
    </div>
</section>

<!-- Booking form → WhatsApp -->
<script>
(function () {
    var form = document.getElementById('bookingForm');
    if (!form) return;

    var phone = '<?php echo esc_js($whatsapp); ?>';
    var sizeSelect = document.getElementById('bk-size');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        var name    = document.getElementById('bk-name').value.trim();
        var date    = document.getElementById('bk-date').value;
        var contact = document.getElementById('bk-contact').value.trim();
        var size    = sizeSelect.value;
        var design  = document.getElementById('bk-design').value.trim();

        var lines = [
            'Hi nusapenidatattoo.com, I want to book a tattoo session.',
            '',
            'Name: ' + name,
            'Preferred date: ' + date,
            'Size: ' + size,
            'Design idea: ' + (design || '-'),
            'My WhatsApp: ' + contact
        ];

        var url = 'https://wa.me/' + phone + '?text=' + encodeURIComponent(lines.join('\n'));
        window.open(url, '_blank');
    });
})();
</script>

<!-- Schema.org: TattooParlor (local SEO) -->
<?php // ANTI-BENTROK: lewati bila plugin SEO (Rank Math/Yoast/dll) aktif — plugin mengeluarkan schema sendiri.
if (!function_exists('bostrank_seo_plugin_active') || !bostrank_seo_plugin_active()) : ?>
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "TattooParlor",
    "name": "<?php echo esc_js(get_bloginfo('name')); ?>",
    "image": "<?php echo esc_url(get_site_icon_url()); ?>",
    "url": "<?php echo esc_url(get_permalink()); ?>",
    "telephone": "<?php echo esc_js($phone); ?>",
    "email": "<?php echo esc_js($email); ?>",
    "address": {
        "@type": "PostalAddress",
        "streetAddress": "<?php echo esc_js($address); ?>",
        "addressLocality": "Nusa Penida",
        "addressRegion": "Bali",
        "addressCountry": "ID"
    },
    "areaServed": "Nusa Penida, Bali",
    "openingHoursSpecification": [
        {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
            "opens": "10:00",
            "closes": "21:00"
        },
        {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": ["Saturday", "Sunday"],
            "opens": "10:00",
            "closes": "22:00"
        }
    ]
}
</script>
<?php endif; ?>

<?php get_template_part('template-parts/footer'); ?>
