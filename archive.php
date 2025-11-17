<?php get_header(); ?>

<main class="site-main">
    <div class="container-main">
        <div class="archive-layout">
            <main class="archive-main">
                <header class="page-header mb-5">
                    <h2 class="section-heading">
                        <?php
                        if (is_category()) :
                            single_cat_title();
                        elseif (is_tag()) :
                            single_tag_title();
                        elseif (is_author()) :
                            echo __('Author: ', 'tahseen-ashrafi');
                            the_author();
                        elseif (is_day()) :
                            echo __('Daily Archives: ', 'tahseen-ashrafi');
                            echo get_the_date();
                        elseif (is_month()) :
                            echo __('Monthly Archives: ', 'tahseen-ashrafi');
                            echo get_the_date('F Y');
                        elseif (is_year()) :
                            echo __('Yearly Archives: ', 'tahseen-ashrafi');
                            echo get_the_date('Y');
                        else :
                            echo __('Archives', 'tahseen-ashrafi');
                        endif;
                        ?>
                    </h2>
                    
                    <?php
                    if (is_category()) :
                        $category_description = category_description();
                        if (!empty($category_description)) :
                            echo '<div class="taxonomy-description">' . $category_description . '</div>';
                        endif;
                    endif;
                    ?>
                </header>

                <?php if (have_posts()) : ?>
                    <div class="archive-posts-grid">
                        <?php
                        while (have_posts()) : the_post();
                        ?>
                            <article class="archive-post-card">
                                <?php if (has_post_thumbnail()) : ?>
                                <div class="archive-post-image">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium'); ?>
                                    </a>
                                    <?php
                                    $categories = get_the_category();
                                    if (!empty($categories)) {
                                        echo '<span class="post-category">' . esc_html($categories[0]->name) . '</span>';
                                    }
                                    ?>
                                </div>
                            <?php endif; ?>
                            <div class="archive-post-content">
                                <h2 class="archive-post-title">
                                    <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 12); ?></a>
                                </h2>
                                <div class="post-date"><?php echo tahseen_ashrafi_time_ago(); ?></div>
                                <a href="<?php the_permalink(); ?>" class="see-more-btn"><?php echo __('See More', 'tahseen-ashrafi'); ?></a>
                            </div>
                            </article>
                        <?php endwhile; ?>
                    </div>

                    <?php
                    global $wp_query;
                    if ($wp_query->max_num_pages > 1) :
                    ?>
                    <div class="text-center mt-4">
                        <button class="see-more-btn load-more-posts" data-category="<?php echo is_category() ? get_queried_object()->slug : ''; ?>" data-paged="2"><?php echo __('View More', 'tahseen-ashrafi'); ?></button>
                    </div>
                    <?php endif; ?>

                <?php else : ?>
                    <div class="no-posts-found">
                        <h2><?php echo __('Nothing Found', 'tahseen-ashrafi'); ?></h2>
                        <p><?php echo __('It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'tahseen-ashrafi'); ?></p>
                        <?php get_search_form(); ?>
                    </div>
                <?php endif; ?>
            </main>

        </div>
    </div>
</main>

<?php get_footer(); ?>
