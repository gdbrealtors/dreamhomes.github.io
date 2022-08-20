<article id="post-<?php the_ID(); ?>" <?php post_class('portfolio portfolio-style2'); ?>>
    <div class="portfolio-inner">
        <div class="portfolio-post-thumbnail">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('rehomes-featured-image-full'); ?>
            <?php endif; ?>
        </div><!-- .post-thumbnail -->
        <div class="portfolio-content">
            <div class="portfolio-content-inner">
                <?php
                $locations = get_post_meta(get_the_ID(), 'osf_portfolio_location', true);
                ?>
                <h4 class="entry-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
                <?php if(!empty($locations))?>

                <div class="entry-locations"><?php echo esc_html($locations) ?></div>

                <?php $entries = get_post_meta(get_the_ID(), 'osf_portfolio_repeat_group', true); ?>
                <?php if (!empty($entries)): ?>
                    <ul class="portfolio-list">
                        <?php if(!empty(get_post_meta(get_the_ID(), 'osf_portfolio_status', true))) echo '<li><label>' . esc_html__('Status ', 'rehomes') . '</label><p>' . esc_html(get_post_meta(get_the_ID(), 'osf_portfolio_status', true)) . '</p></li>'; ?>
                        <?php if(!empty(get_post_meta(get_the_ID(), 'osf_portfolio_area', true))) echo '<li><label>' . esc_html__('Area ', 'rehomes') . '</label><p>' . esc_html(get_post_meta(get_the_ID(), 'osf_portfolio_area', true)) . '</p></li>'; ?>
                        <?php if(!empty(get_post_meta(get_the_ID(), 'osf_portfolio_type', true))) echo '<li><label>' . esc_html__('Type ', 'rehomes') . '</label><p>' . esc_html(get_post_meta(get_the_ID(), 'osf_portfolio_type', true)) . '</p></li>'; ?>
                    </ul>
                <?php endif; ?>
            </div>


        </div>
    </div>
</article><!-- #post-## -->