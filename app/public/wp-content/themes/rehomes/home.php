<?php
get_header(); ?>
    <div class="wrap">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" >
                <?php
                if (have_posts()) :
                    get_template_part('template-parts/'.get_post_type());

                    the_posts_pagination( array(
                        'prev_text'          => '<span class="opal-icon-chevron-left"></span><span class="screen-reader-text">' . esc_html__( 'Previous', 'rehomes' ) . '</span>',
                        'next_text'          => '<span class="screen-reader-text">' . esc_html__( 'Next', 'rehomes' ) . '</span><span class="opal-icon-chevron-right"></span>',
                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'rehomes' ) . ' </span>',
                    ) );
                else :
                    get_template_part( 'template-parts/post/content', 'none' );

                endif;
                ?>

            </main><!-- #main -->
        </div><!-- #primary -->
        <?php get_sidebar(); ?>
    </div><!-- .wrap -->

<?php get_footer();