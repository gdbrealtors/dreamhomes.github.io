<?php get_header();
$array = OSF_Custom_Post_Type_Portfolio::getInstance()->get_all_meta_field_value();
?>
    <div class="wrap">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">

                <div class="search-project">
                    <form action="<?php echo get_post_type_archive_link('osf_portfolio'); ?>" method="get">
                        <div class="d-flex justify-content-center project-group">
                            <div class="project-inner">
                                <label><?php echo esc_html__('Project Status', 'rehomes'); ?></label>
                                <select name="osf_portfolio_status">
                                    <option value=""><?php echo esc_html__('Any', 'rehomes'); ?></option>
                                    <?php
                                    foreach ($array['osf_portfolio_status'] as $item) {
                                        ?>
                                        <option value="<?php echo esc_attr($item); ?>" <?php echo esc_attr(isset($_GET['osf_portfolio_status']) && $item == $_GET['osf_portfolio_status'] ? 'selected' : ''); ?>><?php echo esc_html($item); ?></option>
                                        <?php
                                    }

                                    ?>
                                </select>
                            </div>
                            <div class="project-inner">
                                <label><?php echo esc_html__('Project Type', 'rehomes'); ?></label>
                                <select name="osf_portfolio_type">
                                    <option value=""><?php echo esc_html__('Any', 'rehomes'); ?></option>
                                    <?php
                                    foreach ($array['osf_portfolio_type'] as $item) {
                                        ?>
                                        <option value="<?php echo esc_attr($item); ?>" <?php echo esc_attr(isset($_GET['osf_portfolio_type']) && $item == $_GET['osf_portfolio_type'] ? 'selected' : ''); ?>><?php echo esc_html($item); ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="project-inner">
                                <label><?php echo esc_html__('Location', 'rehomes'); ?></label>
                                <select name="osf_portfolio_location">
                                    <option value=""><?php echo esc_html__('Any', 'rehomes'); ?></option>
                                    <?php
                                    foreach ($array['osf_portfolio_location'] as $item) {
                                        ?>
                                        <option value="<?php echo esc_attr($item); ?>" <?php echo esc_attr(isset($_GET['osf_portfolio_location']) && $item == $_GET['osf_portfolio_location'] ? 'selected' : ''); ?>><?php echo esc_html($item); ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="project-inner">
                                <label><?php echo esc_html__('Budget', 'rehomes'); ?></label>
                                <select name="osf_portfolio_budget">
                                    <option value=""><?php echo esc_html__('Any', 'rehomes'); ?></option>
                                    <?php
                                    $symbol = !empty(get_option('osf_portfolio_archive')['currency_symbol']) ? get_option('osf_portfolio_archive')['currency_symbol'] : '$';

                                    foreach ($arr = range(0, floatval($array['osf_portfolio_price_max']), floatval($array['osf_portfolio_price_max']) / 10) as $k => $number) {
                                        if ($k > 0) {
                                            ?>
                                            <option value="<?php echo esc_attr($arr[$k - 1] . '|' . $number); ?>" <?php echo isset($_GET['osf_portfolio_budget']) && esc_attr(($arr[$k - 1] . '|' . $number) == $_GET['osf_portfolio_budget'] ? 'selected' : ''); ?>><?php echo esc_html($symbol . $arr[$k - 1] . ' - ' . $symbol . $number); ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="project-inner align-self-end">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>


                <?php if (have_posts()) :
                    $column = get_theme_mod('osf_portfolio_archive_column', 3);
                    $style = get_theme_mod('osf_portfolio_archive_style', 'default');
                    echo '<div class="row isotope-grid elementor-portfolio-style-' . esc_attr($style) . '" data-elementor-columns="' . esc_attr($column) . '" data-elementor-columns-tablet="2" data-elementor-columns-mobile="1">';

                    global $portfolio_style;
                    $portfolio_style = $style;

                    while (have_posts()) : the_post();
                        ?>
                        <div class="column-item portfolio-entries">
                            <?php
                            if ($style == 'default1') {
                                get_template_part('template-parts/portfolio/content', '1');
                            } else {
                                get_template_part('template-parts/portfolio/content');
                            }
                            ?>
                        </div>
                    <?php
                    endwhile;
                    echo '</div>';
                    the_posts_pagination(array(
                        'prev_text'          => '<span class="opal-icon-chevron-left"></span><span class="screen-reader-text">' . esc_html__('Previous page', 'rehomes') . '</span>',
                        'next_text'          => '<span class="screen-reader-text">' . esc_html__('Next page', 'rehomes') . '</span><span class="opal-icon-chevron-right"></span>',
                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__('Page', 'rehomes') . ' </span>',
                    ));
                else :
                    get_template_part('template-parts/post/content', 'none');

                endif; ?>

            </main><!-- #main -->
        </div><!-- #primary -->
    </div><!-- .wrap -->

<?php get_footer();
