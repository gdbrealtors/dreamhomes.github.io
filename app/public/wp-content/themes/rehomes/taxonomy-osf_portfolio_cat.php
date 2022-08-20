<?php get_header(); ?>
    <div class="wrap">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">

                <?php if (have_posts()) :
                    $column = get_theme_mod('osf_portfolio_archive_column', 3);
                    $style = get_theme_mod('osf_portfolio_archive_style', 'default');
                    echo '<div class="row isotope-grid elementor-portfolio-style-' . esc_attr($style) . '" data-elementor-columns="' . esc_attr($column) . '" data-elementor-columns-tablet="2" data-elementor-columns-mobile="1">';

                    while (have_posts()) : the_post();
                        ?>
                        <div class="column-item portfolio-entries">
                            <?php
                            get_template_part('template-parts/portfolio/content');
                            ?>
                        </div>
                    <?php
                    endwhile;
                    the_posts_pagination(array(
                        'prev_text'          => '<span class="opal-icon-chevron-left"></span><span class="screen-reader-text">' . esc_html__('Previous page', 'rehomes') . '</span>',
                        'next_text'          => '<span class="screen-reader-text">' . esc_html__('Next page', 'rehomes') . '</span><span class="opal-icon-chevron-right"></span>',
                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__('Page', 'rehomes') . ' </span>',
                    ));
                    echo '</div>';
                else :
                    get_template_part('template-parts/post/content', 'none');

                endif; ?>

            </main><!-- #main -->
        </div><!-- #primary -->
    </div><!-- .wrap -->

<?php get_footer();
