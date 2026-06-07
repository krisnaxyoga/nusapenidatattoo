<?php
/**
 * Lopez Framework - Theme Wording Fields Loader
 *
 * File ini bertanggung jawab untuk:
 * 1. Memuat semua file definisi halaman dari folder /pages/
 * 2. Auto-discover fungsi lpz_page_*_fields() yang terdaftar
 * 3. Menyediakan akses ke semua field definitions
 *
 * CARA KERJA:
 * - Setiap file di folder /pages/ mendefinisikan fungsi lpz_page_{name}_fields()
 * - Framework secara otomatis menemukan semua fungsi tersebut
 * - Field definitions dikumpulkan dan disediakan untuk admin panel
 *
 * CONTOH PENGGUNAAN:
 * ```php
 * // Di pages/about.php
 * function lpz_page_about_fields() {
 *     return [
 *         'title' => 'About Page',
 *         'fields' => [
 *             'about_title' => [
 *                 'label' => 'Title',
 *                 'type' => 'text',
 *                 'default' => 'About Us',
 *             ],
 *         ]
 *     ];
 * }
 * ```
 *
 * DAFTAR ISI:
 * 1. PAGE LOADER - Memuat file dari folder pages/
 * 2. FIELD DISCOVERY - Auto-discover dan kumpulkan field definitions
 * 3. FLAT FIELDS - Menyediakan flat array untuk admin processing
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
   1. PAGE LOADER
   Memuat semua file PHP dari folder /pages/
   =========================================================================== */

/**
 * Load semua file definisi halaman
 *
 * Fungsi ini memuat semua file PHP dari folder /pages/ kecuali _template.php.
 * Menggunakan static variable untuk memastikan file hanya di-load sekali
 * (singleton pattern untuk optimasi performa).
 *
 * CATATAN:
 * - File _template.php adalah template kosong dan di-skip
 * - Setiap file harus mendefinisikan lpz_page_{name}_fields()
 * - File di-load menggunakan require_once untuk menghindari duplikasi
 *
 * @since 1.0.0
 * @return void
 */
function lpz_load_pages() {
    // Static variable untuk tracking apakah sudah di-load
    // Ini mencegah multiple loading yang tidak perlu
    static $loaded = false;

    // Jika sudah di-load sebelumnya, langsung return
    if ($loaded) {
        return;
    }

    // Tentukan path ke folder pages
    $pages_dir = dirname(__FILE__) . '/pages/';

    // Cek apakah folder pages ada
    if (!is_dir($pages_dir)) {
        return;
    }

    // Ambil semua file PHP di folder pages
    $files = glob($pages_dir . '*.php');

    // Loop dan load setiap file
    foreach ($files as $file) {
        $filename = basename($file);

        // Skip file template (dimulai dengan underscore)
        // _template.php adalah template kosong untuk membuat halaman baru
        if ($filename === '_template.php') {
            continue;
        }

        // Load file menggunakan require_once
        // require_once memastikan file hanya di-load sekali
        require_once $file;
    }

    // Tandai bahwa loading sudah selesai
    $loaded = true;
}

/**
 * Panggil loader saat file ini di-include
 *
 * Ini memastikan semua file pages sudah di-load
 * sebelum fungsi lpz_get_fields() dipanggil
 */
lpz_load_pages();

/* ===========================================================================
   2. FIELD DISCOVERY
   Auto-discover dan kumpulkan semua field definitions
   =========================================================================== */

/**
 * Get semua wording fields yang terorganisir berdasarkan section
 *
 * Fungsi ini melakukan auto-discovery terhadap semua fungsi yang mengikuti
 * naming convention lpz_page_{name}_fields() dan mengumpulkan field
 * definitions dari masing-masing fungsi.
 *
 * CARA KERJA:
 * 1. Ambil daftar semua fungsi user-defined
 * 2. Filter fungsi yang match dengan pattern lpz_page_*_fields
 * 3. Panggil setiap fungsi untuk mendapatkan field definitions
 * 4. Kumpulkan dalam array dengan section ID sebagai key
 *
 * RETURN FORMAT:
 * ```php
 * [
 *     'home' => [
 *         'title' => 'Homepage',
 *         'fields' => [
 *             'hero_title' => ['label' => 'Hero Title', 'type' => 'text', ...],
 *             'hero_desc' => ['label' => 'Hero Description', 'type' => 'textarea', ...],
 *         ]
 *     ],
 *     'global' => [
 *         'title' => 'Global Settings',
 *         'fields' => [...]
 *     ],
 * ]
 * ```
 *
 * FILTER HOOK:
 * Hasil bisa dimodifikasi menggunakan filter 'lpz_fields':
 * ```php
 * add_filter('lpz_fields', function($sections) {
 *     // Modifikasi sections jika diperlukan
 *     return $sections;
 * });
 * ```
 *
 * @since 1.0.0
 * @return array Array sections dengan field definitions
 */
function lpz_get_fields() {
    // Static cache untuk menyimpan hasil
    // Ini mencegah discovery berulang yang memakan waktu
    static $sections = null;

    // Jika sudah pernah di-generate, return dari cache
    if ($sections !== null) {
        return $sections;
    }

    // Inisialisasi array kosong untuk menampung sections
    $sections = [];

    // Ambil semua fungsi yang sudah didefinisikan
    // get_defined_functions() mengembalikan array dengan key 'internal' dan 'user'
    $functions = get_defined_functions();

    // Kita hanya butuh fungsi user-defined (bukan built-in PHP)
    $user_functions = $functions['user'];

    // Loop setiap fungsi dan cari yang match dengan pattern
    foreach ($user_functions as $function) {
        /**
         * Pattern matching: lpz_page_{name}_fields
         *
         * Contoh match:
         * - lpz_page_home_fields -> section_id = 'home'
         * - lpz_page_global_fields -> section_id = 'global'
         * - lpz_page_contact_us_fields -> section_id = 'contact_us'
         */
        if (preg_match('/^lpz_page_(.+)_fields$/', $function, $matches)) {
            // $matches[1] adalah bagian {name} dari pattern
            $section_id = $matches[1];

            // Panggil fungsi untuk mendapatkan field definitions
            // call_user_func() memungkinkan kita memanggil fungsi dengan nama dinamis
            $sections[$section_id] = call_user_func($function);
        }
    }

    /**
     * Filter: lpz_fields
     *
     * Memungkinkan theme atau plugin untuk memodifikasi field definitions
     * sebelum digunakan oleh admin panel.
     *
     * @param array $sections Array sections dengan field definitions
     * @return array Modified sections
     */
    return apply_filters('lpz_fields', $sections);
}

/* ===========================================================================
   3. FLAT FIELDS
   Menyediakan flat array untuk kemudahan admin processing
   =========================================================================== */

/**
 * Get flat array dari semua fields (tanpa grouping section)
 *
 * Fungsi ini mengubah struktur nested (sections > fields) menjadi
 * flat array dengan field_id sebagai key. Berguna untuk:
 * - Validasi field saat form submission
 * - Lookup field configuration berdasarkan field_id
 * - Sanitization berdasarkan field type
 *
 * INPUT (dari lpz_get_fields):
 * ```php
 * [
 *     'home' => [
 *         'title' => 'Homepage',
 *         'fields' => [
 *             'hero_title' => ['label' => 'Hero Title', 'type' => 'text'],
 *             'hero_desc' => ['label' => 'Hero Description', 'type' => 'textarea'],
 *         ]
 *     ],
 *     'global' => [
 *         'title' => 'Global',
 *         'fields' => [
 *             'site_name' => ['label' => 'Site Name', 'type' => 'text'],
 *         ]
 *     ],
 * ]
 * ```
 *
 * OUTPUT (flat array):
 * ```php
 * [
 *     'hero_title' => ['label' => 'Hero Title', 'type' => 'text'],
 *     'hero_desc' => ['label' => 'Hero Description', 'type' => 'textarea'],
 *     'site_name' => ['label' => 'Site Name', 'type' => 'text'],
 * ]
 * ```
 *
 * PENGGUNAAN:
 * ```php
 * $all_fields = lpz_get_all_fields_flat();
 *
 * // Cek apakah field ada
 * if (isset($all_fields['hero_title'])) {
 *     $field_config = $all_fields['hero_title'];
 *     $field_type = $field_config['type']; // 'text'
 * }
 * ```
 *
 * @since 1.0.0
 * @return array Flat array dengan field_id sebagai key
 */
function lpz_get_all_fields_flat() {
    // Ambil semua sections dari lpz_get_fields()
    $sections = lpz_get_fields();

    // Inisialisasi array kosong untuk hasil flat
    $flat = [];

    // Loop setiap section
    foreach ($sections as $section_id => $section) {
        // Cek apakah section memiliki fields
        if (isset($section['fields'])) {
            // Loop setiap field dalam section
            foreach ($section['fields'] as $field_id => $field) {
                // Tambahkan ke flat array dengan field_id sebagai key
                // Jika ada field_id yang sama di section berbeda,
                // yang terakhir akan menimpa yang sebelumnya
                $flat[$field_id] = $field;
            }
        }
    }

    return $flat;
}

/* ===========================================================================
   CATATAN UNTUK DEVELOPER
   =========================================================================== */

/**
 * MENAMBAH SECTION BARU:
 *
 * 1. Buat file baru di folder pages/, contoh: pages/about.php
 *
 * 2. Definisikan fungsi dengan format lpz_page_{name}_fields():
 *    ```php
 *    function lpz_page_about_fields() {
 *        return [
 *            'title' => 'About Page',
 *            'fields' => [
 *                'about_title' => [
 *                    'label' => 'Title',
 *                    'type' => 'text',
 *                    'default' => 'About Us',
 *                    'group' => 'Hero Section',
 *                ],
 *                // ... field lainnya
 *            ]
 *        ];
 *    }
 *    ```
 *
 * 3. Framework akan otomatis mendeteksi dan menampilkan di admin panel
 *
 *
 * FIELD CONFIGURATION OPTIONS:
 *
 * - label       : (required) Label yang ditampilkan di admin
 * - type        : (required) Tipe field (text, textarea, wysiwyg, url, image, etc)
 * - default     : (optional) Nilai default jika belum diisi
 * - group       : (optional) Nama group untuk mengelompokkan fields
 * - description : (optional) Help text di bawah field
 * - choices     : (required for select) Array pilihan untuk dropdown
 * - subfields   : (required for repeater) Array subfield definitions
 * - min/max/step: (optional for number) Constraints untuk input number
 *
 *
 * SUPPORTED FIELD TYPES:
 *
 * - text        : Single line text input
 * - textarea    : Multi-line text input
 * - wysiwyg     : WordPress visual editor (TinyMCE)
 * - url         : URL input with validation
 * - email       : Email input with validation
 * - number      : Numeric input with min/max/step
 * - select      : Dropdown select with choices
 * - checkbox    : Boolean checkbox
 * - image       : WordPress media library picker
 * - image_url   : External image URL with preview
 * - repeater    : Multiple items with subfields
 */
