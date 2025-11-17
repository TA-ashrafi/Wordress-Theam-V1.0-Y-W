<?php get_header(); ?>

<main class="site-main">
    <div class="container-main">
        <div class="row">
            <div class="col-lg-8">
                <?php
                while (have_posts()) : the_post();
                ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('single-post-content'); ?>>
                        <header class="entry-header">
                            <h1 class="entry-title"><?php the_title(); ?></h1>
                        </header>

                        <div class="entry-content">
                            <?php 
                            $content = get_the_content();
                            if (empty($content) || trim($content) === '') {
                                echo '<p>Here u can paste your content</p>';
                            } else {
                                the_content();
                            }
                            ?>
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

            <div class="col-lg-4">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
