<?php
// inc/post-translation.php

// Tambah meta box di semua post type
function krisna_add_translation_meta_box() {
    // Ambil semua post type publik (post, page, CPT apapun)
    $post_types = get_post_types(array('public' => true), 'names');

    foreach ($post_types as $post_type) {
        add_meta_box(
            'krisna_translation_box',        // ID unik
            'Translation Links',             // Judul box
            'krisna_translation_box_html',   // Callback
            $post_type,                      // Berlaku di post type ini
            'normal',                        // Posisi
            'default'                        // Prioritas
        );
    }
}
add_action('add_meta_boxes', 'krisna_add_translation_meta_box');

// HTML field
function krisna_translation_box_html($post) {
    $en_url = get_post_meta($post->ID, '_krisna_translation_en_url', true);
    $id_url = get_post_meta($post->ID, '_krisna_translation_id_url', true);
    ?>
<p>
    <label for="krisna_translation_en_url"><strong>EN URL:</strong></label><br>
    <input type="text" style="width:100%" name="krisna_translation_en_url" id="krisna_translation_en_url"
        value="<?php echo esc_attr($en_url); ?>" placeholder="https://domain.com/en/slug">
</p>
<p>
    <label for="krisna_translation_id_url"><strong>ID URL:</strong></label><br>
    <input type="text" style="width:100%" name="krisna_translation_id_url" id="krisna_translation_id_url"
        value="<?php echo esc_attr($id_url); ?>" placeholder="https://domain.com/slug">
</p>
<?php
}

// Simpan data
function krisna_save_translation_urls($post_id) {
    if (array_key_exists('krisna_translation_en_url', $_POST)) {
        update_post_meta(
            $post_id,
            '_krisna_translation_en_url',
            sanitize_text_field($_POST['krisna_translation_en_url'])
        );
    }

    if (array_key_exists('krisna_translation_id_url', $_POST)) {
        update_post_meta(
            $post_id,
            '_krisna_translation_id_url',
            sanitize_text_field($_POST['krisna_translation_id_url'])
        );
    }
}
add_action('save_post', 'krisna_save_translation_urls');