<?php
/**
 * The template for displaying single blog post
 */

get_template_part('template-parts/header');

if (have_posts()) : while (have_posts()) : the_post();

$post_id = get_the_ID();
$reading_time = calculate_reading_time($post_id);
$categories = get_the_category();
$tags = get_the_tags();
?>

<!-- Hero Section with Featured Image -->
<section class="min-h-[70vh] relative overflow-hidden pt-20 bg-gradient-dark">
    <?php if (has_post_thumbnail()) : ?>
    <div class="absolute inset-0 z-0">
        <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>"
             alt="<?php the_title(); ?>"
             class="w-full h-full object-cover opacity-30">
        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-[#0f0f0f]"></div>
    </div>
    <?php endif; ?>

    <div class="max-w-4xl mx-auto px-4 py-20 relative z-10">
        <!-- Breadcrumb -->
        <nav class="mb-6 text-sm" aria-label="Breadcrumb">
            <ol class="flex items-center gap-2 text-gray-400">
                <li><a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-[#d4af37] transition-colors">Home</a></li>
                <li><span class="text-gray-600">/</span></li>
                <li><a href="<?php echo esc_url(home_url('/blog')); ?>" class="hover:text-[#d4af37] transition-colors">Blog</a></li>
                <?php if (!empty($categories)) : ?>
                <li><span class="text-gray-600">/</span></li>
                <li><a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>" class="hover:text-[#d4af37] transition-colors"><?php echo esc_html($categories[0]->name); ?></a></li>
                <?php endif; ?>
            </ol>
        </nav>

        <!-- Categories -->
        <?php if (!empty($categories)) : ?>
        <div class="mb-4 flex flex-wrap gap-2">
            <?php foreach ($categories as $category) : ?>
            <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>"
               class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-[#d4af37] bg-opacity-20 text-[#d4af37] hover:bg-opacity-30 transition-all">
                <?php echo esc_html($category->name); ?>
            </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Title -->
        <h1 class="text-4xl md:text-6xl font-bold mb-6 text-[#f5f5f5] animate-fade-in-up leading-tight">
            <?php the_title(); ?>
        </h1>

        <!-- Excerpt -->
        <?php if (has_excerpt()) : ?>
        <div class="text-xl text-gray-300 leading-relaxed mb-8 max-w-3xl">
            <?php the_excerpt(); ?>
        </div>
        <?php endif; ?>

        <!-- Meta Information -->
        <div class="flex flex-wrap items-center gap-6 text-sm text-gray-400">
            <div class="flex items-center gap-3">
                <?php echo get_avatar(get_the_author_meta('ID'), 40, '', '', array('class' => 'w-10 h-10 rounded-full')); ?>
                <div>
                    <div class="font-medium text-[#f5f5f5]">
                        <?php echo esc_html(get_the_author_meta('display_name')); ?>
                    </div>
                </div>
            </div>
            <span>•</span>
            <time datetime="<?php echo get_the_date('c'); ?>">
                <?php echo get_the_date('F j, Y'); ?>
            </time>
            <span>•</span>
            <span><?php echo $reading_time; ?> min read</span>
            <?php if (get_the_date() !== get_the_modified_date()) : ?>
            <span>•</span>
            <time datetime="<?php echo get_the_modified_date('c'); ?>" class="text-xs">
                Updated: <?php echo get_the_modified_date('M j, Y'); ?>
            </time>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Article Content -->
<article id="post-<?php the_ID(); ?>" <?php post_class('bg-gradient-dark py-20'); ?>>
    <div class="max-w-4xl mx-auto px-4">
        <div class="glass-lg rounded-2xl p-8 md:p-12">
            <!-- Main Content -->
            <div class="prose prose-lg prose-invert max-w-none
                    prose-headings:text-[#f5f5f5] prose-headings:font-bold
                    prose-h2:text-3xl prose-h2:mt-8 prose-h2:mb-4 prose-h2:border-b prose-h2:border-gray-700 prose-h2:pb-3
                    prose-h3:text-2xl prose-h3:mt-6 prose-h3:mb-3 prose-h3:text-[#d4af37]
                    prose-h4:text-xl prose-h4:mt-5 prose-h4:mb-2
                    prose-p:text-gray-300 prose-p:leading-relaxed prose-p:mb-4
                    prose-a:text-[#d4af37] prose-a:no-underline hover:prose-a:underline prose-a:transition-colors
                    prose-strong:text-[#f5f5f5] prose-strong:font-semibold
                    prose-ul:my-6 prose-ul:text-gray-300
                    prose-ol:my-6 prose-ol:text-gray-300
                    prose-li:my-2 prose-li:leading-relaxed
                    prose-blockquote:border-l-4 prose-blockquote:border-[#d4af37] prose-blockquote:bg-white prose-blockquote:bg-opacity-5 prose-blockquote:px-6 prose-blockquote:py-4 prose-blockquote:italic prose-blockquote:my-6 prose-blockquote:rounded-r-lg
                    prose-img:rounded-lg prose-img:shadow-lg prose-img:my-8
                    prose-code:bg-gray-800 prose-code:px-2 prose-code:py-1 prose-code:rounded prose-code:text-sm prose-code:text-[#d4af37]
                    prose-pre:bg-gray-900 prose-pre:border prose-pre:border-gray-700 prose-pre:rounded-lg prose-pre:p-4 prose-pre:my-6
                    prose-table:w-full prose-table:my-6 prose-table:text-gray-300
                    prose-thead:bg-white prose-thead:bg-opacity-5
                    prose-th:border prose-th:border-gray-700 prose-th:px-4 prose-th:py-3 prose-th:text-left prose-th:font-semibold prose-th:text-[#f5f5f5]
                    prose-td:border prose-td:border-gray-700 prose-td:px-4 prose-td:py-3
                    prose-hr:border-gray-700 prose-hr:my-8">
                <?php
                $content = get_the_content();
                $content = apply_filters('the_content', $content);
                $content = str_replace(']]>', ']]&gt;', $content);
                echo $content;
                ?>
            </div>

            <!-- Tags -->
            <?php if (!empty($tags)) : ?>
            <div class="mt-12 pt-8 border-t border-gray-700">
                <h3 class="text-lg font-semibold text-[#f5f5f5] mb-4">Tags</h3>
                <div class="flex flex-wrap gap-2">
                    <?php foreach ($tags as $tag) : ?>
                    <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>"
                       class="inline-block bg-white bg-opacity-5 text-gray-300 text-sm px-3 py-1 rounded-full hover:bg-opacity-10 hover:text-[#d4af37] transition-all">
                        #<?php echo esc_html($tag->name); ?>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Author Bio -->
            <div class="mt-12 pt-8 border-t border-gray-700">
                <div class="flex items-start gap-4">
                    <?php echo get_avatar(get_the_author_meta('ID'), 80, '', '', array('class' => 'w-20 h-20 rounded-full')); ?>
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-[#f5f5f5] mb-2">
                            About <?php echo esc_html(get_the_author_meta('display_name')); ?>
                        </h3>
                        <?php if (get_the_author_meta('description')) : ?>
                        <p class="text-gray-300 leading-relaxed mb-3">
                            <?php echo esc_html(get_the_author_meta('description')); ?>
                        </p>
                        <?php endif; ?>
                        <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"
                           class="text-[#d4af37] hover:underline font-medium text-sm">
                            View all posts by <?php echo esc_html(get_the_author_meta('display_name')); ?> →
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Post Navigation -->
        <div class="mt-8 grid md:grid-cols-2 gap-4">
            <?php
            $prev_post = get_previous_post();
            $next_post = get_next_post();
            ?>

            <?php if ($prev_post) : ?>
            <a href="<?php echo esc_url(get_permalink($prev_post)); ?>" class="glass rounded-xl p-6 hover-lift group">
                <div class="text-sm text-gray-400 mb-2">← Previous Post</div>
                <h4 class="text-lg font-semibold text-[#f5f5f5] group-hover:text-[#d4af37] transition-colors">
                    <?php echo esc_html($prev_post->post_title); ?>
                </h4>
            </a>
            <?php else : ?>
            <div></div>
            <?php endif; ?>

            <?php if ($next_post) : ?>
            <a href="<?php echo esc_url(get_permalink($next_post)); ?>" class="glass rounded-xl p-6 hover-lift group text-right">
                <div class="text-sm text-gray-400 mb-2">Next Post →</div>
                <h4 class="text-lg font-semibold text-[#f5f5f5] group-hover:text-[#d4af37] transition-colors">
                    <?php echo esc_html($next_post->post_title); ?>
                </h4>
            </a>
            <?php endif; ?>
        </div>
    </div>
</article>

<!-- Related Articles Section -->
<section class="py-20 px-4 bg-gradient-dark-reverse">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-3xl font-bold text-center mb-12 text-[#f5f5f5]">
            Related <span class="text-gradient">Articles</span>
        </h2>

        <?php
        if ($categories) {
            $category_ids = wp_list_pluck($categories, 'term_id');
            $related_query = new WP_Query(array(
                'category__in' => $category_ids,
                'post__not_in' => array(get_the_ID()),
                'posts_per_page' => 3,
                'ignore_sticky_posts' => 1,
            ));

            if ($related_query->have_posts()) : ?>
                <div class="grid md:grid-cols-3 gap-8">
                    <?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
                    <article class="glass-lg rounded-2xl overflow-hidden hover-lift">
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

                            <!-- Title -->
                            <h3 class="text-xl font-bold mb-3 text-[#f5f5f5] hover:text-[#d4af37] transition-colors line-clamp-2">
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
                    <?php endwhile; ?>
                </div>
            <?php
                wp_reset_postdata();
            else : ?>
                <div class="text-center glass-lg p-12 rounded-2xl max-w-2xl mx-auto">
                    <p class="text-gray-300">No related articles found.</p>
                </div>
            <?php endif;
        } ?>
    </div>
</section>


<?php endwhile; endif; ?>

<?php get_template_part('template-parts/footer'); ?>
