<?php get_header(); ?>

<main class="site-main">
    <div class="container-main">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="error-404">
                    <div class="code">404</div>
                    <h2 class="title"><?php echo __('Oops! Page Not Found', 'tahseen-ashrafi'); ?></h2>
                    <p class="desc">
                        <?php echo __('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'tahseen-ashrafi'); ?>
                    </p>
                    <div class="error-actions mb-5">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="see-more-btn me-3">
                            <?php echo __('Go to Homepage', 'tahseen-ashrafi'); ?>
                        </a>
                        <a href="javascript:history.back()" class="see-more-btn secondary">
                            <?php echo __('Go Back', 'tahseen-ashrafi'); ?>
                        </a>
                    </div>
                    <div class="search-form-404" style="max-width: 500px; margin: 0 auto;">
                        <h3 style="margin-bottom: 20px; "><?php echo __('Try searching for something else:', 'tahseen-ashrafi'); ?></h3>
                        <?php get_search_form(); ?>
                    </div>
                </div>

                <!-- Popular Posts -->
                <?php
                $popular_posts = new WP_Query(array(
                    'posts_per_page' => 3,
                    'orderby'        => 'comment_count',
                ));
                
                if ($popular_posts->have_posts()) :
                ?>
                    <section class="popular-posts mt-5">
                        <h3 class="section-heading text-center"><?php echo __('Popular Posts', 'tahseen-ashrafi'); ?></h3>
                        <div class="row">
                            <?php
                            while ($popular_posts->have_posts()) : $popular_posts->the_post();
                            ?>
                                <div class="col-md-4 mb-4">
                                    <article class="post-card">
                                        <div class="post-card-image">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_post_thumbnail('featured-medium'); ?>
                                                </a>
                                            <?php endif; ?>
                                            <span class="post-category"><?php echo tahseen_ashrafi_get_categories(); ?></span>
                                        </div>
                                        <div class="post-card-content">
                                            <h3 class="post-card-title">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h3>
                                        </div>
                                    </article>
                                </div>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                            ?>
                        </div>
                    </section>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
