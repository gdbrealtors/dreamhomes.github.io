<?php
get_header(); ?>
    <div class="wrap">
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <?php if (get_theme_mod('osf_page_404_page_enable') != 'default' && !empty(get_theme_mod('osf_page_404_page_custom'))): ?>
                    <?php $query = new WP_Query('page_id=' . get_theme_mod('osf_page_404_page_custom'));
                    if ($query->have_posts()):
                        while ($query->have_posts()) : $query->the_post();
                            the_content();
                        endwhile;
                    endif; ?>
                <?php else: ?>
                    <section class="error-404 not-found">
                        <div class="page-content">
                            <div class="row">
                                <div class="col-12 error-404-content">
                                    <div class="error-content">
                                        <h2 class="error-subtitle p-0 m-0"><?php esc_html_e('It looks like you’re lost...', 'rehomes'); ?></h2>
                                        <h1 class="error-title p-0 m-0"><?php esc_html_e('404', 'rehomes'); ?></h1>
                                        <div class="error-text">
                                            <span><?php esc_html_e("It looks like nothing was found at this location. You can either go back to the last page or go to homepage.", 'rehomes') ?></span>
                                        </div>
                                        <div class="error-btn-bh">
                                            <a href="javascript: history.go(-1)"
                                               class="go-back"><?php esc_html_e('Go Back', 'rehomes'); ?>
                                                <i class="opal-icon-arrow-right"></i></i></a>
                                            <a href="<?php echo esc_url(home_url('/')); ?>"
                                               class="return-home"><?php esc_html_e('Homepage', 'rehomes'); ?>
                                                <i class="opal-icon-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .page-content -->
                    </section><!-- .error-404 -->
                <?php endif; ?>
            </main><!-- #main -->
        </div><!-- #primary -->
    </div><!-- .wrap -->
<?php get_footer();
