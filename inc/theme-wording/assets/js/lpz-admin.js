/**
 * Lopez Framework - Admin JavaScript
 *
 * File ini berisi semua JavaScript untuk halaman admin Lopez Framework.
 * Menggunakan jQuery yang sudah disediakan oleh WordPress.
 *
 * DAFTAR ISI:
 * 1. INISIALISASI - Document ready dan setup awal
 * 2. PAGE SEARCH - Pencarian halaman di sidebar
 * 3. FIELD SEARCH - Pencarian field di content area
 * 4. GROUP TOGGLE - Collapse/expand group field
 * 5. MEDIA UPLOADER - WordPress media library picker
 * 6. IMAGE URL PREVIEW - Preview gambar dari URL
 * 7. REPEATER - Add/remove repeater items
 * 8. NESTED REPEATER - Repeater di dalam repeater
 * 9. GALLERY FIELD - Multiple image selection dengan drag & drop
 *
 * @package    Lopez Framework
 * @author     Yoga Krisna
 * @copyright  2024 Juara Holding Group
 * @since      1.0.0
 */

(function($) {
    'use strict';

    /* =========================================================================
       1. INISIALISASI
       Setup awal saat dokumen sudah siap
       ========================================================================= */

    /**
     * Document Ready Handler
     * Semua inisialisasi dilakukan di sini
     */
    $(document).ready(function() {
        // Inisialisasi semua komponen
        initPageSearch();
        initFieldSearch();
        initGroupToggle();
        initMediaUploader();
        initImageUrlPreview();
        initRepeater();
        initNestedRepeater();
        initGallery();

        // Restore group collapsed state dari localStorage
        restoreGroupState();
    });

    /* =========================================================================
       2. PAGE SEARCH
       Fungsi pencarian halaman di sidebar navigation
       ========================================================================= */

    /**
     * Inisialisasi fitur pencarian halaman
     *
     * Fitur:
     * - Filter halaman berdasarkan kata kunci
     * - Menampilkan pesan "No pages found" jika tidak ada hasil
     * - Real-time filtering saat user mengetik
     */
    function initPageSearch() {
        var $searchInput = $('#lpz-search');
        var $pageItems = $('.lpz-page-item');
        var $noResults = $('.lpz-no-results');

        // Event handler untuk input search
        $searchInput.on('input', function() {
            var query = $(this).val().toLowerCase().trim();

            // Jika query kosong, tampilkan semua halaman
            if (query === '') {
                $pageItems.show();
                $noResults.hide();
                return;
            }

            // Filter halaman berdasarkan query
            var foundCount = 0;
            $pageItems.each(function() {
                var $item = $(this);
                var pageTitle = $item.find('a').text().toLowerCase();

                // Cek apakah judul halaman mengandung query
                if (pageTitle.indexOf(query) !== -1) {
                    $item.show();
                    foundCount++;
                } else {
                    $item.hide();
                }
            });

            // Tampilkan pesan jika tidak ada hasil
            if (foundCount === 0) {
                $noResults.show();
            } else {
                $noResults.hide();
            }
        });
    }

    /* =========================================================================
       3. FIELD SEARCH
       Fungsi pencarian field di dalam tab yang aktif
       ========================================================================= */

    /**
     * Inisialisasi fitur pencarian field
     *
     * Fitur:
     * - Filter field berdasarkan label, ID, atau nilai
     * - Otomatis expand group jika ada field yang cocok
     * - Sembunyikan group jika semua fieldnya tidak cocok
     */
    function initFieldSearch() {
        var $searchInput = $('#lpz-field-search');
        var $fieldCards = $('.lpz-field-card');
        var $groupHeaders = $('.lpz-group-header');

        // Event handler untuk input search
        $searchInput.on('input', function() {
            var query = $(this).val().toLowerCase().trim();

            // Jika query kosong, tampilkan semua field dan group
            if (query === '') {
                $fieldCards.show();
                $groupHeaders.show();
                $('.lpz-group-content').show();
                return;
            }

            // Filter field berdasarkan query
            $fieldCards.each(function() {
                var $card = $(this);
                var label = $card.find('.lpz-field-label').text().toLowerCase();
                var fieldId = $card.data('field-id') || '';

                // Kumpulkan semua nilai dari input di dalam card
                var values = '';
                $card.find('input, textarea, select').each(function() {
                    var val = $(this).val();
                    if (val) {
                        values += ' ' + val.toLowerCase();
                    }
                });

                // Cek apakah label, field ID, atau nilai mengandung query
                var isMatch = label.indexOf(query) !== -1 ||
                              fieldId.toLowerCase().indexOf(query) !== -1 ||
                              values.indexOf(query) !== -1;

                if (isMatch) {
                    $card.show();
                } else {
                    $card.hide();
                }
            });

            // Update visibility group berdasarkan field yang terlihat
            updateGroupVisibility();
        });
    }

    /**
     * Update visibility group berdasarkan field yang terlihat
     *
     * Jika semua field di dalam group disembunyikan,
     * maka group header dan content juga disembunyikan
     */
    function updateGroupVisibility() {
        $('.lpz-group-header').each(function() {
            var $header = $(this);
            var groupId = $header.data('group');
            var $content = $('.lpz-group-content[data-group="' + groupId + '"]');
            var visibleCards = $content.find('.lpz-field-card:visible').length;

            if (visibleCards === 0) {
                // Sembunyikan group jika tidak ada field yang terlihat
                $header.hide();
                $content.hide();
            } else {
                // Tampilkan dan expand group jika ada field yang terlihat
                $header.show().removeClass('collapsed');
                $content.show().removeClass('collapsed');
            }
        });
    }

    /* =========================================================================
       4. GROUP TOGGLE
       Fungsi collapse/expand group field
       ========================================================================= */

    /**
     * Inisialisasi fitur toggle group
     *
     * Fitur:
     * - Click pada header untuk collapse/expand
     * - State disimpan di localStorage
     * - Animasi smooth dengan CSS transition
     */
    function initGroupToggle() {
        // Event handler untuk click pada group header
        $(document).on('click', '.lpz-group-header', function() {
            var $header = $(this);
            var groupId = $header.data('group');
            var $content = $('.lpz-group-content[data-group="' + groupId + '"]');

            // Toggle class collapsed
            $header.toggleClass('collapsed');
            $content.toggleClass('collapsed');

            // Simpan state ke localStorage
            saveGroupState(groupId, $header.hasClass('collapsed'));
        });
    }

    /**
     * Simpan state group ke localStorage
     *
     * @param {string} groupId - ID group
     * @param {boolean} isCollapsed - Apakah group sedang collapsed
     */
    function saveGroupState(groupId, isCollapsed) {
        var collapsedGroups = JSON.parse(localStorage.getItem('wording_collapsed_groups') || '{}');
        collapsedGroups[groupId] = isCollapsed;
        localStorage.setItem('wording_collapsed_groups', JSON.stringify(collapsedGroups));
    }

    /**
     * Restore state group dari localStorage
     *
     * Dipanggil saat halaman dimuat untuk mengembalikan
     * state collapse/expand group seperti sebelumnya
     */
    function restoreGroupState() {
        var collapsedGroups = JSON.parse(localStorage.getItem('wording_collapsed_groups') || '{}');

        $.each(collapsedGroups, function(groupId, isCollapsed) {
            if (isCollapsed) {
                var $header = $('.lpz-group-header[data-group="' + groupId + '"]');
                var $content = $('.lpz-group-content[data-group="' + groupId + '"]');
                $header.addClass('collapsed');
                $content.addClass('collapsed');
            }
        });
    }

    /* =========================================================================
       5. MEDIA UPLOADER
       WordPress Media Library integration
       ========================================================================= */

    /**
     * Inisialisasi WordPress Media Uploader
     *
     * Fitur:
     * - Buka media library saat click tombol "Select Image"
     * - Simpan attachment ID (bukan URL) untuk kompatibilitas
     * - Preview gambar setelah dipilih
     * - Tombol remove untuk menghapus gambar
     */
    function initMediaUploader() {
        // Handler untuk tombol upload image
        $(document).on('click', '.lpz-upload-image', function(e) {
            e.preventDefault();

            var $button = $(this);
            var fieldId = $button.data('field');
            var $preview = $('#' + fieldId + '-preview');
            var $input = $('#' + fieldId);

            // Buka WordPress media frame
            var frame = wp.media({
                title: 'Select Image',
                button: { text: 'Use this image' },
                multiple: false
            });

            // Handler saat gambar dipilih
            frame.on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();

                // Simpan attachment ID (lebih baik daripada URL)
                $input.val(attachment.id);

                // Tampilkan preview
                $preview.html('<img src="' + attachment.url + '" />');
                $preview.show();
            });

            frame.open();
        });

        // Handler untuk tombol remove image
        $(document).on('click', '.lpz-remove-image', function(e) {
            e.preventDefault();

            var $button = $(this);
            var fieldId = $button.data('field');
            var $preview = $('#' + fieldId + '-preview');
            var $input = $('#' + fieldId);

            // Reset input dan preview
            $input.val('');
            $preview.html('');
            $preview.hide();
        });
    }

    /* =========================================================================
       6. IMAGE URL PREVIEW
       Preview gambar dari URL eksternal
       ========================================================================= */

    /**
     * Inisialisasi preview gambar dari URL
     *
     * Fitur:
     * - Real-time preview saat user mengetik URL
     * - Handling error jika URL tidak valid
     */
    function initImageUrlPreview() {
        // Handler untuk perubahan URL gambar
        $(document).on('change keyup', '.lpz-image-url', function() {
            var $input = $(this);
            var fieldId = $input.attr('id');
            var $preview = $('#' + fieldId + '-preview');
            var url = $input.val();

            if (url) {
                // Tampilkan preview dengan error handling
                $preview.html('<img src="' + url + '" onerror="this.style.display=\'none\'" />');
                $preview.show();
            } else {
                // Reset preview jika URL kosong
                $preview.html('');
                $preview.hide();
            }
        });
    }

    /* =========================================================================
       7. REPEATER
       Field repeater untuk input multiple items
       ========================================================================= */

    /**
     * Inisialisasi fitur repeater
     *
     * Fitur:
     * - Tambah item baru dengan tombol "+ Add Item"
     * - Hapus item dengan tombol "x"
     * - Support untuk berbagai tipe subfield
     * - Dinamis generate HTML untuk item baru
     */
    function initRepeater() {
        // Handler untuk tombol add item
        $(document).on('click', '.lpz-add-item', function(e) {
            e.preventDefault();

            var $button = $(this);
            var $container = $button.siblings('.lpz-repeater-container');
            var fieldId = $button.data('field');
            var subfields = $button.data('subfields');
            var index = $container.children().length;

            // Generate HTML untuk item baru
            var html = generateRepeaterItemHtml(fieldId, subfields, index);
            $container.append(html);
        });

        // Handler untuk tombol remove item
        $(document).on('click', '.lpz-repeater-item .remove-item', function(e) {
            e.preventDefault();
            $(this).closest('.lpz-repeater-item').remove();
        });
    }

    /**
     * Generate HTML untuk repeater item baru
     *
     * @param {string} fieldId - ID field repeater
     * @param {object|string} subfields - Konfigurasi subfields
     * @param {number} index - Index item dalam array
     * @return {string} HTML string untuk item baru
     */
    function generateRepeaterItemHtml(fieldId, subfields, index) {
        var html = '<div class="lpz-repeater-item">';
        html += '<a href="#" class="remove-item" title="Remove">&times;</a>';

        // Cek apakah ada subfields yang didefinisikan
        if (typeof subfields === 'object' && subfields !== null) {
            // Loop setiap subfield dan generate input-nya
            $.each(subfields, function(key, config) {
                var label = typeof config === 'object' ? config.label : config;
                var type = typeof config === 'object' ? config.type : 'text';
                var subfieldId = fieldId + '_' + index + '_' + key;
                var subfieldName = 'lpz[' + fieldId + '][' + index + '][' + key + ']';

                html += '<div class="lpz-subfield" style="margin-bottom: 12px;">';
                html += '<label style="display: block; margin-bottom: 4px; font-weight: 500;">' + label + '</label>';
                html += generateSubfieldInputHtml(type, subfieldId, subfieldName, config);
                html += '</div>';
            });
        } else {
            // Simple repeater tanpa subfields
            html += '<input type="text" name="lpz[' + fieldId + '][]" value="" class="large-text" />';
        }

        html += '</div>';
        return html;
    }

    /**
     * Generate HTML untuk input subfield berdasarkan tipe
     *
     * @param {string} type - Tipe subfield (text, textarea, url, image, dll)
     * @param {string} id - ID input
     * @param {string} name - Name attribute input
     * @param {object} config - Konfigurasi tambahan
     * @return {string} HTML string untuk input
     */
    function generateSubfieldInputHtml(type, id, name, config) {
        var html = '';

        switch (type) {
            case 'textarea':
                html = '<textarea name="' + name + '" id="' + id + '" class="large-text" rows="3"></textarea>';
                break;

            case 'url':
                html = '<input type="url" name="' + name + '" id="' + id + '" value="" class="large-text" placeholder="https://" />';
                break;

            case 'image':
                html = '<input type="hidden" name="' + name + '" id="' + id + '" value="" />';
                html += '<div class="lpz-image-buttons">';
                html += '<button type="button" class="button lpz-upload-image" data-field="' + id + '">Select Image</button>';
                html += '<button type="button" class="button lpz-remove-image" data-field="' + id + '">Remove Image</button>';
                html += '</div>';
                html += '<div id="' + id + '-preview" class="lpz-image-preview" style="display:none;"></div>';
                break;

            case 'image_url':
                html = '<input type="url" name="' + name + '" id="' + id + '" value="" class="large-text lpz-image-url" placeholder="https://example.com/image.jpg" />';
                html += '<div id="' + id + '-preview" class="lpz-image-preview" style="display:none;"></div>';
                break;

            case 'wysiwyg':
                // WYSIWYG tidak bisa di-generate dinamis via JS
                // Fallback ke textarea dengan note
                html = '<textarea name="' + name + '" id="' + id + '" class="large-text" rows="6" placeholder="HTML content supported"></textarea>';
                html += '<p class="description" style="margin-top:4px;font-style:italic;">Note: Save and reload to enable visual editor for this field.</p>';
                break;

            case 'repeater':
                // Nested repeater
                var nestedSubfields = (typeof config === 'object' && config.subfields) ? config.subfields : null;
                var nestedSubfieldsJson = nestedSubfields ? JSON.stringify(nestedSubfields) : '""';
                var nestedSubfieldsEsc = escapeHtmlAttr(nestedSubfieldsJson);

                html = '<div class="lpz-nested-repeater" style="border: 1px solid #ccc; padding: 10px; border-radius: 4px; background: #fff;">';
                html += '<div class="lpz-nested-repeater-container" data-field="' + id + '"></div>';
                html += '<button type="button" class="button button-small lpz-add-nested-item" data-field="' + id + '" data-name="' + name + '" data-subfields="' + nestedSubfieldsEsc + '">';
                html += '+ Add Sub-Item</button>';
                html += '</div>';
                break;

            default: // text
                html = '<input type="text" name="' + name + '" id="' + id + '" value="" class="large-text" />';
        }

        return html;
    }

    /* =========================================================================
       8. NESTED REPEATER
       Repeater di dalam repeater (nested/bertingkat)
       ========================================================================= */

    /**
     * Inisialisasi fitur nested repeater
     *
     * Fitur:
     * - Tambah sub-item di dalam repeater item
     * - Hapus sub-item
     * - Support untuk berbagai tipe subfield
     */
    function initNestedRepeater() {
        // Handler untuk tombol add nested item
        $(document).on('click', '.lpz-add-nested-item', function(e) {
            e.preventDefault();

            var $button = $(this);
            var $container = $button.siblings('.lpz-nested-repeater-container');
            var fieldId = $button.data('field');
            var baseName = $button.data('name');
            var subfields = $button.data('subfields');
            var index = $container.children().length;

            // Generate HTML untuk nested item baru
            var html = generateNestedRepeaterItemHtml(fieldId, baseName, subfields, index);
            $container.append(html);
        });

        // Handler untuk tombol remove nested item
        $(document).on('click', '.lpz-nested-repeater-item .remove-nested-item', function(e) {
            e.preventDefault();
            $(this).closest('.lpz-nested-repeater-item').remove();
        });
    }

    /**
     * Generate HTML untuk nested repeater item
     *
     * @param {string} fieldId - ID field parent
     * @param {string} baseName - Base name untuk input
     * @param {object|string} subfields - Konfigurasi subfields
     * @param {number} index - Index item dalam array
     * @return {string} HTML string untuk nested item
     */
    function generateNestedRepeaterItemHtml(fieldId, baseName, subfields, index) {
        var html = '<div class="lpz-nested-repeater-item" style="background: #f5f5f5; border: 1px solid #ddd; border-radius: 4px; padding: 12px; margin-bottom: 10px; position: relative;">';
        html += '<a href="#" class="remove-nested-item" title="Remove" style="position: absolute; top: 8px; right: 8px; color: #a00; text-decoration: none; font-size: 16px;">&times;</a>';

        // Cek apakah ada subfields yang didefinisikan
        if (typeof subfields === 'object' && subfields !== null) {
            $.each(subfields, function(key, config) {
                var label = typeof config === 'object' ? config.label : config;
                var type = typeof config === 'object' ? config.type : 'text';
                var subfieldId = fieldId + '_' + index + '_' + key;
                var subfieldName = baseName + '[' + index + '][' + key + ']';

                html += '<div class="lpz-subfield" style="margin-bottom: 10px;">';
                html += '<label style="display: block; margin-bottom: 4px; font-weight: 500; font-size: 12px;">' + label + '</label>';
                html += generateNestedSubfieldInputHtml(type, subfieldId, subfieldName);
                html += '</div>';
            });
        } else {
            // Simple nested repeater tanpa subfields
            html += '<input type="text" name="' + baseName + '[]" value="" class="large-text" />';
        }

        html += '</div>';
        return html;
    }

    /**
     * Generate HTML untuk input nested subfield
     *
     * @param {string} type - Tipe subfield
     * @param {string} id - ID input
     * @param {string} name - Name attribute input
     * @return {string} HTML string untuk input
     */
    function generateNestedSubfieldInputHtml(type, id, name) {
        var html = '';

        switch (type) {
            case 'textarea':
                html = '<textarea name="' + name + '" id="' + id + '" class="large-text" rows="3"></textarea>';
                break;

            case 'url':
                html = '<input type="url" name="' + name + '" id="' + id + '" value="" class="large-text" placeholder="https://" />';
                break;

            case 'image':
                html = '<input type="hidden" name="' + name + '" id="' + id + '" value="" />';
                html += '<div class="lpz-image-buttons">';
                html += '<button type="button" class="button button-small lpz-upload-image" data-field="' + id + '">Select Image</button>';
                html += '<button type="button" class="button button-small lpz-remove-image" data-field="' + id + '">Remove</button>';
                html += '</div>';
                html += '<div id="' + id + '-preview" class="lpz-image-preview" style="display:none;"></div>';
                break;

            case 'image_url':
                html = '<input type="url" name="' + name + '" id="' + id + '" value="" class="large-text lpz-image-url" placeholder="https://example.com/image.jpg" />';
                html += '<div id="' + id + '-preview" class="lpz-image-preview" style="display:none;"></div>';
                break;

            case 'wysiwyg':
                html = '<textarea name="' + name + '" id="' + id + '" class="large-text" rows="4" placeholder="HTML content supported"></textarea>';
                html += '<p class="description" style="margin-top:4px;font-style:italic;font-size:11px;">Save & reload for visual editor.</p>';
                break;

            default: // text
                html = '<input type="text" name="' + name + '" id="' + id + '" value="" class="large-text" />';
        }

        return html;
    }

    /* =========================================================================
       9. GALLERY FIELD
       Field gallery untuk multiple image selection dengan drag & drop
       ========================================================================= */

    /**
     * Variable untuk tracking drag item
     */
    var draggedGalleryItem = null;

    /**
     * Inisialisasi fitur gallery
     *
     * Fitur:
     * - Tambah multiple gambar dari Media Library
     * - Hapus gambar individual
     * - Drag & drop untuk reorder
     * - Alt text per gambar
     */
    function initGallery() {
        initGalleryAdd();
        initGalleryRemove();
        initGalleryDragDrop();
    }

    /**
     * Inisialisasi tombol add images untuk gallery
     *
     * Membuka WordPress Media Library dengan mode multiple selection
     */
    function initGalleryAdd() {
        $(document).on('click', '.lpz-gallery-add', function(e) {
            e.preventDefault();

            var $button = $(this);
            var fieldId = $button.data('field');
            var $container = $button.siblings('.lpz-gallery-container');

            // Buka WordPress media picker dengan multiple selection
            var frame = wp.media({
                title: 'Select Gallery Images',
                button: { text: 'Add to Gallery' },
                multiple: true,
                library: { type: 'image' }
            });

            // Handler saat gambar dipilih
            frame.on('select', function() {
                var attachments = frame.state().get('selection').toJSON();

                // Loop setiap attachment yang dipilih
                $.each(attachments, function(i, attachment) {
                    // Hitung index baru
                    var index = $container.find('.lpz-gallery-item').length;

                    // Ambil alt text dari attachment atau fallback ke caption/title
                    var altText = attachment.alt || attachment.caption || attachment.title || '';

                    // Generate HTML untuk gallery item baru
                    var html = generateGalleryItemHtml(fieldId, index, attachment.id, attachment.url, altText);

                    // Tambahkan ke container
                    $container.append(html);
                });

                // Re-index semua items
                reindexGallery($container, fieldId);
            });

            frame.open();
        });
    }

    /**
     * Inisialisasi tombol remove untuk gallery item
     */
    function initGalleryRemove() {
        $(document).on('click', '.lpz-gallery-item-remove', function(e) {
            e.preventDefault();
            e.stopPropagation();

            var $item = $(this).closest('.lpz-gallery-item');
            var $container = $item.closest('.lpz-gallery-container');
            var fieldId = $container.data('field');

            // Hapus item dengan animasi
            $item.fadeOut(200, function() {
                $(this).remove();
                // Re-index setelah hapus
                reindexGallery($container, fieldId);
            });
        });
    }

    /**
     * Inisialisasi drag & drop untuk reorder gallery
     *
     * Menggunakan HTML5 Drag and Drop API
     */
    function initGalleryDragDrop() {
        // Drag start
        $(document).on('dragstart', '.lpz-gallery-item', function(e) {
            draggedGalleryItem = this;
            $(this).addClass('dragging');
            e.originalEvent.dataTransfer.effectAllowed = 'move';
            e.originalEvent.dataTransfer.setData('text/html', this.innerHTML);
        });

        // Drag end
        $(document).on('dragend', '.lpz-gallery-item', function(e) {
            $(this).removeClass('dragging');
            $('.lpz-gallery-item').removeClass('drag-over');
            draggedGalleryItem = null;
        });

        // Drag over - allow drop
        $(document).on('dragover', '.lpz-gallery-item', function(e) {
            e.preventDefault();
            e.originalEvent.dataTransfer.dropEffect = 'move';

            if (this !== draggedGalleryItem) {
                $(this).addClass('drag-over');
            }
        });

        // Drag leave
        $(document).on('dragleave', '.lpz-gallery-item', function(e) {
            $(this).removeClass('drag-over');
        });

        // Drop - reorder items
        $(document).on('drop', '.lpz-gallery-item', function(e) {
            e.preventDefault();
            e.stopPropagation();

            if (this !== draggedGalleryItem && draggedGalleryItem) {
                var $container = $(this).closest('.lpz-gallery-container');
                var fieldId = $container.data('field');

                // Tentukan posisi drop (sebelum atau sesudah target)
                var draggedIndex = $(draggedGalleryItem).index();
                var targetIndex = $(this).index();

                if (draggedIndex < targetIndex) {
                    $(this).after(draggedGalleryItem);
                } else {
                    $(this).before(draggedGalleryItem);
                }

                // Re-index setelah reorder
                reindexGallery($container, fieldId);
            }

            $(this).removeClass('drag-over');
        });

        // Allow drop on container (for empty state)
        $(document).on('dragover', '.lpz-gallery-container', function(e) {
            e.preventDefault();
        });

        $(document).on('drop', '.lpz-gallery-container', function(e) {
            e.preventDefault();
            var $container = $(this);
            var fieldId = $container.data('field');

            // Re-index setelah drop
            reindexGallery($container, fieldId);
        });
    }

    /**
     * Generate HTML untuk gallery item
     *
     * @param {string} fieldId - ID field gallery
     * @param {number} index - Index item dalam array
     * @param {number} attachmentId - WordPress attachment ID
     * @param {string} imageUrl - URL gambar
     * @param {string} altText - Alt text gambar
     * @return {string} HTML string untuk gallery item
     */
    function generateGalleryItemHtml(fieldId, index, attachmentId, imageUrl, altText) {
        var html = '<div class="lpz-gallery-item" draggable="true" data-index="' + index + '">';

        // Hidden input untuk attachment ID
        html += '<input type="hidden" name="lpz[' + fieldId + '][' + index + '][id]" value="' + attachmentId + '" class="gallery-item-id">';

        // Gambar
        html += '<img src="' + imageUrl + '" alt="' + escapeHtmlAttr(altText) + '" class="lpz-gallery-item-image">';

        // Overlay dengan tombol remove
        html += '<div class="lpz-gallery-item-overlay">';
        html += '<button type="button" class="lpz-gallery-item-remove" title="Remove">&times;</button>';
        html += '</div>';

        // Alt text input
        html += '<div class="lpz-gallery-item-alt">';
        html += '<input type="text" name="lpz[' + fieldId + '][' + index + '][alt]" value="' + escapeHtmlAttr(altText) + '" placeholder="Alt text">';
        html += '</div>';

        html += '</div>';

        return html;
    }

    /**
     * Re-index gallery items setelah add/remove/reorder
     *
     * Update semua name attributes agar sesuai dengan urutan baru
     *
     * @param {jQuery} $container - Container gallery
     * @param {string} fieldId - ID field gallery
     */
    function reindexGallery($container, fieldId) {
        $container.find('.lpz-gallery-item').each(function(index) {
            var $item = $(this);

            // Update data-index
            $item.attr('data-index', index);

            // Update name attribute untuk hidden input (ID)
            $item.find('.gallery-item-id').attr('name', 'lpz[' + fieldId + '][' + index + '][id]');

            // Update name attribute untuk alt text input
            $item.find('.lpz-gallery-item-alt input').attr('name', 'lpz[' + fieldId + '][' + index + '][alt]');
        });
    }

    /* =========================================================================
       UTILITY FUNCTIONS
       Fungsi helper yang digunakan di berbagai tempat
       ========================================================================= */

    /**
     * Escape HTML attribute value
     *
     * @param {string} str - String yang akan di-escape
     * @return {string} String yang sudah di-escape
     */
    function escapeHtmlAttr(str) {
        if (typeof str !== 'string') {
            return '';
        }
        return str.replace(/"/g, '&quot;').replace(/'/g, '&#39;');
    }

})(jQuery);
