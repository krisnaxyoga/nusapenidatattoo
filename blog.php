<?php
/**
 * Template Name: Blog
 * The template for displaying the blog page
 */

get_template_part('template-parts/header'); ?>

<!-- Blog Hero Section -->
<section class="min-h-[60vh] flex items-center justify-center relative overflow-hidden pt-20 bg-gradient-dark">
    <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
        <h1 class="text-5xl md:text-7xl font-bold mb-6 text-[#f5f5f5] animate-fade-in-up">
            Our <span class="text-gradient">Blog</span>
        </h1>
        <p class="text-xl text-gray-300 max-w-2xl mx-auto">
            Tattoo inspiration, tips, and stories from Nusa Penida Tattoo Studio
        </p>
    </div>
</section>

<!-- Blog Posts Grid -->
<section class="py-20 px-4 bg-gradient-dark">
    <div class="max-w-7xl mx-auto">
        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $blog_query = new WP_Query([
            'post_type'      => 'post',
            'posts_per_page' => 9,
            'paged'          => $paged,
            'orderby'        => 'date',
            'order'          => 'DESC'
        ]);

        if ($blog_query->have_posts()) :
        ?>
            <div class="grid md:grid-cols-3 gap-8">
                <?php
                $post_index = 0;
                while ($blog_query->have_posts()) : $blog_query->the_post();
                ?>
                <article class="glass-lg rounded-2xl overflow-hidden hover-lift stagger-item">
                    <div class="article-image">
                        <a href="<?php the_permalink(); ?>">
                            <?php
                            if (has_post_thumbnail()) {
                                the_post_thumbnail('large', ['class' => 'w-full h-full object-cover']);
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
                        <!-- Meta Info -->
                        <div class="flex items-center gap-4 text-sm text-gray-400 mb-3">
                            <span><?php echo get_the_date(); ?></span>
                            <span>•</span>
                            <span><?php echo calculate_reading_time(get_the_ID()); ?> min read</span>
                        </div>

                        <!-- Category -->
                        <?php
                        $categories = get_the_category();
                        if (!empty($categories)) :
                        ?>
                        <div class="mb-3">
                            <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"
                               class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-[#d4af37] bg-opacity-20 text-[#d4af37] hover:bg-opacity-30 transition-all">
                                <?php echo esc_html($categories[0]->name); ?>
                            </a>
                        </div>
                        <?php endif; ?>

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
                    $post_index++;
                endwhile;
                ?>
            </div>

            <!-- Pagination -->
            <?php if ($blog_query->max_num_pages > 1) : ?>
            <div class="mt-12 flex justify-center gap-2">
                <?php
                echo paginate_links([
                    'total'     => $blog_query->max_num_pages,
                    'current'   => $paged,
                    'prev_text' => '← Previous',
                    'next_text' => 'Next →',
                    'type'      => 'list',
                    'end_size'  => 2,
                    'mid_size'  => 2,
                ]);
                ?>
            </div>
            <?php endif; ?>

        <?php
            wp_reset_postdata();
        else :
        ?>
            <!-- No Posts Found -->
            <div class="text-center glass-lg p-12 rounded-2xl max-w-2xl mx-auto">
                <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h2 class="text-2xl font-bold mb-4 text-[#f5f5f5]">No Posts Found</h2>
                <p class="text-gray-300 mb-6">There are no blog posts available at the moment. Check back soon for tattoo tips and inspiration!</p>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-block btn-glass-accent px-6 py-3 rounded-full font-semibold">
                    Back to Home
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>


<?php get_template_part('template-parts/footer'); ?>
