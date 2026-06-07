<?php
/* Tambah meta box “Headline” di post editor */
add_action('add_meta_boxes', function () {
	add_meta_box('headline_mb', 'Headline', function ($post) {
		$val = get_post_meta($post->ID, 'featured_headline', true);
		wp_nonce_field('headline_nonce', 'headline_nonce');
		echo '<label><input type="checkbox" name="featured_headline" value="1" ' . checked($val, 1, false) . '> Tampil sebagai headline di halaman depan</label>';
	}, 'post', 'side');
});

add_action('save_post', function ($id) {
	if (
		!isset($_POST['headline_nonce']) ||
		!wp_verify_nonce($_POST['headline_nonce'], 'headline_nonce') ||
		defined('DOING_AUTOSAVE') && DOING_AUTOSAVE
	) return;

	update_post_meta($id, 'featured_headline', isset($_POST['featured_headline']) ? 1 : 0);
});

function reading_time() {
	$content = get_post_field('post_content', get_the_ID());
	$word_count = str_word_count(strip_tags($content));
	return max(1, ceil($word_count / 200));
}

add_action('wp_head', function () {
    if (is_single()) {
        $id = get_the_ID();
        $key = 'post_views_count';
        $views = get_post_meta($id, $key, true);
        $views = $views ? absint($views) : 0;
        update_post_meta($id, $key, $views + 1);
    }
});