<?php
/**
 * Lopez Framework - Wording Page Template
 *
 * Copy this file and rename to your-page-name.php
 * Example: front-page.php, about-us.php, contact.php
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
 *
 * Define fields that appear in Theme Wording admin panel.
 * These are editable by admin users.
 */
function lpz_page_PAGENAME_fields() {
    return [
        'title' => 'Page Display Name',
        'fields' => [

            // ----------------------------------------
            // Section: Hero
            // ----------------------------------------
            'PAGENAME_hero_title' => [
                'label'   => 'Hero Title',
                'type'    => 'text',
                'default' => 'Default Title',
                'group'   => 'Hero Section',
            ],
            'PAGENAME_hero_subtitle' => [
                'label'   => 'Hero Subtitle',
                'type'    => 'textarea',
                'default' => 'Default subtitle text',
                'group'   => 'Hero Section',
            ],
            'PAGENAME_hero_image' => [
                'label' => 'Hero Background Image',
                'type'  => 'image',
                'group' => 'Hero Section',
            ],

            // ----------------------------------------
            // Section: Content
            // ----------------------------------------
            'PAGENAME_content_title' => [
                'label'   => 'Content Title',
                'type'    => 'text',
                'default' => 'Content Title',
                'group'   => 'Content Section',
            ],
            'PAGENAME_content_body' => [
                'label' => 'Content Body',
                'type'  => 'wysiwyg',
                'group' => 'Content Section',
            ],

            // ----------------------------------------
            // Section: Repeater Example
            // ----------------------------------------
            'PAGENAME_features' => [
                'label'     => 'Features List',
                'type'      => 'repeater',
                'subfields' => [
                    'icon'  => [
                        'label' => 'Icon',
                        'type'  => 'image',
                    ],
                    'title' => 'Title',
                    'desc'  => [
                        'label' => 'Description',
                        'type'  => 'textarea',
                    ],
                ],
                'group' => 'Features Section',
            ],

        ],
    ];
}

/**
 * ============================================================================
 * TEMPLATE VARIABLES
 * ============================================================================
 *
 * Structured array for easy use in templates.
 * Call: $wording = lpz_page_PAGENAME();
 *
 * Usage in template:
 *   $w = lpz_page_PAGENAME();
 *   echo $w['hero']['title'];
 *   foreach ($w['features'] as $feature) { ... }
 */
function lpz_page_PAGENAME() {
    return [
        'hero' => [
            'title'    => w('PAGENAME_hero_title'),
            'subtitle' => w('PAGENAME_hero_subtitle'),
            'image'    => w('PAGENAME_hero_image'),
        ],
        'content' => [
            'title' => w('PAGENAME_content_title'),
            'body'  => w('PAGENAME_content_body'),
        ],
        'features' => w_repeater('PAGENAME_features'),
    ];
}
