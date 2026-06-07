<?php
/**
 * Template Name: Gallery
 * The template for displaying the portfolio gallery
 */

get_template_part('template-parts/header'); ?>

<!-- Gallery Hero Section -->
<section class="min-h-[60vh] flex items-center justify-center relative overflow-hidden pt-20 bg-gradient-dark">
    <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
        <h1 class="text-5xl md:text-7xl font-bold mb-6 text-[#f5f5f5] animate-fade-in-up">
            Our <span class="text-gradient">Gallery</span>
        </h1>
        <p class="text-xl text-gray-300 max-w-2xl mx-auto">
            Explore our collection of custom tattoo designs — each piece tells a unique story
        </p>
    </div>
</section>

<!-- Gallery Grid Section -->
<section class="py-20 px-4 bg-gradient-dark">
    <div class="max-w-7xl mx-auto">
        <div class="gallery-grid">
            <?php
            // Get all portfolio images from customizer
            $gallery_items = [];
            for ($i = 1; $i <= 6; $i++) {
                $img_id = get_theme_mod("nusatatto_portfolio_img{$i}", '');
                if ($img_id) {
                    $img_url = wp_get_attachment_image_url($img_id, 'full');
                    $img_title = get_theme_mod("nusatatto_portfolio_img{$i}_title", 'Portfolio Image ' . $i);
                    $img_desc = get_theme_mod("nusatatto_portfolio_img{$i}_desc", '');
                    $gallery_items[] = [
                        'url' => $img_url,
                        'title' => $img_title,
                        'desc' => $img_desc
                    ];
                }
            }

            // If no customizer images, use default portfolio images
            if (empty($gallery_items)) {
                for ($i = 1; $i <= 6; $i++) {
                    $img_path = get_template_directory() . "/assets/images/portfolio-{$i}.jpg";
                    if (file_exists($img_path)) {
                        $gallery_items[] = [
                            'url' => get_template_directory_uri() . "/assets/images/portfolio-{$i}.jpg",
                            'title' => "Portfolio Image {$i}",
                            'desc' => ''
                        ];
                    }
                }
            }

            // If still no gallery items, create placeholders
            if (empty($gallery_items)) {
                for ($i = 1; $i <= 6; $i++) {
                    $gallery_items[] = [
                        'url' => '',
                        'title' => 'Gallery Placeholder',
                        'desc' => 'Upload images via WordPress Customizer → Portfolio Settings'
                    ];
                }
            }

            // Display gallery items
            $index = 0;
            foreach ($gallery_items as $item) :
                $delay = ($index % 6) * 0.1;
            ?>
            <div class="gallery-item stagger-item" <?php echo !empty($item['url']) ? 'onclick="openModal(' . $index . ')"' : ''; ?>>
                <?php if (!empty($item['url'])) : ?>
                <img src="<?php echo esc_url($item['url']); ?>"
                     alt="<?php echo esc_attr($item['title']); ?>"
                     loading="lazy">
                <?php else : ?>
                <!-- Placeholder -->
                <div class="w-full h-full flex flex-col items-center justify-center bg-gradient-to-br from-gray-800 to-gray-900 p-4">
                    <svg class="w-16 h-16 text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-sm text-gray-500 text-center">No Image</p>
                </div>
                <?php endif; ?>
                <div class="gallery-overlay">
                    <div class="text-center text-[#f5f5f5]">
                        <?php if ($item['title']) : ?>
                        <div class="text-lg font-semibold mb-2"><?php echo esc_html($item['title']); ?></div>
                        <?php endif; ?>
                        <?php if ($item['desc']) : ?>
                        <div class="text-sm text-gray-300 mb-4"><?php echo esc_html($item['desc']); ?></div>
                        <?php endif; ?>
                        <?php if (!empty($item['url'])) : ?>
                        <div class="text-[#d4af37] text-sm font-semibold">Click to View</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php
                $index++;
            endforeach;
            ?>
        </div>
    </div>
</section>

<!-- Modal for Image Popup -->
<div id="imageModal" class="modal" onclick="closeModal()">
    <!-- Close Button -->
    <span class="modal-close" onclick="closeModal()">&times;</span>

    <!-- Navigation Buttons -->
    <button class="modal-nav modal-nav-prev" onclick="event.stopPropagation(); changeImage(-1)">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
    </button>

    <button class="modal-nav modal-nav-next" onclick="event.stopPropagation(); changeImage(1)">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
    </button>

    <!-- Modal Content -->
    <div class="modal-content-wrapper" onclick="event.stopPropagation();">
        <img id="modalImage" src="" alt="Gallery Image" class="modal-img">

        <!-- Caption -->
        <div class="modal-caption">
            <h3 id="modalTitle" class="text-2xl font-bold text-[#f5f5f5] mb-2"></h3>
            <p id="modalDesc" class="text-gray-300"></p>
        </div>
    </div>
</div>

<!-- Latest Articles Section -->
<section class="py-20 px-4 bg-gradient-dark-reverse">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold mb-4 text-[#f5f5f5]">Latest <span class="text-gradient">Articles</span></h2>
            <p class="text-gray-300 max-w-2xl mx-auto">Discover tattoo inspiration, tips, and stories from our studio</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <?php
            $latest_posts = new WP_Query([
                'post_type' => 'post',
                'posts_per_page' => 3,
                'orderby' => 'date',
                'order' => 'DESC'
            ]);

            if ($latest_posts->have_posts()) :
                $post_index = 0;
                while ($latest_posts->have_posts()) : $latest_posts->the_post();
                    $delay = $post_index * 0.1;
            ?>
            <article class="glass-lg rounded-2xl overflow-hidden hover-lift stagger-item">
                <div class="article-image">
                    <a href="<?php the_permalink(); ?>">
                        <?php
                        if (has_post_thumbnail()) {
                            the_post_thumbnail('blog-thumbnail', ['class' => 'w-full h-full object-cover']);
                        } else {
                            // Placeholder image
                            ?>
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-800 to-gray-900">
                                <svg class="w-20 h-20 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <?php
                        }
                        ?>
                    </a>
                </div>

                <div class="p-6">
                    <div class="flex items-center gap-4 text-sm text-gray-400 mb-3">
                        <span><?php echo get_the_date(); ?></span>
                        <span>•</span>
                        <span><?php echo calculate_reading_time(get_the_ID()); ?> min read</span>
                    </div>

                    <h3 class="text-xl font-bold mb-3 text-[#f5f5f5] hover:text-[#d4af37] transition-colors">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>

                    <p class="text-gray-300 mb-4 line-clamp-3">
                        <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                    </p>

                    <a href="<?php the_permalink(); ?>" class="inline-flex items-center text-[#d4af37] font-semibold hover:gap-2 transition-all">
                        Read More
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </article>
            <?php
                    $post_index++;
                endwhile;
                wp_reset_postdata();
            else :
            ?>
            <div class="col-span-3 text-center glass-lg p-12 rounded-2xl">
                <p class="text-gray-300 text-lg">No articles found. Check back soon for tattoo tips and inspiration!</p>
            </div>
            <?php endif; ?>
        </div>

        <?php if ($latest_posts->found_posts > 3) : ?>
        <div class="text-center mt-12">
            <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="inline-block btn-glass-accent px-8 py-4 rounded-full font-semibold">
                View All Articles
            </a>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Gallery Modal Script -->
<script>
// Gallery data from PHP
const galleryData = <?php echo json_encode($gallery_items); ?>;
let currentImageIndex = 0;

function openModal(index) {
    currentImageIndex = index;
    updateModalImage();
    const modal = document.getElementById('imageModal');
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
    // Add fade-in animation
    setTimeout(() => modal.style.opacity = '1', 10);
}

function closeModal() {
    const modal = document.getElementById('imageModal');
    modal.style.opacity = '0';
    setTimeout(() => {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }, 300);
}

function changeImage(direction) {
    currentImageIndex += direction;

    // Loop around
    if (currentImageIndex >= galleryData.length) {
        currentImageIndex = 0;
    } else if (currentImageIndex < 0) {
        currentImageIndex = galleryData.length - 1;
    }

    updateModalImage();
}

function updateModalImage() {
    const item = galleryData[currentImageIndex];
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    const modalDesc = document.getElementById('modalDesc');
    
    // Fade out
    modalImage.style.opacity = '0';
    
    setTimeout(() => {
        modalImage.src = item.url;
        modalTitle.textContent = item.title;
        modalDesc.textContent = item.desc;
        
        // Fade in
        modalImage.style.opacity = '1';
    }, 150);
}

// Keyboard navigation
document.addEventListener('keydown', function(event) {
    const modal = document.getElementById('imageModal');
    if (modal.style.display === 'flex') {
        switch(event.key) {
            case 'Escape':
                closeModal();
                break;
            case 'ArrowLeft':
                changeImage(-1);
                break;
            case 'ArrowRight':
                changeImage(1);
                break;
        }
    }
});

// Optimize hover effects with event delegation
document.addEventListener('DOMContentLoaded', function() {
    // Gallery hover effects
    const galleryGrid = document.querySelector('.gallery-grid');
    if (galleryGrid) {
        galleryGrid.addEventListener('mouseenter', function(e) {
            if (e.target.closest('.gallery-item')) {
                const item = e.target.closest('.gallery-item');
                const overlay = item.querySelector('.gallery-overlay');
                const img = item.querySelector('img');
                if (overlay) overlay.style.opacity = '1';
                if (img) img.style.transform = 'scale(1.1)';
            }
        }, true);
        
        galleryGrid.addEventListener('mouseleave', function(e) {
            if (e.target.closest('.gallery-item')) {
                const item = e.target.closest('.gallery-item');
                const overlay = item.querySelector('.gallery-overlay');
                const img = item.querySelector('img');
                if (overlay) overlay.style.opacity = '0';
                if (img) img.style.transform = 'scale(1)';
            }
        }, true);
    }
    
    // Article image hover effects
    document.querySelectorAll('.article-image a').forEach(link => {
        const img = link.querySelector('img');
        if (img) {
            link.addEventListener('mouseenter', () => {
                img.style.transform = 'scale(1.08)';
            });
            link.addEventListener('mouseleave', () => {
                img.style.transform = 'scale(1)';
            });
        }
    });
    
    // Modal navigation hover
    document.querySelectorAll('.modal-nav').forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.style.background = 'rgba(212, 175, 55, 0.3)';
            this.style.borderColor = '#d4af37';
        });
        btn.addEventListener('mouseleave', function() {
            this.style.background = 'rgba(255, 255, 255, 0.1)';
            this.style.borderColor = 'rgba(255, 255, 255, 0.2)';
        });
    });
    
    // Close button hover
    const closeBtn = document.querySelector('.modal-close');
    if (closeBtn) {
        closeBtn.addEventListener('mouseenter', function() {
            this.style.color = '#d4af37';
        });
        closeBtn.addEventListener('mouseleave', function() {
            this.style.color = '#f5f5f5';
        });
    }
});

// Preload next/previous images for smoother navigation
function preloadImage(index) {
    if (galleryData[index] && galleryData[index].url) {
        const img = new Image();
        img.src = galleryData[index].url;
    }
}

// Preload adjacent images when modal opens or navigates
function preloadAdjacentImages() {
    const nextIndex = (currentImageIndex + 1) % galleryData.length;
    const prevIndex = (currentImageIndex - 1 + galleryData.length) % galleryData.length;
    preloadImage(nextIndex);
    preloadImage(prevIndex);
}

// Call preload on modal open and navigation
document.addEventListener('DOMContentLoaded', function() {
    const originalOpenModal = window.openModal;
    window.openModal = function(index) {
        originalOpenModal(index);
        preloadAdjacentImages();
    };
    
    const originalChangeImage = window.changeImage;
    window.changeImage = function(direction) {
        originalChangeImage(direction);
        preloadAdjacentImages();
    };
});
</script>

<?php get_template_part('template-parts/footer'); ?>
