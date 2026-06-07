<?php
/**
 * The template for displaying 404 pages (not found)
 */

get_template_part('template-parts/header'); ?>

<section class="min-h-screen flex items-center justify-center relative overflow-hidden pt-20 bg-gradient-dark">
    <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
        <!-- 404 Number -->
        <div class="mb-8 animate-fade-in-up">
            <h1 class="error-404-number leading-none">
                404
            </h1>
        </div>

        <!-- Error Message -->
        <div class="glass-lg p-8 md:p-12 rounded-2xl animate-fade-in-up">
            <h2 class="text-3xl md:text-4xl font-bold mb-4 text-[#f5f5f5]">
                Oops! Page Not Found
            </h2>
            <p class="text-lg text-gray-300 mb-8 max-w-2xl mx-auto">
                The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.
            </p>

            <!-- Search Form -->
            <div class="mb-8">
                <form role="search" method="get" class="search-form max-w-md mx-auto" action="<?php echo esc_url(home_url('/')); ?>">
                    <div class="flex gap-2">
                        <input type="search"
                               class="flex-1 px-4 py-3 rounded-full text-[#0f0f0f] placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#d4af37]"
                               placeholder="Search..."
                               value="<?php echo get_search_query(); ?>"
                               name="s"
                               required>
                        <button type="submit" class="px-6 py-3 rounded-full bg-[#d4af37] text-[#0f0f0f] font-semibold hover:bg-[#f5d780] transition-all">
                            Search
                        </button>
                    </div>
                </form>
            </div>

            <!-- Navigation Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-glass-accent px-8 py-4 rounded-full font-semibold hover-lift">
                    <svg class="inline-block w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Back to Home
                </a>

                <?php
                $whatsapp = get_theme_mod('nusatatto_whatsapp', '6285792283479');
                $whatsapp_url = 'https://wa.me/' . $whatsapp . '?text=Hello,%20I%20need%20help%20finding%20information';
                ?>
                <a href="<?php echo esc_url($whatsapp_url); ?>" target="_blank" class="glass-lg px-8 py-4 rounded-full font-semibold hover-lift text-[#f5f5f5]">
                    <svg class="inline-block w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                    </svg>
                    Contact Us
                </a>
            </div>
        </div>

        <!-- Popular Links -->
        <div class="mt-12 glass p-6 rounded-2xl">
            <h3 class="text-xl font-semibold mb-4 text-[#f5f5f5]">Popular Links</h3>
            <div class="grid md:grid-cols-4 gap-4 text-sm">
                <a href="<?php echo esc_url(home_url('/#about')); ?>" class="text-gray-400 hover:text-[#d4af37] transition-colors">About Us</a>
                <a href="<?php echo esc_url(home_url('/#portfolio')); ?>" class="text-gray-400 hover:text-[#d4af37] transition-colors">Portfolio</a>
                <a href="<?php echo esc_url(home_url('/#why-us')); ?>" class="text-gray-400 hover:text-[#d4af37] transition-colors">Why Choose Us</a>
                <a href="<?php echo esc_url(home_url('/#faq')); ?>" class="text-gray-400 hover:text-[#d4af37] transition-colors">FAQ</a>
            </div>
        </div>
    </div>
</section>

<?php get_template_part('template-parts/footer'); ?>
