<?php
/**
 * Tahseen Ashrafi Theme functions and definitions
 */

// Theme Setup
function tahseen_ashrafi_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');
    
    // Let WordPress manage the document title
    add_theme_support('title-tag');
    
    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(800, 600, true);
    add_image_size('featured-large', 1200, 800, true);
    add_image_size('featured-medium', 600, 400, true);
    add_image_size('featured-small', 300, 200, true);
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'tahseen-ashrafi'),
    ));
    
    // Switch default core markup to output valid HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');
}
add_action('after_setup_theme', 'tahseen_ashrafi_setup');


// Enqueue scripts and styles
function tahseen_ashrafi_scripts() {
    // Enqueue Bootstrap CSS
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');
    
    // Enqueue theme stylesheet
    wp_enqueue_style('tahseen-ashrafi-style', get_stylesheet_uri(), array('bootstrap'), '1.0');
    
    // Enqueue Bootstrap JS
    wp_enqueue_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array('jquery'), '5.3.0', true);
    
    // Enqueue theme scripts
    wp_enqueue_script('tahseen-ashrafi-script', get_template_directory_uri() . '/js/theme.js', array('jquery'), '1.0', true);

    // Localize script for AJAX
    wp_localize_script('tahseen-ashrafi-script', 'ajax_params', array(
        'ajaxurl' => admin_url('admin-ajax.php')
    ));

    // Enqueue comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'tahseen_ashrafi_scripts');

// Register widget areas
function tahseen_ashrafi_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'tahseen-ashrafi'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here to appear in your sidebar.', 'tahseen-ashrafi'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer', 'tahseen-ashrafi'),
        'id'            => 'footer-1',
        'description'   => __('Add widgets here to appear in your footer.', 'tahseen-ashrafi'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'tahseen_ashrafi_widgets_init');

// Custom excerpt length
function tahseen_ashrafi_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'tahseen_ashrafi_excerpt_length');

// Custom excerpt more
function tahseen_ashrafi_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'tahseen_ashrafi_excerpt_more');

// Get post categories
function tahseen_ashrafi_get_categories() {
    $categories = get_the_category();
    if (!empty($categories)) {
        return esc_html($categories[0]->name);
    }
    return __('Uncategorized', 'tahseen-ashrafi');
}

// Get time ago
function tahseen_ashrafi_time_ago() {
    return sprintf(
        __('%s ago', 'tahseen-ashrafi'),
        human_time_diff(get_the_time('U'), current_time('timestamp'))
    );
}

// Get posts by category
function tahseen_ashrafi_get_category_posts($category_slug, $posts_per_page = 5) {
    $args = array(
        'category_name'  => $category_slug,
        'posts_per_page' => $posts_per_page,
        'post_status'    => 'publish',
    );
    return new WP_Query($args);
}

// Add custom theme options
function tahseen_ashrafi_customize_register($wp_customize) {
    // Add section for logo
    $wp_customize->add_section('tahseen_ashrafi_logo_section', array(
        'title'    => __('Theme Logo', 'tahseen-ashrafi'),
        'priority' => 30,
    ));
    
    // Add setting for logo
    $wp_customize->add_setting('tahseen_ashrafi_logo', array(
        'default'   => '',
        'transport' => 'refresh',
    ));
    
    // Add control for logo
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'tahseen_ashrafi_logo', array(
        'label'    => __('Upload Logo', 'tahseen-ashrafi'),
        'section'  => 'tahseen_ashrafi_logo_section',
        'settings' => 'tahseen_ashrafi_logo',
    )));
}
add_action('customize_register', 'tahseen_ashrafi_customize_register');

// Change posts per page for archive pages to 15
function tahseen_ashrafi_posts_per_page($query) {
    if (!is_admin() && $query->is_main_query() && (is_category() || is_tag() || is_archive())) {
        $query->set('posts_per_page', 15);
    }
}
add_action('pre_get_posts', 'tahseen_ashrafi_posts_per_page');

// AJAX Load More Posts
function tahseen_ashrafi_load_more_posts() {
    $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';

    $args = array(
        'posts_per_page' => 15,
        'paged' => $paged,
        'post_status' => 'publish',
    );

    if (!empty($category)) {
        $args['category_name'] = $category;
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) : $query->the_post();
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
        <?php
        endwhile;
        $html = ob_get_clean();

        wp_send_json_success(array(
            'html' => $html,
            'has_more' => ($paged < $query->max_num_pages)
        ));
    } else {
        wp_send_json_error();
    }

    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_load_more_posts', 'tahseen_ashrafi_load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'tahseen_ashrafi_load_more_posts');

// Related posts function
function tahseen_ashrafi_related_posts($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $categories = get_the_category($post_id);
    if (empty($categories)) {
        return array();
    }
    
    $category_ids = array();
    foreach ($categories as $category) {
        $category_ids[] = $category->term_id;
    }
    
    $args = array(
        'category__in'   => $category_ids,
        'post__not_in'   => array($post_id),
        'posts_per_page' => 5,
        'orderby'        => 'rand',
    );
    
    return new WP_Query($args);
}
