<?php
/**
 * The sidebar containing the main widget area
 */

if (!is_active_sidebar('sidebar-1')) {
    // If no widgets, show default content
    ?>
    <aside class="sidebar">
        <!-- TOP News Widget -->
        <div class="widget">
            <h3 class="widget-title"><?php echo __('TOP News', 'tahseen-ashrafi'); ?></h3>
            <?php
            $top_news = new WP_Query(array(
                'posts_per_page' => 4,
                'orderby'        => 'date',
            ));
            
            if ($top_news->have_posts()) :
                while ($top_news->have_posts()) : $top_news->the_post();
            ?>
                <article class="sidebar-post-card">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="sidebar-post-image">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('thumbnail'); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="sidebar-post-content">
                        <h4 class="sidebar-post-title">
                            <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 10); ?></a>
                        </h4>
                    </div>
                </article>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>

        <!-- People Also Watched Widget (Recent Posts) -->
        <?php if (is_single()) : ?>
            <div class="widget">
                <h3 class="widget-title"><?php echo __('People Also Watched', 'tahseen-ashrafi'); ?></h3>
                <?php
                $recent_posts = new WP_Query(array(
                    'posts_per_page' => 5,
                    'orderby'        => 'date',
                    'post__not_in'   => array(get_the_ID()),
                ));
                
                if ($recent_posts->have_posts()) :
                    while ($recent_posts->have_posts()) : $recent_posts->the_post();
                ?>
                    <article class="sidebar-post-card">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="sidebar-post-image">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('thumbnail'); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <div class="sidebar-post-content">
                            <h4 class="sidebar-post-title">
                                <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 10); ?></a>
                            </h4>
                        </div>
                    </article>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        <?php endif; ?>

        <!-- Categories Widget (Dynamic from Menu) -->
        <div class="widget widget-categories">
            <h3 class="widget-title"><?php echo __('Categories', 'tahseen-ashrafi'); ?></h3>
            <ul>
                <?php
                $locations = get_nav_menu_locations();
                if (isset($locations['primary'])) {
                    $menu_items = wp_get_nav_menu_items($locations['primary']);
                    if ($menu_items) {
                        foreach ($menu_items as $item) {
                            echo '<li><a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a></li>';
                        }
                    }
                } else {
                    echo '<li><a href="' . esc_url(home_url('/')) . '">Home</a></li>';
                    echo '<li><a href="' . esc_url(home_url('/category/india')) . '">India</a></li>';
                    echo '<li><a href="' . esc_url(home_url('/category/world')) . '">World</a></li>';
                    echo '<li><a href="' . esc_url(home_url('/category/sports')) . '">Sports</a></li>';
                    echo '<li><a href="' . esc_url(home_url('/category/entertainment')) . '">Entertainment</a></li>';
                    echo '<li><a href="' . esc_url(home_url('/category/automobile')) . '">Automobile</a></li>';
                    echo '<li><a href="' . esc_url(home_url('/category/business')) . '">Business</a></li>';
                    echo '<li><a href="' . esc_url(home_url('/category/lifestyle')) . '">Lifestyle</a></li>';
                    echo '<li><a href="' . esc_url(home_url('/category/tech')) . '">Tech</a></li>';
                    echo '<li><a href="' . esc_url(home_url('/category/education')) . '">Education</a></li>';
                    echo '<li><a href="' . esc_url(home_url('/category/science')) . '">Science</a></li>';
                }
                ?>
            </ul>
        </div>

        <!-- Tags Widget -->
        <?php
        $tags = get_tags();
        if ($tags) :
        ?>
            <div class="widget">
                <h3 class="widget-title"><?php echo __('Tags', 'tahseen-ashrafi'); ?></h3>
                <div class="tag-cloud">
                    <?php
                    foreach ($tags as $tag) {
                        echo '<a href="' . get_tag_link($tag->term_id) . '" class="badge bg-secondary me-2 mb-2" style="display: inline-block;">' . esc_html($tag->name) . '</a>';
                    }
                    ?>
                </div>
            </div>
        <?php endif; ?>
    </aside>
    <?php
    return;
}
?>

<aside class="sidebar">
    <?php dynamic_sidebar('sidebar-1'); ?>
</aside>
