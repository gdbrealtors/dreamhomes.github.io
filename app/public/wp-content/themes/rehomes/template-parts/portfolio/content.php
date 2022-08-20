<article id="post-<?php the_ID(); ?>" <?php post_class('portfolio'); ?>>
    <div class="portfolio-inner">
        <div class="portfolio-post-thumbnail">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('rehomes-featured-image-full'); ?>
            <?php endif; ?>
            <a class="thumbnail-overlay" href="<?php the_permalink() ?>"></a>
        </div><!-- .post-thumbnail -->
        <div class="portfolio-content">
            <?php
            global $portfolio_style;

            if ($portfolio_style == 'caption'):?>
                <div class="line"></div>
            <?php endif; ?>

            <div class="portfolio-content-inner">
                <?php $locations = get_post_meta(get_the_ID(), 'osf_portfolio_location', true); ?>
                <h2 class="entry-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
                <div class="entry-locations"><?php echo esc_html($locations) ?></div>
            </div>

        </div>
    </div>
</article><!-- #post-## -->