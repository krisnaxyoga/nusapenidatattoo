<?php
/**
 * Lopez Framework - Admin HTML Templates
 *
 * File ini berisi semua template HTML untuk halaman admin Lopez Framework.
 * Dipisahkan dari logic untuk memudahkan maintenance dan customization.
 *
 * DAFTAR ISI:
 * 1. MAIN TEMPLATE - Template halaman admin utama
 * 2. SIDEBAR TEMPLATE - Template sidebar navigation
 * 3. CONTENT TEMPLATE - Template content area
 * 4. FIELD TEMPLATES - Template untuk berbagai tipe field
 *
 * @package    Lopez Framework
 * @author     Yoga Krisna
 * @copyright  2024 Juara Holding Group
 * @since      1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/* ===========================================================================
   1. MAIN TEMPLATE
   Template wrapper untuk halaman admin
   =========================================================================== */

/**
 * Render halaman admin utama
 *
 * Fungsi ini merender keseluruhan halaman admin termasuk:
 * - Sidebar navigation
 * - Content area dengan field cards
 * - Form actions (save & reset)
 *
 * @param array $sections     Semua section/halaman yang terdaftar
 * @param string $current_tab Tab/section yang sedang aktif
 * @param array $options      Nilai-nilai yang tersimpan di database
 * @return void
 */
function lpz_render_admin_page_html($sections, $current_tab, $options) {
    // Ambil data section yang aktif
    $current_section = $sections[$current_tab];
    $fields = $current_section['fields'] ?? [];
    $field_count = count($fields);
    ?>
    <div class="wrap" style="margin: 0; max-width: 100%;">
        <?php
        // Tampilkan notifikasi (success/error messages)
        settings_errors('lpz_messages');
        ?>

        <div class="lpz-wrap">
            <?php
            // Render sidebar navigation
            lpz_render_sidebar_html($sections, $current_tab);
            ?>

            <!-- Content Area -->
            <div class="lpz-content">
                <form method="post" action="">
                    <?php
                    // Security: WordPress nonce untuk CSRF protection
                    wp_nonce_field('lpz_save', 'lpz_nonce');
                    ?>
                    <input type="hidden" name="lpz_tab" value="<?php echo esc_attr($current_tab); ?>">

                    <?php
                    // Render content header dan body
                    lpz_render_content_header_html($current_section, $field_count);
                    lpz_render_content_body_html($fields, $options);
                    lpz_render_actions_html($current_tab);
                    ?>
                </form>

                <?php
                // Form tersembunyi untuk reset to defaults
                lpz_render_reset_form_html($current_tab);
                ?>
            </div>
        </div>
    </div>
    <?php
}

/* ===========================================================================
   2. SIDEBAR TEMPLATE
   Template untuk sidebar navigation di sebelah kiri
   =========================================================================== */

/**
 * Render sidebar navigation
 *
 * Sidebar berisi:
 * - Logo/branding
 * - Search box untuk filter halaman
 * - List halaman yang bisa dipilih
 * - Footer dengan credit
 *
 * @param array $sections     Semua section/halaman yang terdaftar
 * @param string $current_tab Tab/section yang sedang aktif
 * @return void
 */
function lpz_render_sidebar_html($sections, $current_tab) {
    ?>
    <div class="lpz-sidebar">
        <!-- Sidebar Header: Logo & Search -->
        <div class="lpz-sidebar-header">
            <?php lpz_render_sidebar_branding_html(); ?>

            <h2><?php _e('Pages', 'flavor'); ?></h2>

            <!-- Search Box -->
            <div class="lpz-search">
                <span class="lpz-search-icon dashicons dashicons-search"></span>
                <input
                    type="text"
                    id="lpz-search"
                    placeholder="<?php esc_attr_e('Search pages...', 'flavor'); ?>"
                >
            </div>
        </div>

        <!-- Page List -->
        <ul class="lpz-pages">
            <?php foreach ($sections as $section_id => $section) :
                $section_field_count = count($section['fields'] ?? []);
                $is_active = $current_tab === $section_id;
            ?>
                <li class="lpz-page-item <?php echo $is_active ? 'active' : ''; ?>">
                    <a href="<?php echo esc_url(add_query_arg(['page' => 'lpz', 'tab' => $section_id], admin_url('themes.php'))); ?>">
                        <span class="lpz-page-icon dashicons dashicons-admin-page"></span>
                        <?php echo esc_html($section['title']); ?>
                        <span class="lpz-page-count"><?php echo $section_field_count; ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

        <!-- No Results Message (hidden by default) -->
        <div class="lpz-no-results">
            <?php _e('No pages found', 'flavor'); ?>
        </div>

        <!-- Sidebar Footer -->
        <?php lpz_render_sidebar_footer_html(); ?>
    </div>
    <?php
}

/**
 * Render branding/logo di sidebar header
 *
 * @return void
 */
function lpz_render_sidebar_branding_html() {
    ?>
    <div class="lopez-framework-branding" style="text-align: center; margin-bottom: 15px;">
        <img
            src="https://juaraholding.com/id/wp-content/uploads/2024/12/JHG-LOGO-4.png"
            alt="Lopez Framework"
            style="max-width: 180px; height: auto;"
        >
    </div>
    <?php
}

/**
 * Render footer sidebar dengan credit
 *
 * @return void
 */
function lpz_render_sidebar_footer_html() {
    ?>
    <div class="lopez-framework-footer" style="padding: 15px 20px; border-top: 1px solid rgba(255,255,255,0.1); margin-top: auto;">
        <div style="font-size: 11px; color: rgba(255,255,255,0.6); text-align: center;">
            <strong style="color: #fff;">Powered by Lopez Framework</strong><br>
            by 404 Team
        </div>
    </div>
    <?php
}

/* ===========================================================================
   3. CONTENT TEMPLATE
   Template untuk content area di sebelah kanan
   =========================================================================== */

/**
 * Render content header
 *
 * Header berisi judul section, jumlah field, dan search box untuk field
 *
 * @param array $section      Data section yang aktif
 * @param int $field_count    Jumlah field di section ini
 * @return void
 */
function lpz_render_content_header_html($section, $field_count) {
    ?>
    <div class="lpz-content-header">
        <h2><?php echo esc_html($section['title']); ?></h2>
        <p><?php printf(__('%d fields available for editing', 'flavor'), $field_count); ?></p>

        <!-- Field Search Box -->
        <div style="margin-top: 12px;">
            <input
                type="text"
                id="lpz-field-search"
                placeholder="<?php esc_attr_e('Search fields...', 'flavor'); ?>"
                style="width: 300px; padding: 6px 12px;"
            >
        </div>
    </div>
    <?php
}

/**
 * Render content body dengan semua field cards
 *
 * Loop semua field dan render dengan grouping
 *
 * @param array $fields   Daftar field yang akan dirender
 * @param array $options  Nilai-nilai yang tersimpan
 * @return void
 */
function lpz_render_content_body_html($fields, $options) {
    ?>
    <div class="lpz-content-body">
        <?php
        $current_group = '';
        $group_open = false;

        foreach ($fields as $field_id => $field) :
            // Ambil nilai dari database atau gunakan default
            $value = isset($options[$field_id]) ? $options[$field_id] : ($field['default'] ?? '');
            $type = $field['type'] ?? 'text';

            // Cek apakah field ini memulai group baru
            if (!empty($field['group']) && $field['group'] !== $current_group) :
                // Tutup group sebelumnya jika ada
                if ($group_open) :
                    echo '</div>'; // Close .lpz-group-content
                endif;

                $current_group = $field['group'];
                $group_id = sanitize_title($current_group);
                ?>
                <!-- Group Header: <?php echo esc_html($current_group); ?> -->
                <div class="lpz-group-header" data-group="<?php echo esc_attr($group_id); ?>">
                    <span><?php echo esc_html($current_group); ?></span>
                    <span class="group-toggle dashicons dashicons-arrow-down-alt2"></span>
                </div>
                <div class="lpz-group-content" data-group="<?php echo esc_attr($group_id); ?>">
                <?php
                $group_open = true;
            endif;

            // Render field card
            lpz_render_field_card_html($field_id, $field, $value, $type);

        endforeach;

        // Tutup group terakhir jika masih terbuka
        if ($group_open) :
            echo '</div>'; // Close .lpz-group-content
        endif;
        ?>
    </div>
    <?php
}

/**
 * Render field card individual
 *
 * Setiap field ditampilkan dalam card dengan header (label + type badge)
 * dan body (input field)
 *
 * @param string $field_id  ID field
 * @param array $field      Konfigurasi field
 * @param mixed $value      Nilai field saat ini
 * @param string $type      Tipe field
 * @return void
 */
function lpz_render_field_card_html($field_id, $field, $value, $type) {
    ?>
    <div class="lpz-field-card" data-field-id="<?php echo esc_attr($field_id); ?>">
        <!-- Field Card Header -->
        <div class="lpz-field-card-header">
            <span class="lpz-field-label"><?php echo esc_html($field['label']); ?></span>
            <span class="lpz-field-type"><?php echo esc_html($type); ?></span>
        </div>

        <!-- Field Card Body -->
        <div class="lpz-field-card-body">
            <?php
            // Render input berdasarkan tipe field
            lpz_render_field($field_id, $field, $value);
            ?>

            <?php if (!empty($field['description'])) : ?>
                <p class="lpz-field-description"><?php echo esc_html($field['description']); ?></p>
            <?php endif; ?>
        </div>
    </div>
    <?php
}

/**
 * Render form actions (Save & Reset buttons)
 *
 * @param string $current_tab Tab yang aktif (untuk reset)
 * @return void
 */
function lpz_render_actions_html($current_tab) {
    ?>
    <div class="lpz-actions">
        <div>
            <?php submit_button(__('Save Changes', 'flavor'), 'primary', 'submit', false); ?>
        </div>
        <a
            href="#"
            class="lpz-reset-link"
            onclick="if(confirm('<?php esc_attr_e('Are you sure you want to reset this section to defaults?', 'flavor'); ?>')) { document.getElementById('reset-form').submit(); } return false;"
        >
            <?php _e('Reset to Defaults', 'flavor'); ?>
        </a>
    </div>
    <?php
}

/**
 * Render hidden reset form
 *
 * Form terpisah untuk reset to defaults karena membutuhkan
 * nonce yang berbeda dari form save
 *
 * @param string $current_tab Tab yang aktif
 * @return void
 */
function lpz_render_reset_form_html($current_tab) {
    ?>
    <form method="post" action="" id="reset-form" style="display: none;">
        <?php wp_nonce_field('lpz_reset', 'lpz_reset_nonce'); ?>
        <input type="hidden" name="lpz_reset_tab" value="<?php echo esc_attr($current_tab); ?>">
    </form>
    <?php
}

/* ===========================================================================
   4. FIELD INPUT TEMPLATES
   Template untuk input field berdasarkan tipe
   =========================================================================== */

/**
 * Render text input field
 *
 * @param string $field_id  ID field
 * @param mixed $value      Nilai field
 * @return void
 */
function lpz_render_text_field_html($field_id, $value) {
    ?>
    <input
        type="text"
        name="lpz[<?php echo esc_attr($field_id); ?>]"
        id="<?php echo esc_attr($field_id); ?>"
        value="<?php echo esc_attr($value); ?>"
        class="large-text"
    >
    <?php
}

/**
 * Render textarea field
 *
 * @param string $field_id  ID field
 * @param mixed $value      Nilai field
 * @return void
 */
function lpz_render_textarea_field_html($field_id, $value) {
    ?>
    <textarea
        name="lpz[<?php echo esc_attr($field_id); ?>]"
        id="<?php echo esc_attr($field_id); ?>"
        class="large-text"
        rows="4"
    ><?php echo esc_textarea($value); ?></textarea>
    <?php
}

/**
 * Render URL input field
 *
 * @param string $field_id  ID field
 * @param mixed $value      Nilai field
 * @return void
 */
function lpz_render_url_field_html($field_id, $value) {
    ?>
    <input
        type="url"
        name="lpz[<?php echo esc_attr($field_id); ?>]"
        id="<?php echo esc_attr($field_id); ?>"
        value="<?php echo esc_url($value); ?>"
        class="large-text"
        placeholder="https://"
    >
    <?php
}

/**
 * Render number input field
 *
 * @param string $field_id  ID field
 * @param array $field      Konfigurasi field (min, max, step)
 * @param mixed $value      Nilai field
 * @return void
 */
function lpz_render_number_field_html($field_id, $field, $value) {
    ?>
    <input
        type="number"
        name="lpz[<?php echo esc_attr($field_id); ?>]"
        id="<?php echo esc_attr($field_id); ?>"
        value="<?php echo esc_attr($value); ?>"
        class="small-text"
        <?php echo isset($field['min']) ? 'min="' . esc_attr($field['min']) . '"' : ''; ?>
        <?php echo isset($field['max']) ? 'max="' . esc_attr($field['max']) . '"' : ''; ?>
        <?php echo isset($field['step']) ? 'step="' . esc_attr($field['step']) . '"' : ''; ?>
    >
    <?php
}

/**
 * Render select/dropdown field
 *
 * @param string $field_id  ID field
 * @param array $field      Konfigurasi field dengan choices
 * @param mixed $value      Nilai field yang dipilih
 * @return void
 */
function lpz_render_select_field_html($field_id, $field, $value) {
    $choices = $field['choices'] ?? [];
    ?>
    <select
        name="lpz[<?php echo esc_attr($field_id); ?>]"
        id="<?php echo esc_attr($field_id); ?>"
    >
        <?php foreach ($choices as $choice_value => $choice_label) : ?>
            <option value="<?php echo esc_attr($choice_value); ?>" <?php selected($value, $choice_value); ?>>
                <?php echo esc_html($choice_label); ?>
            </option>
        <?php endforeach; ?>
    </select>
    <?php
}

/**
 * Render checkbox field
 *
 * @param string $field_id  ID field
 * @param array $field      Konfigurasi field dengan checkbox_label
 * @param mixed $value      Nilai field (1 atau kosong)
 * @return void
 */
function lpz_render_checkbox_field_html($field_id, $field, $value) {
    ?>
    <label>
        <input
            type="checkbox"
            name="lpz[<?php echo esc_attr($field_id); ?>]"
            id="<?php echo esc_attr($field_id); ?>"
            value="1"
            <?php checked($value, '1'); ?>
        >
        <?php echo esc_html($field['checkbox_label'] ?? ''); ?>
    </label>
    <?php
}

/**
 * Render image upload field (WordPress Media Library)
 *
 * @param string $field_id  ID field
 * @param mixed $value      Attachment ID atau URL
 * @return void
 */
function lpz_render_image_field_html($field_id, $value) {
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
        name="lpz[<?php echo esc_attr($field_id); ?>]"
        id="<?php echo esc_attr($field_id); ?>"
        value="<?php echo esc_attr($value); ?>"
    >
    <div class="lpz-image-buttons">
        <button type="button" class="button lpz-upload-image" data-field="<?php echo esc_attr($field_id); ?>">
            <?php _e('Select Image', 'flavor'); ?>
        </button>
        <button type="button" class="button lpz-remove-image" data-field="<?php echo esc_attr($field_id); ?>">
            <?php _e('Remove Image', 'flavor'); ?>
        </button>
    </div>
    <div id="<?php echo esc_attr($field_id); ?>-preview" class="lpz-image-preview" style="<?php echo empty($image_url) ? 'display:none;' : ''; ?>">
        <?php if (!empty($image_url)) : ?>
            <img src="<?php echo esc_url($image_url); ?>" alt="">
        <?php endif; ?>
    </div>
    <?php
}

/**
 * Render image URL field (external URL)
 *
 * @param string $field_id  ID field
 * @param mixed $value      URL gambar
 * @return void
 */
function lpz_render_image_url_field_html($field_id, $value) {
    ?>
    <input
        type="url"
        name="lpz[<?php echo esc_attr($field_id); ?>]"
        id="<?php echo esc_attr($field_id); ?>"
        value="<?php echo esc_url($value); ?>"
        class="large-text lpz-image-url"
        placeholder="https://example.com/image.jpg"
    >
    <div id="<?php echo esc_attr($field_id); ?>-preview" class="lpz-image-preview" style="<?php echo empty($value) ? 'display:none;' : ''; ?>">
        <?php if (!empty($value)) : ?>
            <img src="<?php echo esc_url($value); ?>" alt="">
        <?php endif; ?>
    </div>
    <?php
}

/**
 * Render repeater field
 *
 * Field repeater memungkinkan user menambah multiple items
 * dengan subfields yang bisa dikonfigurasi
 *
 * @param string $field_id  ID field
 * @param array $field      Konfigurasi field dengan subfields
 * @param mixed $value      Array nilai items
 * @return void
 */
function lpz_render_repeater_field_html($field_id, $field, $value) {
    $subfields = $field['subfields'] ?? null;
    $items = is_array($value) ? $value : [];
    ?>
    <div class="lpz-repeater-container" data-field="<?php echo esc_attr($field_id); ?>">
        <?php if (!empty($subfields)) : ?>
            <?php foreach ($items as $index => $item) : ?>
                <div class="lpz-repeater-item">
                    <a href="#" class="remove-item" title="Remove">&times;</a>
                    <?php foreach ($subfields as $subkey => $subfield_config) :
                        // Support both simple format ('key' => 'Label') and complex format
                        $subfield_type = 'text';
                        $subfield_label = $subfield_config;
                        $subfield_config_array = [];

                        if (is_array($subfield_config)) {
                            $subfield_type = $subfield_config['type'] ?? 'text';
                            $subfield_label = $subfield_config['label'] ?? $subkey;
                            $subfield_config_array = $subfield_config;
                        }

                        $subfield_value = $item[$subkey] ?? '';
                        $subfield_name = "lpz[{$field_id}][{$index}][{$subkey}]";
                        $subfield_id = "{$field_id}_{$index}_{$subkey}";
                    ?>
                        <div class="lpz-subfield" style="margin-bottom: 12px;">
                            <label style="display: block; margin-bottom: 4px; font-weight: 500;">
                                <?php echo esc_html($subfield_label); ?>
                            </label>
                            <?php lpz_render_subfield($subfield_id, $subfield_name, $subfield_type, $subfield_value, $subfield_config_array); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <?php foreach ($items as $index => $item) : ?>
                <div class="lpz-repeater-item">
                    <a href="#" class="remove-item" title="Remove">&times;</a>
                    <input
                        type="text"
                        name="lpz[<?php echo esc_attr($field_id); ?>][]"
                        value="<?php echo esc_attr($item); ?>"
                        class="large-text"
                    >
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <button
        type="button"
        class="button lpz-add-item"
        data-field="<?php echo esc_attr($field_id); ?>"
        data-subfields='<?php echo !empty($subfields) ? esc_attr(json_encode(lpz_normalize_subfields($subfields))) : '""'; ?>'
    >
        <?php _e('+ Add Item', 'flavor'); ?>
    </button>
    <?php
}

/* ===========================================================================
   5. GALLERY FIELD TEMPLATE
   Template untuk field gallery dengan multiple image selection
   =========================================================================== */

/**
 * Render gallery field
 *
 * Field gallery memungkinkan user memilih multiple gambar dari Media Library
 * dengan fitur drag & drop untuk reordering dan alt text per gambar.
 *
 * DATA FORMAT:
 * ```php
 * [
 *     ['id' => 123, 'alt' => 'Image 1 alt text'],
 *     ['id' => 456, 'alt' => 'Image 2 alt text'],
 * ]
 * ```
 *
 * FITUR:
 * - Multiple image selection dari WordPress Media Library
 * - Drag & drop untuk reorder gambar
 * - Alt text input per gambar
 * - Remove individual images
 * - Grid layout responsive
 *
 * @since 1.1.0
 * @param string $field_id  ID field
 * @param mixed $value      Array of image items (id, alt)
 * @return void
 */
function lpz_render_gallery_field_html($field_id, $value) {
    // Pastikan value adalah array
    $items = is_array($value) ? $value : [];
    ?>
    <div class="lpz-gallery-wrapper">
        <!-- Gallery Container (Grid) -->
        <div class="lpz-gallery-container" data-field="<?php echo esc_attr($field_id); ?>">
            <?php foreach ($items as $index => $item) :
                // Ambil attachment ID dan alt text
                $attachment_id = isset($item['id']) ? intval($item['id']) : 0;
                $alt_text = isset($item['alt']) ? $item['alt'] : '';

                // Skip jika tidak ada attachment ID
                if (!$attachment_id) {
                    continue;
                }

                // Ambil URL gambar dari attachment
                $image_url = wp_get_attachment_url($attachment_id);

                // Skip jika URL tidak ditemukan (attachment dihapus)
                if (!$image_url) {
                    continue;
                }
            ?>
                <div class="lpz-gallery-item" draggable="true" data-index="<?php echo $index; ?>">
                    <!-- Hidden input untuk attachment ID -->
                    <input
                        type="hidden"
                        name="lpz[<?php echo esc_attr($field_id); ?>][<?php echo $index; ?>][id]"
                        value="<?php echo esc_attr($attachment_id); ?>"
                        class="gallery-item-id"
                    >

                    <!-- Image preview -->
                    <img
                        src="<?php echo esc_url($image_url); ?>"
                        alt="<?php echo esc_attr($alt_text); ?>"
                        class="lpz-gallery-item-image"
                    >

                    <!-- Overlay dengan tombol remove -->
                    <div class="lpz-gallery-item-overlay">
                        <button type="button" class="lpz-gallery-item-remove" title="<?php esc_attr_e('Remove', 'flavor'); ?>">
                            &times;
                        </button>
                    </div>

                    <!-- Alt text input -->
                    <div class="lpz-gallery-item-alt">
                        <input
                            type="text"
                            name="lpz[<?php echo esc_attr($field_id); ?>][<?php echo $index; ?>][alt]"
                            value="<?php echo esc_attr($alt_text); ?>"
                            placeholder="<?php esc_attr_e('Alt text', 'flavor'); ?>"
                        >
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Tombol Add Images -->
        <button
            type="button"
            class="button lpz-gallery-add"
            data-field="<?php echo esc_attr($field_id); ?>"
        >
            <?php _e('+ Add Images', 'flavor'); ?>
        </button>
    </div>
    <?php
}
