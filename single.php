<?php get_header(); ?>

<main class="site-main">
    <div class="container-main single-post-layout">
        <div class="single-post-wrapper">
            <div class="single-post-main">
                <?php
                while (have_posts()) : the_post();
                ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('single-post-content'); ?>>
                        <header class="entry-header">
                            <h1 class="entry-title"><?php echo wp_trim_words(get_the_title(), 12); ?></h1>
                            <div class="entry-meta">
                                <span class="post-date"><?php echo get_the_date(); ?></span>
                                <span class="post-author"> | <?php echo __('By', 'tahseen-ashrafi'); ?> <?php the_author(); ?></span>
                                <span class="post-time"> | <?php echo tahseen_ashrafi_time_ago(); ?></span>
                            </div>
                        </header>

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <?php the_post_thumbnail('large'); ?>
                                <span class="post-category"><?php echo tahseen_ashrafi_get_categories(); ?></span>
                            </div>
                        <?php endif; ?>

                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>
                    </article>

                    <?php
                    // If comments are open or there is at least one comment, load comment template
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                    ?>

                <?php endwhile; ?>
            </div>

        </div>
    </div>
</main>

<?php get_footer(); ?>
