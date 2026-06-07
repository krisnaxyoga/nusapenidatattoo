<?php
/**
 * Lopez Framework - Theme Wording Admin Page
 *
 * File utama untuk admin interface Lopez Framework.
 * File ini telah di-refactor menjadi modular dengan memisahkan:
 * - CSS ke assets/css/lpz-admin.css
 * - JavaScript ke assets/js/lpz-admin.js
 * - HTML Templates ke includes/lpz-admin-html.php
 *
 * DAFTAR ISI:
 * 1. SETUP & HOOKS - Registrasi menu dan enqueue scripts
 * 2. PAGE RENDER - Fungsi render halaman admin
 * 3. FIELD RENDER - Fungsi render berbagai tipe field
 * 4. FORM HANDLING - Proses save dan reset data
 * 5. SANITIZATION - Fungsi sanitasi data input
 *
 * Supported Field Types:
 * - text: Single line text input
 * - textarea: Multi-line text input
 * - wysiwyg: WordPress visual editor (TinyMCE)
 * - url: URL input with validation
 * - email: Email input with validation
 * - number: Numeric input with min/max/step
 * - select: Dropdown select
 * - checkbox: Boolean checkbox
 * - image: WordPress media library picker
 * - image_url: External image URL with preview
 * - repeater: Multiple items with subfields
 * - gallery: Multiple images with drag & drop reorder
 * - boat_select: Custom boat selection (extensible)
 * - boat_multi_select: Custom multi-boat selection (extensible)
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

// Load HTML template functions
require_once LPZ_DIR . '/includes/lpz-admin-html.php';

/* ===========================================================================
   1. SETUP & HOOKS
   Registrasi admin menu dan enqueue scripts/styles
   =========================================================================== */

/**
 * Register admin menu page
 *
 * Menambahkan submenu "JHG Wording" di bawah menu Appearance.
 * Hanya user dengan capability 'edit_theme_options' yang bisa akses.
 *
 * @since 1.0.0
 * @return void
 */
function lpz_add_admin_menu() {
    add_theme_page(
        __('JHG Wording', 'flavor'),      // Page title
        __('JHG Wording', 'flavor'),      // Menu title
        'edit_theme_options',              // Capability required
        'lpz',                             // Menu slug
        'lpz_render_admin_page'            // Callback function
    );
}
add_action('admin_menu', 'lpz_add_admin_menu');

/**
 * Enqueue admin scripts and styles
 *
 * Load CSS dan JS hanya di halaman admin Lopez Framework
 * untuk menghindari konflik dengan halaman admin lain.
 *
 * @since 1.0.0
 * @param string $hook Current admin page hook
 * @return void
 */
function lpz_admin_scripts($hook) {
    // Hanya load di halaman Lopez Framework
    if ($hook !== 'appearance_page_lpz') {
        return;
    }

    // WordPress media uploader untuk image fields
    wp_enqueue_media();

    // Enqueue CSS file
    wp_enqueue_style(
        'lpz-admin-css',                                    // Handle
        LPZ_URL . '/assets/css/lpz-admin.css',              // Source
        [],                                                  // Dependencies
        LPZ_VERSION                                          // Version
    );

    // Enqueue JavaScript file
    wp_enqueue_script(
        'lpz-admin-js',                                     // Handle
        LPZ_URL . '/assets/js/lpz-admin.js',                // Source
        ['jquery'],                                          // Dependencies
        LPZ_VERSION,                                         // Version
        true                                                 // Load in footer
    );

    // Localize script untuk translasi dan data
    wp_localize_script('lpz-admin-js', 'lpzAdmin', [
        'selectImage'  => __('Select Image', 'flavor'),
        'useImage'     => __('Use this image', 'flavor'),
        'removeImage'  => __('Remove Image', 'flavor'),
        'addItem'      => __('+ Add Item', 'flavor'),
        'addSubItem'   => __('+ Add Sub-Item', 'flavor'),
        'confirmReset' => __('Are you sure you want to reset this section to defaults?', 'flavor'),
    ]);
}
add_action('admin_enqueue_scripts', 'lpz_admin_scripts');

/* ===========================================================================
   2. PAGE RENDER
   Fungsi untuk merender halaman admin
   =========================================================================== */

/**
 * Render halaman admin utama
 *
 * Entry point untuk menampilkan halaman admin.
 * Melakukan validasi permission dan menyiapkan data.
 *
 * @since 1.0.0
 * @return void
 */
function lpz_render_admin_page() {
    // Security: Cek permission user
    if (!current_user_can('edit_theme_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.', 'flavor'));
    }

    // Ambil semua sections yang terdaftar
    $sections = lpz_get_fields();
    $section_keys = array_keys($sections);

    // Tentukan tab yang aktif dari query string atau default ke tab pertama
    $current_tab = isset($_GET['tab']) ? sanitize_key($_GET['tab']) : $section_keys[0];

    // Validasi: Pastikan tab yang diminta ada
    if (!isset($sections[$current_tab])) {
        $current_tab = $section_keys[0];
    }

    // Ambil semua nilai yang tersimpan di database
    $options = get_option('lpz_options', []);
    // Remove slashes saat menampilkan di form (WordPress menambahkan slashes)
    $options = wp_unslash($options);

    // Render halaman menggunakan HTML template
    lpz_render_admin_page_html($sections, $current_tab, $options);
}

/* ===========================================================================
   3. FIELD RENDER
   Fungsi untuk merender berbagai tipe field input
   =========================================================================== */

/**
 * Render individual field based on type
 *
 * Router function yang memilih render function berdasarkan tipe field.
 * Setiap tipe field memiliki render function tersendiri.
 *
 * @since 1.0.0
 * @param string $field_id Unique ID untuk field
 * @param array $field     Konfigurasi field (label, type, default, dll)
 * @param mixed $value     Nilai field saat ini
 * @return void
 */
function lpz_render_field($field_id, $field, $value) {
    $type = $field['type'] ?? 'text';

    // Route ke render function berdasarkan tipe
    switch ($type) {
        case 'textarea':
            lpz_render_textarea_field_html($field_id, $value);
            break;

        case 'wysiwyg':
            lpz_render_wysiwyg_field($field_id, $value);
            break;

        case 'url':
            lpz_render_url_field_html($field_id, $value);
            break;

        case 'image':
            lpz_render_image_field_html($field_id, $value);
            break;

        case 'image_url':
            lpz_render_image_url_field_html($field_id, $value);
            break;

        case 'repeater':
            lpz_render_repeater_field_html($field_id, $field, $value);
            break;

        case 'number':
            lpz_render_number_field_html($field_id, $field, $value);
            break;

        case 'select':
            lpz_render_select_field_html($field_id, $field, $value);
            break;

        case 'checkbox':
            lpz_render_checkbox_field_html($field_id, $field, $value);
            break;

        case 'boat_select':
            // Delegate ke boat module jika tersedia
            if (function_exists('lpz_render_boat_select')) {
                lpz_render_boat_select($field_id, $field, $value);
            }
            break;

        case 'boat_multi_select':
            // Delegate ke boat module jika tersedia
            if (function_exists('lpz_render_boat_multi_select')) {
                lpz_render_boat_multi_select($field_id, $field, $value);
            }
            break;

        case 'gallery':
            // Gallery: multiple images dengan drag & drop reorder
            lpz_render_gallery_field_html($field_id, $value);
            break;

        default: // text
            lpz_render_text_field_html($field_id, $value);
            break;
    }
}

/**
 * Render WYSIWYG editor field
 *
 * Menggunakan wp_editor() WordPress untuk visual editing.
 * ID field di-sanitize karena wp_editor tidak support karakter tertentu.
 *
 * @since 1.0.0
 * @param string $field_id Unique ID untuk field
 * @param mixed $value     Nilai field (HTML content)
 * @return void
 */
function lpz_render_wysiwyg_field($field_id, $value) {
    // Sanitize editor ID (wp_editor tidak support - dan .)
    $editor_id = str_replace(['-', '.'], '_', $field_id);

    wp_editor($value, $editor_id, [
        'textarea_name' => 'lpz[' . $field_id . ']',
        'textarea_rows' => 10,
        'media_buttons' => true,     // Tampilkan tombol Add Media
        'teeny'         => false,    // Full toolbar
        'quicktags'     => true,     // Tab Text/HTML
    ]);
}

/**
 * Normalize subfields to consistent format for JavaScript
 *
 * Mengubah format subfields yang bervariasi menjadi format konsisten
 * yang bisa digunakan oleh JavaScript untuk generate item baru.
 *
 * @since 1.0.0
 * @param array $subfields Array konfigurasi subfields
 * @return array Normalized subfields array
 */
function lpz_normalize_subfields($subfields) {
    $normalized = [];

    foreach ($subfields as $key => $config) {
        if (is_array($config)) {
            // Complex format: ['label' => 'Label', 'type' => 'text']
            $entry = [
                'label' => $config['label'] ?? $key,
                'type'  => $config['type'] ?? 'text',
            ];

            // Include nested subfields untuk tipe repeater
            if (($config['type'] ?? '') === 'repeater' && !empty($config['subfields'])) {
                $entry['subfields'] = lpz_normalize_subfields($config['subfields']);
            }

            $normalized[$key] = $entry;
        } else {
            // Simple format: 'key' => 'Label'
            $normalized[$key] = [
                'label' => $config,
                'type'  => 'text',
            ];
        }
    }

    return $normalized;
}

/**
 * Render subfield inside repeater item
 *
 * Render input untuk subfield di dalam repeater.
 * Support nested repeater (repeater di dalam repeater).
 *
 * @since 1.0.0
 * @param string $id     Field ID
 * @param string $name   Field name attribute
 * @param string $type   Field type
 * @param mixed $value   Field value
 * @param array $config  Field configuration
 * @return void
 */
function lpz_render_subfield($id, $name, $type, $value, $config = []) {
    switch ($type) {
        case 'textarea':
            ?>
            <textarea
                name="<?php echo esc_attr($name); ?>"
                id="<?php echo esc_attr($id); ?>"
                class="large-text"
                rows="3"
            ><?php echo esc_textarea($value); ?></textarea>
            <?php
            break;

        case 'wysiwyg':
            // WYSIWYG di dalam repeater
            $editor_id = str_replace(['-', '.', '[', ']'], '_', $id);
            wp_editor($value, $editor_id, [
                'textarea_name' => $name,
                'textarea_rows' => 8,
                'media_buttons' => true,
                'teeny'         => false,
                'quicktags'     => true,
            ]);
            break;

        case 'url':
            ?>
            <input
                type="url"
                name="<?php echo esc_attr($name); ?>"
                id="<?php echo esc_attr($id); ?>"
                value="<?php echo esc_url($value); ?>"
                class="large-text"
                placeholder="https://"
            >
            <?php
            break;

        case 'image':
            // Handle both attachment ID and URL
            $image_url = '';
            if (!empty($value)) {
                if (is_numeric($value)) {
                    $image_url = wp_get_attachment_url(intval($value));
                } else {
                    $image_url = $value;
                }
            }
            ?>
            <input
                type="hidden"
                name="<?php echo esc_attr($name); ?>"
                id="<?php echo esc_attr($id); ?>"
                value="<?php echo esc_attr($value); ?>"
            >
            <div class="lpz-image-buttons">
                <button type="button" class="button lpz-upload-image" data-field="<?php echo esc_attr($id); ?>">
                    <?php _e('Select Image', 'flavor'); ?>
                </button>
                <button type="button" class="button lpz-remove-image" data-field="<?php echo esc_attr($id); ?>">
                    <?php _e('Remove Image', 'flavor'); ?>
                </button>
            </div>
            <div id="<?php echo esc_attr($id); ?>-preview" class="lpz-image-preview" style="<?php echo empty($image_url) ? 'display:none;' : ''; ?>">
                <?php if (!empty($image_url)) : ?>
                    <img src="<?php echo esc_url($image_url); ?>" alt="">
                <?php endif; ?>
            </div>
            <?php
            break;

        case 'image_url':
            ?>
            <input
                type="url"
                name="<?php echo esc_attr($name); ?>"
                id="<?php echo esc_attr($id); ?>"
                value="<?php echo esc_url($value); ?>"
                class="large-text lpz-image-url"
                placeholder="https://example.com/image.jpg"
            >
            <div id="<?php echo esc_attr($id); ?>-preview" class="lpz-image-preview" style="<?php echo empty($value) ? 'display:none;' : ''; ?>">
                <?php if (!empty($value)) : ?>
                    <img src="<?php echo esc_url($value); ?>" alt="">
                <?php endif; ?>
            </div>
            <?php
            break;

        case 'number':
            ?>
            <input
                type="number"
                name="<?php echo esc_attr($name); ?>"
                id="<?php echo esc_attr($id); ?>"
                value="<?php echo esc_attr($value); ?>"
                class="small-text"
                <?php echo isset($config['min']) ? 'min="' . esc_attr($config['min']) . '"' : ''; ?>
                <?php echo isset($config['max']) ? 'max="' . esc_attr($config['max']) . '"' : ''; ?>
            >
            <?php
            break;

        case 'select':
            $choices = $config['choices'] ?? [];
            ?>
            <select name="<?php echo esc_attr($name); ?>" id="<?php echo esc_attr($id); ?>">
                <?php foreach ($choices as $choice_value => $choice_label) : ?>
                    <option value="<?php echo esc_attr($choice_value); ?>" <?php selected($value, $choice_value); ?>>
                        <?php echo esc_html($choice_label); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php
            break;

        case 'boat_select':
            // Boat select inside repeater
            if (function_exists('lpz_render_boat_select_subfield')) {
                lpz_render_boat_select_subfield($id, $name, $value);
            } else {
                // Fallback ke text input
                ?>
                <input
                    type="text"
                    name="<?php echo esc_attr($name); ?>"
                    id="<?php echo esc_attr($id); ?>"
                    value="<?php echo esc_attr($value); ?>"
                    class="large-text"
                    placeholder="Boat ID"
                >
                <?php
            }
            break;

        case 'repeater':
            // Nested repeater support
            $nested_subfields = $config['subfields'] ?? null;
            $nested_items = is_array($value) ? $value : [];
            ?>
            <div class="lpz-nested-repeater" style="border: 1px solid #ccc; padding: 10px; border-radius: 4px; background: #fff;">
                <div class="lpz-nested-repeater-container" data-field="<?php echo esc_attr($id); ?>">
                    <?php if (!empty($nested_subfields)) : ?>
                        <?php foreach ($nested_items as $nested_index => $nested_item) : ?>
                            <div class="lpz-nested-repeater-item" style="background: #f5f5f5; border: 1px solid #ddd; border-radius: 4px; padding: 12px; margin-bottom: 10px; position: relative;">
                                <a href="#" class="remove-nested-item" title="Remove" style="position: absolute; top: 8px; right: 8px; color: #a00; text-decoration: none; font-size: 16px;">&times;</a>
                                <?php foreach ($nested_subfields as $nested_subkey => $nested_subfield_config) :
                                    $nested_subfield_type = 'text';
                                    $nested_subfield_label = $nested_subfield_config;
                                    $nested_subfield_config_array = [];

                                    if (is_array($nested_subfield_config)) {
                                        $nested_subfield_type = $nested_subfield_config['type'] ?? 'text';
                                        $nested_subfield_label = $nested_subfield_config['label'] ?? $nested_subkey;
                                        $nested_subfield_config_array = $nested_subfield_config;
                                    }

                                    $nested_subfield_value = $nested_item[$nested_subkey] ?? '';
                                    $nested_subfield_name = "{$name}[{$nested_index}][{$nested_subkey}]";
                                    $nested_subfield_id = "{$id}_{$nested_index}_{$nested_subkey}";
                                ?>
                                    <div class="lpz-subfield" style="margin-bottom: 10px;">
                                        <label style="display: block; margin-bottom: 4px; font-weight: 500; font-size: 12px;">
                                            <?php echo esc_html($nested_subfield_label); ?>
                                        </label>
                                        <?php lpz_render_subfield($nested_subfield_id, $nested_subfield_name, $nested_subfield_type, $nested_subfield_value, $nested_subfield_config_array); ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <?php foreach ($nested_items as $nested_index => $nested_item) : ?>
                            <div class="lpz-nested-repeater-item" style="background: #f5f5f5; border: 1px solid #ddd; border-radius: 4px; padding: 12px; margin-bottom: 10px; position: relative;">
                                <a href="#" class="remove-nested-item" title="Remove" style="position: absolute; top: 8px; right: 8px; color: #a00; text-decoration: none; font-size: 16px;">&times;</a>
                                <input
                                    type="text"
                                    name="<?php echo esc_attr($name); ?>[]"
                                    value="<?php echo esc_attr($nested_item); ?>"
                                    class="large-text"
                                >
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <button
                    type="button"
                    class="button button-small lpz-add-nested-item"
                    data-field="<?php echo esc_attr($id); ?>"
                    data-name="<?php echo esc_attr($name); ?>"
                    data-subfields='<?php echo !empty($nested_subfields) ? esc_attr(json_encode(lpz_normalize_subfields($nested_subfields))) : '""'; ?>'
                >
                    <?php _e('+ Add Sub-Item', 'flavor'); ?>
                </button>
            </div>
            <?php
            break;

        default: // text
            ?>
            <input
                type="text"
                name="<?php echo esc_attr($name); ?>"
                id="<?php echo esc_attr($id); ?>"
                value="<?php echo esc_attr($value); ?>"
                class="large-text"
            >
            <?php
            break;
    }
}

/* ===========================================================================
   4. FORM HANDLING
   Proses save dan reset data dari form
   =========================================================================== */

/**
 * Handle form submission (save and reset)
 *
 * Dipanggil saat admin_init untuk memproses form submission
 * sebelum halaman di-render.
 *
 * @since 1.0.0
 * @return void
 */
function lpz_handle_save() {
    // Hanya proses di admin area
    if (!is_admin()) {
        return;
    }

    // Handle Save
    if (isset($_POST['lpz_nonce']) && wp_verify_nonce($_POST['lpz_nonce'], 'lpz_save')) {
        lpz_process_save();
    }

    // Handle Reset
    if (isset($_POST['lpz_reset_nonce']) && wp_verify_nonce($_POST['lpz_reset_nonce'], 'lpz_reset')) {
        lpz_process_reset();
    }
}
add_action('admin_init', 'lpz_handle_save');

/**
 * Process save form submission
 *
 * Sanitize dan simpan semua field values ke database.
 *
 * @since 1.0.0
 * @return void
 */
function lpz_process_save() {
    // Security: Cek permission
    if (!current_user_can('edit_theme_options')) {
        return;
    }

    // Ambil semua field definitions
    $all_fields = lpz_get_all_fields_flat();

    // Ambil existing options
    $options = get_option('lpz_options', []);

    // Ambil posted data dan remove WordPress magic slashes
    $posted = isset($_POST['lpz']) ? wp_unslash($_POST['lpz']) : [];

    // Loop setiap field yang di-post
    foreach ($posted as $field_id => $value) {
        // Skip jika field tidak terdefinisi (security)
        if (!isset($all_fields[$field_id])) {
            continue;
        }

        $field = $all_fields[$field_id];
        $type = $field['type'] ?? 'text';

        // Sanitize dan simpan
        $options[$field_id] = lpz_sanitize_field($value, $type, $field);
    }

    // Update database
    update_option('lpz_options', $options);

    // Clear cache
    wp_cache_delete('lpz_options', 'lpz');

    // Tampilkan success message
    add_settings_error(
        'lpz_messages',
        'lpz_saved',
        __('Settings saved successfully.', 'flavor'),
        'success'
    );
}

/**
 * Process reset form submission
 *
 * Hapus semua nilai untuk section tertentu (reset to defaults).
 *
 * @since 1.0.0
 * @return void
 */
function lpz_process_reset() {
    // Security: Cek permission
    if (!current_user_can('edit_theme_options')) {
        return;
    }

    // Ambil tab yang akan di-reset
    $reset_tab = isset($_POST['lpz_reset_tab']) ? sanitize_key($_POST['lpz_reset_tab']) : '';
    $sections = lpz_get_fields();

    // Validasi tab exists
    if (!isset($sections[$reset_tab])) {
        return;
    }

    // Ambil existing options
    $options = get_option('lpz_options', []);

    // Hapus semua field di section yang di-reset
    $fields = $sections[$reset_tab]['fields'] ?? [];
    foreach ($fields as $field_id => $field) {
        unset($options[$field_id]);
    }

    // Update database
    update_option('lpz_options', $options);

    // Clear cache
    wp_cache_delete('lpz_options', 'lpz');

    // Tampilkan success message
    add_settings_error(
        'lpz_messages',
        'lpz_reset',
        __('Section reset to defaults.', 'flavor'),
        'success'
    );
}

/* ===========================================================================
   5. SANITIZATION
   Fungsi-fungsi untuk sanitasi data input
   =========================================================================== */

/**
 * Sanitize field value based on type
 *
 * Setiap tipe field memiliki sanitasi yang sesuai
 * untuk keamanan dan integritas data.
 *
 * @since 1.0.0
 * @param mixed $value   Nilai yang akan di-sanitize
 * @param string $type   Tipe field
 * @param array $field   Konfigurasi field (untuk repeater subfields)
 * @return mixed Nilai yang sudah di-sanitize
 */
function lpz_sanitize_field($value, $type, $field = []) {
    // Strip slashes dari magic quotes
    if (is_string($value)) {
        $value = stripslashes($value);
    }

    switch ($type) {
        case 'textarea':
            // Sanitize textarea - preserve line breaks
            return sanitize_textarea_field($value);

        case 'wysiwyg':
            // Allow safe HTML tags for WYSIWYG content
            return wp_kses_post($value);

        case 'url':
            // Sanitize URL
            return esc_url_raw($value);

        case 'image':
            // Image: store attachment ID (integer) or URL fallback
            if (is_numeric($value)) {
                return intval($value);
            }
            return esc_url_raw($value);

        case 'image_url':
            // Convert full URL to relative path for local images
            $value = esc_url_raw($value);
            $home_url = home_url();
            if (strpos($value, $home_url) === 0) {
                $value = str_replace($home_url, '', $value);
            }
            return $value;

        case 'email':
            // Sanitize email
            return sanitize_email($value);

        case 'number':
            // Convert to integer
            return intval($value);

        case 'checkbox':
            // Convert to '1' or empty string
            return $value ? '1' : '';

        case 'repeater':
            // Sanitize repeater (recursive)
            return lpz_sanitize_repeater($value, $field);

        case 'gallery':
            // Sanitize gallery (array of images with id and alt)
            return lpz_sanitize_gallery($value);

        default: // text
            // Default text sanitization
            return sanitize_text_field($value);
    }
}

/**
 * Sanitize repeater field values
 *
 * Loop setiap item dan sanitize subfields sesuai tipe masing-masing.
 *
 * @since 1.0.0
 * @param mixed $value   Array of repeater items
 * @param array $field   Field configuration with subfields
 * @return array Sanitized repeater data
 */
function lpz_sanitize_repeater($value, $field = []) {
    if (!is_array($value)) {
        return [];
    }

    $sanitized = [];
    $subfields = $field['subfields'] ?? null;

    foreach ($value as $index => $item) {
        if (!empty($subfields) && is_array($item)) {
            $sanitized_item = [];

            foreach ($item as $subkey => $subvalue) {
                $clean_key = sanitize_key($subkey);

                // Strip slashes
                if (is_string($subvalue)) {
                    $subvalue = stripslashes($subvalue);
                }

                // Get subfield type
                $subfield_config = $subfields[$subkey] ?? null;
                $subfield_type = 'text';

                if (is_array($subfield_config)) {
                    $subfield_type = $subfield_config['type'] ?? 'text';
                }

                // Sanitize based on subfield type
                $sanitized_item[$clean_key] = lpz_sanitize_subfield($subvalue, $subfield_type, $subfield_config);
            }

            $sanitized[] = $sanitized_item;
        } else {
            // Simple repeater without subfields
            $sanitized[] = sanitize_text_field($item);
        }
    }

    return $sanitized;
}

/**
 * Sanitize individual subfield value
 *
 * @since 1.0.0
 * @param mixed $value    Value to sanitize
 * @param string $type    Subfield type
 * @param array $config   Subfield configuration
 * @return mixed Sanitized value
 */
function lpz_sanitize_subfield($value, $type, $config = []) {
    switch ($type) {
        case 'wysiwyg':
            return wp_kses_post($value);

        case 'textarea':
            return sanitize_textarea_field($value);

        case 'url':
            return esc_url_raw($value);

        case 'image':
            if (is_numeric($value)) {
                return intval($value);
            }
            return esc_url_raw($value);

        case 'image_url':
            $img_url = esc_url_raw($value);
            $home_url = home_url();
            if (strpos($img_url, $home_url) === 0) {
                $img_url = str_replace($home_url, '', $img_url);
            }
            return $img_url;

        case 'number':
            return intval($value);

        case 'email':
            return sanitize_email($value);

        case 'repeater':
            // Nested repeater - recursive sanitization
            return lpz_sanitize_nested_repeater($value, $config);

        default:
            return sanitize_text_field($value);
    }
}

/**
 * Sanitize nested repeater values recursively
 *
 * Support unlimited nesting levels untuk repeater di dalam repeater.
 *
 * @since 1.0.0
 * @param mixed $value   Nested repeater value
 * @param array $config  Nested repeater configuration
 * @return array Sanitized nested repeater data
 */
function lpz_sanitize_nested_repeater($value, $config = []) {
    if (!is_array($value)) {
        return [];
    }

    $sanitized = [];
    $subfields = $config['subfields'] ?? null;

    foreach ($value as $index => $item) {
        if (!empty($subfields) && is_array($item)) {
            $sanitized_item = [];

            foreach ($item as $subkey => $subvalue) {
                $clean_key = sanitize_key($subkey);

                // Strip slashes
                if (is_string($subvalue)) {
                    $subvalue = stripslashes($subvalue);
                }

                // Get subfield type
                $subfield_config = $subfields[$subkey] ?? null;
                $subfield_type = 'text';

                if (is_array($subfield_config)) {
                    $subfield_type = $subfield_config['type'] ?? 'text';
                }

                // Sanitize (recursive call untuk nested repeater)
                $sanitized_item[$clean_key] = lpz_sanitize_subfield($subvalue, $subfield_type, $subfield_config);
            }

            $sanitized[] = $sanitized_item;
        } else {
            $sanitized[] = is_array($item) ? $item : sanitize_text_field($item);
        }
    }

    return $sanitized;
}

/**
 * Sanitize gallery field values
 *
 * Gallery menyimpan array of images dengan struktur:
 * [
 *     ['id' => 123, 'alt' => 'Alt text'],
 *     ['id' => 456, 'alt' => 'Another alt'],
 * ]
 *
 * @since 1.1.0
 * @param mixed $value Array of gallery items
 * @return array Sanitized gallery data
 */
function lpz_sanitize_gallery($value) {
    if (!is_array($value)) {
        return [];
    }

    $sanitized = [];

    foreach ($value as $item) {
        if (!is_array($item)) {
            continue;
        }

        // Hanya proses item yang memiliki ID valid
        $attachment_id = isset($item['id']) ? intval($item['id']) : 0;
        if ($attachment_id <= 0) {
            continue;
        }

        // Sanitize alt text
        $alt_text = isset($item['alt']) ? sanitize_text_field($item['alt']) : '';

        $sanitized[] = [
            'id'  => $attachment_id,
            'alt' => $alt_text,
        ];
    }

    return $sanitized;
}
