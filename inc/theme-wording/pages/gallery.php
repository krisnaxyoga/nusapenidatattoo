<?php
/**
 * Lopez Framework - Gallery Page Wording
 *
 * Mendefinisikan field untuk halaman Gallery (template gallery.php).
 * Menggantikan pengaturan portfolio dari Customizer.
 *
 * Section ID: gallery
 * Helper:     lpz_page_gallery()
 *
 * @package    Lopez Framework
 * @author     Yoga Krisna
 * @copyright  2024 Juara Holding Group
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * ============================================================================
 * ADMIN FIELDS
 * ============================================================================
 */
function lpz_page_gallery_fields() {
    return [
        'title'  => 'Gallery Page',
        'fields' => [

            // ----------------------------------------
            // Section: Hero
            // ----------------------------------------
            'gallery_hero_title' => [
                'label'   => 'Hero Title',
                'type'    => 'text',
                'default' => 'Our Gallery',
                'group'   => 'Hero Section',
            ],
            'gallery_hero_subtitle' => [
                'label'   => 'Hero Subtitle',
                'type'    => 'textarea',
                'default' => 'Explore our collection of custom tattoo designs — each piece tells a unique story',
                'group'   => 'Hero Section',
            ],

            // ----------------------------------------
            // Section: Gallery Images
            // ----------------------------------------
            'gallery_images' => [
                'label'       => 'Gallery Images',
                'type'        => 'gallery',
                'description' => 'Upload gambar sebanyak-banyaknya. Drag untuk mengurutkan. Teks "Alt" dipakai sebagai judul/caption pada popup.',
                'group'       => 'Gallery Images',
            ],

        ],
    ];
}

/**
 * ============================================================================
 * TEMPLATE VARIABLES
 * ============================================================================
 *
 * Usage:
 *   $g = lpz_page_gallery();
 *   echo $g['hero']['title'];
 *   foreach ($g['images'] as $img) { ... }  // [id, url, alt]
 */
function lpz_page_gallery() {
    return [
        'hero' => [
            'title'    => w('gallery_hero_title'),
            'subtitle' => w('gallery_hero_subtitle'),
        ],
        'images' => w_gallery('gallery_images', 'full'),
    ];
}
