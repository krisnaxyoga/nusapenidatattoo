<?php
/**
 * Lopez Framework - Theme Wording System Initializer
 *
 * File utama untuk inisialisasi Lopez Framework.
 * Memuat semua file yang diperlukan dengan dependency handling yang tepat.
 * File ini harus di-include dari functions.php theme.
 *
 * CARA PENGGUNAAN:
 * Di functions.php theme, tambahkan:
 * require_once get_template_directory() . '/inc/lpz/lpz-init.php';
 *
 * DAFTAR ISI:
 * 1. CONSTANTS - Definisi konstanta framework
 * 2. INITIALIZATION - Fungsi inisialisasi utama
 * 3. CACHE HANDLING - Penanganan cache
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
   1. CONSTANTS
   Definisi konstanta yang digunakan di seluruh framework
   =========================================================================== */

/**
 * LPZ_VERSION - Versi framework
 *
 * Digunakan untuk:
 * - Cache busting pada CSS dan JS files
 * - Tracking versi di database jika diperlukan
 *
 * Format: MAJOR.MINOR.PATCH (Semantic Versioning)
 */
if (!defined('LPZ_VERSION')) {
    define('LPZ_VERSION', '1.1.0');
}

/**
 * LPZ_DIR - Path absolut ke direktori framework
 *
 * Digunakan untuk:
 * - require_once file PHP
 * - File system operations
 *
 * Contoh: /var/www/html/wp-content/themes/flavor/inc/lpz/
 */
if (!defined('LPZ_DIR')) {
    define('LPZ_DIR', dirname(__FILE__));
}

/**
 * LPZ_URL - URL ke direktori framework
 *
 * Digunakan untuk:
 * - Enqueue CSS dan JS files
 * - Asset URLs
 *
 * Contoh: https://example.com/wp-content/themes/flavor/inc/lpz/
 */
if (!defined('LPZ_URL')) {
    // Deteksi apakah framework berada di dalam theme atau sebagai standalone
    $lpz_dir = dirname(__FILE__);
    $theme_dir = get_template_directory();
    $theme_url = get_template_directory_uri();

    // Hitung relative path dari theme directory
    if (strpos($lpz_dir, $theme_dir) === 0) {
        // Framework berada di dalam theme
        $relative_path = str_replace($theme_dir, '', $lpz_dir);
        define('LPZ_URL', $theme_url . $relative_path);
    } else {
        // Fallback: framework sebagai standalone (development)
        define('LPZ_URL', plugin_dir_url(__FILE__));
    }
}

/* ===========================================================================
   2. INITIALIZATION
   Fungsi utama untuk memuat semua file framework
   =========================================================================== */

/**
 * Inisialisasi Lopez Framework
 *
 * Memuat semua file yang diperlukan dengan urutan yang benar:
 * 1. lpz-fields.php - Field definitions dan discovery
 * 2. lpz-helper.php - Helper functions untuk template
 * 3. pages/*.php - Semua definisi halaman/section
 * 4. lpz-admin.php - Admin interface (hanya di admin area)
 *
 * @since 1.0.0
 * @return void
 */
function lpz_init() {
    /**
     * Load field definitions
     *
     * File ini berisi fungsi lpz_get_fields() dan lpz_get_all_fields_flat()
     * yang diperlukan oleh admin dan frontend.
     */
    require_once LPZ_DIR . '/lpz-fields.php';

    /**
     * Load helper functions
     *
     * Berisi fungsi-fungsi seperti w(), we(), w_img(), w_repeater()
     * yang digunakan di template untuk mengambil nilai wording.
     */
    require_once LPZ_DIR . '/lpz-helper.php';

    /**
     * Load semua page definition files
     *
     * Setiap file di folder pages/ mendefinisikan:
     * - lpz_page_{name}_fields() - Definisi field untuk section tersebut
     * - lpz_page_{name}() - Helper function untuk template (opsional)
     *
     * Files di-load secara otomatis tanpa perlu manual include.
     */
    $pages_dir = LPZ_DIR . '/pages/';
    if (is_dir($pages_dir)) {
        foreach (glob($pages_dir . '*.php') as $file) {
            require_once $file;
        }
    }

    /**
     * Load admin interface (hanya di admin area)
     *
     * Performance optimization: file admin hanya di-load saat di admin area.
     * Ini mengurangi memory usage di frontend.
     */
    if (is_admin()) {
        // Pastikan folder includes ada
        $includes_dir = LPZ_DIR . '/includes/';
        if (!is_dir($includes_dir)) {
            // Buat folder jika belum ada (untuk backward compatibility)
            wp_mkdir_p($includes_dir);
        }

        require_once LPZ_DIR . '/lpz-admin.php';
    }
}

/**
 * Hook inisialisasi ke WordPress
 *
 * Menggunakan 'after_setup_theme' dengan priority 5 agar:
 * - Dijalankan setelah theme setup selesai
 * - Dijalankan sebelum hooks dengan priority default (10)
 * - Memungkinkan theme untuk override jika diperlukan
 */
add_action('after_setup_theme', 'lpz_init', 5);

/* ===========================================================================
   3. CACHE HANDLING
   Penanganan cache untuk optimasi performa
   =========================================================================== */

/**
 * Clear cache saat options di-update
 *
 * Dipanggil otomatis oleh WordPress setiap kali ada option yang di-update.
 * Kita hanya clear cache jika option 'lpz_options' yang di-update.
 *
 * @since 1.0.0
 * @param string $option_name Nama option yang di-update
 * @return void
 */
function lpz_options_updated($option_name) {
    // Hanya proses jika lpz_options yang di-update
    if ($option_name === 'lpz_options') {
        // Clear framework cache jika fungsi tersedia
        if (function_exists('lpz_clear_cache')) {
            lpz_clear_cache();
        }

        // Clear WordPress object cache untuk option ini
        wp_cache_delete('lpz_options', 'options');

        /**
         * Hook untuk clear cache external
         *
         * Memungkinkan theme atau plugin lain untuk melakukan
         * cache clearing tambahan saat wording di-update.
         *
         * @since 1.0.0
         */
        do_action('lpz_cache_cleared');
    }
}
add_action('updated_option', 'lpz_options_updated');

/**
 * Debug helper (hanya aktif di development)
 *
 * Uncomment untuk debugging saat development.
 * JANGAN aktifkan di production!
 */
// function lpz_debug_info() {
//     if (defined('WP_DEBUG') && WP_DEBUG && current_user_can('manage_options')) {
//         error_log('LPZ_VERSION: ' . LPZ_VERSION);
//         error_log('LPZ_DIR: ' . LPZ_DIR);
//         error_log('LPZ_URL: ' . LPZ_URL);
//     }
// }
// add_action('init', 'lpz_debug_info');
