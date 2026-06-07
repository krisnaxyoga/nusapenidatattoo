<?php
/**
 * The template for displaying archive pages (categories, tags, dates, authors)
 */

get_template_part('template-parts/header'); ?>

<!-- Archive Hero Section -->
<section class="min-h-[60vh] flex items-center justify-center relative overflow-hidden pt-20 bg-gradient-dark">
    <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
        <h1 class="text-5xl md:text-7xl font-bold mb-6 text-[#f5f5f5] animate-fade-in-up">
            <?php
            if (is_category()) {
                single_cat_title();
            } elseif (is_tag()) {
                single_tag_title();
            } elseif (is_author()) {
                echo 'Author: ' . get_the_author();
            } elseif (is_date()) {
                echo 'Archive: ' . get_the_date('F Y');
            } else {
                echo 'Archives';
            }
            ?>
        </h1>

        <?php if (is_category() && category_description()) : ?>
        <p class="text-xl text-gray-300 max-w-2xl mx-auto">
            <?php echo category_description(); ?>
        </p>
        <?php elseif (is_tag() && tag_description()) : ?>
        <p class="text-xl text-gray-300 max-w-2xl mx-auto">
            <?php echo tag_description(); ?>
        </p>
        <?php else : ?>
        <p class="text-xl text-gray-300 max-w-2xl mx-auto">
            Browse our collection of articles
        </p>
        <?php endif; ?>
    </div>
</section>

<!-- Archive Posts Grid -->
<section class="py-20 px-4 bg-gradient-dark">
    <div class="max-w-7xl mx-auto">
        <?php if (have_posts()) : ?>
            <div class="grid md:grid-cols-3 gap-8">
                <?php
                while (have_posts()) : the_post();
                ?>
                <article class="glass-lg rounded-2xl overflow-hidden hover-lift stagger-item">
                    <?php if (has_post_thumbnail()) : ?>
                    <div class="article-image">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('large', ['class' => 'w-full h-full object-cover']); ?>
                        </a>
                    </div>
                    <?php endif; ?>

                    <div class="p-6">
                        <!-- Meta Info -->
                        <div class="flex items-center gap-4 text-sm text-gray-400 mb-3">
                            <span><?php echo get_the_date(); ?></span>
                            <span>•</span>
                            <span><?php echo calculate_reading_time(get_the_ID()); ?> min read</span>
                        </div>

                        <!-- Category (if not on category archive) -->
                        <?php if (!is_category()) :
                            $categories = get_the_category();
                            if (!empty($categories)) :
                        ?>
                        <div class="mb-3">
                            <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"
                               class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-[#d4af37] bg-opacity-20 text-[#d4af37] hover:bg-opacity-30 transition-all">
                                <?php echo esc_html($categories[0]->name); ?>
                            </a>
                        </div>
                        <?php endif; endif; ?>

                        <!-- Title -->
                        <h3 class="text-xl font-bold mb-3 text-[#f5f5f5] hover:text-[#d4af37] transition-colors">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>

                        <!-- Excerpt -->
                        <p class="text-gray-300 mb-4 line-clamp-3">
                            <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                        </p>

                        <!-- Read More -->
                        <a href="<?php the_permalink(); ?>" class="inline-flex items-center text-[#d4af37] font-semibold hover:gap-2 transition-all">
                            Read More
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </article>
                <?php
                endwhile;
                ?>
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                <?php
                the_posts_pagination([
                    'mid_size'           => 2,
                    'prev_text'          => '← Previous',
                    'next_text'          => 'Next →',
                    'screen_reader_text' => ' ',
                ]);
                ?>
            </div>

        <?php else : ?>
            <!-- No Posts Found -->
            <div class="text-center glass-lg p-12 rounded-2xl max-w-2xl mx-auto">
                <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h2 class="text-2xl font-bold mb-4 text-[#f5f5f5]">No Posts Found</h2>
                <p class="text-gray-300 mb-6">Sorry, there are no posts in this archive yet.</p>
                <a href="<?php echo esc_url(home_url('/blog')); ?>" class="inline-block btn-glass-accent px-6 py-3 rounded-full font-semibold mr-2">
                    View All Posts
                </a>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-block glass-lg px-6 py-3 rounded-full font-semibold text-[#f5f5f5]">
                    Back to Home
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>

<style>
/* Pagination Styling */
.pagination {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    justify-content: center;
    list-style: none;
}

.pagination .page-numbers {
    display: inline-block;
    padding: 10px 16px;
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: #f5f5f5;
    text-decoration: none;
    transition: all 0.3s ease;
    font-weight: 500;
}

.pagination .page-numbers:hover {
    background: rgba(212, 175, 55, 0.2);
    border-color: #d4af37;
    color: #d4af37;
}

.pagination .page-numbers.current {
    background: #d4af37;
    border-color: #d4af37;
    color: #0f0f0f;
}

.pagination .dots {
    background: transparent;
    border: none;
    color: #9ca3af;
}

.pagination .prev,
.pagination .next {
    font-weight: 600;
}
</style>

<?php get_template_part('template-parts/footer'); ?>
