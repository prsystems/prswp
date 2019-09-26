<?php
/*
 * Template Name: Full Width No Title
 * @package prstheme
 */

get_header(); ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div id="primary" class="content-area">
                <main id="main" class="site-main">

					<?php
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content', 'no-title' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>

                </main><!-- #main -->
            </div><!-- #primary -->
        </div><!-- .col-12 -->
<?php
get_footer();