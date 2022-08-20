<?php
get_header(); ?>

    <main id="main" class="site-main" role="main">
        <?php
        /* Start the Loop */
        while (have_posts()) : the_post();
            ?>
            <div class="row single-portfolio-row">
                <div class="col-12 single-portfolio-summary">
                    <div class="single-portfolio-summary-inner">

                        <ul class="single-portfolio-menu">
                            <li><a href="#overview"><?php echo esc_html__('Overview', 'rehomes'); ?></a></li>
                            <?php
                            $menu = get_post_meta(get_the_ID(), 'osf_portfolio_repeat_menu', true);
                            if (!empty($menu)) {
                                foreach ((array)$menu as $key => $entry) {
                                    $name = $link = '';
                                    if (isset($entry['menu_name'])) {
                                        $name = $entry['menu_name'];
                                    }
                                    if (isset($entry['menu_link'])) {
                                        $link = $entry['menu_link'];
                                    }
                                    echo '<li><a href="' . esc_attr($link) . '">' . esc_html($name) . '</a></li>';
                                }
                            }
                            ?>
                        </ul>


                        <div id="overview" class="w-100">
                            <h3 class="single-portfolio-summary-meta-title"><?php echo esc_html__('Overview', 'rehomes'); ?></h3>
                        </div>
                        <div class="single-portfolio-summary-meta row w-100">
                            <div class="col-xl-9 col-12">
                                <div class="row">
                                    <?php if (has_post_thumbnail()) {
                                        ?>
                                        <div class="col-xl-6 col-12 pt-3">
                                            <?php the_post_thumbnail('rehomes-gallery-image') ?>
                                        </div>
                                        <div class="col-xl-6 col-12"><div class="px-xl-3"><?php echo wpautop(get_post_meta(get_the_ID(), 'osf_portfolio_overview', true)); ?></div></div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="col-12"><?php echo wpautop(get_post_meta(get_the_ID(), 'osf_portfolio_overview', true)); ?></div>
                                        <?php
                                    } ?>
                                </div>
                            </div>
                            <div class="col-xl-3 col-12">
                                <ul class="single-portfolio-summary-meta-list">
                                    <?php if(!empty(get_post_meta(get_the_ID(), 'osf_portfolio_status', true))) echo '<li><span class="meta-title">' . esc_html__('Status ', 'rehomes') . '</span><span class="meta-value">' . esc_html(get_post_meta(get_the_ID(), 'osf_portfolio_status', true)) . '</span></li>'; ?>
                                    <?php if(!empty(get_post_meta(get_the_ID(), 'osf_portfolio_area', true))) echo '<li><span class="meta-title">' . esc_html__('Area ', 'rehomes') . '</span><span class="meta-value">' . esc_html(get_post_meta(get_the_ID(), 'osf_portfolio_area', true)) . '</span></li>'; ?>
                                    <?php if(!empty(get_post_meta(get_the_ID(), 'osf_portfolio_location', true))) echo '<li><span class="meta-title">' . esc_html__('Location ', 'rehomes') . '</span><span class="meta-value">' . esc_html(get_post_meta(get_the_ID(), 'osf_portfolio_location', true)) . '</span></li>'; ?>
                                    <?php if(!empty(get_post_meta(get_the_ID(), 'osf_portfolio_type', true))) echo '<li><span class="meta-title">' . esc_html__('Type ', 'rehomes') . '</span><span class="meta-value">' . esc_html(get_post_meta(get_the_ID(), 'osf_portfolio_type', true)) . '</span></li>'; ?>
                                    <?php
                                    $entries = get_post_meta(get_the_ID(), 'osf_portfolio_repeat_group', true);
                                    foreach ((array)$entries as $key => $entry) {
                                        $title = $desc = '';
                                        if (isset($entry['title'])) {
                                            $title = $entry['title'];
                                        }
                                        if (isset($entry['description'])) {
                                            $desc = $entry['description'];
                                        }
                                        echo '<li><span class="meta-title">' . esc_html($title) . '</span><span class="meta-value">' . esc_html($desc) . '</span></li>';
                                    }
                                    ?>
                                    <?php
                                    $symbol = !empty(get_option('osf_portfolio_archive')['currency_symbol']) ? get_option('osf_portfolio_archive')['currency_symbol'] : '$';
                                    if(!empty(get_post_meta(get_the_ID(), 'osf_portfolio_price_min', true)) && !empty(get_post_meta(get_the_ID(), 'osf_portfolio_price_max', true))) echo '<li><span class="meta-title">' . esc_html__('Price Range ', 'rehomes') . '</span><span class="meta-value">' . esc_html($symbol) . restyle_text(get_post_meta(get_the_ID(), 'osf_portfolio_price_min', true)) . ' - ' . esc_html($symbol) . restyle_text(get_post_meta(get_the_ID(), 'osf_portfolio_price_max', true)) . '</span></li>'; ?>
                                </ul>
                            </div>
                        </div>
                        <div class="single-portfolio-summary-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        endwhile; // End of the loop.
        ?>

    </main><!-- #main -->

<?php get_footer();
