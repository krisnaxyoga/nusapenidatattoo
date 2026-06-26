<?php
/**
 * Lopez Framework - Homepage Wording
 *
 * Mendefinisikan field wording untuk halaman depan (front-page.php).
 * Default diambil dari nilai Customizer / teks lama agar tampilan tidak berubah
 * sebelum diedit. Gambar (hero/about/portfolio) & kontak (WA/telepon/alamat)
 * tetap dari Customizer agar konsisten dengan header, footer, dan halaman lain.
 *
 * Section ID: home
 * Helper:     w('home_*') / we('home_*')
 *
 * @package    Lopez Framework
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

function lpz_page_home_fields() {
    return [
        'title'  => 'Homepage',
        'fields' => [

            /* ============================ HERO ============================ */
            'home_hero_headline' => [
                'label'   => 'Hero Headline',
                'type'    => 'text',
                'default' => 'Nusa Penida Tattoo – Ink Your Island Story',
                'group'   => 'Hero',
            ],
            'home_hero_description' => [
                'label'   => 'Hero Description',
                'type'    => 'textarea',
                'default' => 'Experience the art of tattooing in paradise. Our certified artists in Nusa Penida create custom designs that tell your Bali story — with care, creativity, and clean precision.',
                'group'   => 'Hero',
            ],
            'home_hero_btn_primary' => [
                'label'   => 'Hero Primary Button',
                'type'    => 'text',
                'default' => 'Book Your Tattoo',
                'group'   => 'Hero',
            ],
            'home_hero_btn_secondary' => [
                'label'   => 'Hero Secondary Button',
                'type'    => 'text',
                'default' => 'View Our Portfolio',
                'group'   => 'Hero',
            ],

            /* ======================= SEO INTRO BLOCK ===================== */
            'home_intro_title' => [
                'label'   => 'Intro Title',
                'type'    => 'text',
                'default' => 'Tattoo Studio in Nusa Penida, Bali',
                'group'   => 'Intro (SEO)',
            ],
            'home_intro_text' => [
                'label'   => 'Intro Paragraph (HTML allowed)',
                'type'    => 'wysiwyg',
                'default' => '<strong>Nusa Penida Tattoo</strong> is a professional, fully-sterile tattoo studio on Nusa Penida island, Bali. We create custom <strong>fine-line, minimalist, blackwork and traditional Balinese tattoos</strong> for international travelers — with English-speaking artists and <strong>walk-ins welcome</strong>.',
                'group'   => 'Intro (SEO)',
            ],
            'home_fact_1' => [
                'label'   => 'Quick Fact 1',
                'type'    => 'text',
                'default' => 'Nusa Penida, Bali — near Toyapakeh harbor & Crystal Bay',
                'group'   => 'Intro (SEO)',
            ],
            'home_fact_2' => [
                'label'   => 'Quick Fact 2',
                'type'    => 'text',
                'default' => 'Open daily, 10:00 AM – 9:00 PM',
                'group'   => 'Intro (SEO)',
            ],
            'home_fact_3' => [
                'label'   => 'Quick Fact 3',
                'type'    => 'text',
                'default' => 'Custom & flash designs available',
                'group'   => 'Intro (SEO)',
            ],
            'home_fact_4' => [
                'label'   => 'Quick Fact 4',
                'type'    => 'text',
                'default' => 'Walk-ins welcome — no appointment needed',
                'group'   => 'Intro (SEO)',
            ],
            'home_fact_5' => [
                'label'   => 'Quick Fact 5',
                'type'    => 'text',
                'default' => 'Fine-line, minimalist, blackwork & custom Balinese',
                'group'   => 'Intro (SEO)',
            ],
            'home_fact_6' => [
                'label'   => 'Quick Fact 6',
                'type'    => 'text',
                'default' => 'English-speaking, certified artists',
                'group'   => 'Intro (SEO)',
            ],

            /* ============================ ABOUT ========================== */
            'home_about_title' => [
                'label'   => 'About Title',
                'type'    => 'text',
                'default' => 'Authentic Tattoo Studio in Nusa Penida',
                'group'   => 'About',
            ],
            'home_about_desc1' => [
                'label'   => 'About Paragraph 1',
                'type'    => 'textarea',
                'default' => 'At Nusa Penida Tattoo, we blend world-class tattoo artistry with the island\'s natural beauty. Our professional team offers a safe, hygienic, and welcoming space for travelers seeking meaningful tattoos — inspired by the ocean, island life, and personal stories.',
                'group'   => 'About',
            ],
            'home_about_desc2' => [
                'label'   => 'About Paragraph 2',
                'type'    => 'textarea',
                'default' => 'Whether it\'s your first ink or your next masterpiece, our artists will make it unforgettable.',
                'group'   => 'About',
            ],
            'home_stat1_number' => ['label' => 'Stat 1 Number', 'type' => 'text', 'default' => '500+', 'group' => 'About'],
            'home_stat1_label'  => ['label' => 'Stat 1 Label',  'type' => 'text', 'default' => 'Happy Clients', 'group' => 'About'],
            'home_stat2_number' => ['label' => 'Stat 2 Number', 'type' => 'text', 'default' => '10+', 'group' => 'About'],
            'home_stat2_label'  => ['label' => 'Stat 2 Label',  'type' => 'text', 'default' => 'Years Experience', 'group' => 'About'],
            'home_stat3_number' => ['label' => 'Stat 3 Number', 'type' => 'text', 'default' => '100%', 'group' => 'About'],
            'home_stat3_label'  => ['label' => 'Stat 3 Label',  'type' => 'text', 'default' => 'Satisfaction', 'group' => 'About'],

            /* ========================== PORTFOLIO ======================== */
            'home_portfolio_title' => [
                'label'   => 'Portfolio Title',
                'type'    => 'text',
                'default' => 'Our Work Speaks for Itself',
                'group'   => 'Portfolio',
            ],
            'home_portfolio_desc' => [
                'label'   => 'Portfolio Description',
                'type'    => 'textarea',
                'default' => 'From fine-line art to bold tribal pieces — each tattoo is crafted with precision and passion.',
                'group'   => 'Portfolio',
            ],

            /* =========================== WHY US ========================== */
            'home_whyus_title' => [
                'label'   => 'Why Us Title',
                'type'    => 'text',
                'default' => 'Why Choose Nusa Penida Tattoo',
                'group'   => 'Why Us',
            ],
            'home_feature1_title' => ['label' => 'Feature 1 Title', 'type' => 'text', 'default' => 'Certified & Experienced Artists', 'group' => 'Why Us'],
            'home_feature1_desc'  => ['label' => 'Feature 1 Text', 'type' => 'textarea', 'default' => 'Professional team with international certification and impressive portfolios to bring your vision to life.', 'group' => 'Why Us'],
            'home_feature2_title' => ['label' => 'Feature 2 Title', 'type' => 'text', 'default' => '100% Hygienic, Sterile Equipment', 'group' => 'Why Us'],
            'home_feature2_desc'  => ['label' => 'Feature 2 Text', 'type' => 'textarea', 'default' => 'Using premium ink and sterile equipment for the best results and maximum safety for every client.', 'group' => 'Why Us'],
            'home_feature3_title' => ['label' => 'Feature 3 Title', 'type' => 'text', 'default' => 'Custom Designs, Island Inspiration', 'group' => 'Why Us'],
            'home_feature3_desc'  => ['label' => 'Feature 3 Text', 'type' => 'textarea', 'default' => 'In-depth discussion about design, size, and placement to create your perfect tattoo inspired by island life.', 'group' => 'Why Us'],
            'home_feature4_title' => ['label' => 'Feature 4 Title', 'type' => 'text', 'default' => 'English-Speaking Staff', 'group' => 'Why Us'],
            'home_feature4_desc'  => ['label' => 'Feature 4 Text', 'type' => 'textarea', 'default' => 'Our team speaks fluent English to ensure clear communication and understanding of your tattoo vision.', 'group' => 'Why Us'],
            'home_feature5_title' => ['label' => 'Feature 5 Title', 'type' => 'text', 'default' => 'Easy WhatsApp Booking & Fast Replies', 'group' => 'Why Us'],
            'home_feature5_desc'  => ['label' => 'Feature 5 Text', 'type' => 'textarea', 'default' => 'Complete aftercare guidance and post-service support for optimal healing and results.', 'group' => 'Why Us'],
            'home_feature6_title' => ['label' => 'Feature 6 Title', 'type' => 'text', 'default' => 'Competitive Pricing', 'group' => 'Why Us'],
            'home_feature6_desc'  => ['label' => 'Feature 6 Text', 'type' => 'textarea', 'default' => 'Affordable pricing packages without sacrificing quality and professionalism in every work.', 'group' => 'Why Us'],

            /* ============================ FAQ ============================ */
            'home_faq_title' => [
                'label'   => 'FAQ Title',
                'type'    => 'text',
                'default' => 'Frequently Asked Questions',
                'group'   => 'FAQ',
            ],
            'home_faq1_q' => ['label' => 'FAQ 1 Question', 'type' => 'text', 'default' => 'Is a fine-line tattoo good for first-timers?', 'group' => 'FAQ'],
            'home_faq1_a' => ['label' => 'FAQ 1 Answer', 'type' => 'textarea', 'default' => 'Yes. Fine-line tattoos are ideal for first-time clients because they are minimalist, less painful and heal faster than larger tattoo styles. Our artists will guide you through design, size and placement during a friendly consultation.', 'group' => 'FAQ'],
            'home_faq2_q' => ['label' => 'FAQ 2 Question', 'type' => 'text', 'default' => 'Do you accept walk-in tattoos in Nusa Penida?', 'group' => 'FAQ'],
            'home_faq2_a' => ['label' => 'FAQ 2 Answer', 'type' => 'textarea', 'default' => 'Yes, walk-ins are welcome every day from 10:00 AM to 9:00 PM. To guarantee your preferred time and artist, we recommend messaging us on WhatsApp first, especially during high season.', 'group' => 'FAQ'],
            'home_faq3_q' => ['label' => 'FAQ 3 Question', 'type' => 'text', 'default' => 'What tattoo styles does Nusa Penida Tattoo offer?', 'group' => 'FAQ'],
            'home_faq3_a' => ['label' => 'FAQ 3 Answer', 'type' => 'textarea', 'default' => 'We specialize in fine-line, minimalist, lettering, blackwork, tribal and traditional Balinese tattoos, as well as fully custom designs inspired by the ocean and island life.', 'group' => 'FAQ'],
            'home_faq4_q' => ['label' => 'FAQ 4 Question', 'type' => 'text', 'default' => 'Is it safe and hygienic to get a tattoo while traveling in Nusa Penida?', 'group' => 'FAQ'],
            'home_faq4_a' => ['label' => 'FAQ 4 Answer', 'type' => 'textarea', 'default' => 'Yes. We follow strict hygiene standards using single-use sterile needles, premium ink and professional procedures, making it safe for international travelers.', 'group' => 'FAQ'],
            'home_faq5_q' => ['label' => 'FAQ 5 Question', 'type' => 'text', 'default' => 'How long does a fine-line tattoo take to heal?', 'group' => 'FAQ'],
            'home_faq5_a' => ['label' => 'FAQ 5 Answer', 'type' => 'textarea', 'default' => 'Fine-line tattoos usually heal within 7 to 14 days. Proper aftercare is essential in a tropical climate like Bali — avoid sun, sea water and pools until fully healed. We provide complete aftercare guidance.', 'group' => 'FAQ'],
            'home_faq6_q' => ['label' => 'FAQ 6 Question', 'type' => 'text', 'default' => 'Do your tattoo artists speak English?', 'group' => 'FAQ'],
            'home_faq6_a' => ['label' => 'FAQ 6 Answer', 'type' => 'textarea', 'default' => 'Yes. Our artists speak fluent English, so it is easy for international travelers to discuss design, size and placement clearly.', 'group' => 'FAQ'],
            'home_faq7_q' => ['label' => 'FAQ 7 Question', 'type' => 'text', 'default' => 'Can I bring my own tattoo design?', 'group' => 'FAQ'],
            'home_faq7_a' => ['label' => 'FAQ 7 Answer', 'type' => 'textarea', 'default' => 'Absolutely. You can bring your own design or idea, and our artists will refine it or create a fully custom piece that fits your story.', 'group' => 'FAQ'],
            'home_faq8_q' => ['label' => 'FAQ 8 Question', 'type' => 'text', 'default' => 'How do I book a tattoo appointment in Nusa Penida?', 'group' => 'FAQ'],
            'home_faq8_a' => ['label' => 'FAQ 8 Answer', 'type' => 'textarea', 'default' => 'Just message us on WhatsApp before or during your visit to Nusa Penida — tell us your idea, size and preferred date, and we will confirm your appointment.', 'group' => 'FAQ'],

            /* ========================== LOCATION ========================= */
            'home_location_title' => [
                'label'   => 'Location Title',
                'type'    => 'text',
                'default' => 'Find Us in the Heart of Nusa Penida',
                'group'   => 'Location',
            ],
            'home_location_studio_name' => [
                'label'   => 'Studio Name',
                'type'    => 'text',
                'default' => 'Nusa Penida Tattoo Studio',
                'group'   => 'Location',
            ],
            'home_location_hours' => [
                'label'   => 'Operating Hours Text',
                'type'    => 'text',
                'default' => 'Monday – Sunday: 10:00 AM – 9:00 PM',
                'group'   => 'Location',
            ],
            'home_location_walkin' => [
                'label'   => 'Walk-in Note',
                'type'    => 'text',
                'default' => 'Walk-ins welcome — no appointment needed',
                'group'   => 'Location',
            ],
            'home_location_intro' => [
                'label'   => 'Location Paragraph',
                'type'    => 'textarea',
                'default' => 'We\'re located just minutes from the harbor — easy to reach for travelers staying in Toyapakeh, Crystal Bay, or anywhere on the island.',
                'group'   => 'Location',
            ],
            'home_location_btn' => [
                'label'   => 'Location Button',
                'type'    => 'text',
                'default' => 'Book via WhatsApp',
                'group'   => 'Location',
            ],
            'home_map_embed' => [
                'label'       => 'Google Maps Embed URL',
                'type'        => 'textarea',
                'default'     => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3363.7254776412406!2d115.48628397425568!3d-8.688476688491884!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd2730020060b5b%3A0xb10103ba6bfb897e!2sTATTOO%20DWIKI%20NUSA%20PENIDA!5e1!3m2!1sen!2sid!4v1782482583525!5m2!1sen!2sid',
                'description' => 'Tempel hanya URL dari atribut src="..." pada kode embed Google Maps (bukan seluruh tag iframe).',
                'group'       => 'Location',
            ],

            /* ========================== REVIEWS ========================== */
            'home_reviews_title' => [
                'label'   => 'Reviews Title',
                'type'    => 'text',
                'default' => 'Our Clients Love the Studio',
                'group'   => 'Reviews',
            ],
            'home_reviews_subtitle' => [
                'label'   => 'Reviews Subtitle',
                'type'    => 'textarea',
                'default' => 'Hear what our happy clients say about their tattoo experience in Nusa Penida.',
                'group'   => 'Reviews',
            ],
            'home_review1_text' => ['label' => 'Review 1 Text', 'type' => 'textarea', 'default' => 'Amazing tattoo experience in Nusa Penida! Clean studio, friendly artists, and professional service.', 'group' => 'Reviews'],
            'home_review1_name' => ['label' => 'Review 1 Name', 'type' => 'text', 'default' => 'Emily Carter', 'group' => 'Reviews'],
            'home_review2_text' => ['label' => 'Review 2 Text', 'type' => 'textarea', 'default' => 'Best tattoo studio in Nusa Penida. Highly recommended!', 'group' => 'Reviews'],
            'home_review2_name' => ['label' => 'Review 2 Name', 'type' => 'text', 'default' => 'Wayan Putra', 'group' => 'Reviews'],
            'home_review3_text' => ['label' => 'Review 3 Text', 'type' => 'textarea', 'default' => 'Super clean, safe, and creative tattoo artists. Totally worth visiting!', 'group' => 'Reviews'],
            'home_review3_name' => ['label' => 'Review 3 Name', 'type' => 'text', 'default' => 'Sophie Lee', 'group' => 'Reviews'],

            /* ============================ CTA ============================ */
            'home_cta_title' => [
                'label'   => 'CTA Title',
                'type'    => 'text',
                'default' => 'Ready for Your Dream Tattoo?',
                'group'   => 'Final CTA',
            ],
            'home_cta_text' => [
                'label'   => 'CTA Text',
                'type'    => 'textarea',
                'default' => 'Book your tattoo session today and make your Bali trip unforgettable.',
                'group'   => 'Final CTA',
            ],
            'home_cta_btn_primary' => [
                'label'   => 'CTA Primary Button',
                'type'    => 'text',
                'default' => 'Book Your Tattoo',
                'group'   => 'Final CTA',
            ],
            'home_cta_btn_whatsapp' => [
                'label'   => 'CTA WhatsApp Button',
                'type'    => 'text',
                'default' => 'Chat WhatsApp',
                'group'   => 'Final CTA',
            ],

        ],
    ];
}
