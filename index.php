<?php get_header(); ?>

<main class="site-main">
    <div class="container-main">
        <!-- TOP News Section - 3 top, 4 bottom (7 total) -->
        <?php
        $top_news = new WP_Query(array(
            'posts_per_page' => 7,
            'post_status'    => 'publish',
        ));
        
        if ($top_news->have_posts()) :
        ?>
        <section class="news-section">
            <h2 class="section-heading">TOP Stories</h2>
            <div class="top-news-grid">
                <?php 
                $post_count = 0;
                while ($top_news->have_posts()) : $top_news->the_post(); 
                    $post_count++;
                    $grid_class = ($post_count <= 3) ? 'top-row' : 'bottom-row';
                ?>
                    <article class="news-box <?php echo $grid_class; ?>">
                        <div class="news-box-image">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('large'); ?>
                                </a>
                                <span class="post-category"><?php echo tahseen_ashrafi_get_categories(); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="image-credit">Image captured by "Tahseen Ashrafi"</div>
                        <div class="news-box-content">
                            <h3 class="news-box-title">
                                <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 12); ?></a>
                            </h3>
                            <div class="post-date"><?php echo tahseen_ashrafi_time_ago(); ?></div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
        </section>
        <?php
            wp_reset_postdata();
        endif;
        ?>

        <?php
        // Get menu items dynamically from primary menu
        $menu_items = wp_get_nav_menu_items('primary');
        if (!$menu_items) {
            // Fallback categories if no menu is set
            $categories = array('entertainment', 'lifestyle', 'tech', 'sports', 'science', 'world', 'education');
        } else {
            $categories = array();
            foreach ($menu_items as $item) {
                // Extract category slug from URL
                if (strpos($item->url, '/category/') !== false) {
                    $slug = basename($item->url);
                    if ($slug && $slug !== 'home') {
                        $categories[] = $slug;
                    }
                }
            }
        }
        
        foreach ($categories as $category_slug) :
            $category = get_category_by_slug($category_slug);
            if (!$category) continue;
            
            $category_posts = tahseen_ashrafi_get_category_posts($category_slug, 5);
            if (!$category_posts->have_posts()) continue;
        ?>
            <section class="news-section category-section">
                <h2 class="section-heading"><?php echo esc_html($category->name); ?></h2>
                <div class="category-layout">
                    <!-- Left Side: 4 Small Posts (2x2) -->
                    <div class="category-small-posts">
                        <?php 
                        $post_count = 0;
                        while ($category_posts->have_posts() && $post_count < 4) : 
                            $category_posts->the_post(); 
                            $post_count++;
                        ?>
                            <article class="small-post-card">
                                <div class="small-post-image">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('medium'); ?>
                                        </a>
                                        <span class="post-category"><?php echo tahseen_ashrafi_get_categories(); ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="image-credit">Image captured by "Tahseen Ashrafi"</div>
                                <div class="small-post-content">
                                    <h3 class="small-post-title">
                                        <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 10); ?></a>
                                    </h3>
                                    <div class="post-date"><?php echo tahseen_ashrafi_time_ago(); ?></div>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>
                    
                    <!-- Right Side: 1 Large Featured Post -->
                    <div class="category-featured-post">
                        <?php 
                        if ($category_posts->have_posts()) : 
                            $category_posts->the_post();
                        ?>
                            <article class="featured-post-card">
                                <div class="featured-post-image">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('large'); ?>
                                        </a>
                                        <span class="post-category"><?php echo tahseen_ashrafi_get_categories(); ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="image-credit">Image captured by "Tahseen Ashrafi"</div>
                                <div class="featured-post-content">
                                    <h3 class="featured-post-title">
                                        <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 15); ?></a>
                                    </h3>
                                    <div class="featured-post-excerpt">
                                        <?php echo wp_trim_words(get_the_excerpt(), 25); ?>
                                    </div>
                                    <a href="<?php the_permalink(); ?>" class="see-more-btn"><?php echo __('See More', 'tahseen-ashrafi'); ?></a>
                                    <div class="post-date"><?php echo tahseen_ashrafi_time_ago(); ?></div>
                                </div>
                            </article>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php
            wp_reset_postdata();
        endforeach;
        ?>
    </div>
</main>

<?php get_footer(); ?>
