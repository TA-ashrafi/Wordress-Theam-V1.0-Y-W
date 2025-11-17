<?php get_header(); ?>

<main class="site-main">
    <div class="container-main">
        <div class="row">
            <div class="col-lg-8">
                <header class="page-header mb-5">
                    <h1 class="page-title">
                        <?php
                        printf(
                            __('Search Results for: %s', 'tahseen-ashrafi'),
                            '<span>' . get_search_query() . '</span>'
                        );
                        ?>
                    </h1>
                </header>

                <?php if (have_posts()) : ?>
                    <div class="search-results">
                        <?php
                        while (have_posts()) : the_post();
                        ?>
                            <article class="post-card post-card-horizontal mb-4">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="post-card-image">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('featured-medium'); ?>
                                        </a>
                                        <span class="post-category"><?php echo tahseen_ashrafi_get_categories(); ?></span>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="post-card-content" style="flex: 1;">
                                    <h2 class="post-card-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>
                                    <div class="entry-meta mb-2">
                                        <span class="post-date"><?php echo get_the_date(); ?></span>
                                        <span> | <?php echo tahseen_ashrafi_time_ago(); ?></span>
                                        <span> | <?php echo __('By', 'tahseen-ashrafi'); ?> <?php the_author(); ?></span>
                                    </div>
                                    <div class="post-excerpt">
                                        <?php the_excerpt(); ?>
                                    </div>
                                    <a href="<?php the_permalink(); ?>" class="see-more-btn"><?php echo __('Read More', 'tahseen-ashrafi'); ?></a>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>

                    <?php tahseen_ashrafi_pagination(); ?>

                <?php else : ?>
                    <div class="no-posts-found single-post-content">
                        <h2><?php echo __('Nothing Found', 'tahseen-ashrafi'); ?></h2>
                        <p><?php echo __('Sorry, but nothing matched your search terms. Please try again with different keywords.', 'tahseen-ashrafi'); ?></p>
                        <?php get_search_form(); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="col-lg-4">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
