<?php
get_header();
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 * Template Name: Full Width Template
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ample Maagazine
 */



get_header();

?>

    <div id="content">
        <section class="block-wrapper">
            <div class="container">
                <div class="row">
                    <div id="primary" class="col-lg-12 col-md-12">

                        <main id="main" class="site-main">


                            <?php
                            while ( have_posts() ) : the_post();

                                get_template_part( 'template-parts/content', 'fullwidth' );

                                // If comments are open or we have at least one comment, load up the comment template.
                                if ( comments_open() || get_comments_number() ) :
                                    comments_template();
                                endif;

                            endwhile; // End of the loop.
                            ?>
                        </main><!-- #main -->

                    </div><!-- Content Col end -->


                </div><!-- Row end -->
            </div><!-- Container end -->
        </section><!-- First block end -->
    </div>


<?php

get_footer();

