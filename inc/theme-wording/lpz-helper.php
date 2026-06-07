<?php
/**
 * Lopez Framework - Theme Wording Helper Functions
 *
 * File ini menyediakan helper functions untuk mengambil nilai wording di template.
 * Menggunakan static caching untuk optimasi performa.
 *
 * FILE INI ADALAH YANG PALING SERING DIGUNAKAN DI TEMPLATE!
 * Semua fungsi di sini dirancang untuk kemudahan penggunaan di file template theme.
 *
 * =============================================================================
 * QUICK REFERENCE - Fungsi yang Paling Sering Digunakan
 * =============================================================================
 *
 * // Ambil nilai (return, tidak echo)
 * w('field_key')                    // Returns raw value
 * w('field_key', 'default')         // Dengan fallback default
 *
 * // Echo nilai (langsung tampilkan)
 * we('field_key')                   // Echo escaped text (aman dari XSS)
 * we_url('field_key')               // Echo escaped URL
 * we_html('field_key')              // Echo HTML (untuk WYSIWYG content)
 *
 * // Repeater (untuk loop data)
 * w_repeater('repeater_key')        // Returns array untuk di-loop
 *
 * // Gallery (multiple images)
 * w_gallery('gallery_key')          // Returns array [{id, url, alt}, ...]
 * w_gallery('gallery_key', 'full')  // Dengan custom image size
 *
 * // Image dengan fallback
 * w_img('upload_key', 'url_key')    // Ambil image URL (upload dulu, fallback ke URL)
 * we_img('upload_key', 'url_key')   // Echo image URL
 *
 * // Checkbox
 * w_checked('checkbox_key')         // Returns boolean true/false
 *
 * =============================================================================
 *
 * DAFTAR ISI:
 * 1. CORE FUNCTION - Fungsi inti untuk mengambil nilai
 * 2. SHORTHAND TEXT - Fungsi pendek untuk text output
 * 3. SHORTHAND IMAGE - Fungsi pendek untuk image handling
 * 4. SHORTHAND REPEATER - Fungsi pendek untuk repeater/array
 * 5. UTILITY FUNCTIONS - Fungsi utilitas tambahan
 *
 * @package    Lopez Framework
 * @author     Yoga Krisna
 * @copyright  2024 Juara Holding Group
 * @since      1.0.0
 */

// Prevent direct access - Security measure
if (!defined('ABSPATH')) {
    exit;
}

/* ===========================================================================
   1. CORE FUNCTION
   Fungsi inti untuk mengambil nilai wording dari database
   =========================================================================== */

/**
 * Get nilai wording dari database
 *
 * Ini adalah fungsi INTI dari framework. Semua helper function lain
 * memanggil fungsi ini untuk mengambil nilai.
 *
 * CARA KERJA:
 * 1. Load semua options dari database (cached)
 * 2. Load semua field definitions (cached)
 * 3. Cari nilai berdasarkan key
 * 4. Return nilai yang ditemukan atau default
 *
 * PRIORITAS NILAI:
 * 1. Nilai yang disimpan di database (dari admin)
 * 2. Default yang diberikan saat memanggil fungsi
 * 3. Default dari field definition
 * 4. String kosong ''
 *
 * CONTOH PENGGUNAAN:
 * ```php
 * // Basic usage
 * $title = lpz('hero_title');
 *
 * // Dengan default value
 * $title = lpz('hero_title', 'Welcome');
 *
 * // Untuk image (returns attachment ID atau URL)
 * $image = lpz('hero_image');
 * ```
 *
 * @since 1.0.0
 * @param string $key     Key wording yang ingin diambil
 * @param mixed $default  Nilai default jika key tidak ditemukan (opsional)
 * @return mixed Nilai wording atau default
 */
function lpz($key, $default = null) {
    /**
     * Static variables untuk caching
     *
     * Static variables mempertahankan nilai antar pemanggilan fungsi.
     * Ini sangat penting untuk performa karena:
     * - $options: Hanya query database sekali per request
     * - $fields: Hanya load field definitions sekali per request
     * - $loaded: Flag untuk memastikan inisialisasi sudah dilakukan
     */
    static $options = null;
    static $fields = null;
    static $loaded = false;

    // Force reload jika belum di-load (fix untuk static cache issue)
    // Ini memastikan cache di-reset dengan benar saat pertama kali dipanggil
    if (!$loaded) {
        $options = null;
        $loaded = true;
    }

    // Load options dari database (hanya sekali)
    // get_option() mengambil nilai dari wp_options table
    if ($options === null) {
        $options = get_option('lpz_options', []);
    }

    // Load field definitions (hanya sekali)
    // Ini diperlukan untuk mendapatkan default values dari field config
    if ($fields === null) {
        $fields = lpz_get_all_fields_flat();
    }

    // PRIORITAS 1: Return nilai dari database jika ada dan tidak kosong
    if (isset($options[$key]) && $options[$key] !== '') {
        return $options[$key];
    }

    // PRIORITAS 2: Return default yang diberikan saat memanggil fungsi
    if ($default !== null) {
        return $default;
    }

    // PRIORITAS 3: Return default dari field definition
    if (isset($fields[$key]['default'])) {
        return $fields[$key]['default'];
    }

    // PRIORITAS 4: Return string kosong sebagai fallback terakhir
    return '';
}

/* ===========================================================================
   2. SHORTHAND TEXT FUNCTIONS
   Fungsi pendek untuk output text di template
   =========================================================================== */

/**
 * Shorthand: Get wording value
 *
 * Alias pendek untuk lpz(). Lebih mudah diingat dan diketik.
 *
 * PENGGUNAAN:
 * ```php
 * $title = w('hero_title');
 * $desc = w('hero_description', 'Default description');
 * ```
 *
 * @since 1.0.0
 * @param string $key     Key wording
 * @param mixed $default  Nilai default (opsional)
 * @return mixed Nilai wording
 */
function w($key, $default = null) {
    return lpz($key, $default);
}

/**
 * Shorthand: Echo escaped text
 *
 * Langsung echo nilai yang sudah di-escape dengan esc_html().
 * GUNAKAN INI untuk text biasa agar aman dari XSS attack.
 *
 * PENGGUNAAN:
 * ```php
 * <h1><?php we('hero_title'); ?></h1>
 * <p><?php we('hero_description', 'Default text'); ?></p>
 * ```
 *
 * KEAMANAN:
 * - esc_html() mengubah karakter HTML menjadi entities
 * - Mencegah XSS (Cross-Site Scripting) attack
 * - Contoh: <script> menjadi &lt;script&gt;
 *
 * @since 1.0.0
 * @param string $key     Key wording
 * @param mixed $default  Nilai default (opsional)
 * @return void (langsung echo)
 */
function we($key, $default = null) {
    echo esc_html(lpz($key, $default));
}

/**
 * Shorthand: Echo escaped URL
 *
 * Langsung echo URL yang sudah di-escape dengan esc_url().
 * GUNAKAN INI untuk URL di href, src, dll.
 *
 * PENGGUNAAN:
 * ```php
 * <a href="<?php we_url('cta_link'); ?>">Click Here</a>
 * <img src="<?php we_url('logo_url'); ?>" alt="Logo">
 * ```
 *
 * KEAMANAN:
 * - esc_url() memvalidasi dan membersihkan URL
 * - Mencegah javascript: protocol injection
 * - Hanya mengizinkan protocol yang aman (http, https, mailto, dll)
 *
 * @since 1.0.0
 * @param string $key     Key wording
 * @param mixed $default  Nilai default (opsional)
 * @return void (langsung echo)
 */
function we_url($key, $default = null) {
    echo esc_url(lpz($key, $default));
}

/**
 * Shorthand: Echo HTML content (untuk WYSIWYG)
 *
 * Langsung echo HTML yang sudah di-filter dengan wp_kses_post().
 * GUNAKAN INI untuk content dari WYSIWYG editor.
 *
 * PENGGUNAAN:
 * ```php
 * <div class="content">
 *     <?php we_html('about_content'); ?>
 * </div>
 * ```
 *
 * KEAMANAN:
 * - wp_kses_post() hanya mengizinkan HTML tags yang aman
 * - Tags yang diizinkan: p, br, strong, em, a, ul, ol, li, h1-h6, dll
 * - Tags berbahaya seperti <script>, <iframe> akan dihapus
 *
 * @since 1.0.0
 * @param string $key     Key wording
 * @param mixed $default  Nilai default (opsional)
 * @return void (langsung echo)
 */
function we_html($key, $default = null) {
    echo wp_kses_post(lpz($key, $default));
}

/* ===========================================================================
   3. SHORTHAND IMAGE FUNCTIONS
   Fungsi pendek untuk handling gambar
   =========================================================================== */

/**
 * Shorthand: Get image URL dengan fallback
 *
 * Menghandle dua skenario:
 * 1. Image dari Media Library (disimpan sebagai attachment ID)
 * 2. Image dari external URL (disimpan sebagai string URL)
 *
 * PENGGUNAAN:
 * ```php
 * // Dengan fallback ke URL field
 * $img_url = w_img('hero_image', 'hero_image_url');
 *
 * // Tanpa fallback
 * $img_url = w_img('logo');
 * ```
 *
 * CARA KERJA:
 * 1. Cek nilai upload_key
 * 2. Jika numeric (attachment ID), convert ke URL
 * 3. Jika string (URL), gunakan langsung
 * 4. Jika kosong dan ada url_key, gunakan nilai url_key sebagai fallback
 *
 * @since 1.0.0
 * @param string $upload_key Key untuk field image upload
 * @param string $url_key    Key untuk field URL fallback (opsional)
 * @return string URL gambar atau string kosong
 */
function w_img($upload_key, $url_key = null) {
    // Ambil nilai dari upload field
    $upload = lpz($upload_key);

    if (!empty($upload)) {
        // Jika nilai numeric, ini adalah attachment ID dari Media Library
        if (is_numeric($upload)) {
            // Convert attachment ID ke URL
            $url = wp_get_attachment_url(intval($upload));
            if ($url) {
                return $url;
            }
        } else {
            // Nilai sudah berupa URL, return langsung
            return $upload;
        }
    }

    // Fallback ke URL field jika upload kosong
    return $url_key ? lpz($url_key) : '';
}

/**
 * Shorthand: Get image data lengkap (URL, alt, title)
 *
 * Mengambil data lengkap dari Media Library attachment.
 * Sangat berguna untuk accessibility (alt text).
 *
 * PENGGUNAAN:
 * ```php
 * $img = w_img_data('hero_image', 'hero_image_url', 'Hero Image');
 * ?>
 * <img
 *     src="<?php echo esc_url($img['url']); ?>"
 *     alt="<?php echo esc_attr($img['alt']); ?>"
 *     title="<?php echo esc_attr($img['title']); ?>"
 * >
 * ```
 *
 * RETURN FORMAT:
 * ```php
 * [
 *     'url'   => 'https://example.com/image.jpg',
 *     'alt'   => 'Alt text dari Media Library',
 *     'title' => 'Title dari attachment post',
 * ]
 * ```
 *
 * @since 1.0.0
 * @param string $upload_key  Key untuk field image upload
 * @param string $url_key     Key untuk field URL fallback (opsional)
 * @param string $default_alt Alt text default jika tidak ada di Media Library
 * @return array Array dengan keys: url, alt, title
 */
function w_img_data($upload_key, $url_key = null, $default_alt = '') {
    // Inisialisasi result dengan default values
    $result = [
        'url'   => '',
        'alt'   => $default_alt,
        'title' => '',
    ];

    // Ambil nilai upload field
    $upload_value = lpz($upload_key);

    if (!empty($upload_value)) {
        // Jika numeric, ini attachment ID - ambil data lengkap
        if (is_numeric($upload_value)) {
            $attachment_id = intval($upload_value);

            // Ambil URL dari attachment
            $result['url'] = wp_get_attachment_url($attachment_id);

            // Ambil alt text dari post meta
            // Alt text disimpan di _wp_attachment_image_alt meta
            $result['alt'] = get_post_meta($attachment_id, '_wp_attachment_image_alt', true) ?: $default_alt;

            // Ambil title dari attachment post
            $result['title'] = get_the_title($attachment_id);
        } else {
            // Nilai sudah berupa URL
            $result['url'] = $upload_value;
        }
    }

    // Fallback ke URL field jika upload kosong
    if (empty($result['url']) && $url_key) {
        $result['url'] = lpz($url_key);
    }

    return $result;
}

/**
 * Shorthand: Echo image URL dengan fallback
 *
 * Kombinasi w_img() + echo + esc_url() untuk kemudahan.
 *
 * PENGGUNAAN:
 * ```php
 * <img src="<?php we_img('hero_image', 'hero_image_url'); ?>" alt="Hero">
 * ```
 *
 * @since 1.0.0
 * @param string $upload_key Key untuk field image upload
 * @param string $url_key    Key untuk field URL fallback (opsional)
 * @return void (langsung echo)
 */
function we_img($upload_key, $url_key = null) {
    echo esc_url(w_img($upload_key, $url_key));
}

/**
 * Shorthand: Echo complete image tag
 *
 * Generate dan echo tag <img> lengkap dengan class dan alt.
 *
 * PENGGUNAAN:
 * ```php
 * <?php w_img_tag('logo', 'site-logo', 'Company Logo'); ?>
 * // Output: <img src="..." class="site-logo" alt="Company Logo">
 * ```
 *
 * CATATAN:
 * - Tidak output apapun jika URL kosong
 * - Class dan alt di-escape untuk keamanan
 *
 * @since 1.0.0
 * @param string $key   Key wording untuk image URL
 * @param string $class CSS class untuk image (opsional)
 * @param string $alt   Alt text untuk image (opsional)
 * @return void (langsung echo)
 */
function w_img_tag($key, $class = '', $alt = '') {
    $url = lpz($key);

    // Hanya output jika URL tidak kosong
    if (!empty($url)) {
        printf(
            '<img src="%s" class="%s" alt="%s">',
            esc_url($url),
            esc_attr($class),
            esc_attr($alt)
        );
    }
}

/**
 * Shorthand: Echo image tag dengan fallback
 *
 * Sama seperti w_img_tag() tapi dengan fallback URL field.
 *
 * PENGGUNAAN:
 * ```php
 * <?php w_img_tag_fallback('hero_image', 'hero_image_url', 'hero-bg', 'Hero Background'); ?>
 * ```
 *
 * @since 1.0.0
 * @param string $upload_key Key untuk field image upload
 * @param string $url_key    Key untuk field URL fallback
 * @param string $class      CSS class untuk image (opsional)
 * @param string $alt        Alt text untuk image (opsional)
 * @return void (langsung echo)
 */
function w_img_tag_fallback($upload_key, $url_key, $class = '', $alt = '') {
    $url = w_img($upload_key, $url_key);

    // Hanya output jika URL tidak kosong
    if (!empty($url)) {
        printf(
            '<img src="%s" class="%s" alt="%s">',
            esc_url($url),
            esc_attr($class),
            esc_attr($alt)
        );
    }
}

/* ===========================================================================
   4. SHORTHAND REPEATER, GALLERY & CHECKBOX FUNCTIONS
   Fungsi pendek untuk repeater (array), gallery, dan checkbox (boolean)
   =========================================================================== */

/**
 * Shorthand: Get repeater sebagai array
 *
 * Repeater field menyimpan data sebagai array.
 * Fungsi ini memastikan return value selalu array (tidak pernah null/false).
 *
 * PENGGUNAAN:
 * ```php
 * <?php foreach (w_repeater('features') as $feature) : ?>
 *     <div class="feature">
 *         <h3><?php echo esc_html($feature['title']); ?></h3>
 *         <p><?php echo esc_html($feature['description']); ?></p>
 *     </div>
 * <?php endforeach; ?>
 * ```
 *
 * REPEATER DATA FORMAT:
 * ```php
 * [
 *     ['title' => 'Feature 1', 'description' => 'Desc 1', 'icon' => 123],
 *     ['title' => 'Feature 2', 'description' => 'Desc 2', 'icon' => 456],
 * ]
 * ```
 *
 * @since 1.0.0
 * @param string $key Key repeater field
 * @return array Array of items (selalu array, tidak pernah null)
 */
function w_repeater($key) {
    $value = lpz($key);

    // Pastikan return value selalu array
    // Ini mencegah error saat foreach jika nilai kosong/null
    return is_array($value) ? $value : [];
}

/**
 * Shorthand: Get gallery sebagai array dengan URL
 *
 * Gallery field menyimpan array of images dengan attachment ID dan alt text.
 * Fungsi ini mengkonversi attachment ID menjadi URL yang siap digunakan.
 *
 * PENGGUNAAN:
 * ```php
 * <?php foreach (w_gallery('photo_gallery') as $image) : ?>
 *     <div class="gallery-item">
 *         <img src="<?php echo esc_url($image['url']); ?>"
 *              alt="<?php echo esc_attr($image['alt']); ?>">
 *     </div>
 * <?php endforeach; ?>
 * ```
 *
 * RETURN FORMAT:
 * ```php
 * [
 *     ['id' => 123, 'url' => 'https://...jpg', 'alt' => 'Alt text'],
 *     ['id' => 456, 'url' => 'https://...jpg', 'alt' => 'Another alt'],
 * ]
 * ```
 *
 * @since 1.1.0
 * @param string $key   Key gallery field
 * @param string $size  Image size (thumbnail, medium, large, full). Default: 'large'
 * @return array Array of images dengan url, id, dan alt
 */
function w_gallery($key, $size = 'large') {
    $value = lpz($key);

    // Pastikan return value selalu array
    if (!is_array($value)) {
        return [];
    }

    $gallery = [];

    foreach ($value as $item) {
        if (!is_array($item)) {
            continue;
        }

        $attachment_id = isset($item['id']) ? intval($item['id']) : 0;
        if ($attachment_id <= 0) {
            continue;
        }

        // Get image URL dengan size yang diminta
        $image_src = wp_get_attachment_image_src($attachment_id, $size);
        if (!$image_src) {
            continue;
        }

        $gallery[] = [
            'id'  => $attachment_id,
            'url' => $image_src[0],
            'alt' => isset($item['alt']) ? $item['alt'] : '',
        ];
    }

    return $gallery;
}

/**
 * Shorthand: Check apakah checkbox di-check
 *
 * Checkbox menyimpan nilai '1' (string) jika checked.
 * Fungsi ini return boolean untuk kemudahan if statement.
 *
 * PENGGUNAAN:
 * ```php
 * <?php if (w_checked('show_newsletter')) : ?>
 *     <div class="newsletter-form">
 *         <!-- Newsletter form here -->
 *     </div>
 * <?php endif; ?>
 * ```
 *
 * @since 1.0.0
 * @param string $key Key checkbox field
 * @return bool True jika checked, false jika tidak
 */
function w_checked($key) {
    // Checkbox menyimpan '1' (string) jika checked
    return lpz($key) === '1';
}

/* ===========================================================================
   5. UTILITY FUNCTIONS
   Fungsi utilitas tambahan
   =========================================================================== */

/**
 * Get full image URL dari berbagai format input
 *
 * Fungsi utilitas yang menghandle berbagai format image value:
 * - Attachment ID (numeric): Convert ke URL via Media Library
 * - Relative path (/wp-content/...): Prepend home_url()
 * - Absolute URL (https://...): Return as-is
 *
 * PENGGUNAAN:
 * ```php
 * $url = kl_get_image_url($image_value);
 * ```
 *
 * CATATAN:
 * - Fungsi ini dibungkus dengan function_exists() untuk menghindari
 *   conflict jika sudah didefinisikan di tempat lain
 *
 * @since 1.0.0
 * @param mixed $value Attachment ID, URL, atau path
 * @return string Full URL atau string kosong
 */
if (!function_exists('kl_get_image_url')) {
    function kl_get_image_url($value) {
        // Return kosong jika value kosong
        if (empty($value)) {
            return '';
        }

        // Jika numeric, ini attachment ID - ambil URL dari Media Library
        if (is_numeric($value)) {
            $url = wp_get_attachment_url(intval($value));
            return $url ? $url : '';
        }

        // Jika sudah absolute URL, return langsung
        if (strpos($value, 'http://') === 0 || strpos($value, 'https://') === 0) {
            return $value;
        }

        // Relative path - prepend home_url()
        // Contoh: /wp-content/uploads/2024/01/image.jpg
        return home_url() . $value;
    }
}

/**
 * Check apakah wording key ada/terdefinisi
 *
 * Berguna untuk conditional rendering berdasarkan keberadaan field.
 *
 * PENGGUNAAN:
 * ```php
 * if (lpz_exists('custom_field')) {
 *     // Field terdefinisi di pages/*.php
 * }
 * ```
 *
 * CATATAN:
 * - Ini mengecek apakah field TERDEFINISI, bukan apakah ada nilainya
 * - Field yang terdefinisi tapi belum diisi akan return true
 *
 * @since 1.0.0
 * @param string $key Key wording
 * @return bool True jika field terdefinisi
 */
function lpz_exists($key) {
    $fields = lpz_get_all_fields_flat();
    return isset($fields[$key]);
}

/**
 * Clear wording cache
 *
 * Dipanggil otomatis saat options di-update.
 * Bisa juga dipanggil manual jika diperlukan.
 *
 * PENGGUNAAN:
 * ```php
 * // Biasanya tidak perlu dipanggil manual
 * // Tapi jika ada custom caching:
 * lpz_clear_cache();
 * ```
 *
 * @since 1.0.0
 * @return void
 */
function lpz_clear_cache() {
    // Clear WordPress object cache untuk lpz_options
    wp_cache_delete('lpz_options', 'lpz');
}

/* ===========================================================================
   CATATAN UNTUK DEVELOPER
   =========================================================================== */

/**
 * BEST PRACTICES:
 *
 * 1. SELALU gunakan fungsi yang di-escape untuk output:
 *    - we() untuk text biasa
 *    - we_url() untuk URL
 *    - we_html() untuk WYSIWYG content
 *
 * 2. Untuk kondisional, gunakan w() (return) bukan we() (echo):
 *    ```php
 *    // Benar
 *    if (w('show_section')) { ... }
 *
 *    // Salah
 *    if (we('show_section')) { ... } // we() return void!
 *    ```
 *
 * 3. Untuk repeater, selalu gunakan w_repeater():
 *    ```php
 *    // Benar - w_repeater() selalu return array
 *    foreach (w_repeater('items') as $item) { ... }
 *
 *    // Risky - w() bisa return null
 *    foreach (w('items') as $item) { ... } // Error jika null!
 *    ```
 *
 * 4. Untuk image, gunakan w_img() untuk handle attachment ID:
 *    ```php
 *    // Benar - handles attachment ID
 *    $url = w_img('hero_image');
 *
 *    // Salah - tidak convert ID ke URL
 *    $url = w('hero_image'); // Bisa return "123" bukan URL!
 *    ```
 *
 *
 * SECURITY NOTES:
 *
 * - JANGAN pernah echo w() langsung tanpa escaping
 * - SELALU gunakan we(), we_url(), atau we_html()
 * - Untuk attribute, gunakan esc_attr(): echo esc_attr(w('field'))
 *
 *
 * PERFORMANCE NOTES:
 *
 * - Semua fungsi menggunakan static caching
 * - Database hanya di-query SEKALI per request
 * - Aman untuk dipanggil berkali-kali tanpa overhead
 */
